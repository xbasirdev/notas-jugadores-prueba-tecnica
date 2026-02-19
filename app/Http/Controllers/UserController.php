<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    public function __construct(private UserRepositoryInterface $users)
    {
    }

    public function index()
    {
        $users = $this->users->all(25);
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        $roles = \Spatie\Permission\Models\Role::all();
        return view('users.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'roles' => 'nullable|array',
        ]);

        $this->users->create($data);

        return redirect()->route('users.index');
    }

    public function edit(int $id)
    {
        $user = $this->users->find($id);
        $roles = \Spatie\Permission\Models\Role::all();
        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
            'roles' => 'nullable|array',
        ]);

        $this->users->update($id, $data);

        return redirect()->route('users.index');
    }

    public function destroy(int $id)
    {
        // Toggle active flag instead of hard delete
        $user = $this->users->find($id);
        if ($user) {
            $user->active = ! $user->active;
            $user->save();
        }

        return redirect()->route('users.index');
    }
}
