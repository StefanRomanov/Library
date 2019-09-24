<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class BookRequest extends FormRequest
{
    const TITLE_CONSTRAINTS = 'required|max:30|min:1';
    const AUTHOR_CONSTRAINTS = 'required|max:30|min:2';
    const PRICE_CONSTRAINTS = 'required';
    const TITLE_REQUIRED_ERROR_MESSAGE = 'Title field is required';
    const AUTHOR_REQUIRED_ERROR_MESSAGE = 'Author field is required';
    const PRICE_REQUIRED_ERROR_MESSAGE = 'Price field is required';
    const TITLE_MAX_ERROR_MESSAGE = 'Title should be maximum 30 characters';
    const TITLE_MIN_ERROR_MESSAGE = 'Title should be minimum 1 character';
    const AUTHOR_MAX_ERROR_MESSAGE = 'Author should be maximum 30 characters';
    const AUTHOR_MIN_ERROR_MESSAGE = 'Author should be minimum 2 character';

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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => self::TITLE_CONSTRAINTS,
            'author' => self::AUTHOR_CONSTRAINTS,
            'price' => self::PRICE_CONSTRAINTS,
        ];
    }

    public function messages()
    {
        return [
            'title.required' => self::TITLE_REQUIRED_ERROR_MESSAGE,
            'author.required' => self::AUTHOR_REQUIRED_ERROR_MESSAGE,
            'price.required' => self::PRICE_REQUIRED_ERROR_MESSAGE,
            'title.max' => self::TITLE_MAX_ERROR_MESSAGE,
            'title.min' => self::TITLE_MIN_ERROR_MESSAGE,
            'author.max' => self::AUTHOR_MAX_ERROR_MESSAGE,
            'author.min' => self::AUTHOR_MIN_ERROR_MESSAGE,
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors],JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
