<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Console\Command\Command as CommandAlias;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Telegram\Bot\Laravel\Facades\Telegram;

class SetWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:webhook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set webhook to the app';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Telegram::bot('mainBot')->setWebhook(['url' => env('APP_URL') . "/telegram/" . env("TG_MAIN_BOT") . "/webhook"]);

        return  1;
    }
}