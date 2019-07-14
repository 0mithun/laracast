<?php

namespace Tests\Feature;

// use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
   use RefreshDatabase;
   
    public function test_correct_response_after_user_login(){
        $user = factory(\App\User::class)->create();

        $this->postJson('/login',[
            'email'         =>  $user->email,
            'password'      =>  'password'
        ])
        ->assertStatus(200)
        ->assertSessionHas('success','Successfully Logged In.')
        ;
    }

    public function test_a_user_receives_correct_message_when_passing_wrong_credentials(){
        $user = factory(\App\User::class)->create();

        $this->postJson('/login', [
            'email'     =>  $user->email,
            'password'  =>  'wrong'
        ])
        ->assertStatus(422)
        ->assertJson([
            'message'   =>  'These credentials do not match our records.'
        ]);
    }
}
