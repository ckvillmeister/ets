<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\RoleHasPermissions;


class PermissionController extends Controller
{

    function index(Request $request){
        if (! Gate::allows('View Permissions')) {
            abort(403);
        }

        return view('permissions.index');
    }

    function retrieve(Request $request){
        $status = $request->input('status');
        $permissions = Permission::where('status', $status)->get();
        return view('permissions.list',compact('permissions'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    function create(Request $request){
        $id = $request->input('id');
        $permission = isset($id) ? Permission::where('id', $id)->first() : null;
        return view('permissions.create', ['permission' => $permission]);
    }

    public function store(Request $request)
    {   
        $id = $request->input('id');

        if ($id){
            
            Permission::where('id', $id)->update(['name' => $request->input('name'),
                                                    'updated_at' => date('Y-m-d H:i:s')
                                            ]);
            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"Permission successfully updated!"];
        }
        else{
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:permissions,name'
            ]);

            if ($validator->fails()){
                return ['icon'=>'error',
                    'title'=>'Error',
                    'message'=> $validator->errors()->first('name')];
            }
    
            Permission::create($request->all() + ['guard_name' => Auth::getDefaultDriver()]);
            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"Permission successfully created!"];
        }
    }

    function toggleStatus(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');

        if (!$status):
            $results = RoleHasPermissions::where('permission_id', $id)->get();

            if (count($results)):
                return ['icon'=>'error', 
                            'title'=>'Error',
                            'message'=>"Unable to delete! Permission is currently associated to a role."];
            endif;
        endif;

        Permission::where('id', $id)->update(['status' => $status]);
        return ($status) ? ['icon'=>'success','title'=>'Success','message'=>"Permission successfully re-activated!"] : ['icon'=>'success','title'=>'Success','message'=>"Permission successfully deleted!"];
    }
}
