<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
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
            $validator = Validator::make($request->all(), [
                'firstname' => 'required',
                'lastname' => 'required',
                'role' => 'required',
            ]);

            if ($validator->fails()){
                return ['icon'=>'error',
                    'title'=>'Error',
                    'message'=> $validator->errors()->first()];
            }

            $user = User::where('id', $id)->update($request->all() + ['updated_by' => Auth::id(),
                                                                        'updated_at' => date('Y-m-d H:i:s')]);
            $user = User::where('id', $id)->first();
            $role = Role::where('id', $request->input('role'))->first();
            $user->assignRole($role);

            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"User successfully updated!"];
        }
        else{
            $validator = Validator::make($request->all(), [
                'firstname' => 'required',
                'lastname' => 'required',
                'username' => 'required|unique:users,username',
                'password' => 'required',
                'role' => 'required',
            ]);

            if ($validator->fails()){
                return ['icon'=>'error',
                    'title'=>'Error',
                    'message'=> $validator->errors()->first()];
            }
    
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
        if ($action):
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

    public function changePassword(Request $request)
    {
        $id = Auth::id();
        $opassword = ($request->input('opassword')) ? $request->input('opassword') : null;
        $password = ($request->input('password')) ? $request->input('password') : null;
        $password_confirmation = ($request->input('password_confirmation')) ? $request->input('password_confirmation') : null;

        
        if ($password){
            if (!Hash::check($opassword, Auth::user()->password)){
                return ['icon'=>'error',
                        'title'=>'Error',
                        'message'=>"Old password entered is incorrect!"];
            }
            elseif ($password != $password_confirmation){
                return ['icon'=>'error',
                        'title'=>'Error',
                        'message'=>"Password does not match!"];
            }
            else{
                User::where('id', $id)->update(['password' => Hash::make($password)]);
                return ['icon'=>'success',
                        'title'=>'Success',
                        'message'=>"Password successfully changed!"];
            }
        }
        else{
            return view('user.changepass');
        }
        
    }
}
