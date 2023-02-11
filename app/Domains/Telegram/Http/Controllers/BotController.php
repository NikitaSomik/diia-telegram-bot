<?php

declare(strict_types=1);

namespace App\Domains\Telegram\Http\Controllers;

use App\Domains\Telegram\Conversations\InitialConversation;
use App\Domains\Telegram\Services\BotMenuServiceInterface;
use App\Http\Controllers\Controller;
use BotMan\BotMan\BotMan;

class BotController extends Controller
{

    public function __invoke(BotMenuServiceInterface $botManService): void
    {
        $botman = app('botman');

        $menus = $botManService->getAll();
        $menusName = $menus->pluck('name')->implode('|');

        $botman->hears('/start|/back|' . $menusName, function(BotMan $bot) use ($botManService) {
            $bot->startConversation(new InitialConversation());
        });

        $botman->listen();
    }
}
