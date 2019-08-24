<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Notifications\RegisterAccountNotification;

class AuthController extends Controller
{
    /**
     * @param RegisterRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $data =$request->all();
        $filter = User::where('code',$data["code"])->first();

        if(empty($filter)) {
            return response()->json(['error' => 'not found student'],404);
        }
        $data['password'] = Hash::make($data["password"]);
        $data['status'] = User::PARENT;
        $result = User::create($data);
        try {
            User::where('email',$data['email'])
                ->first()
                ->notify(new RegisterAccountNotification());

        }catch (\Exception $exception){
            $exception->getMessage();
        }

        return response()->json([ 'data' => $result ],201);

    }

    /**
     * @param LoginRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email','password');

        if(!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'],401);
        }

        return response()->json([ 'token' => $token ],200);
    }

}
