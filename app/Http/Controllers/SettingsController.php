<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    function index(Request $request){
        if (! Gate::allows('View Settings')) {
            abort(403);
        }

        return view('settings.index');
    }
}
