<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('migrate:fresh', function () {
    /** @var \Illuminate\Console\Command $cmd */
    $cmd = $this;

    $cmd->info('Nda boleh di fresh skarang, di skip aja dari tutorialnya ');

})->purpose('Disable fresh command');
