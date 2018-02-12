<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;

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

    public function scopeResearch($query, $q){
            return $query->where('title','LIKE','%'.$q.'%')
                        ->orWhere('post_type','LIKE','%'.$q.'%')
                        ->orWhere('description','LIKE','%'.$q.'%')
                        ->orwhereHas('category', function($category)use($q){ 
                            return $category->where('name','LIKE','%'.$q.'%'); 
                        });
    }
    
    public function setCategoryIdAttribute($value){
        if($value==0){
            $this->attributes['category_id'] = null;
        } else {
            $this->attributes['category_id'] = $value;
        }
    }

    //renvoie la date au format FR
    public function getStartDateFrAttribute($value) {
        return Carbon::parse($value)->format('d/m/Y');
    }

    //renvoie la date au format FR
    public function getEndDateFrAttribute($value) {
        return Carbon::parse($value)->format('d/m/Y');
    } 

    //renvoie la date au format normal
    /* public function getStartDateAttribute(){
        return $this->attributes['start_date'];
    }

    public function getEndDateAttribute(){
        return $this->attributes['end_date'];
    } */

    public function getSlugAttribute($value){ // $post->slug
        return Str::slug($this->attributes['title']); // Ma formation à moi perso ===> ma_formation_moi_perso
    }

}