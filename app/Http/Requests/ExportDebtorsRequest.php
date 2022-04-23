<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExportDebtorsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start_date' => 'date|required',
            'end_date' => 'date|required',
        ];
    }
}
