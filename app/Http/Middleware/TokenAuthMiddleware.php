<?php

namespace App\Http\Middleware;

use App\Livewire\CreateJiri\Contacts;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TokenAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Token');

        $users = auth()->user()
            ->contacts()
            ->join('attendances', 'contacts.id', '=', 'attendances.contact_id')
            ->where('role', 'jury')
            ->get();

        foreach ($users as $user){
            $user = $user::where('token', $token);
            if (!$user) {
                return response()->json(['message' => 'Token non valide'], 401);
            }
            Auth::login($user);
        }
        return $next($request);
    }
}
