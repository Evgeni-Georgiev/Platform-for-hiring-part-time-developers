<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class HireApiRequest extends \App\Http\Requests\HireRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(new Response([
            'message' => 'Validation errors',
            'errors' => $validator->errors()
        ], ResponseAlias::HTTP_BAD_REQUEST));
    }
}
