<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\DocumentStored;

class NotificationController extends Controller
{
    
    function notify(){
    	event(new DocumentStored('Clark'));
    }
}
