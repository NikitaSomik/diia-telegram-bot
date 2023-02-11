<?php

declare(strict_types=1);

namespace App\Domains\Telegram\Services;

use App\Domains\Telegram\Models\BotMenu;
use App\Domains\Telegram\RowsKeyboard;
use BotMan\Drivers\Telegram\Extensions\Keyboard;
use Illuminate\Database\Eloquent\Collection;
use BotMan\Drivers\Telegram\Extensions\KeyboardButton;

class BotMenuService implements BotMenuServiceInterface
{

    /**
     * Show menu columns in bot
     */
    private const BOT_MENU_COLUMNS = 2;

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return BotMenu::all();
    }

    /**
     * @param int|null $parentId
     * @return Collection
     */
    public function getByParentColumn(?int $parentId = null): Collection
    {
        return BotMenu::query()
            ->filterByParent($parentId)
            ->get();
    }

    /**
     * @param Collection $menus
     * @return RowsKeyboard
     */
    public function makeMenuKeyboard(Collection $menus): RowsKeyboard
    {
        $keyboard = RowsKeyboard::create()->type(Keyboard::TYPE_KEYBOARD)
            ->resizeKeyboard();

        $menusChunks = $menus->chunk(self::BOT_MENU_COLUMNS);
        foreach ($menusChunks as $menus) {
            $keyboardButtons = $menus
                ->values()
                ->map(fn ($menu) => (KeyboardButton::create($menu['name'])->callbackData("{$menu['id']}")));
            $keyboard = $keyboard->addRows($keyboardButtons->toArray());
        }

        return $keyboard;
    }
}
