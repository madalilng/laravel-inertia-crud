<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class UserController extends Controller
{
    protected $isApi = false;
    public function __construct()
    {
        if (strpos(Route::current()->uri, 'api') !== false)
            $this->isApi = true;
    }


    public function index()
    {
        $users = User::query()
            ->orderByDesc('id')
            ->get();

        if ($this->isApi)
            return $users;
        return Inertia::render('Users/UserList', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $postData = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $postData['password'] = Hash::make($postData['password']);

        $createdUser = User::create($postData);

        return redirect()->route('user.view', $createdUser->id);
    }

    public function show($id)
    {

        $users = User::query()
            ->orderByDesc('id')
            ->get();

        $selectedUser = User::find($id);
        return Inertia::render('Users/UserList', ['users' => $users, 'selectedUser' => $selectedUser]);
    }

    public function update(Request $request, User $user)
    {
        $userData = $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable'
        ]);

        if (@$userData['password']) {
            $userData['password'] = Hash::make($userData['password']);
        }

        $user->update($userData);

        return redirect()->route('user.view', $user->id);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
