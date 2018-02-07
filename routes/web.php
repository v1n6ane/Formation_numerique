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
use App\Post;
use Illuminate\Support\Facades\Input;

Route::get('/', 'FrontController@index');

Route::get('post/{id}', 'FrontController@show')->where(['id'=>'[0-9]+']);

Route::get('post/{name}', 'FrontController@showByType')->where(['name'=>'[a-z]+']);

/* Route::any('/search',function(){
    $q = Input::get ( 'q' );
    $posts = Post::where('title','LIKE','%'.$q.'%')
        ->orWhere('post_type','LIKE','%'.$q.'%')
        ->get();
    if(count($posts) > 0)
        return view('front.search')->withDetails($posts)->withQuery ( $q );
    else return view ('front.search')->withMessage('No results found. Try to search again !');
}); */

Route::any('search','FrontController@research')->name('search');

/* Routes pour la page de contact */
Route::get('contact', 'ContactController@show')->name('contact');

Route::post('contact',  'ContactController@mailToAdmin'); 

//Route avec un middleware qui sécurise toutes les actions du contrôleur de ressource
Route::resource('admin/post', 'PostController')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
