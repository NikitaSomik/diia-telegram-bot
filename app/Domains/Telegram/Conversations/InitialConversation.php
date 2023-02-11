<?php

declare(strict_types=1);

namespace App\Domains\Telegram\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use Illuminate\Support\Str;

class InitialConversation extends Conversation
{

    public function run(): void
    {
        $answer = Str::replace('/', '', ($this->bot->getConversationAnswer())->getText());
        $menuConversation = MenuConversationFactory::make($answer);

        $this->bot->startConversation($menuConversation);
    }
}
