<?php

namespace App\Domains\Telegram;

use BotMan\Drivers\Telegram\Extensions\Keyboard;
use Illuminate\Support\Collection;

class RowsKeyboard extends Keyboard
{
    public static function create($type = self::TYPE_INLINE): RowsKeyboard|self
    {
        return new self($type);
    }

    /**
     * Keyboard constructor.
     * @param string $type
     */
    public function __construct($type = self::TYPE_INLINE)
    {
        parent::__construct($type);
    }

    /**
     * Add a new row to the Keyboard.
     * @param array $buttons
     * @return RowsKeyboard
     */
    public function addRows(array $buttons): RowsKeyboard
    {
        $this->rows[] = $buttons;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'reply_markup' => json_encode(Collection::make([
                $this->type => $this->rows,
                'one_time_keyboard' => $this->oneTimeKeyboard,
                'resize_keyboard' => $this->resizeKeyboard,
            ])->filter()),
        ];
    }
}
