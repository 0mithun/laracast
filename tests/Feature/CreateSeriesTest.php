<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CreateSeriesTest extends TestCase
{
   
   use RefreshDatabase;

   public function test_a_series_must_be_created_with_a_image(){

      $this->loginAdmin();
      // $this->withoutExceptionHandling();

      // Storage::fake(config('filesystems.default'));
      
      $this->post('/admin/series',[
         'title'     => 'the best series',
         'description'     => 'the best series',
      ])
         // ->assertRedirect('admin/series/create')
         ->assertSessionHasErrors('image')
      ;
   }
   public function test_a_series_must_be_created_with_on_image_which_actually_on_image(){

      $this->loginAdmin();
      $this->post('/admin/series',[
         'title'           => 'the best series',
         'description'     => 'the best series',
         'image'           => 'STRING_INVALID_IMAGE'
      ])
         // ->assertRedirect('admin/series/create')
         ->assertSessionHasErrors('image')
      ;
   }

   public function test_only_administrator_can_create_series(){

      $this->withoutExceptionHandling();

      $user = factory(\App\User::class)->create();

      $this->actingAs($user);
      
      $this->post('/admin/series',[
         'title'           => 'the best series',
         'description'     => 'the best series',
         'image'           => UploadedFile::fake()->image('image-series.png')
      ])
         ->assertSessionHas('error','You are not authorized to perform this action');
      ;
   }
}
