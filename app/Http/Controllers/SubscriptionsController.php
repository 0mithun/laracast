<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    


    public function change(){

        $this->validate(request(),[
            'plan'      =>  'required'
        ]);

        $user = auth()->user();
        $userPlan = $user->subscriptions->first()->name;

        // dd(request()->all());

        if(request('plan') == $user->plan){
            return redirect()->back();
        }else{
            $user->subscription($userPlan)->swap(request('plan'));
            
            return redirect()->back();
        }
    }
}
