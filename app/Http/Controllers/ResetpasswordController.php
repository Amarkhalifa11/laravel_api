<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker;
use Hash;
use Otp;

class ResetpasswordController extends Controller
{
    private $otp;

    public function __construct()
    {
        $this->otp   = new Otp;
    }

    public function Reset_password(Request $request){

        $validation = $request->validate([
            'email'  => 'required|email|exists:workers',
            'otp'  => 'required|max:6',
            'password'  => 'required|confirmed|string|min:6',
        ]);



        $otp2 = $this->otp->validate($request->email , $request->otp);
        
        if (!$otp2->status) {
            return response()->json(['error' => $otp2] , 401);
        }

        $workers = Worker::where('email' , $request->email)->first();
        $workers->update(['password'  => Hash::make($request->password)]);
        // $workers->tokens()->delete();

        $success['success'] = true;
        return response()->json($success, 200);


    }
}
