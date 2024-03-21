<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Category;
use App\Models\Document;

class ReportsController extends Controller
{
    function index(Request $request){
        if (! Gate::allows('View Reports')) {
            abort(403);
        }

        $categories = Category::where('status', 1)->get();

        return view('reports.index', ['categories' => $categories]);
    }

    function displayReports(Request $request){
    	$category = ($request->input('category')) ? $request->input('category') : null;
    	$date_from = ($request->input('date_from')) ? $request->input('date_from') : null;
    	$date_to = ($request->input('date_to')) ? $request->input('date_to') : null;

    	$documents = Document::whereBetween('doc_date', [$date_from, $date_to]);
    	$documents = ($category) ? $documents->where('category', $category) : $documents;
    	$documents = $documents->get();

    	return view('reports.list', ['documents' => $documents]);
    }
}
