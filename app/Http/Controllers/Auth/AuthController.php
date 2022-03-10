<?php

namespace App\Http\Controllers\Auth;

use App\Domains\User\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

/**
 * AuthController
 *
 * class to control all operations of users in api
 * methods to show the current user(me),logout, login
 */
class AuthController extends Controller
{

    /**
     * me
     *method to show the current user
     *@params void
     *returns only one record of user in json
     */
    public function me()
    {
        $user = Auth::user();

        return [
            'email' => $user->email,
            'first_name' => $user->first_name,
            'last_name'=>$user->last_name,
            'id' => $user->id,
        ];
    }

    /**
     * logout
     *method to delete record of current users
     *
     * @return message(json) or report of failure
     */
    public function logout()
    {
        try {
            Session::flush();
            $success = true;
            $message = 'Successfully logged out';
            Auth::user()->tokens()->delete();
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];

        return response()->json($response);
    }

    /**
     * login
     *method to login, it protected with middleware of sanctum
     *accepts json data to identify the user(email and password)
     * @param  mixed $request
     * @returns a response with token and user data on success,
     * if fail, returns only a message of failure
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        
        $user = User::where(
            'email',
            $credentials['email']
        )->first();
        $match = Hash::check( $credentials['password'],$user->password);  
        if ($user && $match) {
            $token = $user->createToken('access-token')->plainTextToken;

            // response
            return response([
                'user' => $user,
                'token' => $token,
            ]);
        }
        
        return response([
            'message' => 'These credentials do not match our records.',
        ], 401);
    }
}
