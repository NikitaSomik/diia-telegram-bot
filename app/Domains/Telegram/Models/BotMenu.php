<?php

declare(strict_types=1);

namespace App\Domains\Telegram\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

/**
 * Class BotMenu
 *
 * @property string name
 *
 * @method static filterByParent(?bool $parentId)
 */
class BotMenu extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @param EloquentBuilder $query
     * @param int|null $parentId
     * @return EloquentBuilder
     */
    public function scopeFilterByParent(EloquentBuilder $query, ?int $parentId): EloquentBuilder
    {
        return $query
            ->when(!is_null($parentId), fn ($query) => $query->where('parent_id', $parentId))
            ->when(is_null($parentId), fn ($query) => $query->whereNull('parent_id'));
    }

    /**
     * @return HasOne
     */
    public function parent(): HasOne
    {
        return $this->hasOne(BotMenu::class, 'id', 'parent_id');
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(BotMenu::class, 'parent_id', 'id');
    }
}
