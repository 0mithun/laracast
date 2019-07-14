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

      
      $this->post('/admin/series',[
         'title'           => 'the best series',
         'description'     => 'the best series',
         'image'           => 'STRING_INVALID_IMAGE'
      ])
         // ->assertRedirect('admin/series/create')
         ->assertSessionHasErrors('image')
      ;
   }
}
