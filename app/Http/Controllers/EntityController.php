<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Entity;
use App\Models\Province;
use App\Models\Town;
use App\Models\Barangay;

class EntityController extends Controller
{
    function index(Request $request){
        if (! Gate::allows('View Entity Manager')) {
            abort(403);
        }

        $search = $request->input('search');
        $status = ($request->exists('status')) ? $request->input('status') : 1;

        if ($search):
            $entities = Entity::where('status', $status)
                                ->when($search, function($query) use ($search){
                                    $query->where('firstname', 'LIKE', '%'.$search.'%')
                                            ->orWhere('middlename', 'LIKE', '%'.$search.'%')
                                            ->orWhere('lastname', 'LIKE', '%'.$search.'%')
                                            ->orWhere('entityname', 'LIKE', '%'.$search.'%');
                                })->paginate(12);
        else:
            $entities = Entity::where('status', $status)->paginate(12);
        endif;
        
        return view('entity.index', ['entities' => $entities]);
    }

    function create(Request $request){
        $id = $request->input('id');
        $entity = Entity::find($id);
        $provinces = Province::all()->sortBy("description");
        $towns = Town::where('province_code', '0712')->orderBy('description', 'ASC')->get();
        $brgys = Barangay::where('town_code', '071244')->orderBy('description', 'ASC')->get();
        return view('entity.create', ['entity' => $entity, 'provinces' => $provinces, 'towns' => $towns, 'brgys' => $brgys]);
    }

    function store(Request $request){
        if ($request->input('entity-type') == 'individual'):
            $request->validate([
                'firstname' => 'required',
                'lastname' => 'required'
            ]);
        else:
            $request->validate([
                'entityname' => 'required'
            ])->add('entity-type', $request->input('entity-type'));
        endif;

        if ($request->input('id')){
            Entity::where('id', $request->input('id'))->update($request->except('entity-type'));
        }
        else{
            Entity::create($request->all());
        }

        return redirect('/entity');
    }

    function toggleStatus(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        Entity::where('id', $id)->update(['status' => $status]);
        return ($status) ? ['icon'=>'success','title'=>'Success','message'=>"Entity successfully restored!"] : ['icon'=>'success','title'=>'Success','message'=>"Entity successfully deleted!"];
    }

    function profile(Request $request){
        $id = $request->input('id');
        $entity = Entity::with(['barangay', 'town', 'province'])->find($id);
        return view('entity.profile', ['entity' => $entity]);
    }
}
