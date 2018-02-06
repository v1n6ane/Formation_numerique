<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function post(){
        //récupère tous les livres d'une catégorie - relation oneToMany
        return $this->hasMany(Post::class);
    }
}
