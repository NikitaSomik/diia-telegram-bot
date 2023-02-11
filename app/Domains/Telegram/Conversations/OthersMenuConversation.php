<?php

declare(strict_types=1);

namespace App\Domains\Telegram\Conversations;

use App\Domains\Telegram\Services\BotMenuService;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\Drivers\Telegram\Extensions\KeyboardButton;

class OthersMenuConversation extends Conversation
{
    private const DESCRIPTION = '🕹Please now use the buttons to select which product your question is about:
- 📱 digital documents
– 🗃services

This is necessary so that you receive an answer only regarding the selected product or ask a question to a manager who specializes in it.';

    private BotMenuService $botManService;

    public function __construct(BotMenuService $botManService, private string $answer)
    {
        $this->botManService = $botManService;
    }

    public function run(): void
    {
        $menus = $this->botManService->getAll();
        $menu = $menus->first(fn ($menu) => $menu->name === $this->answer);
        $menus = $this->botManService->getByParentColumn($menu->id);

        $keyboard = $this->botManService->makeMenuKeyboard($menus);
        $keyboard->addRow(KeyboardButton::create('/back'));

        $this->bot->reply(self::DESCRIPTION, $keyboard->toArray());
    }
}
