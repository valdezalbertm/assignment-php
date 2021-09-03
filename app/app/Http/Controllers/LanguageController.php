<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\JsonResponse;

class LanguageController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $languages = Language::all();
        return response()->json($languages);
    }
}
