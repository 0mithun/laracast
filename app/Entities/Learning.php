<?php

namespace App\Entities;

use Redis;
use App\Lesson;

trait Learning{
    
    /**
     * 
     * Mark a lesson as completed for a user
     * 
     * @param App\Lesson $lesson
     * 
     * @return void 
     * 
     */


    public function completeLesson($lesson){
        // dd("user:{$this->id}:series:{$lesson->series->id}");
        Redis::sadd("user:{$this->id}:series:{$lesson->series->id}", $lesson->id);
    }


    /**
     * 
     * Get percentage completed for a series for a user
     * 
     * @param App\Series $series
     * 
     * @return void
     * 
     */
    
    public function percentageCompletedForSeries($series){
        $numberOfLessonsInSeries = $series->lessons->count();

        $numberOfCompletedLessons = $this->getNumberOfCompletedLessonsForASeries($series);
        
        return ($numberOfCompletedLessons /  $numberOfLessonsInSeries) * 100;

    }


    /**
     * 
     * Get number of completed lesson for a series
     * 
     * @param App\Series $series
     * 
     * @return void 
     *  
     */

    public function getNumberOfCompletedLessonsForASeries($series){
        return count($this->getCompletedLessonsForASeries($series));
    }


    /**
     * 
     * Check if a user has started a series
     * 
     * @param App\Series $series
     * 
     * @return void
     * 
     */

    public function getCompletedLessonsForASeries($series){
        return redis::smembers("user:{$this->id}:series:{$series->id}");
    }


    public function hasStartedSeries($series)
    {
        return $this->getNumberOfCompletedLessonsForASeries($series) > 0;
    }


    /**
     * 
     * Check if a user has completed a lesson
     * 
     * @param App\Series $series
     * 
     * @return void 
     * 
     */

     public function getCompletedLessons($series)
     {
         $completedLesson = $this->getCompletedLessonsForASeries($series);

         return collect($completedLesson)->map(function($lesson_id){
             return Lesson::find($lesson_id);
         });
     }

}