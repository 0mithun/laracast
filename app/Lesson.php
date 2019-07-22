<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    protected $fillable = [
        'series_id', 'title','description', 'episode_number','video_id'
    ];

    
    public function series(){
        return $this->BelongsTo(Series::class);
    }
}
