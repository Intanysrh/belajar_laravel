<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function loginAction(Request $request)
    {
        $credential = $request->only('email', 'password');
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'error' => $validator->errors()], 422);
        }

        if (!Auth::attempt($credential)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid credential'], 401);
        }
        //kita generate token pake sanctum atau jwt
        // auth()->user();
        $user = Auth::user();
        $token = $user->createToken('api_token')->plainTextToken;
        return response()->json(['status' => 'success', 'user' => $user, 'token' => $token]);
    }

    public function getUsers()
    {
        $users = User::get();
        return response()->json(['data' => $users]);
    }

    public function me()
    {
        return response()->json(['status' => 'success', 'data' => Auth::user()]);
    }

    public function storeUser(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
            }
            $users = User::create($request->all());
            return response()->json(['data' => $users, 'message' => 'Request success'], 201);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Request failed', 'errors' => $th->getMessage()], 500);
        }
    }

    public function updateUser(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'nullable|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
            }

            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // $users = User::create($request->all());
            // return response()->json(['data' => $users, 'message' => 'Request success'], 201);

            return response()->json(['status' => 'success', 'manage' => 'Request Update Success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Request failed', 'errors' => $th->getMessage()], 500);
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['status' => 'success', 'message' => 'Delete success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Delete failed', 'errors' => $th->getMessage()], 500);
        }
    }

    public function editUsers($id)
    {
        $user = User::findOrFail($id);
        return response()->json(['status' => 'success', 'message' => 'Request success', 'data' => $user]);
    }
}
