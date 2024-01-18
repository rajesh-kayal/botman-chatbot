<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Http\Request;

class BotManController extends Controller
{

    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function ($botman, $message) {

            if ($message == 'hi') {
                $this->askName($botman);
            } elseif ($message == 'help') {
                $this->provideHelp($botman);
            } elseif ($message == 'refresh') {
                $this->updateContact($botman);
            } else {
                $this->defaultReply($botman);
            }

        });

        $botman->listen();
    }

    public function askName($botman)
    {
        $botman->ask("Hello! What is Your Name?", function (Answer $answer) {
            $name = $answer->getText();

            $this->say("Nice to meet you, $name! How can I assist you today?");
        });
    }

    public function provideHelp($botman)
    {
        $botman->reply("Sure! I can help you with various tasks. For example, you can ask me about the weather, news, or anything else you have in mind.");
    }

    public function updateContact($botman)
    {
        $contactNumber = '+1234567890';

        $botman->reply("Great! If you need assistance, feel free to call us at $contactNumber. We're here to help! You can also ask anything else.");
    }

    public function defaultReply($botman)
    {
        $botman->reply("I'm not sure I understand. If you have any questions or need assistance, feel free to ask. You can also type 'help' for more information.");
    }



}
