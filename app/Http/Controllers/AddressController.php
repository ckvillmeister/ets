<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barangay;
use App\Models\Town;

class AddressController extends Controller
{
    function towns($code, Request $request){
        $towns = ($code) ? Town::where('province_code', $code)->get() : Town::all();
        return $towns->toJson();
    }

    function barangays($code, Request $request){
        $barangays = ($code) ? Barangay::where('town_code', $code)->get() : Barangay::all();
        return $barangays->toJson();
    }
}
