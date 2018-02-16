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

Route::get('post/{id}/{slug?}', 'FrontController@show')->where(['id'=>'[0-9]+'])->name('show_post');

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

Route::any('admin/search','PostController@research')->name('post.search');

/* Routes pour la page de contact */
Route::get('contact', 'ContactController@show')->name('contact');

Route::post('contact', 'ContactController@mailToAdmin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route avec un middleware qui sécurise toutes les actions du contrôleur de ressource
Route::resource('admin/post', 'PostController')->middleware('auth');

//Routes dans un groupe avec un middleware qui sécurise toutes les actions des contrôleurs de ressource
Route::middleware(['auth'])->group(function(){

    //Route pour supprimer plusieurs post en même temps
    Route::delete('admin/destroy/all', 'PostController@destroyAll')
        ->name('post.destroyAll');

    //route pour updater le status
    Route::any('admin/post/{id}/updateStatus', 'PostController@updateStatus')
        ->where(['id'=>'[0-9]+'])
        ->name('post.updateStatus');

    //Route pour afficher la corbeille côté back
    Route::get('admin/trash','PostController@showTrash')
        ->name('post.trash');

    //Route pour supprimer vraiment un post de la corbeille
    Route::delete('admin/force/delete/{id}','PostController@forceDelete')
        ->where(['id'=>'[0-9]+'])
        ->name('post.forceDelete');

    //Route pour supprimer vraiment plusieurs posts de la corbeille
    Route::delete('admin/delete/all', 'PostController@forceDeleteAll')
        ->name('post.forceDeleteAll');

    //Route pour restaurer le post de la corbeille
    Route::put('admin/restore/{id}', 'PostController@restore')
        ->where(['id'=>'[0-9]+'])
        ->name('post.restore');
    
});
