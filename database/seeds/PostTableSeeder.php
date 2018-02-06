<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Category::create([
            'name' => 'front end'
        ]);

        App\Category::create([
            'name' => 'back end'
        ]);

        App\Category::create([
            'name' => 'webdesign'
        ]);
        

        Storage::disk('local')->delete(Storage::allFiles());

        //création de 30 posts à partir de la factory
        factory(App\Post::class, 30)->create()->each(function($post){
            //associations une categorie à un pot que nous venons de créer
            //pour chaque $post on lui associe une categorie particulière
            $category=App\Category::find(rand(1,3));
            $post->category()->associate($category);
            $post->save(); //il faut sauvegarder l'association pour faire persister en BDD

            //ajout des images
            //on utilisefuturama sur lorempicsum pour récupérer des images aléatoirement
            //attenton il n'y en a que 9 différentes
            $link = str_random(12) . '.jpg';
            //$file = file_get_contents('http://lorempicsum.com/futurama/250/250/' . rand(1,9));
            $file = file_get_contents('http://placeimg.com/250/250/tech');
            Storage::disk('local')->put($link, $file);

            $post->picture()->create([
                'title' => 'Default',
                'link' => $link
            ]);
        });

    }
}