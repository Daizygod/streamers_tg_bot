<?php

use App\Http\Controllers\TelegramClubStatsController;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::post('/webhook', function () {
//    //return view('welcome');
//    return view('documentation');
//});

//Route::post('/{token}/webhook', [TelegramClubStatsController::class, 'webhook']);

Route::post("/{token}/webhook", function ($token) {

    if ($token === env('TG_MAIN_BOT')) {
        $update = Telegram::bot('mainBot')->commandsHandler(true);
//        Telegram::bot('mainBot')->sendMessage(['text' => json_encode($update), 'chat_id' => '244205384']);
    }

    // Commands handler method returns the Update object.
    // So you can further process $update object
    // to however you want.

    return 'ok';
});



