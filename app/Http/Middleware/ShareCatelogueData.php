<?php

namespace App\Http\Middleware;

use App\Models\Catelogue;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class ShareCatelogueData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $catelogue = Catelogue::all();
        View::share('catelogue', $catelogue);
        return $next($request);
    }
}
