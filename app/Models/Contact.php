<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'image',
        'firstname',
        'email',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this
            ->belongsTo(User::class);
    }

    public function jiris(): BelongsToMany
    {
        return $this
            ->belongsToMany(Jiri::class, 'attendances', 'contact_id', 'jiri_id')
            ->withPivot(['role', 'token']);
    }

    public function projects(): BelongsToMany
    {
        return $this
            ->belongsToMany(Project::class, 'implementations', 'contact_id', 'project_id')
            ->withPivot(['urls', 'scores', 'tasks']);
    }

    public function implementations(): HasMany
    {
        return $this
            ->HasMany(Implementation::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    /*
     * Apply a query scope to retrieve only the contacts of the authenticated user
     */
    protected static function booted(): void
    {
        //static::addGlobalScope(new Scopes\AuthUserScope());
    }
}
