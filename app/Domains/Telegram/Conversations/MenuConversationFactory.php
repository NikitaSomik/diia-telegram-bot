<?php

declare(strict_types=1);

namespace App\Domains\Telegram\Conversations;

use App\Domains\Telegram\Services\BotMenuServiceInterface;
use BotMan\BotMan\Messages\Conversations\Conversation;

final class MenuConversationFactory
{

    public static function make(string $answer): Conversation
    {
        $botMenuService = app(BotMenuServiceInterface::class);
        return match ($answer) {
            MainMenuConversation::START_COMMAND,
            MainMenuConversation::BACK_COMMAND => new MainMenuConversation($botMenuService),
            default => new OthersMenuConversation($botMenuService, $answer),
        };
    }
}
