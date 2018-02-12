<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Illuminate\Support\Facades\Input;

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
        $posts = Post::whereRaw('start_date >= now()' )->published()->with('picture', 'category')->orderBy('start_date')->take(2)->get(); //retourne les posts ordonnés par date de début, paginer par 2

        //aficher la vue 
        return view('front.index', ['posts'=>$posts]);    
    }

    public function show($id){
        $post = Post::find($id); //retourne un seul livre

        // afficher la vue
        return view('front.show', ['post' => $post]);
    }

    public function showByType(string $post_type){
        $posts=Post::where('post_type', $post_type)->paginate($this->paginate);
        
        return view('front.type', ['posts' => $posts]);
    }

    public function research(Request $request){

        $this->validate($request, [
            'q' => 'required|string',
        ]);

        $q = Input::get ( 'q' );

        if($q != ""){
            /* $posts = Post::where('title','LIKE','%'.$q.'%')
                        ->orWhere('post_type','LIKE','%'.$q.'%')
                        ->orWhere('description','LIKE','%'.$q.'%')
                        ->orwhereHas('category', function($category)use($q){ 
                            return $category->where('name','LIKE','%'.$q.'%'); 
                        })
                        ->paginate($this->paginate); */

            $posts = Post::research($q)->published()->paginate($this->paginate);

            if(count($posts) > 0)
                return view('front.search')->withDetails($posts)->withQuery($q);
                //l'écriture équivaut à 
                //view('front.view', ['details' => $posts, 'query' => $q]);
        }           
        return view ('front.search')->withMessage('No results found. Try to search again !');
    }

}
