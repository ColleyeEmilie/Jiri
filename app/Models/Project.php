<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'link',
        'ponderation',
        'description',
    ];

    public function user(): BelongsTo
    {
        return $this
            ->belongsTo(User::class);
    }

    public function implementations(): HasMany
    {
        return $this
            ->hasMany(Implementation::class);
    }

    public function duties(): HasMany
    {
        return $this
            ->hasMany(Duty::class);
    }

    /*
    * Apply a query scope to retrieve only the projects of the authenticated user
    */
    protected static function booted(): void
    {
        static::addGlobalScope(new Scopes\AuthUserScope());
    }
}
