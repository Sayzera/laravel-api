<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'max:20', 'unique:articles,title'],
            'body' => ['required', 'min:5'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Başlık alanı zorunludur.',
            'title.max' => 'Başlık alanı en fazla 20 karakter olabilir.',
            'title.unique' => 'Bu başlık daha önce kullanılmış.',
            'body.required' => 'İçerik alanı zorunludur.',
            'body.min' => 'İçerik alanı en az 5 karakter olabilir.',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
        'errors' => $validator->errors(),
        'status' => true
        ], 422));
    }
}
