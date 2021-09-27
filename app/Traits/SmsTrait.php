<?php

namespace App\Traits;

use AfricasTalking\SDK\AfricasTalking;
use Exception;

trait SmsTrait
{
    public function sendText($message, $phone)
    {
        $username = config("africastalking.sandbox.username");
        $apiKey = config("africastalking.sandbox.api_key");

        $AT = new AfricasTalking($username, $apiKey);

        $sms = $AT->sms();

        try {
            $result = $sms->send([
                'to'      => $phone,
                'message' => $message
            ]);

            print_r($result);
        } catch (Exception $e) {
            echo "Error: ".$e.getMessage();
        }

        return "I am done";
    }
}