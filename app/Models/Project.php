<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    public function implementations(): HasMany
    {
        return $this
            ->hasMany(Implementation::class);
    }

    /*
    * Apply a query scope to retrieve only the projects of the authenticated user
    */
    protected static function booted(): void
    {
        static::addGlobalScope(new Scopes\AuthUserScope());
    }
}
