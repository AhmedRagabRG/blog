<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $data = [
            'logo' => 'nullable|image|mimes:jpg,jpeg,png',
            'favicon' => 'nullable|image|mimes:jpg,jpeg,png',
            'facebook' => 'nullable|string',
            'twitter' => 'nullable|string',
            'instagram' => 'nullable|string',
            'email' => 'nullable|string',
            'phone' => 'required|string',
        ];

        foreach (LaravelLocalization::getSupportedLocales() as $key => $value) {
            $data[$key . '*.title'] = 'nullable|string';
            $data[$key . '*.content'] = 'nullable|string';
            $data[$key . '*.address'] = 'nullable|string';
        }

        return $data;
    }
}
