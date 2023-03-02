<?php

namespace App\Http\Requests;

use App\Rules\UserRoleNameRule;
use Illuminate\Foundation\Http\FormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CategoryRequest extends FormRequest
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
            'img' => 'nullable|image|mimes:jpg,jpeg,png',
            'parent' => 'required|string',
        ];

        foreach (LaravelLocalization::getSupportedLocales() as $key => $value) {
            $data[$key . '*.title'] = 'required|string';
            $data[$key . '*.content'] = 'required|string';
        }

        return $data;
    }
}
