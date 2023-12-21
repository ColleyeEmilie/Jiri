<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Duty extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'jiri_id',
        'project_id',
    ];

    public function jiri(): BelongsTo
    {
        return $this
            ->belongsTo(Jiri::class);
    }

    public function project(): BelongsTo
    {
        return $this
            ->belongsTo(Project::class);
    }
}
