<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jiri extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'starting_at',
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

    public function projects(): BelongsToMany
    {
        return $this
            ->belongsToMany(Project::class, 'duties', 'jiri_id', 'project_id')
            ->where("duties.deleted_at", null);
    }

    public function attendances(): HasMany
    {
        return $this
            ->hasMany(Attendance::class);
    }

    public function contacts(): BelongsToMany
    {
        return $this
            ->belongsToMany(Contact::class, 'attendances', 'jiri_id', 'contact_id');
    }

    public function students(): BelongsToMany
    {
        return $this
            ->belongsToMany(Contact::class, 'attendances', 'jiri_id', 'contact_id')
            ->withPivot('role')
            ->where('attendances.deleted_at', null)
            ->wherePivot('role', 'student');
    }

    public function evaluators(): BelongsToMany
    {
        return $this
            ->belongsToMany(Contact::class, 'attendances', 'jiri_id', 'contact_id')
            ->withPivot('role', 'token')
            ->where('attendances.deleted_at', null)
            ->wherePivot('role', 'jury');
    }

    /*
     * Apply a query scope to retrieve only the jiris of the authenticated user
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new Scopes\AuthUserScope());
    }
}
