<?php

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

/* Route::get('/', function () {
    return view('welcome');
}); */


Route::get('/aktivasi/{encryptedurl}', 'MainController@aktivasi');

Route::get('/member/event/{event_id}/peserta', 'UsersController@peserta');
Route::get('/member/event/participant/{peserta_id}/detail', 'UsersController@pesertadetail');
Route::get('/member/event/participant/{peserta_id}/accept', 'UsersController@pesertaaccept');
Route::post('/member/event/participant/{peserta_id}/reject', 'UsersController@pesertareject');

Route::get('/upcoming', 'MainController@upcoming');
Route::get('/create/hackathon', 'UsersController@createevent')->middleware('member');
Route::get('/member/mainpage', 'UsersController@index')->middleware('member');
Route::get('/member/event/{event_id}/hapus', 'UsersController@event_hapus')->middleware('member');
Route::get('/member/event/{event_id}/edit', 'UsersController@event_edit')->middleware('member');
Route::get('/member/event', 'UsersController@event')->middleware('member');
Route::get('/member/createhackathon', 'UsersController@createevent')->middleware('member');
Route::post('/member/createhackathon', 'UsersController@createevent_post')->middleware('member');
Route::post('/member/edithackathon', 'UsersController@editevent_post')->middleware('member');
Route::get('/member/login', 'UsersController@login');
Route::get('/member/logout', 'UsersController@logout');
Route::get('/aktivasi/member/{encryptedurl}', 'UsersController@aktivasi_member');


Route::get('/member/project/{team_id}/detail', 'UsersController@project_detail')->middleware('member');
Route::get('/member/project/{team_id}/edit', 'UsersController@project_edit')->middleware('member');
Route::get('/member/project/{team_id}/delete', 'UsersController@project_delete')->middleware('member');
Route::post('/member/project/{team_id}/edit', 'UsersController@project_edit_post')->middleware('member');
Route::get('/member/project', 'UsersController@project')->middleware('member');

Route::post('/member/reset/{encryptedurl}', 'UsersController@reset_password_done');
Route::get('/member/reset/{encryptedurl}', 'UsersController@reset_password_form');
Route::post('/member/reset_password', 'UsersController@reset_password');
Route::get('/member/forget_password', 'UsersController@forget_password');
Route::get('/member/update_password', 'UsersController@update_password');
Route::post('/member/signup', 'UsersController@signup');
Route::post('/member/validate', 'UsersController@validateit');

/* Route::post('/api/openid/{provider}', 'ApiController@openid');
Route::post('/api/openid', 'ApiController@openid'); */

Route::get('/social/auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('/social/auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::post('/', 'MainController@index_post')->middleware('mainmid');
Route::get('/{slug}','MainController@index')->middleware('mainmid');
Route::post('/{slug}','MainController@index_post')->middleware('mainmid');
Route::get('/', 'MainController@index')->middleware('mainmid');