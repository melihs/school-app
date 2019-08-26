<?php


namespace App\Repositories\Interfaces;


use App\User;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function index();
    public function show();
    public function update(Request $request,$id);
}