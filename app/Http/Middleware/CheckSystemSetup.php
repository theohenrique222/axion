<?php

namespace App\Http\Middleware;

use App\Facades\SystemSettings;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSystemSetup
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->isSetupPath($request)) {
            return $next($request);
        }

        try {
            if (! SystemSettings::isSetupCompleted()) {
                return redirect('/setup');
            }
        } catch (\RuntimeException) {
            return redirect('/setup');
        }

        return $next($request);
    }

    protected function isSetupPath(Request $request): bool
    {
        return $request->is('setup') || $request->is('setup/*');
    }
}
