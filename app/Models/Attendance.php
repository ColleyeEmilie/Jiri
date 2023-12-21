<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'role',
        'token',
        'contact_id',
        'jiri_id',
    ];

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
}
