<?php
namespace App\Traits;

trait CreateJiri
{
    public function lastJiri()
    {
        return auth()
            ->user()
            ->jiris()
            ->orderBy('created_at', 'desc')
            ->first();
    }

}
