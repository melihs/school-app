<?php


namespace App\Repositories;


use App\User;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @return mixed
     */
    public function index()
    {
        $students = Student::with('parent')->get();

        return $students;
    }

    /**
     * @return mixed
     */
    public function show()
    {
        $parent = User::find(auth()->user()->id);
        $getRelateds = $parent->students->toArray();

        return $parent;
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $parent = User::find($id);
        $request->validate(['name' =>'string|max:255|required']);
        $parent->name = request('name');
        $this->emailValidation($parent,$id);
        $this->passwordValidate($parent);
        $parent->save();

        return $parent;

    }

    /**
     * @param $user
     * @param $id
     *
     * @return array|\Illuminate\Http\Request|string
     */
    public function emailValidation($user,$id)
    {
        $getEmail = User::find($id)->email;
        if ($getEmail !== request('email')) {
            Validator::make((array) request('email'), ['email' =>'string|max:255|unique:users|email|required']);
            $user->email = request('email');

            return $user->email;
        }
    }

    /**
     * @param $user
     *
     * @return string
     */
    public function passwordValidate($user)
    {
        if (request('password'))
        {
            Validator::make((array) request('password'), ['password' =>'string|max:4|required' ]);
            $user->password = Hash::make(request('password'));

            return $user->password;
        }
    }
}