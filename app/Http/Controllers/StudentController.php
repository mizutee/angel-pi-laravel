<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Question;
use App\Models\User;
use App\Models\Answer;

class StudentController extends Controller
{
    //
    public function getStudentClasses() {
        $user = auth()->user();
        if (!$user) {
            return redirect('/login');
        }
        return view('studentclass', ['user' => $user]);
    }

    public function getStudentsInfo() {
        $user = auth()->user();
        if (!$user) {
            return redirect('/login');
        }
        $students = User::where('role', 'student')->get();

        return view('studentlist', ['students' => $students, 'user' => $user]);
    }

    public function getStudentSurvey() {
        $user = auth()->user();
        if (!$user) {
            return redirect('/login');
        };
        $teachers = User::with('subject')->where('role', 'teacher')->get();
        $questions = Question::with('type')->get();

        $groupedQuestion = $questions->groupBy(function ($question) {
            return $question->type->name;
        });

        return view('studentsurvey', ['user' => $user, 'groupedQuestions' => $groupedQuestion, 'teachers' => $teachers]);
    }

    public function submitStudentSurvey(Request $request) {
        \Log::info('Survey form submitted', $request->all()); // Debugging
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'teacher_id' => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $questions = Question::all();
        $totalQuestions = $questions->count(); // Total number of questions
        
        // Check if all experience and expectation answers are provided
        $unansweredQuestions = collect($questions)->filter(function ($question) use ($request) {
            return !$request->has("experience_{$question->id}") || !$request->has("expectation_{$question->id}");
        });
    
        if ($unansweredQuestions->isNotEmpty()) {
            return redirect()->back()->withErrors(['message' => 'Please answer all questions before submitting.'])->withInput();
        }
    
        // Prepare the data for bulk insertion
        $answers = [];
        $teacherId = $request->input('teacher_id');
        $studentId = auth()->id(); // Assuming you have the student ID from the authenticated user
    
        foreach ($questions as $question) {
            $answers[] = [
                'question_id' => $question->id,
                'student_id' => $studentId,
                'teacher_id' => $teacherId,
                'experience_value' => $request->input("experience_{$question->id}"), // Experience
                'expectation_value' => $request->input("expectation_{$question->id}"), // Expectation
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    
        // Bulk insert the answers into the database
        Answer::insert($answers);
    
        // Redirect with success message
        return redirect()->back()->with('success', 'Survey submitted successfully!');
    }
    

    public function editStudentInfo(Request $request, $id) {
        $student = User::findOrFail($id);
        $student->fill($request->all()); // Fill the model with all request data
        $student->save(); // Save the changes
    
        // Redirect to the /admin/teacher route with a success message
        return redirect('/admin/student')->with('success', 'Student updated successfully.');
    }

    public function addStudent(Request $request) {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string'
        ]);
    
        // Create a new Student instance
        $student = new User();
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->dob = $request->input('dob');
        $student->gender = $request->input('gender');
        $student->password = bcrypt('123456'); // Hash the password
        $student->phone_number = $request->input('phone_number');
        $student->role = 'student'; // Set the default role to student
        $student->address = $request->input('address');
        // Set other fields as needed
        $student->save(); // Save the new student to the database
    
        // Redirect to the /admin/student route with a success message
        return redirect('/admin/student')->with('success', 'Student added successfully.');
    }

    public function deleteStudent($id) {
        $student = User::findOrFail($id);
        $student->delete();

        return redirect('/admin/student')->with('success', 'Student deleted successfully.');
    }
}
