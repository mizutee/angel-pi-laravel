<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TeacherController extends Controller
{
    public function getTeachersInfo() {
        $user = auth()->user();
        if (!$user) {
            return redirect('/login');
        }
        $teachers = User::with('subject')->where('role', 'teacher')->get();
        $subjects = Subject::all();

        return view('teacherlist', ['teachers' => $teachers, 'subjects' => $subjects, 'user' => $user]);
    }

    public function editTeacherInfo(Request $request, $id) {
        $teacher = User::findOrFail($id);
        $teacher->fill($request->all()); // Fill the model with all request data
        $teacher->save(); // Save the changes
    
        // Redirect to the /admin/teacher route with a success message
        return redirect('/admin/teacher')->with('success', 'Teacher updated successfully.');
    }

    public function addTeacher(Request $request) {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:15',
            'subject_id' => 'required|exists:subjects,id', // Ensure the subject exists
            'address' => 'required|string'
        ]);
    
        // Create a new teacher instance
        $teacher = new User();
        $teacher->name = $request->input('name');
        $teacher->email = $request->input('email');
        $teacher->dob = $request->input('dob');
        $teacher->gender = $request->input('gender');
        $teacher->password = bcrypt('123456'); // Hash the password
        $teacher->phone_number = $request->input('phone_number');
        $teacher->subject_id = $request->input('subject_id'); // Set the subject ID
        $teacher->role = 'teacher'; // Set the default role to teacher
        $teacher->address = $request->input('address');
        // Set other fields as needed
        $teacher->save(); // Save the new teacher to the database
    
        // Redirect to the /admin/teacher route with a success message
        return redirect('/admin/teacher')->with('success', 'Teacher added successfully.');
    }

    public function deleteTeacher($id) {
        $teacher = User::findOrFail($id);
        $teacher->delete();

        return redirect('/admin/teacher')->with('success', 'teacher deleted successfully.');
    }

    public function getTeacherSurvey() {
        $user = auth()->user();
    
        $query = Answer::join('questions', 'answers.question_id', '=', 'questions.id')
            ->join('types', 'questions.type_id', '=', 'types.id')
            ->select(
                'types.name as type', 
                'questions.question as question',
                DB::raw('COUNT(DISTINCT answers.student_id) as total_students'),
                DB::raw('COUNT(CASE WHEN answers.experience_value = 1 THEN 1 END) as exp_1'),
                DB::raw('COUNT(CASE WHEN answers.experience_value = 2 THEN 1 END) as exp_2'),
                DB::raw('COUNT(CASE WHEN answers.experience_value = 3 THEN 1 END) as exp_3'),
                DB::raw('COUNT(CASE WHEN answers.experience_value = 4 THEN 1 END) as exp_4'),
                DB::raw('COUNT(CASE WHEN answers.experience_value = 5 THEN 1 END) as exp_5'),
                DB::raw('COUNT(CASE WHEN answers.expectation_value = 1 THEN 1 END) as expc_1'),
                DB::raw('COUNT(CASE WHEN answers.expectation_value = 2 THEN 1 END) as expc_2'),
                DB::raw('COUNT(CASE WHEN answers.expectation_value = 3 THEN 1 END) as expc_3'),
                DB::raw('COUNT(CASE WHEN answers.expectation_value = 4 THEN 1 END) as expc_4'),
                DB::raw('COUNT(CASE WHEN answers.expectation_value = 5 THEN 1 END) as expc_5')
            )
            ->where('answers.teacher_id', $user->id)
            ->groupBy('types.name', 'questions.question');
    
        // Execute the query
        $surveyResults = $query->get();

        $totalStudents = $surveyResults->isNotEmpty() ? $surveyResults->first()->total_students : 0;
    
        // Initialize total counts
        $totalExperienceCounts = ["1" => 0, "2" => 0, "3" => 0, "4" => 0, "5" => 0];
        $totalExpectationCounts = ["1" => 0, "2" => 0, "3" => 0, "4" => 0, "5" => 0];

        // Sum all experience values
        foreach ($surveyResults as $item) {
            $totalExperienceCounts["1"] += $item->exp_1;
            $totalExperienceCounts["2"] += $item->exp_2;
            $totalExperienceCounts["3"] += $item->exp_3;
            $totalExperienceCounts["4"] += $item->exp_4;
            $totalExperienceCounts["5"] += $item->exp_5;
        }

        foreach ($surveyResults as $item) {
            $totalExpectationCounts["1"] += $item->expc_1;
            $totalExpectationCounts["2"] += $item->expc_2;
            $totalExpectationCounts["3"] += $item->expc_3;
            $totalExpectationCounts["4"] += $item->expc_4;
            $totalExpectationCounts["5"] += $item->expc_5;
        }

        // Calculate total responses
        $totalExperienceSum = array_sum($totalExperienceCounts);
        $totalExpectationSum = array_sum($totalExpectationCounts);

        // Calculate percentages
        $experiencePercentages = [];
        foreach ($totalExperienceCounts as $key => $count) {
            $experiencePercentages[$key] = $totalExperienceSum > 0 ? round(($count / $totalExperienceSum) * 100, 2) : 0;
        }

        $expectationPercentages = [];
        foreach ($totalExpectationCounts as $key => $count) {
            $expectationPercentages[$key] = $totalExpectationSum > 0 ? round(($count / $totalExpectationSum) * 100, 2) : 0;
        }

        // Total experience summary
        $totalExperienceSummary = [
            "total_counts" => $totalExperienceCounts,
            "total_responses" => $totalExperienceSum,
            "percentages" => $experiencePercentages
        ];

        $totalExpectationSummary = [
            "total_counts" => $totalExpectationCounts,
            "total_responses" => $totalExpectationSum,
            "percentages" => $expectationPercentages
        ];
    
        // Transform results into grouped format with percentages
        $formattedResults = $surveyResults->groupBy('type')->map(function ($group, $type) {
            return [
                'type' => $type,
                'questions' => $group->map(function ($item) {
                    $totalExperience = $item->exp_1 + $item->exp_2 + $item->exp_3 + $item->exp_4 + $item->exp_5;
                    $totalExpectation = $item->expc_1 + $item->expc_2 + $item->expc_3 + $item->expc_4 + $item->expc_5;
                    
                    return [
                        'question' => $item->question,
                        'average' => number_format((($item->exp_1 * 1) + ($item->exp_2 * 2) + ($item->exp_3 * 3) + ($item->exp_4 * 4) + ($item->exp_5 * 5))  / ($item->exp_1 + $item->exp_2 + $item->exp_3 + $item->exp_4 + $item->exp_5), 2),
                        'experience' => [
                            "1" => [
                                "count" => $item->exp_1,
                                "percentage" => $totalExperience > 0 ? round(($item->exp_1 / $totalExperience) * 100, 2) : 0
                            ],
                            "2" => [
                                "count" => $item->exp_2,
                                "percentage" => $totalExperience > 0 ? round(($item->exp_2 / $totalExperience) * 100, 2) : 0
                            ],
                            "3" => [
                                "count" => $item->exp_3,
                                "percentage" => $totalExperience > 0 ? round(($item->exp_3 / $totalExperience) * 100, 2) : 0
                            ],
                            "4" => [
                                "count" => $item->exp_4,
                                "percentage" => $totalExperience > 0 ? round(($item->exp_4 / $totalExperience) * 100, 2) : 0
                            ],
                            "5" => [
                                "count" => $item->exp_5,
                                "percentage" => $totalExperience > 0 ? round(($item->exp_5 / $totalExperience) * 100, 2) : 0
                            ],
                        ],
                        'expectation' => [
                            "1" => [
                                "count" => $item->expc_1,
                                "percentage" => $totalExpectation > 0 ? round(($item->expc_1 / $totalExpectation) * 100, 2) : 0
                            ],
                            "2" => [
                                "count" => $item->expc_2,
                                "percentage" => $totalExpectation > 0 ? round(($item->expc_2 / $totalExpectation) * 100, 2) : 0
                            ],
                            "3" => [
                                "count" => $item->expc_3,
                                "percentage" => $totalExpectation > 0 ? round(($item->expc_3 / $totalExpectation) * 100, 2) : 0
                            ],
                            "4" => [
                                "count" => $item->expc_4,
                                "percentage" => $totalExpectation > 0 ? round(($item->expc_4 / $totalExpectation) * 100, 2) : 0
                            ],
                            "5" => [
                                "count" => $item->expc_5,
                                "percentage" => $totalExpectation > 0 ? round(($item->expc_5 / $totalExpectation) * 100, 2) : 0
                            ],
                        ]
                    ];
                })->values()
            ];
        })->values();
    
        return view('teachersurvey', [
            'user' => $user,
            'total_students' => $totalStudents,
            'total_experience_summary' => $totalExperienceSummary,
            'total_expectation_summary' => $totalExpectationSummary,
            'result' => $formattedResults,
        ]);
    }

    
    
}
