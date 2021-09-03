<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TranslationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'language_id' => ['required_without:language_iso', 'exists:languages,id'],
            'key_id' => ['required_without:key', 'exists:keys,id'],
            'language_iso' => ['required_without:language_id', 'exists:languages,iso_code'],
            'key' => ['required_without:key_id', 'exists:keys,name'],
            'value' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'language_id.exists' => 'Language ID does not exist on our record',
            'key_id.exists' => 'Key ID does not exist on our record',
            'language_iso.exists' => 'Language ISO Code does not exist on our record',
            'key.exists' => 'Key does not exist on our record',
        ];
    }
}
