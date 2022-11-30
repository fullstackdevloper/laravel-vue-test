<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = $request->user();

        if($user->is_admin) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $tokenResult = $user->createToken('API TOKEN');
        $token = $tokenResult->accessToken;

        $token->expires_at = $request->remember_me ? Carbon::now()->addWeeks(10): Carbon::now()->addDays(1);

        $token->save();

        return response()->json([
            'access_token' => $token->token,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $token->expires_at
            )
                ->toDateTimeString(),
        ]);
    }

    /**
     * Create User
     * @param Request $request
     * @return User 
     */
    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_admin' => 0,
            ]);

            $tokenResult = $user->createToken('API TOKEN');

            $token = $tokenResult->accessToken;

            if ($request->remember_me) {
                $token->expires_at = Carbon::now()->addWeeks(10);
            }

            $token->save();

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'access_token' => $token->token,
                'token_type' => 'Bearer',
                'expires_at' =>  Carbon::parse(
                    $token->expires_at
                )
                    ->toDateTimeString()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * get User
     * @param Request $request
     * @return User 
     */
    public function user()
    {
        return new UserResource(Auth::user());
    }
}
