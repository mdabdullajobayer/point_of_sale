<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('token');
        // dd($token);
        $result = JWTToken::VerifyToeken($token);
        if ($result == 'Unathorise') {
            return to_route('login');
        } else {
            $request->headers->set('email', $result->UserEmail);
            $request->headers->set('id', $result->userId);
            return $next($request);
        }
    }
}
