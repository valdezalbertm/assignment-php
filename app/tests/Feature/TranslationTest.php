<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Key;
use App\Models\Language;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Tests\TestCase;

class TranslationTest extends TestCase
{
    use DatabaseTransactions;

    public function testUpdateTranslation()
    {
        $bearer_token = $this->createReadWriteAccessToken();

        $random_text = Str::uuid()->toString();

        $update_params = [
            'key_id' => Key::first()->id,
            'language_id' => Language::first()->id,
            'value' => $random_text,
        ];

        $response = $this
            ->withToken($bearer_token)
            ->put(route('translation.update'), $update_params);
        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('translations', $update_params);
    }
}
