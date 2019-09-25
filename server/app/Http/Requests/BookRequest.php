<?php

namespace App\Http\Requests;


use App\Helpers\Constants;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class BookRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => Constants::TITLE_CONSTRAINTS,
            'author' => Constants::AUTHOR_CONSTRAINTS,
            'price' => Constants::PRICE_CONSTRAINTS,
        ];
    }

    public function messages()
    {
        return [
            'title.required' => Constants::TITLE_REQUIRED_ERROR_MESSAGE,
            'author.required' => Constants::AUTHOR_REQUIRED_ERROR_MESSAGE,
            'price.required' => Constants::PRICE_REQUIRED_ERROR_MESSAGE,
            'title.max' => Constants::TITLE_MAX_ERROR_MESSAGE,
            'title.min' => Constants::TITLE_MIN_ERROR_MESSAGE,
            'author.max' => Constants::AUTHOR_MAX_ERROR_MESSAGE,
            'author.min' => Constants::AUTHOR_MIN_ERROR_MESSAGE,
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors],JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
