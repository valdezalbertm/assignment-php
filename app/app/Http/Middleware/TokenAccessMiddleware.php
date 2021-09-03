<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Token;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TokenAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    private const WRITE_REQUEST_METHODS = [
        Request::METHOD_PUT,
        Request::METHOD_POST,
        Request::METHOD_DELETE,
    ];
    private const INVALID_TOKEN_ERROR = 'Invalid Token';
    private const ACCESS_READ_ONLY_ERROR = 'Access Limited to Read Only';
    private const INVALID_METHOD_ERROR = 'Invalid Method';
    private const MISSING_TOKEN_ERROR = 'Missing Token';

    public function handle(Request $request, Closure $next)
    {
        $method = $request->getMethod();
        $bearer_token = $request->bearerToken();

        if ($bearer_token) {
            $token = Token::where('token', $bearer_token)->first();
            if (! $token) {
                return new Response(self::INVALID_TOKEN_ERROR, Response::HTTP_UNAUTHORIZED);
            } else {
                if ($method === Request::METHOD_GET) {
                    // do nothing, as read only is the default access
                } elseif (in_array($method, self::WRITE_REQUEST_METHODS)) {
                    if (! $token->has_write_access) {
                        return new Response(self::ACCESS_READ_ONLY_ERROR, Response::HTTP_UNAUTHORIZED);
                    } else {
                        // continue, the token has write access
                    }
                } else {
                    // other routes are accessed, and we are not accepting it
                    return new Response(self::INVALID_METHOD_ERROR, Response::HTTP_BAD_REQUEST);
                }
            }
        } else {
            return new Response(self::MISSING_TOKEN_ERROR, Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
