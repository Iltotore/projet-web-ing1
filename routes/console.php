<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command"s IO methods.
|
*/

Artisan::command("inspire", function () {
    $this->comment(Inspiring::quote());
})->purpose("Display an inspiring quote");

Artisan::command("db:setup", function () {
    $this->call("db:wipe");
    $this->call("migrate:refresh");
    $this->call("db:seed");
});

//Send a mail
Artisan::command("mail:send {to} {subject} {content}", function(string $to, string $subject, string $content) {
    echo $to;
    Mail::raw($content, function ($m) use($to, $subject, $content) {
        $m->to($to)->subject($subject);
    });
})->purpose("Send a mail");
