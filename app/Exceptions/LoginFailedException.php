<?php

namespace App\Exceptions;

use Exception;

class LoginFailedException extends Exception
{
    // public function report(){

    // }

    public function render(){
        return response()->json([
            'message' => 'These credentials do not match our records.'
        ],422);
    }
}
