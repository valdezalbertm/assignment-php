<?php

namespace Tests;

use App\Models\Token;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Str;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function createReadWriteAccessToken(): string
    {
        $token_uuid = Str::uuid()->toString();
        $token = Token::create([
            'token' => $token_uuid,
            'has_write_access' => true,
        ]);

        return $token->token;
    }
}
