<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends BaseModel
{
    use HasFactory;

    public static $cacheKey = 'categories';

    protected $fillable = ['name', 'description'];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
