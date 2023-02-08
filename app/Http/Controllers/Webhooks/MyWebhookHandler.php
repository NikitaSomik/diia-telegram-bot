<?php

namespace App\Http\Controllers\Webhooks;

use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;

class MyWebhookHandler extends WebhookHandler
{
    public function start(): void
    {
        $keyboard = ReplyKeyboard::make()
            ->button('Digital documents')
            ->button('Services')
            ->button('Authorization')
            ->button('Action.Signature')
            ->button('Changing light bulbs')
            ->button('I lost my phone')
            ->button('Action partners')
            ->button('Where the Action is taken')
            ->chunk(2);

        Telegraph::message('Hi')
            ->replyKeyboard($keyboard)->send();
    }
}
