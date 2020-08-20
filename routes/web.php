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

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
Route::get('/dashboard/posts', 'DashboardController@posts');
Route::get('/dashboard/comments', 'DashboardController@comments');
Route::get('/dashboard/likes', 'DashboardController@likes');
Route::get('/dashboard/dislikes', 'DashboardController@dislikes');
Route::get('/dashboard/settings', 'DashboardController@settings');
Route::post('/dashboard/settings', 'DashboardController@saveSettings')->name('saveSettings');;

Route::resource('posts', 'PostsController');

Route::post('comment/create/{post_id}', 'CommentsController@store')->name('createComment');

Route::post('comment/delete/{comment_id}', 'CommentsController@destroy')->name('deleteComment');

Route::get('/like/create/{post_id}/{val}', 'LikesController@store');
Route::get('/like/update/{post_id}', 'LikesController@update');
Route::get('/like/delete/{post_id}', 'LikesController@destroy');