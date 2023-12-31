<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Implementation extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'urls',
        'tasks',
        'scores',
        'jiri_id',
        'contact_id',
        'project_id',
    ];

    public function author(): BelongsTo
    {
        return $this
            ->belongsTo(Contact::class);
    }

    public function jiri(): BelongsTo
    {
        return $this
            ->belongsTo(Jiri::class);
    }

    public function contact(): BelongsTo
    {
        return $this
            ->belongsTo(Contact::class);
    }

    public function project(): BelongsTo
    {
        return $this
            ->belongsTo(Project::class);
    }

    public function getScoresAttribute($value)
    {
        return json_decode($value);
    }

    public function getUrlsAttribute($value)
    {
        return json_decode($value);
    }

    public function getTasksAttribute($value)
    {
        return json_decode($value);
    }
}
