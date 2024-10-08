<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
class RegisterController extends Controller
{
    public function __construct(){
        $this->middleware("guest");
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create([
            "name"=> $request->name,
            "email"=> $request->email,
            "password"=> Hash::make($request->password),
            
        ]);

        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type'=> 'Bearer',
        ],201);
    }
}
