<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Key;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KeyController extends Controller
{
    private const KEY_ALREADY_EXISTS_WARN = 'Key already exists';

    public function index(): JsonResponse
    {
        $keys = Key::all();
        return response()->json($keys);
    }

    public function update(Request $request, Key $key): JsonResponse
    {
        $this->validate($request, ['name' => 'required']);
        $response = $key->update([
            'name' => $request->name,
        ]);
        return response()->json($response);
    }

    public function show(Key $key): JsonResponse
    {
        return response()->json($key);
    }

    public function store(Request $request): JsonResponse
    {
        $this->validate($request, ['name' => 'required']);
        $response = null;
        $status_code = Response::HTTP_OK;
        $key = Key::where('name', $request->name)->exists();
        if ($key) {
            $response = self::KEY_ALREADY_EXISTS_WARN;
        } else {
            $response = Key::create(['name' => $request->name]);
            $status_code = Response::HTTP_CREATED;
        }

        return response()->json($response, $status_code);
    }

    public function destroy(Key $key): JsonResponse
    {
        $response = $key->delete();
        return response()->json($response);
    }
}
