<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Http\Middleware\TokenAccessMiddleware;
use App\Models\Key;
use App\Models\Language;
use App\Models\Token;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Tests\TestCase;

class TokenTest extends TestCase
{
    use DatabaseTransactions;

    public function testNoToken()
    {
        $token_uuid = Str::uuid()->toString();
        Token::create([
            'token' => $token_uuid,
            'has_write_access' => true,
        ]);

        $response = $this->get(route('language.get'));
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $this->assertEquals($response->content(), TokenAccessMiddleware::MISSING_TOKEN_ERROR);
    }

    public function testInvalidToken()
    {
        $token_uuid = Str::uuid()->toString();

        $response = $this->withToken($token_uuid)->get(route('language.get'));
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $this->assertEquals($response->content(), TokenAccessMiddleware::INVALID_TOKEN_ERROR);
    }

    public function testValidReadOnlyAccessToken()
    {
        $token_uuid = Str::uuid()->toString();
        Token::create(['token' => $token_uuid]);

        $response = $this->withToken($token_uuid)->get(route('language.get'));
        $response->assertStatus(Response::HTTP_OK);

        $response = $this
            ->withToken($token_uuid)
            ->put(route('translation.update'), [
                'language_id' => Language::first()->id,
                'key_id' => Key::first()->id,
                'value' => 'test_value',
            ]);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testValidReadAndWriteAccessToken()
    {
        $bearer_token = $this->createReadWriteAccessToken();

        $response = $this->withToken($bearer_token)->get(route('language.get'));
        $response->assertStatus(Response::HTTP_OK);

        $response = $this
            ->withToken($bearer_token)
            ->put(route('translation.update'), [
                'language_id' => Language::first()->id,
                'key_id' => Key::first()->id,
                'value' => 'test_value',
            ]);
        $response->assertStatus(Response::HTTP_OK);
    }
}
