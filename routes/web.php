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
//patient
// Route::get('patient/list', 'App\Http\Controllers\PatientController@index')->name('patient.list');
Route::get('patient/list', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\PatientController@index'])->name('patient.list');
// Route::get('patient/create', 'App\Http\Controllers\PatientController@create')->name('patient.create');
Route::get('patient/create', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\PatientController@create'])->name('patient.create');
Route::post('patient/store', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\PatientController@store'])->name('patient.store');
Route::get('patient/edit/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\PatientController@edit'])->name('patient.edit');
Route::patch('/patient/update/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\PatientController@update'])->name('patient.update');
Route::get('/patient/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\PatientController@show'])->name('patient.view');
Route::patch('/patient/destroy/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\PatientController@destroy'])->name('patient.destroy');
Route::get('/patient/follow_up_create/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\PatientController@follow_up_create'])->name('patient.follow_up_create');
Route::post('/patient/follow_up_store', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\PatientController@follow_up_store'])->name('patient.follow_up_store');
Route::get('/patient/follow_up_view/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\PatientController@follow_up_view'])->name('patient.follow_up_view');

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

Route::get('/calls/manage_addr', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\CallsController@manage_addr'])->name('calls.manage_addr');

//Panchayat Samiti
Route::get('panchayat/list', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\PanchayatController@index'])->name('panchayat.list');
Route::get('panchayat/create', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\PanchayatController@create'])->name('panchayat.create');
Route::post('panchayat/store', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\PanchayatController@store'])->name('panchayat.store');
Route::get('panchayat/edit/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\PanchayatController@edit'])->name('panchayat.edit');
Route::patch('/panchayat/edit/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\PanchayatController@update'])->name('panchayat.update');
Route::get('/panchayat/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\PanchayatController@show'])->name('panchayat.view');
Route::patch('/panchayat/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\PanchayatController@destroy'])->name('panchayat.destroy');

Route::get('feedback/list', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\FeedbackController@index'])->name('feedback.list');
Route::get('feedback/create/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\FeedbackController@create'])->name('feedback.create');
Route::post('feedback/store', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\FeedbackController@store'])->name('feedback.store');
Route::get('/feedback/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\FeedbackController@show'])->name('feedback.view');

//Upload
Route::get('/upload/create/', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\UploadPatientDataController@create'])->name('upload.create');
Route::post('/upload/store/', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\UploadPatientDataController@store'])->name('upload.store');

//Home Isolation
Route::get('/isolation/follow_up_create/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\HomeIsolationController@follow_up_create'])->name('isolation.follow_up_create');
Route::post('/isolation/follow_up_store', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\HomeIsolationController@follow_up_store'])->name('isolation.follow_up_store');
Route::get('/isolation/follow_up_view/{_id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\HomeIsolationController@follow_up_view'])->name('isolation.follow_up_view');