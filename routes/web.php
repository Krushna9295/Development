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

Route::get('/', function () {
    return view('auth/login');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dash/dash');
// })->name('dashboard');

Route::get('/dashboard',['middleware' => 'auth', 'uses' => 'App\Http\Controllers\HomeController@index'])->name('dashboard');
Route::get('/dash', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\DashController@index'])->name('dash.dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/dash', 'App\Http\Controllers\Dash@index')->name('dash');
//Student
// Route::get('student/list', 'App\Http\Controllers\StudentController@index')->name('student.list');
Route::get('student/list', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\StudentController@index'])->name('student.list');
// Route::get('student/create', 'App\Http\Controllers\StudentController@create')->name('student.create');
Route::get('student/create', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\StudentController@create'])->name('student.create');
Route::post('student/store', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\StudentController@store'])->name('student.store');
Route::get('student/edit/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\StudentController@edit'])->name('student.edit');
Route::patch('/student/update/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\StudentController@update'])->name('student.update');
Route::get('/student/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\StudentController@show'])->name('student.view');
Route::patch('/student/destroy/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\StudentController@destroy'])->name('student.destroy');
//Hospital
Route::get('hospital/list', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\HospitalController@index'])->name('hospital.list');
Route::get('hospital/create', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\HospitalController@create'])->name('hospital.create');
Route::post('hospital/store', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\HospitalController@store'])->name('hospital.store');
Route::get('hospital/edit/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\HospitalController@edit'])->name('hospital.edit');
Route::patch('/hospital/edit/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\HospitalController@update'])->name('hospital.update');
Route::get('/hospital/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\HospitalController@show'])->name('hospital.view');
Route::patch('/hospital/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\HospitalController@destroy'])->name('hospital.destroy');

//User
Route::get('user/list', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\UserController@index'])->name('user.list');
Route::get('user/create', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\UserController@create'])->name('user.create');
Route::post('user/store', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\UserController@store'])->name('user.store');
Route::get('user/edit/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\UserController@edit'])->name('user.edit');
Route::patch('/user/edit/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\UserController@update'])->name('user.update');
Route::get('/user/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\UserController@show'])->name('user.view');
Route::patch('/user/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\UserController@destroy'])->name('user.destroy');
Route::get('/fetch_clg_ref_id/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\UserController@fetch_clg_ref_id'])->name('fetch_clg_ref_id');

Route::get('/get_state_as_per_name/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\CommanController@get_state_as_per_name'])->name('state.get');
Route::get('/get_city_as_per_name/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\CommanController@get_city_as_per_name'])->name('city.get');
Route::get('/get_district_as_per_name/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\CommanController@get_district_as_per_name'])->name('district.get');
Route::get('/get_tahshil_as_per_name/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\CommanController@get_tahshil_as_per_name'])->name('tahshil.get');
Route::post('/get_district_state', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\CommanController@get_district_state']);
Route::post('/get_tahsil_district', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\CommanController@get_tahsil_district']);
Route::post('/get_city_tahsil', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\CommanController@get_city_tahsil']);
Route::post('/get_po_as_per_atc', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\CommanController@get_po_as_per_atc']);

Route::get('image-upload1', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\ImageUploadController@imageUpload'])->name('image.upload');
Route::post('image-upload', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\ImageUploadController@imageUploadPost'])->name('image.upload.post');
Route::post('/calls/save_call_details', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\CallsController@save_call_details'])->name('calls.save_call_details');;




