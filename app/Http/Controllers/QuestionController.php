<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Type;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function getQuestionsInfo() {
        $user = auth()->user();
        if (!$user) {
            return redirect('/login');
        }
        $questions = Question::with('type')->get();
        $types = Type::all();
        return view('questionlist', ['questions' => $questions, 'types' => $types, 'user' => $user]);
    }

    public function editQuestionInfo(Request $request, $id) {
        // Validate the incoming request data
        $request->validate([
            'question' => 'required|string|max:255',
            'type_id' => 'required|integer', // Ensure this matches your database schema
        ]);
    
        // Find the question by ID
        $question = Question::findOrFail($id);
    
        // Update the question with the new data
        $question->question = $request->input('question');
        $question->type_id = $request->input('type_id');
    
        // Save the changes
        $question->save();
    
        // Redirect to the /admin/question route with a success message
        return redirect('/admin/question')->with('success', 'Question updated successfully.');
    }
    
    public function deleteQuestion($id) {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect('/admin/question')->with('success', 'Question deleted successfully.');
    }

    public function addQuestion(Request $request) {
        $request->validate([
            'question' => 'required|string|max:255',
            'type_id' => 'required|integer'
        ]);

        $question = new Question();
        $question->question = $request->input('question');
        $question->type_id = $request->input('type_id');

        $question->save();

        return redirect('/admin/question')->with('success', 'Question added successfully.');
    }
}
