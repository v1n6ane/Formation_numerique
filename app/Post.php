<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use Sortable;
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be stored in database.
     *
     * @var array
     */
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

    /**
     * The attributes that should be sort
     *
     * @var array
     */
    public $sortable = [
        'id',
        'title', 
        'description', 
        'start_date',
        'end_date', 
        'price', 
        'nb_max_student', 
        'post_type', 
        'status',  
        'category_id',
        'created_at',
        'updated_at'
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
    public function getStartDateFrAttribute() {
        return Carbon::parse($this->attributes['start_date'])->format('d/m/Y');

        //Carbon\Carbon::parse($quotes->created_at)->format('d-m-Y i')
    }

    //renvoie la date au format FR
    public function getEndDateFrAttribute() {
        return Carbon::parse($this->attributes['end_date'])->format('d/m/Y');
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