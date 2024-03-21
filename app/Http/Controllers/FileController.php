<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth as Authentication;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Attachments;

class FileController extends Controller
{
    function index(Request $request){
        if (! Gate::allows('View File Uploader')) {
            abort(403);
        }

        $search = $request->input('search');
        $status = ($request->exists('status')) ? $request->input('status') : 1;

        if ($search):
            $files = File::where('status', $status)
                                ->when($search, function($query) use ($search){
                                    $query->where('filename', 'LIKE', '%'.$search.'%');
                                })->orderBy('id', 'desc')->paginate(12);
        else:
            $files = File::where('status', $status)->orderBy('id', 'desc')->paginate(12);
        endif;

        return view('file.index', ['files' => $files]);
    }

    function create(Request $request){
        return view('file.upload');
    }

    function store(Request $request){
        $extension = $request->fileuploader->extension();
        $filename = date('Y_m_d_H_i_s_'.substr((string)microtime(), 2, 4));
        
        File::create([
            'filename' => $filename.'.'.$extension,
            'type' => $extension,
            'created_by' => Authentication::id(),
            'created_at' => date('Y-m-d H:i:s')
        ]);
        Storage::disk('local')->putFileAs('/', $request->fileuploader, $filename.'.'.$extension);
    }

    function toggleStatus(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');

        if (!$status):
            $results = Attachments::where('file_id', $id)->get();

            if (count($results)):
                return ['icon'=>'error', 
                            'title'=>'Error',
                            'message'=>"Unable to delete! Uploaded scanned file is currently attached to a document."];
            endif;
        endif;

        File::where('id', $id)->update(['status' => $status]);
        return ($status) ? ['icon'=>'success','title'=>'Success','message'=>"File successfully restored!"] : ['icon'=>'success','title'=>'Success','message'=>"File successfully deleted!"];
    }

    function getFiles(Request $request){
        $files = File::orderBy('id', 'DESC')->get();
        $path  = Storage::disk('local')->path('');

        return view('document.filelist', ['files' => $files, 'path' => $path]);
    }
}
