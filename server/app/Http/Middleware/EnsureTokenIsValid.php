<?php

namespace App\Http\Middleware;

use App\Facades\ApiResponse;
use App\Models\RegistrationToken;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authorization = $request->bearerToken();

        if (!$authorization) {
            return ApiResponse::error(__('token/token.response.403.missing_token'), [], '403');
        }

        $plainToken = base64_decode($authorization, true);

        if (!$plainToken) {
            return ApiResponse::error(__('token/token.response.403.invalid_token_format'), [], '403');
        }

        $validToken = RegistrationToken::where('used', false)
            ->where('expires_at', '>', now())
            ->get()
            ->first(function ($record) use ($plainToken) {
                return Hash::check($plainToken, $record->token);
            });

        if (!$validToken) {
            return ApiResponse::error(__('token/token.response.403.expired_token'), [], '403');
        }

        $validToken->update(['used' => true]);

        return $next($request);
    }
}
