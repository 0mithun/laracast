<?php

namespace App\Entities;

use Redis;
use App\Lesson;
use PhpParser\ErrorHandler\Collecting;
use App\Series;

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
     * @return array 
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


    /**
     * 
     * Check a user has completed a lesson
     * 
     * @param App\Lesson $lesson
     * 
     * @return void
     */
    



     public function hasCompletedLesson($lesson){
        return \in_array(
            $lesson->id,
            $this->getCompletedLessonsForASeries($lesson->series)
        );
     }

    /** 
     * Get a user completed series ids
     * 
     * @return array
     * 
    */
     
    public function seriesBeingWatchedIds(){
        $keys = Redis::keys("user:{$this->id}:series:*"); 

       $series_id_array = [];
       foreach($keys as $key):
            $series_id = explode(':',$key)[3];
            array_push($series_id_array, $series_id);
       endforeach;

       return $series_id_array;
    }


    /** 
     * 
     * Get all the series a user is watching
     * 
     * @return void
     * 
    */

    public function seriesBeingWatched(){
       
       return collect($this->seriesBeingWatchedIds())->map(function($id){
           return Series::find($id);
       })->filter();

    }


    /** 
     * 
     * Get Count a user is completed lesson for a series
     * 
     * 
     * 
     * @return void
     * 
    */
    public function getTotalNumberOfCompletedLessons(){
        $keys = Redis::keys("user:{$this->id}:series:*");

        $result = 0;

        
        foreach($keys as $key):
            
            $result = $result +  count(Redis::smembers($key));
        endforeach;

        return $result;
    }
}