<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Worker;
use App\Notifications\ResetPasswordNotification;

class ForgetpasswordController extends Controller
{
    public function forgetPassword(Request $request){

        $validation = $request->validate([
            'email'  => 'required|email|exists:workers',
        ]);

        $input = $request->only('email');
        $worker = Worker::where('email' , $input)->first();
        $worker->notify(new ResetPasswordNotification());

        $success['email'] = $request->email;
        $success['success'] = true;

        return response()->json($success, 200);


    }
}
