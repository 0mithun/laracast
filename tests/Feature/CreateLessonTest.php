<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateLessonTest extends TestCase
{
    use RefreshDatabase;
   public function test_a_user_can_create_lesson(){

        $this->loginAdmin();

        $this->withoutExceptionHandling();
        $series = factory(\App\Series::class)->create();

       $lesson = [
            'title'             =>      'new lesson',
            'description'       =>      'new lesson description',
            'episode_number'    =>      12,
            'video_id'          =>      14943
       ];
       $this->postJson("/admin/{$series->id}/lessons",$lesson)
            ->assertStatus(201)
            ->assertJson($lesson)
            ;
       
        $this->assertDatabaseHas('lessons',[
            'title'     =>  $lesson['title'],
            'description'  =>   $lesson['description'],
            'episode_number'   =>   $lesson['episode_number'],
            'video_id'  =>  $lesson['video_id']
        ]);
   }

   public function test_a_title_is_required_to_create_a_lesson(){
        $this->loginAdmin();

        // $this->withoutExceptionHandling();
        $series = factory(\App\Series::class)->create();

    $lesson = [
            // 'title'             =>      'new lesson',
            'description'       =>      'new lesson description',
            'episode_number'    =>      12,
            'video_id'          =>      14943
    ];
    $this->post("/admin/{$series->id}/lessons",$lesson)
            ->assertSessionHasErrors('title')
            ;
   }

   public function test_a_description_is_required_to_create_a_lesson(){
        $this->loginAdmin();

        // $this->withoutExceptionHandling();
        $series = factory(\App\Series::class)->create();

    $lesson = [
            'title'             =>      'new lesson',
            // 'description'       =>      'new lesson description',
            'episode_number'    =>      12,
            'video_id'          =>      14943
    ];
    $this->post("/admin/{$series->id}/lessons",$lesson)
            ->assertSessionHasErrors('description')
            ;
   }
   public function test_a_episode_number_is_required_to_create_a_lesson(){
        $this->loginAdmin();

        // $this->withoutExceptionHandling();
        $series = factory(\App\Series::class)->create();

    $lesson = [
            'title'             =>      'new lesson',
            'description'       =>      'new lesson description',
            // 'episode_number'    =>      12,
            'video_id'          =>      14943
    ];
    $this->post("/admin/{$series->id}/lessons",$lesson)
            ->assertSessionHasErrors('episode_number')
            ;
   }
   public function test_a_video_id_is_required_to_create_a_lesson(){
        $this->loginAdmin();

        // $this->withoutExceptionHandling();
        $series = factory(\App\Series::class)->create();

    $lesson = [
            'title'             =>      'new lesson',
            'description'       =>      'new lesson description',
            'episode_number'    =>      12,
            // 'video_id'          =>      14943
    ];
    $this->post("/admin/{$series->id}/lessons",$lesson)
            ->assertSessionHasErrors('video_id')
            ;
   }
}
