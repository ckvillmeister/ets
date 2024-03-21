<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    function index(Request $request){
        if (! Gate::allows('View User Accounts')) {
            abort(403);
        }

        return view('user.index');
    }

    function retrieve(Request $request){
        $status = $request->input('status');
        $users = User::with('role')->where('status', $status)->get();
        return view('user.list', ['users' => $users]);
    }

    function create(Request $request){
        $id = $request->input('id');
        $roles = Role::where('status', 1)->get();
        $user = User::where('id', $id)->first();
        return view('user.create', ['user' => $user, 'roles' => $roles]);
    }

    public function store(Request $request)
    {   
        $id = $request->input('id');
        
        if ($id){
            $request->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'role' => 'required',
            ]);

            $user = User::where('id', $id)->update($request->all());
            $user = User::where('id', $id)->first();
            $role = Role::where('id', $request->input('role'))->first();
            $user->assignRole($role);

            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"User successfully updated!"];
        }
        else{
            $request->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'username' => 'required|unique:users,username',
                'password' => 'required',
                'role' => 'required',
            ]);
    
            $user = User::create($request->all());
            $role = Role::where('id', $request->input('role'))->first();
            $user->assignRole($role);
            
            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"User successfully created!"];
        }
    }

    function toggleStatus(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        User::where('id', $id)->update(['status' => $status]);
        return ($status) ? ['icon'=>'success','title'=>'Success','message'=>"User successfully re-activated!"] : ['icon'=>'success','title'=>'Success','message'=>"User successfully de-activated!"];
    }

    public function resetPassword($action, Request $request)
    {   
        if ($action == 'resetForm'):
            $id = $request->input('id');
            $user = User::where('id', $id)->first();
            return view('user.resetpass', ['user' => $user]);
        else:
            $id = $request->input('id');
            User::where('id', $id)->update(['password' => Hash::make($request->input('password'))]);
            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"Password reset successfully!"];
        endif;
        
    }
}
