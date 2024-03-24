<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use App\Enums\UserRole;
use Closure;

class CheckAuthUserAutherizeForCurrentRoute
{
    use JsonResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()) {
            $authenticateUser       = Auth::user();
            $authenticateUserRole   = strtolower(UserRole::getName($authenticateUser->role));
            $permissions            = config('permissions');
            $rolePermissions        = $permissions[$authenticateUserRole];
            $currentRoute           = $request->route()->getName();

            if(in_array($currentRoute, $rolePermissions))
                return $next($request);

            return $this->failed(['error' => 'This user Unauthorized for this route']);
        }

        return $next($request);
    }
}
