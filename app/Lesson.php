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
        return $this->series->lessons()->where('episode_number', '>', $this->episode_number)
                    ->orderBy('episode_number','ASC')
                    ->first();
    }

    public function getPreviousLesson(){
        return $this->series->lessons()->where('episode_number', '<', $this->episode_number)
                    ->orderby('episode_number', 'DESC')
                    ->first();
    }
}
