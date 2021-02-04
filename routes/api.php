<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('image/upload','ImagesController@uploads');
Route::get('images/loadmore','ImagesController@loadmore');
Route::get('search/image','ImagesController@search');

Route::get('section/child','SectionController@child');
Route::get('search/keywords','KeywordsController@search');
Route::get('search/news','NewsController@search');
Route::get('search/articles','ArticlesController@search');

Route::get('search/question','QuestionController@search');



Route::get('news/{slug}','WebsiteController@NewsSectionApi');
Route::get('articles/{slug}','WebsiteController@ArticlesSectionApi');
Route::get('exams','WebsiteController@examsApi');
Route::get('exams/{slug}','WebsiteController@examsApi');
Route::get('tags/{slug}','WebsiteController@TagsSectionApi');
Route::get('search','WebsiteController@SearchSectionApi');
Route::get('files','WebsiteController@filesApi');
