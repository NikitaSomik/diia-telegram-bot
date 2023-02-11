<?php

declare(strict_types=1);

namespace App\Domains\Telegram\Conversations;

use App\Domains\Telegram\Services\BotMenuService;
use BotMan\BotMan\Messages\Conversations\Conversation;

class MainMenuConversation extends Conversation
{
    private const DESCRIPTION = '🕹Please now use the buttons to select which product your question is about:
- 📱 digital documents
– 🗃services

This is necessary so that you receive an answer only regarding the selected product or ask a question to a manager who specializes in it.';

    private BotMenuService $botManService;

    public const START_COMMAND = 'start';
    public const BACK_COMMAND = 'back';

    public function __construct(BotMenuService $botManService)
    {
        $this->botManService = $botManService;
    }

    public function run(): void
    {
        $menus = $this->botManService->getByParentColumn();
        $keyboard = $this->botManService->makeMenuKeyboard($menus);

        $this->bot->reply(self::DESCRIPTION, $keyboard->toArray());
    }
}
