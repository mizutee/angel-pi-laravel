<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StudentController;

Route::get('/login', function () {
    $user = auth()->user();
    if ($user) {
        return redirect('/');
    }
    return view('login');
})->name('login');
Route::post('/login', [UserController::class, 'loginUser']);

Route::get('/register', function () {
    $user = auth()->user();
    if ($user) {
        return redirect('/');
    }
    return view('register');
});
Route::post('/register', [UserController::class, 'registerUser']);


Route::middleware(['auth'])->group(function () {
    Route::get('/', function() {
        $user = auth()->user();
        if (!$user) {
            return redirect('/login');
        }
        return view('home', ['user' => $user]);
    });

    Route::get('/admin/teacher', [TeacherController::class, 'getTeachersInfo']);
    Route::put('/admin/teacher/{id}', [TeacherController::class, 'editTeacherInfo'])->name('teacher.update');
    Route::get('/admin/teacher/{id}/download', [TeacherController::class, 'downloadTeacherReport'])->name('teacher.download');
    Route::post('/admin/teacher', [TeacherController::class, 'addTeacher'])->name('teacher.add');
    Route::delete('/admin/teacher/{id}', [TeacherController::class, 'deleteTeacher'])->name('teacher.delete');
    Route::get('/admin/teacher/overall', [TeacherController::class, 'showOverallScores'])->name('teacher.overall');
    Route::get('/admin/teacher/download', [TeacherController::class, 'downloadOverallScores'])->name('teacher.overall.download');

    Route::get('/admin/student', [StudentController::class, 'getStudentsInfo'])->name('students.list');
    Route::put('/admin/student/{id}', [StudentController::class, 'editStudentInfo'])->name('student.update');
    Route::post('/admin/student', [StudentController::class, 'addStudent'])->name('student.add');
    Route::delete('/admin/student/{id}', [StudentController::class, 'deleteStudent'])->name('student.delete');
    
    Route::get('/admin/question', [QuestionController::class, 'getQuestionsInfo']);
    Route::post('/admin/question', [QuestionController::class, 'addQuestion'])->name('question.add');
    Route::put('/admin/question/{id}', [QuestionController::class, 'editQuestionInfo'])->name('question.update');
    Route::delete('/admin/question/{id}', [QuestionController::class, 'deleteQuestion'])->name('question.delete');

    Route::get('/student/myclass', [StudentController::class, 'getStudentClasses']);
    Route::get('/student/survey', [StudentController::class, 'getStudentSurvey']);
    Route::post('/student/survey', [StudentController::class, 'submitStudentSurvey'])->name('survey.submit');

    Route::get('/teacher/survey', [TeacherController::class, 'getTeacherSurvey'])->name('teacher.survey');

    Route::post('/logout', [UserController::class, 'logoutUser'])->name('user.logout');
});