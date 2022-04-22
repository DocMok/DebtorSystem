<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserControler extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function store(UserStoreRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => 0
        ]);
    return redirect(route('index'));
    }

    public function index()
    {
        $users = User::paginate(20);
        return view('user.index', compact('users'));
    }
public function edit(User $user)
{
    return view('user.edit', compact('user'));
}
}
