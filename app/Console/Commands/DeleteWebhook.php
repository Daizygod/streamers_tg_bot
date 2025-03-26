<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Console\Command\Command as CommandAlias;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Telegram\Bot\Laravel\Facades\Telegram;

class DeleteWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:webhook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete webhook';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Telegram::bot('mainBot')->deleteWebhook();

        return  1;
    }
}