<?php

namespace App\Bot;

use Illuminate\Support\Facades\Cache;

class Trivia
{
    const NEW_QUESTION = "new";
    const ANSWER = "answer";

    public $question;
    public $options;
    private $solution;
    private $userId;
    public function __construct(array $data, $userId)
    {
        $this->question = "";
        $this->solution = "";
        $this->options = [];
        $this->userId = userId;
   }
}