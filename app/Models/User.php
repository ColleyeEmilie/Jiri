<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Livewire\CreateJiri\Contacts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function jiris(): HasMany
    {
        return $this
            ->hasMany(Jiri::class);
    }

    public function contacts(): HasMany
    {
        return $this
            ->HasMany(Contact::class);
    }

    public function projects(): HasMany
    {
        return $this
            ->hasMany(Project::class);
    }

    public function attendances(): hasManyThrough
    {
        return $this
            ->hasManyThrough(Attendance::class, Contact::class);
    }

    public function implementations(): hasManyThrough
    {
        return $this
            ->hasManyThrough(Implementation::class, Jiri::class);
    }

    public function duties(): hasManyThrough
    {
        return $this
            ->hasManyThrough(Duty::class, Jiri::class);
    }
}
