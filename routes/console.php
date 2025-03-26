<?php

use App\Console\Commands\GetUpdates;
use Illuminate\Support\Facades\Schedule;

Schedule::command(GetUpdates::class)->everyTwoSeconds();
