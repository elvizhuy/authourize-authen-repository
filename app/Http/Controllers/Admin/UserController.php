<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class UserController extends Controller
{
    public function index()
    {
        $userID = Auth::user()->id;
        if (Auth::user()->user_id === 0) {
            $users = User::all();
        } else {
            $users = User::where('user_id', $userID)->get();
        }
        return view('admin.users.list', compact('users'));
    }

    public function add()
    {
        $groups = Group::all();
        return view('admin.users.add', compact('groups'));
    }

    public function postAdd(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'groups_id' => ['required', function ($attribute, $value, $fail) {
                if ($value == 0) {
                    $fail('Group must be filled!');
                }
            }]
        ], [
            'name.required' => 'Name can not be empty',
            'email.required' => 'Email can not be empty',
            'email.unique' => 'Email must be unique',
            'password.required' => 'Password can not be empty',
            'password.min' => 'Password must be > 6',
            'groups_id.required' => 'Group ID can not be empty',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->groups_id = $request->groups_id;
        $user->user_id = Auth::user()->id;
        $user->save();

        return redirect()->route('admin.users.index')->with('msg', 'New User added successfully...');
    }
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $groups = Group::all();
        return view('admin.users.edit', compact('user', 'groups'));
    }

    public function postEdit(User $user, Request $request)
    {
        $this->authorize('update', $user);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'groups_id' => ['required', function ($attribute, $value, $fail) {
                if ($value == 0) {
                    $fail('Group must be filled!');
                }
            }]
        ], [
            'name.required' => 'Name can not be empty',
            'email.required' => 'Email can not be empty',
            'email.unique' => 'Email must be unique',
            'groups_id.required' => 'Group ID can not be empty',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->groups_id = $request->groups_id;
        $user->save();

        return back()->with('msg', 'Update User successfully...');
    }

    public function delete(User $user)
    {
        $this->authorize('delete', $user);
        if (Auth::user()->id != $user->id) {
            User::destroy($user->id);
            return redirect()->route('admin.users.index')->with('msg', 'User deleted!');
        }
        return redirect()->route('admin.users.index')->with('msg', 'User can not be deleted!');
    }
}
