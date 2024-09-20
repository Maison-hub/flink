<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'biography' => ['nullable', 'string'],
            'profile_picture' => ['nullable', 'image', 'max:1024'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
            'biography' => $request->string('biography'),
            'profile_picture' => $request->file('profile_picture') ? $request->file('profile_picture')->store('profile-pictures', 'public') : null,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return response()->noContent();
    }

    //update user
    public function update(Request $request): Response
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class.',email,'.$request->user()->id],
            'biography' => ['nullable', 'string'],
            'profile_picture' => ['nullable', 'image', 'max:1024'],
        ]);

        $profile_photo_path = null;
            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $profile_photo_path = $file->store('profile_picture', 'public'); // Store the file in the 'profile_photos' directory in the 'public' disk
        }

        $request->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'biography' => $request->biography,
            'profile_picture' => $profile_photo_path,
        ]);

        return response()->noContent();
    }

    // update profile picture
    public function updateProfilePicture(Request $request): Response
    {        
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('picture');
        $profile_photo_path = $file->store('avatars', 'public'); // Store the file in the 'profile_photos' directory in the 'public' disk

        //delete old profile picture if existing
        if ($request->user()->profile_picture) {
            Storage::disk('public')->delete($request->user()->profile_picture);
        }

        $request->user()->update([
            'profile_picture' => $profile_photo_path,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Profile picture updated successfully'
        ]);
    }
}
