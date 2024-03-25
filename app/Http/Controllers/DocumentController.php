<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Enums\Actions;
use App\Models\Document;
use App\Models\Category;
use App\Models\File;
use App\Models\Attachments;
use App\Models\DocumentHistory;
use App\Events\DocumentStored;

class DocumentController extends Controller
{

    function index(Request $request){
        if (! Gate::allows('View Document Manager')) {
            abort(403);
        }

        $search = $request->input('search');
        $status = ($request->exists('status')) ? $request->input('status') : 1;

        if ($search):
            $documents = Document::where('status', $status)
                                ->when($search, function($query) use ($search){
                                    $query->where('title', 'LIKE', '%'.$search.'%')
                                            ->orWhere('description', 'LIKE', '%'.$search.'%')
                                            ->orWhere('series', 'LIKE', '%'.$search.'%');
                                })->paginate(12);
        else:
            $documents = Document::where('status', $status)->paginate(12);
        endif;

        return view('document.index', ['documents' => $documents]);
    }

    function create(Request $request){
        $id = ($request->input('id')) ? $request->input('id') : null;
        $document = Document::find($id);
        $categories = Category::where('status', 1)->get();
        return view('document.create', ['document' => $document, 'categories' => $categories]);
    }

    function store(Request $request){
        $id = ($request->input('id')) ? $request->input('id') : null;
        $attachments = ($request->input('attachments')) ? explode(",", $request->input('attachments')) : [];
        $category = ($request->input('category')) ? $request->input('category') : null;
        $series = ($request->input('series')) ? $request->input('series') : null;
        $title = ($request->input('title')) ? $request->input('title') : null;
        $description = ($request->input('description')) ? $request->input('description') : null;
        $doc_date = ($request->input('doc_date')) ? $request->input('doc_date') : null;
        $sender = ($request->input('sender')) ? $request->input('sender') : null;
        $datetimesent = ($request->input('datetimesent')) ? $request->input('datetimesent') : null;
        $recipient = ($request->input('recipient')) ? $request->input('recipient') : null;
        $datetimereceived = ($request->input('datetimereceived')) ? $request->input('datetimereceived') : null;
        $fullname = Auth::user()->firstname.' '.Auth::user()->lastname;
        $files = ($request->files) ? $request->files : null;
        
        if ($files){
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $filename = date('Y_m_d_H_i_s_'.substr((string)microtime(), 2, 4));
                
                Storage::disk('local')->putFileAs('/', $file, $filename.'.'.$extension);
                $file = File::create([
                    'filename' => $filename.'.'.$extension,
                    'type' => $extension,
                    'created_by' => Auth::id(),
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                array_push($attachments, $file->id);
            }
        }


        if ($id){
            $document = Document::where('id', $id)->update(['category' => $category,
                                                'series' => $series,
                                                'title' => $title,
                                                'description' => $description,
                                                'doc_date' => $doc_date,
                                                'sender' => $sender,
                                                'datetimesent' => $datetimesent,
                                                'recipient' => $recipient,
                                                'datetimereceived' => $datetimereceived,
                                                'updated_by' => Auth::id(),
                                                'updated_at' => date('Y-m-d H:i:s')
                                                ]);
            Attachments::where('document_id', $id)->delete();

            if ($attachments){
                foreach($attachments as $key => $attachment):
                    Attachments::create(['document_id' => $id, 'file_id' =>$attachment]);
                endforeach;
            }

            DocumentHistory::create(['document_id' => $id, 
                                        'action' =>  2,
                                        'executed_by' => Auth::id(),
                                        'execution_date' => date('Y-m-d H:i:s')
                                        ]);

            event(new DocumentStored($fullname, 'updated'));

            return ['icon'=>'success', 
                            'title'=>'Success',
                            'message'=>"Document successfully updated!",
                            'id' => $id];
        }
        else{
            $document = Document::create($request->all() + ['created_by' => Auth::id()]);

            if ($attachments){
                foreach($attachments as $key => $attachment):
                    Attachments::create(['document_id' => $document->id, 'file_id' =>$attachment]);
                endforeach;
            }

            DocumentHistory::create(['document_id' => $document->id, 
                                        'action' =>  1,
                                        'executed_by' => Auth::id(),
                                        'execution_date' => date('Y-m-d H:i:s')
                                        ]);

    

            event(new DocumentStored($fullname, 'created'));

            return ['icon'=>'success', 
                            'title'=>'Success',
                            'message'=>"New document successfully saved!",
                            'id' => $document->id];

        }
        
    }

     function toggleStatus(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        Document::where('id', $id)->update(['status' => $status]);
        return ($status) ? ['icon'=>'success','title'=>'Success','message'=>"Document successfully restored!"] : ['icon'=>'success','title'=>'Success','message'=>"Document successfully deleted!"];
    }

    function view(Request $request){
        $id = $request->input('id');
        $document = Document::with(['category', 'attachments.info', 'history_logs.executor'])->find($id);
        return view('document.view', ['document' => $document]);
    }
}
