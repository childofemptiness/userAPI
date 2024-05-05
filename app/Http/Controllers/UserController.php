<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function store(Request $request) {

        $validateData = $request->validate([

            'name' => 'required|max:255',

            'email' => 'required|email|unique:users',

            'password' => 'required|min:6',
        ]);

        $user = User::create([

            'name' => $validateData['name'],

            'email' => $validateData['email'],

            'password' => Hash::make($validateData['password']),
        ]);

        $token = $user->createToken('AccessToken')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token], 200);
    }

    public function show(User $user) {

        return response()->json($user);
    }

    public function update(Request $request, User $user) {

        $validateData = $request->validate([

            'name' => 'required|max:255',

            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validateData);

        return response()->json($user);
    }

    public function destroy(User $user) {

        $user->delete();

        return response()->json(null, 204);
    }

    public function login(Request $request) {

        $credentials = $request->validate([

            'email' => 'required|email',

            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Пришлось сделать так, поскольку имеет место быть баг Laravel, Auth::user() не имеет метода createToken, хотя должен
            $authenticatedUser = Auth::user();

            $user = User::find($authenticatedUser->id);

            $token = $user->createToken('AccessToken')->plainTextToken;

            return response()->json(['token' => $token], 200);
        }
    }
}
