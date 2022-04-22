<?php


namespace App\Http\Traits;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

trait ApiValidationError
{

    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse(
            [
                'success' => false,
                'errors_message' => $validator->errors()->first(),
                'data' => null,
            ],
            422
        );

        throw new ValidationException($validator, $response);
    }

}
