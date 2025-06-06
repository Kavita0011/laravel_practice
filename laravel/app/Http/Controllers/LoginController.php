<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    //
       public function login(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error!',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check credentials
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials.'
            ], 401);
        }

        $user = Auth::user();
        $userloggedin = User::where('email', $request->email)->first();
        // Check if user is active
        // Generate token
        $token = $userloggedin->createToken('API Token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful.',
            'token' => $token,
            'user' => $user
        ], 200);
    }
    // logout
    /**
     * Logout the user (Invalidate the token)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
    
        // get token
        $token = $request->user()->currentAccessToken();
        // check if the token is valid
        if (!$token) {
            return response()->json([
                'status' => false,
                'message' => 'Token not found.'
            ], 404);
        }
    // delete token
        // delete the token
        $token->delete();
        return response()->json([
            'status' => true,
            'message' => 'Logout successful.'
        ], 200);}

}
