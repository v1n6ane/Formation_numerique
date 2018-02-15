<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post; //importer l'alias de la classe
use App\Category;
use Storage;
use Illuminate\Support\Facades\Input;
use Cache;

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
        $posts = Post::with('picture', 'category')->sortable()->paginate($this->paginate); //retourne les livres paginés par 10
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
    public function store(PostRequest $request)
    {
        //Validation dans le PostRequest

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
        $post = Post::find($id); //retourne un seul livre
        
        return view('back.post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id); //retourne un seul livre

        //dd($post->start_date);
        $categories=Category::pluck('name', 'id')->all();
        $types=Post::pluck('post_type')->unique();

        return view('back.post.edit', ['post' => $post, 'categories' => $categories, 'types' => $types]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        //Validation dans le PostRequest

        $post = Post::find($id);

        $post->update($request->all());

        //mise à jour de l'image
        $image = $request->file('picture');

        if(!empty($image)){
            //suppression de l'image précédente
            if(count($post->picture)>0){
                Storage::disk('local')->delete($post->picture->link); //supprimer physiquement l'image
                $post->picture()->delete(); //supprimer l'information en BDD
            }

            //méthode store retourne un lien hash sécurisé
            $link = $request->file('picture')->store('./');

            //ajouter la nouvelle image dans la bdd
            $post->picture()->create([
                'link' => $link,
                'title' => $request->title_image?? $request->title
            ]);
        }

        return redirect()->route('post.index')->with('message', 'Le livre a été mis à jour avec succès');
    }

    public function updateStatus(Request $request, $id)
    {
        //Validation 
        $this->validate($request, [
            'status' => 'in:published,unpublished',
        ]);

        $post = Post::find($id);

        $post->update($request->all());

        return redirect()->route('post.index')->with('message', 'Le livre a été mis à jour avec succès');
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

    public function research(Request $request){

        $this->validate($request, [
            'q' => 'required|string',
        ]);

        $q = Input::get ( 'q' );

        if($q != ""){
            
            $posts = Post::research($q)->paginate($this->paginate);

            if(count($posts) > 0)
                return view('back.post.search')->withDetails($posts)->withQuery($q);
                //l'écriture équivaut à 
                //view('front.view', ['details' => $posts, 'query' => $q]);
        }           
        return view ('back.post.search')->withMessage('No results found. Try to search again !');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        Post::whereIn('id',explode(",",$ids))->delete();

        return response()->json(['success'=>"Products Deleted successfully."]);
    }

}