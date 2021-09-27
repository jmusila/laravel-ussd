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

        if ($text == "") {
            // first response when a user dials our ussd code
            $response  = "CON Welcome to CleanGenesis Academy \n";
            $response .= "1. Register \n";
            $response .= "2. About CleanGenesis";
        } elseif ($text == "1") {
            // when user respond with option one to register
            $response = "CON Choose which framework to learn \n";
            $response .= "1. Django Web Framework \n";
            $response .= "2. Laravel Web Framework";
        } elseif ($text == "1*1") {
            // when use response with option django
            $response = "CON Please enter your first name";
        } elseif ($ussd_string_exploded[0] == 1 && $ussd_string_exploded[1] == 1 && $level == 3) {
            $response = "CON Please enter your last name";
        } elseif ($ussd_string_exploded[0] == 1 && $ussd_string_exploded[1] == 1 && $level == 4) {
            $response = "CON Please enter your email";
        } elseif ($ussd_string_exploded[0] == 1 && $ussd_string_exploded[1] == 1 && $level == 5) {
            // save data in the database
            $response = "END Your data has been captured successfully! Thank you for registering for Django online classes at HLAB.";
        } elseif ($text == "1*2") {
            // when use response with option Laravel
            $response = "CON Please enter your first name. ";
        } elseif ($ussd_string_exploded[0] == 1 && $ussd_string_exploded[1] == 2 && $level == 3) {
            $response = "CON Please enter your last name";
        } elseif ($ussd_string_exploded[0] == 1 && $ussd_string_exploded[1] == 2 && $level == 4) {
            $response = "CON Please enter your email";
        } elseif ($ussd_string_exploded[0] == 1 && $ussd_string_exploded[1] == 2 && $level == 5) {
            // save data in the database
            $response = "END Your data has been captured successfully! Thank you for registering for Laravel online classes at HLAB.";
        } elseif ($text == "2") {
            // Our response a user respond with input 2 from our first level
            $response = "END At HLAB we try to find a good balance between theory and practical!.";
        }
        // send your response back to the API
        header('Content-type: text/plain');
        echo $response;
    }
}
