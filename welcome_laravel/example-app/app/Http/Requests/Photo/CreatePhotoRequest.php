<?php

namespace App\Http\Requests\Photo;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class CreatePhotoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:photos,name|min:3|max:64',
//            'place' => 'string|min:3|max:64',
//            'description' => 'nullable|string',
//            'url' => 'nullable|string',
        ];
    }

    // Если возникает ошибка валидации
    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse(['errors' => $validator->errors()], 422);

        throw new ValidationException($validator, $response);
    }
}
