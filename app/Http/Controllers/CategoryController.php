<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Document;

class CategoryController extends Controller
{
    function index(Request $request){
        if (! Gate::allows('View Document Categories')) {
            abort(403);
        }

        return view('category.index');
    }

    function retrieve(Request $request){
        $status = $request->input('status');
        $categories = Category::where('status', $status)->get();
        return view('category.list',compact('categories'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    function create(Request $request){
        $id = $request->input('id');
        $category = isset($id) ? Category::where('id', $id)->first() : null;
        return view('category.create', ['category' => $category]);
    }

    public function store(Request $request)
    {   
        $id = $request->input('id');
        $seriesno = ($request->input('is_with_series_no')) ? intval($request->input('is_with_series_no')) : null;
        $sender = ($request->input('is_with_sender')) ? intval($request->input('is_with_sender')) : null;
        $recipient = ($request->input('is_with_receiver')) ? intval($request->input('is_with_receiver')) : null;

        if ($id){
            Category::where('id', $id)->update(['category' => $request->input('category'),
                                                    'is_with_series_no' => $seriesno,
                                                    'is_with_sender' => $sender,
                                                    'is_with_receiver' => $recipient,
                                                    'updated_by' => Auth::id(),
                                                    'updated_at' => date('Y-m-d H:i:s')
                                                ]);
            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"Category successfully updated!"];
        }
        else{
            $validator = Validator::make($request->all(), [
                'category' => 'required|unique:category,category'
            ]);

            if ($validator->fails()){
                return ['icon'=>'error',
                    'title'=>'Error',
                    'message'=> $validator->errors()->first('category')];
            }
    
            Category::create($request->all());
            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"Category successfully created!"];
        }
    }

    function toggleStatus(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');

        if (!$status):
            $results = Document::where('category', $id)->get();

            if (count($results)):
                return ['icon'=>'error', 
                            'title'=>'Error',
                            'message'=>"Unable to delete! Category is currently associated to a document!"];
            endif;
        endif;

        Category::where('id', $id)->update(['status' => $status]);
        return ($status) ? ['icon'=>'success','title'=>'Success','message'=>"Category successfully re-activated!"] : ['icon'=>'success','title'=>'Success','message'=>"Category successfully deleted!"];
    }
}
