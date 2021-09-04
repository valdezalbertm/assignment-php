<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Key;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Tests\TestCase;

class KeyCrudTest extends TestCase
{
    use DatabaseTransactions;

    public function testGetAllKeys()
    {
        $bearer_token = $this->createReadWriteAccessToken();

        $response = $this
            ->withToken($bearer_token)
            ->get(route('key.index'));
        $response->assertStatus(Response::HTTP_OK);

        $arrayed_keys = Key::all()->toJson();

        $this->assertEquals($arrayed_keys, $response->content());
    }

    public function testGetKey()
    {
        $bearer_token = $this->createReadWriteAccessToken();

        $key_id = Key::first()->id;

        $response = $this
            ->withToken($bearer_token)
            ->get(route('key.show', ['key' => $key_id]));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function testUpdateKey()
    {
        $bearer_token = $this->createReadWriteAccessToken();

        $key_id = Key::first()->id;
        $random_text = Str::uuid()->toString();

        $this
            ->withToken($bearer_token)
            ->put(
                route('key.update', ['key' => $key_id]),
                ['name' => $random_text]
            );

        $this->assertDatabaseHas('keys', [
            'id' => $key_id,
            'name' => $random_text,
        ]);
    }

    public function testDeleteKey()
    {
        $bearer_token = $this->createReadWriteAccessToken();

        $key_id = Key::first()->id;

        $this
            ->withToken($bearer_token)
            ->delete(route('key.destroy', ['key' => $key_id]));

        $this->assertDatabaseMissing('keys', ['id' => $key_id]);
    }

    public function testCreateKey()
    {
        $bearer_token = $this->createReadWriteAccessToken();

        $random_text = Str::uuid()->toString();
        $this
            ->withToken($bearer_token)
            ->post(
                route('key.store'),
                ['name' => $random_text]
            );

        $this->assertDatabaseHas('keys', ['name' => $random_text]);
    }

    public function testDuplicateKey()
    {
        $bearer_token = $this->createReadWriteAccessToken();

        $random_text = Str::uuid()->toString();
        $response = $this
            ->withToken($bearer_token)
            ->post(
                route('key.store'),
                ['name' => $random_text]
            );
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas('keys', ['name' => $random_text]);

        $response = $this
            ->withToken($bearer_token)
            ->post(
                route('key.store'),
                ['name' => $random_text]
            );
        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('keys', ['name' => $random_text]);
    }
}
