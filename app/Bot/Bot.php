<?php

namespace App\Bot;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Bot\Trivia;

class Bot
{
    
    private $messaging;

    public function __construct(Messaging $messaging) 
    {
        $this->messaging = $messaging;
    }
    
    //extracts entries from a Messenger callback
    public function extractDataFromMessage()
    {
        $matches = [];
        $text = $this->messaging->getMessage()->getText();
        //single letter message means an answer
        if (preg_match("/^(\\w)\$/i", $text, $matches)) {
            return [
                "type" => Trivia::ANSWER,
                "data" => [
                    "answer" => $matches[0]
                ],
                "user_id" => $this->messaging->getSenderId()
           ];
        } else if (preg_match("/^new|next\$/i", $text, $matches)) {
            //"new" or "next" requests a new question
            return [
                "type" => Trivia::NEW_QUESTION,
                "data" => [],
                "user_id" => $this->messaging->getSenderId()
            ];
        }
        //anything else, we dont care
        return [
            "type" => "unknown",
            "data" => [],
            "user_id" => $this->messaging->getSenderId()
        ];
    }

}