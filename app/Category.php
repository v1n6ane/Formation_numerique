<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Category extends Model
{
    use Sortable;

    public $sortable = [ 'id', 'name', 'created_at', 'updated_at'];

    public function post(){
        //récupère tous les livres d'une catégorie - relation oneToMany
        return $this->hasMany(Post::class);
    }

}
