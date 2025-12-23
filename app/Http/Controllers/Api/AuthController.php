<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthController
 *
 * Handles API based authentication using Laravel Sanctum.
 * Responsible for user login, token generation and logout.
 */
class AuthController extends Controller
{
    /**
     * Authenticate user credentials and generate Sanctum access token.
     *
     * This method validates login credentials, attempts authentication
     * and returns an access token on successful login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {   
        // Validate incoming login request
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Attempt authentication using provided credentials
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Retrieve authenticated user instance
        $user = Auth::user();

        // Generate Sanctum personal access token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return authenticated user data along with access token
        return response()->json([
            'success' => true,
            'data' => [
                'user'        => $user->load('roles', 'permissions'),
                'accessToken' => $token,
                'tokenType'   => 'Bearer'
            ],
            'message' => 'Login successful'
        ]);
    }

    /**
     * Logout authenticated user by revoking current access token.
     *
     * This method deletes the active Sanctum token,
     * effectively logging out the user from the API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {   
        // Revoke the currently active access token
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }
}
