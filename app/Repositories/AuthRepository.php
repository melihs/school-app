<?php


namespace App\Repositories;


use App\User;
use App\Student;
use App\Events\NotificationSent;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Notifications\RegisterAccountNotification;
use App\Repositories\Interfaces\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface
{
    public function register(RegisterRequest $request)
    {
        $data =$request->all();
        $filter = Student::where('code',$data["code"])->first();

        if(!isset($filter)) {
            return null;
        }

        $data['password'] = Hash::make($data["password"]);
        $data['role'] = User::PARENT;
        $result = User::create($data);
        $parent = User::where('email',$data['email'])->first();
        event(new NotificationSent($parent));

        try {
            User::where('email',$data['email'])
                ->first()
                ->notify(new RegisterAccountNotification());

        }catch (\Exception $exception){
            return response()->json([
                'error' => 'email failed',
                'message' => $exception->getMessage()
            ],404);
        }

        return $parent;
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