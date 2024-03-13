<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User 
     */
    public function createUser(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(), 
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'biography' => 'nullable',
                'profile_photo' => 'nullable|image|max:2048'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $profile_photo_path = null;
            if ($request->hasFile('profile_photo')) {
                $file = $request->file('profile_photo');
                $profile_photo_path = $file->store('profile_photos', 'public'); // Store the file in the 'profile_photos' directory in the 'public' disk
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'biography' => $request->biography,
                'profile_photo' => $profile_photo_path
            ]);
            $user->sendEmailVerificationNotification();

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    //update profile information of user
    public function updateProfil(Request $request)
    {
        try {
            $user = auth()->user();
            $profile_photo_path = $user->profile_photo;
            if ($request->hasFile('profile_photo')) {
                //delete old profile picture of user by and set the new one contail in the request
                if($user->profile_photo){
                    unlink(storage_path('app/public/' . $user->profile_photo));
                }
                $file = $request->file('profile_photo');
                $profile_photo_path = $file->store('profile_photos', 'public'); // Store the file in the 'profile_photos' directory in the 'public' disk
            }

            $user->update([
                'name' => $request->name,
                'biography' => $request->biography,
                'profile_photo' => $profile_photo_path
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Profile Updated Successfully',
                'user' => $user,
                'debug' => $profile_photo_path
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}