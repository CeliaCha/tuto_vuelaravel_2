<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function store(Request $request)
    {
        $user = $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //$user->save();

         $user = User::create($user);

        return $user;
    }
}
