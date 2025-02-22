<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends BaseModel
{
    use HasFactory;

    public static $cacheKey = 'events';

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'description',
        'date',
        'time',
        'max_participants',
        'location',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function host(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_user', 'event_id', 'user_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderByRaw(
                'CASE 
                    WHEN date >= ? THEN 0 
                    ELSE 1 
                END, date ASC',
                [now()]
            )->orderBy('time', 'asc');
        });
    }
}
