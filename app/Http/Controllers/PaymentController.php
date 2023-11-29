<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment(){
        
        $payLink =  auth()->guard('client')->user()->charge(12.99, 'Action Figure');
        return response()->json([
            'paylink' => $payLink
        ]);


    }
}
