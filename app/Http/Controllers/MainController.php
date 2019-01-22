<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function receive(Request $request)
    {
            $data = $request->all();
        
            //get the user’s id
            $id = $data["entry"][0]["messaging"][0]["sender"]["id"];
        $this->sendTextMessage($id, "Hello friend, What can i help?");
    }

private function sendTextMessage($recipientId, $messageText)
    {
        $messageData = [
            "recipient" => [
                "id" => $recipientId
            ],
            "message" => [
                "text" => $messageText
            ]
        ];
        $ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token=EAAhmYW4BXZAIBAA4SjktNpL7rFCMSFlZBa3OxcHMMFFozJYWptFnjbhcNdYqABCRJroBujqPnbNcOYXnZAEJSxG1X7tmc82jBA3896fPddcrX3CsxZAfZCERNcXAuz96D3YR8Q0tPfQ6BzHaG85kEa7hdKFq6SU8yaHMLSB3mgQZDZD');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messageData));
        curl_exec($ch);
    
}

}
