<?php

use Illuminate\Support\Facades\Schedule;

Schedule::call(\App\Console\Commands\GetUpdates::class)->everyTwoSeconds();
