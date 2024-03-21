<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Document;

class DashboardController extends Controller
{
    function index(Request $request){
        if (! Gate::allows('View Dashboard')) {
            abort(403);
        }

        return view('dashboard.index', ['DocumentsPerType' => $this->getDocumentsPerType(),
    									'DocumentsPerMonth' => $this->getDocumentsPerMonth()]);
    }

    function getDocumentsPerType(){
    	$categories = Category::where('status', 1)->get();
    	$categ = []; 
    	$data = [];
    	$color = [];
    	$collection = [];

    	foreach ($categories as $key => $category) {
    		$categ[] = $category->category;
    		$data[] = Document::where('category', $category->id)->get()->count();
    		$color[] = $this->randomHexColor();
    	}

    	$collection = [$categ, $data, $color];
    	return $collection;
    }

    function getDocumentsPerMonth(){
    	$months = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
    	$year = date('Y');
    	$data = [];

    	foreach ($months as $month) {
    		$data[] = Document::whereYear('doc_date', $year)->whereMonth('doc_date', $month)->get()->count();
    	}
    	
    	return $data;
    }

    function randomHexColor(){
	    //return '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);

	    return '#' . str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
	}
}
