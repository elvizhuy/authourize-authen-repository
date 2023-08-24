<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        $userID = Auth::user()->id;
        if (Auth::user()->user_id === 0) {
            $groups = Group::all();
        } else {
            $groups = Group::where('user_id', $userID)->get();
        }

        return view('admin.group.list', compact('groups'));
    }


    public function add()
    {
        return view('admin.group.add');
    }

    public function postAdd(Request $request)
    {
        $request->validate([
            'name' => 'required:unique:groups,name',
        ], [
            'name.required' => 'Name can not be empty',
            'name.unique' => 'Name is duplicated',
        ]);

        $group = new Group();
        $group->name = $request->name;
        $group->user_id = Auth::user()->id;
        $group->save();

        return redirect()->route('admin.groups.index')->with('msg', 'Update group successfully...');
    }
    public function edit(Group $group)
    {
        $this->authorize('update', $group);

        $groups = Group::all();
        return view('admin.group.edit', compact('groups'));
    }

    public function postEdit(Group $group, Request $request)
    {
        $this->authorize('update', $group);

        $request->validate([
            'name' => 'required:unique:groups,name',
        ], [
            'name.required' => 'Name can not be empty',
            'name.unique' => 'Name is duplicated',
        ]);

        $group = new Group();
        $group->name = $request->name;
        $group->save();

        return back()->with('msg', 'Update group successfully...');
    }

    public function delete(Group $group)
    {
        $this->authorize('delete', $group);

        $userCount = $group->user->count();
        if ($userCount == 0) {
            Group::destroy($group->id);
            return redirect()->route('admin.group.list')->with('msg', 'Group deleted!');
        }
        return redirect()->route('admin.group.list')->with('msg', 'Group can not be deleted!');
    }

    public function permission(Group $group)
    {
        $this->authorize('permission', $group);
        $modules = Module::all();
        $roleListArr = [
            'view' => 'View',
            'add' => 'Add',
            'edit' => 'Edit',
            'remove' => 'Remove'
        ];

        $roleJson = $group->permissions;
        if (!empty($roleJson)) {
            $roleArr = json_decode($roleJson, true);
        } else {
            $roleArr = [];
        }

        return view('admin.group.permission', compact('group', 'modules', 'roleListArr', 'roleArr'));
    }

    public function postPermission(Request $request, Group $group)
    {
        $this->authorize('permission', $group);

        if (!empty($request->role)) {
            $roleArray = $request->role;
        } else {
            $roleArray = [];
        }
        $roleJson = json_encode($roleArray);
        $group->permissions = $roleJson;
        $group->save();
        return back()->with('msg', 'Grant permission successfully...');
    }
}
