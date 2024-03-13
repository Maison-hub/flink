<?php
// app/Http/Controllers/EmailVerificationController.php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class EmailVerificationController extends Controller
{
    public function verify(Request $request)
    {
        $user = User::find($request->route('id'));
    
        if ($user &&
            hash_equals((string) $request->route('hash'), sha1($user->email))
        ) {
            if (!$user->hasVerifiedEmail()) {
                $user->markEmailAsVerified();
    
                event(new \Illuminate\Auth\Events\Verified($user));
            }
    
            return view('email_verified');
        }
    
        return response()->json('Invalid verification link.', 400);
    }
}