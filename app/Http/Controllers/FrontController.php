<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class FrontController extends Controller
{
    protected $paginate = 5;

    public function __construct(){
        //methode pour injecter des données à une vue partielle  à l'appel de la classe
        view()->composer('partials.menu', function($view){
            $types = Post::pluck('post_type', 'id')->unique(); //on récupère un tableau associatif ['id'=>'post_type']
            $view->with('types', $types); //on passe les données à la vue
        });
    }

    public function index(){
        $posts = Post::orderBy('start_date')->paginate(2); //retourne les posts ordonnés par date de début, paginer par 2

        //aficher la vue 
        return view('front.index', ['posts'=>$posts]);    
    }

    public function show($id){
        $post = Post::find($id); //retourne un seul livre

        // afficher la vue
        return view('front.show', ['post' => $post]);
    }
    
}
