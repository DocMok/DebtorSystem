<?php

namespace App\Http\Traits;

use Illuminate\Validation\Validator;

trait ErrorValidableResponse
{
    protected function failedValidation(Validator $validator): void
    {
        ApiResponsable::staticErrorResponse($validator->errors()->first(), 400);
    }
}
