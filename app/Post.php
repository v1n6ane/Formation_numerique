<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function picture(){
        return $this->hasOne(Picture::class);
    }

    public function category(){
        return $this->belongsTo(Category::class); //associé au plus à une catégorie
    }

    public function scopePublished($query){
        return $query->where('status', 'published');
    }
}