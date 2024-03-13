<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Support\Facades\URL;

class ApiSigned
{
    public function handle(Request $request, Closure $next)
    {
        if (! URL::hasValidSignature($request)) {
            throw new InvalidSignatureException;
        }

        return $next($request);
    }
}