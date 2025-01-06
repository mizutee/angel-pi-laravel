<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;

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
        return view('teachersurvey', ['user' => $user]);
    }
}
