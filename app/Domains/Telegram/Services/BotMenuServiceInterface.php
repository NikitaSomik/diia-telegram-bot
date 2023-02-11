<?php

declare(strict_types=1);

namespace App\Domains\Telegram\Services;

use Illuminate\Support\Collection;

interface BotMenuServiceInterface
{
    public function getAll(): Collection;
    public function getByParentColumn(?int $parentId = null): Collection;
}
