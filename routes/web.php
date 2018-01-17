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


Route::get('posts', function(Request $request) {
    $collection = Mongo::get()->blog->posts;
    $posts =  $collection->find()->toArray();
    return view('home', ['posts' =>$posts]);

});

Route::get('posts/{id}', function(Request $request, $id) {
    $collection = Mongo::get()->blog->posts;
    return $collection->findOne(['_id'=> $id]);
});

Route::get('/', function () {
    return view('welcome');
});


