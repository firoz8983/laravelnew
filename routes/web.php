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

Route::get('/', function () {
    return view('pages.index');
});

Route::get('/contact/us','HelloController@contact')->name('contact');
Route::get('/about/us','HelloController@about')->name('about');
Route::get('/write/post','BoloController@writepost')->name('write.post');
//category crud r here
Route::get('/all/category','BoloController@Allcategory')->name('all_category');
Route::get('/add/category','BoloController@add_category')->name('add.category');
Route::post('/store/category','BoloController@store_category')->name('store.category');
Route::get('view/category/{id}','BoloController@viewCategory');
Route::get('delete/category/{id}','BoloController@deleteCategory');
Route::get('edit/category/{id}','BoloController@editCategory');
Route::post('update/category/{id}','BoloController@updateCategory');
//posts cruds r here
Route::get('write/post','PostController@writepost')->name('write.post');
Route::post('store/post','PostController@StorePost')->name('store.post');
Route::get('all/post','PostController@Allpost')->name('all.post');
Route::get('view/post/{id}','PostController@ViewPost');
Route::get('edit/post/{id}','PostController@EditPost');
Route::post('update/post/{id}','PostController@updatePost');
Route::post('delete/post/{id}','PostController@deletePost');



