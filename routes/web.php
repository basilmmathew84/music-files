<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('lang/{locale}', 'HomeController@lang');

Route::get('/', function () {
    return redirect()->route('home');
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
//Route::get('/email', 'EmailsController@index')->name('email');
/*
Route::get('send-mail', function () {

    $email = ['message' => 'This is a test!'];
    \Mail::to('anishkmathew@gmail.com')->send(new \App\Mail\TestEmail($email));

    dd("Email is Sent.");
}); */
//Route::get("send-email", 'EmailController@sendEmail')->name('first.email');
Route::group([
    'middleware' => ['permission:view users'],
    'prefix' => 'users',
], function () {
    Route::get('/', 'UsersController@index')
        ->name('users.user.index');
    Route::get('/create', 'UsersController@create')
        ->name('users.user.create');
    Route::get('/show/{user}', 'UsersController@show')
        ->name('users.user.show');
    Route::get('/{user}/edit', 'UsersController@edit')
        ->name('users.user.edit');
    Route::post('/', 'UsersController@store')
        ->name('users.user.store');
    Route::put('user/{user}', 'UsersController@update')
        ->name('users.user.update');
    Route::delete('/user/{user}', 'UsersController@destroy')
        ->name('users.user.destroy');
});

Route::group([
<<<<<<< HEAD
    'middleware' => ['permission:view settings'],
    'prefix' => 'settings',
], function () {
    Route::get('/', 'SettingsController@index')
        ->name('settings.settings.index');   
    Route::get('/{settings}/edit', 'SettingsController@edit')
            ->name('settings.settings.edit'); 
    Route::put('settings/{settings}', 'SettingsController@update')
            ->name('settings.settings.update');
       
   
});
Route::group([
    'middleware' => ['permission:view courses'],
    'prefix' => 'courses',
], function () {
    Route::get('/', 'CoursesController@index')
        ->name('courses.course.index');
    Route::get('/create', 'CoursesController@create')
        ->name('courses.course.create');
    Route::get('/{course}/edit', 'CoursesController@edit')
        ->name('courses.course.edit');
   Route::post('/', 'CoursesController@store')
        ->name('courses.course.store');
    Route::put('courses/{course}', 'CoursesController@update')
        ->name('courses.course.update');
    Route::delete('/course/{course}', 'CoursesController@destroy')
        ->name('courses.course.destroy');
       
 
   
=======
    'middleware' => ['permission:view users'],
    'prefix' => 'students',
], function () {
    Route::get('/students', 'StudentsController@index')
        ->name('students.student.index');
    Route::get('/create', 'StudentsController@create')
        ->name('students.student.create');
    Route::get('/show/{student}', 'StudentsController@show')
        ->name('students.student.show');
    Route::get('/{student}/edit', 'StudentsController@edit')
        ->name('students.student.edit');
    Route::post('/', 'StudentsController@store')
        ->name('students.student.store');
    Route::put('student/{student}', 'StudentsController@update')
        ->name('students.student.update');
    Route::delete('/student/{student}', 'StudentsController@destroy')
        ->name('students.student.destroy');
>>>>>>> a8c6f2d0a54d7dc5cae284a52a9b31dde20c5d97
});
