<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $fillable = [
        'title', 'slug','image_url', 'description'
    ];

    
    protected $with = ['lessons'];

    public function lessons(){
        return $this->hasMany(Lesson::class);
    }

     public function getRouteKeyName()
     {
         return 'slug';
     }

    public function getImagePathAttribute(){
        return asset('storage/'.$this->image_url);
    }

    public function getOrderdedLessons(){
        return $this->lessons()->orderBy('episode_number','ASC')->get();
    }
}
