<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $visit = new Visit();
        $visit->user_id = auth()->id(); 
        $visit->visited_at = Carbon::now();
        $visit->save();

        return $next($request);
    }
}
