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

Auth::routes();


Route::get('/','WebsiteController@Home');
Route::get('/search','WebsiteController@search');

Route::get('/aboutUs','WebsiteController@aboutUs');
Route::get('/contactus','WebsiteController@contactUs');
Route::get('/privacy','WebsiteController@privacy');
Route::get('/share_with_us','WebsiteController@share_with_us');

Route::post('/ContactusForm','WebsiteController@ContactusForm');

Route::get('/exams','WebsiteController@exams');
Route::get('/exams/{slug}','WebsiteController@examsSection');
Route::get('/exams/{id}/{slug}','WebsiteController@examsSingle');

Route::prefix('news')->group(function () {
  Route::get('/{slug}','WebsiteController@NewsSection');
  Route::get('{id}/{slug}','WebsiteController@NewsSingle');
});

Route::prefix('articles')->group(function () {
  Route::get('/','WebsiteController@Articles');
  Route::get('/{slug}','WebsiteController@ArticlesSection');
  Route::get('{id}/{slug}','WebsiteController@ArticlesSingle');
});

Route::get('files/{id}/{slug}','WebsiteController@filesSingle');
Route::get('files','WebsiteController@filesSection');
Route::get('tags/{slug}','WebsiteController@tags');

Route::group(['prefix' => 'dashboard','middleware'=>'roles','roles'=>[1,2,3,4]], function () {

    Route::get('/','DashboardController@index');
    Route::resource('image','ImagesController');
    Route::resource('keywords','KeywordsController');
    Route::resource('news','NewsController');
    Route::resource('articles','ArticlesController');
    Route::resource('question','QuestionController');
    Route::resource('exam','ExamController');
    Route::post('image/saveAlbum','ImagesController@saveAlbum');
});


Route::group(['prefix' => 'dashboard','middleware'=>'roles','roles'=>[1,2]], function () {

    Route::post('socailMedia','NewsController@socailMedia');
    Route::resource('roles','RolesController');
    Route::resource('users','UsersController');

    Route::post('section/orderSave','SectionController@saveOrder');
    Route::post('section/orderSaveMenu','SectionController@saveOrderMenu');
    Route::get('fixedNews/inHome','NewsController@inHome');
    Route::post('fixedNews/inhome/save','NewsController@inHomeSave');
    Route::resource('files','FilesController');
    Route::resource('articleSection','ArticlesSectionController');
    Route::resource('section','SectionController');
    Route::resource('examsSection','ExamsSectionController');
});
