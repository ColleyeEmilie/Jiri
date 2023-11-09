<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class AuthUserScope implements Scope
{
    /**
     * This scope will be applied to all queries on the model.
     * Since this app requires a user to be authenticated, it
     * makes sense to apply this scope to all queries since we
     * want to manipulate only the data of the authenticated user.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where('user_id', auth()->id());
    }
}
