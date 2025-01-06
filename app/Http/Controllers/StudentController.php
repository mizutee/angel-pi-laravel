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
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'teacher_id' => 'required|integer',
            // Dynamically validate that all question IDs are present
        ]);

        $questions = Question::all();
        $totalQuestions = $questions->count(); // Total number of questions
    
        // Count the number of answered questions
        $answeredQuestions = 0;
    
        foreach ($questions as $question) {
            if ($request->has($question->id)) {
                $answeredQuestions++;
            }
        }
    
        // Check if all questions have been answered
        if ($answeredQuestions !== $totalQuestions) {
            return redirect()->back()->withErrors(['message' => 'Please answer all questions before submitting.'])->withInput();
        }

        // Prepare the data for bulk insertion
        $answers = [];
        $teacherId = $request->input('teacher_id');
        $studentId = auth()->id(); // Assuming you have the student ID from the authenticated user

        foreach ($request->except(['_token', 'teacher_id']) as $questionId => $answerValue) {
            $answers[] = [
                'question_id' => $questionId,
                'student_id' => $studentId,
                'teacher_id' => $teacherId,
                'answer_value' => $answerValue,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Bulk insert the answers into the database
        Answer::insert($answers);

        // Redirect or return a response
        return redirect()->back()->with('success', 'Survey submitted successfully!');
    }
}
