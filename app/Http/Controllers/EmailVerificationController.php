<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Otp;
use App\Models\Worker;


class EmailVerificationController extends Controller
{
    private $otp;

    public function __construct()
    {
        $this->otp   = new Otp;
    }
    public function Email_verification_worker(Request $request){
        $validation = $request->validate([
            'email'  => 'required|email|exists:workers',
            'otp'    => 'required|max:6',
        ]);

        $otp2 = $this->otp->validate($request->email , $request->otp);
        if (!$otp2->status) {
            return response()->json(['error' => $otp2] , 401);
        }

        
        $workers = Worker::where('email' , $request->email)->first();

        $workers->update([
            'status' => 1,
            'verified_at' => now()
        ]);

        $success = $workers;
        $success['success'] = true;
        return response()->json($success, 200);


    }
}
