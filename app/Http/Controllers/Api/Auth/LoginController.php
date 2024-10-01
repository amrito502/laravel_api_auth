<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\LoginRequest;
class LoginController extends Controller
{
    public function __construct(){
        $this->middleware("guest");
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $user = User::where("email", $request->email)->first();
        if (!$user || ! \Hash::check($request->password, $user->password)) {
            return response()->json([
                "message"=> "incorrect user!"
            ],401);

        }

        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type'=> 'Bearer',
        ],200);

    }
}
