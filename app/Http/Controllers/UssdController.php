<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UssdController extends Controller
{
    /**
     * Ussd menu
     */
    public function ussdMenu(Request $request)
    {
        $sessionId   = $request->get('session_id');
        $serviceCode = $request->get('service_code');
        $phoneNumber = $request->get('phone_number');
        $text        = $request->get('text');

        $ussd_string_exploded = explode("*", $text);

        $level = count($ussd_string_exploded);
    }
}
