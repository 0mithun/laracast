<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'series_id', 'title','description', 'episode_number','video_id'
    ];

    
    public function series(){
        return $this->belongsTo(Series::class);
    }

    public function getNextLesson(){
        $next_lesson =  $this->series->lessons()->where('episode_number', '>', $this->episode_number)
                    ->orderBy('episode_number','ASC')
                    ->first();
        
        if($next_lesson){
            return $next_lesson;
        }

        return $this;
    }

    public function getPreviousLesson(){
        $previous_lesson = $this->series->lessons()->where('episode_number', '<', $this->episode_number)
                    ->orderby('episode_number', 'DESC')
                    ->first();
        
        if($previous_lesson){
            return $previous_lesson;
        }
        return $this;
    }
}
