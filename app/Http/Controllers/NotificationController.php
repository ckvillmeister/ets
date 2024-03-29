<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Httpequest;
use App\Events\DocumentStored;
use Twilio\Rest\Client;

class NotificationController extends Controller
{
    
    function notify(){
    	event(new DocumentStored('Clark'));
    }

    function sendMsg(){
    	$sid    = "AC90d3a6fc3cc71ebfad34c7a3e5588071";
	    $token  = "6e86e6863f7ffbc51168100b5e2f9883";
	    $twilio = new Client($sid, $token);

	    $body = "Basdadaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";

	    $message = $twilio->messages
	      ->create("+639097764778", // to
	        array(
	          "from" => "+16018094470",
	          "body" => $body
	        )
	      );
    }
}
