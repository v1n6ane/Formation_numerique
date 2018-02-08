<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 
        'description', 
        'start_date',
        'end_date', 
        'price', 
        'nb_max_student', 
        'post_type', 
        'status',  
        'category_id'
    ];

    public function picture(){
        return $this->hasOne(Picture::class);
    }

    public function category(){
        return $this->belongsTo(Category::class); //associé au plus à une catégorie
    }

    public function scopePublished($query){
        return $query->where('status', 'published');
    }

    public function setCategoryIdAttribute($value){
        if($value==0){
            $this->attributes['category_id'] = null;
        } else {
            $this->attributes['category_id'] = $value;
        }
    }
}