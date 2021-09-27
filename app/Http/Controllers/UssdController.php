<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UssdController extends Controller
{
    /**
     * Ussd menu
     */
    public function ussdMenu(Request $request)
    {
        $sessionId   = $request["sessionId"];
        $serviceCode = $request["serviceCode"];
        $phone       = $request["phoneNumber"];
        $text        = $request["text"];

        header('Content-type: text/plain');

        if (User::where('phone_number', $phone)->exists()) {
            // Function to handle already registered users
            $this->handleReturnUser($text, $phone);
        } else {
            // Function to handle new users
            $this->handleNewUser($text, $phone);
        }
    }

    public function handleNewUser($ussd_string, $phone)
    {
        $ussd_string_exploded = explode("*", $ussd_string);

        // Get menu level from ussd_string reply
        $level = count($ussd_string_exploded);

        if (empty($ussd_string) or $level == 0) {
            $this->newUserMenu(); // show the home menu
        }

        switch ($level) {
              case ($level == 1 && !empty($ussd_string)):
                  if ($ussd_string_exploded[0] == "1") {
                      // If user selected 1 send them to the registration menu
                      $this->ussd_proceed("Please enter your full name and desired pin separated by commas. \n eg: Jane Doe,1234");
                  } elseif ($ussd_string_exploded[0] == "2") {
                      //If user selected 2, send them the information
                      $this->ussd_stop("You will receive more information on SampleUSSD via sms shortly.");
                      $this->sendText("This is a subscription service from SampleUSSD.", $phone);
                  } elseif ($ussd_string_exploded[0] == "3") {
                      //If user selected 3, exit
                      $this->ussd_stop("Thank you for reaching out to SampleUSSD.");
                  }
              break;
              case 2:
                  if ($this->ussdRegister($ussd_string_exploded[1], $phone) == "success") {
                      $this->servicesMenu();
                  }
              break;
              // N/B: There are no more cases handled as the following requests will be handled by return user
          }
    }
}
