<?php

namespace App\Actions\Token;

use App\Contracts\Actions\Token\GetTokenActionContract;
use App\Models\RegistrationToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GetTokenAction implements GetTokenActionContract
{

    /**
     * @return array
     */
    public function __invoke(): array
    {
        $plainToken = Str::random(64);
        $hashedToken = Hash::make($plainToken);

        RegistrationToken::create([
            'token' => $hashedToken,
            'expires_at' => now()->addMinutes(40),
        ]);

        return ['token' => base64_encode($plainToken)];
    }
}
