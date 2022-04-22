<?php


namespace App\Http\Traits;


trait ApiResponsable
{
    /**
     * Clear null values from array
     */
    public static function clearNullFromRequest($input)
    {
        $newInput = array();
        foreach ($input as $key => $value) {
            if (!is_null($value)) {
                $newInput[$key] = $value;
            }
        }
        return $newInput;
    }

    public static function staticErrorResponse($input, $status = 400): void
    {
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
            'Access-Control-Allow-Headers' => 'X-Requested-With, Content-Type, X-Token-Auth, Authorization'
        ];

        response(
            [
                'success' => false,
                'errors_message' => $input,
                'data' => null,
            ],
            $status
        )->withHeaders($headers)
            ->send();
        exit();
    }

    public function errorResponse($input, $status = 400)
    {
        return response(
            [
                'success' => false,
                'errors_message' => $input,
                'data' => null,
            ],
            $status
        );
    }

    public function successResponse($input)
    {
        return response(
            [
                'success' => true,
                'errors_message' => null,
                'data' => $input,
            ],
            200
        );
    }
}
