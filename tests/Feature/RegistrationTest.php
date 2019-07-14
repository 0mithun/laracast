<?php

namespace Tests\Feature;

use Mail;
use App\User;
use Tests\TestCase;
use App\Mail\ConfirmYourEmail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
   use RefreshDatabase;
//    public function test_a_user_has_a_user_name_after_registration(){
//         $user = factory(\App\User::class)->create();

//         $this->assertDatabaseHas('users', [
//             'username'      =>  str_slug($user->name)
//         ]);
//    }

   // public function test_an_email_send_to_newly_registered_user(){

   //      $this->withoutExceptionHandling();
   //      Mail::fake();

   //     $this->post('/register',[
   //          'name'      =>  'kati frantz',
   //          'username'  =>   'kati-frantz',
   //          'email'     =>  'test@gmail.com',
   //          'password'  =>  'password'
   //     ])
   //     ->assertRedirect();

   //     Mail::assertSent(ConfirmYourEmail::class);

   // }

   public function test_a_user_has_a_token_after_registration(){
      //   $this->withoutExceptionHandling();
      //   Mail::fake();

       $this->post('/register',[
            'name'      =>  'kati frantz',
            'username'  =>   'kati-frantz',
            'email'     =>  'test@gmail.com',
            'password'  =>  'password'
       ])
       ->assertRedirect();

      $user = User::find(1);
         
      $this->assertNotNull($user->confirm_token);
   }

}
