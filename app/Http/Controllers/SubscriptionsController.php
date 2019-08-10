<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function showSubscribe(){
        return view('subscribe');
    }

    public function saveSubscribe(){
        // return request()->all();
        return auth()->user()
        ->newSubscription('Laracast Payment', request('plan'))
        ->create(request('stripeToken'));
    }


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

   public function cardUpdate(){

        $this->validate(request(), [
            'stripeToken'  => 'required'
        ]);
        $token = request('stripeToken');
        $user = auth()->user();
        $user->updateCard($token);
        return response()->json('ok');
    }
}
