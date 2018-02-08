<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; //importer l'alias de la classe
use App\Category;

class PostController extends Controller
{
    protected $paginate = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate($this->paginate); //retourne les livres paginés par 10
        //aficher la vue
        return view('back.post.index', ['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::pluck('name', 'id')->all();
        $types=Post::pluck('post_type')->unique();

        return view('back.post.create', ['categories' => $categories, 'types' => $types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required|string',
            'category_id' => 'integer',
            'type' => 'in:stage,formation',
            'status' => 'in:published,unpublished',
            'start_date' => 'date|after:tomorrow',
            'end_date' => 'date|after:start_date',
            'picture' => 'image|mimes:jpeg,jpg,png',
            'title_image' => 'string|nullable',
        ]);

        $post = Post::create($request->all()); //hydratation avec les données du livre enregistré en BDD - champs renseignés dans la classe dans la variable fillable
        
        //image
        $image = $request->file('picture');

        if(!empty($image)){

            //méthode store retourne un lien hash sécurisé
            $link = $request->file('picture')->store('./');

            //mettre à jour la table picture pour le lien vers l'image dans la bdd
            $post->picture()->create([
                'link' => $link,
                'title' => $request->title_image?? $request->title
            ]);
        }
        return redirect()->route('post.index')->with('message', "L'article a été ajouté avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        
        $post->delete();

        return redirect()->route('post.index')->with('message', 'Le livre a été supprimé avec succès');
    }
}
