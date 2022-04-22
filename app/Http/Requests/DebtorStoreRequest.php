<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DebtorStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|required',
            'iin' => 'string|required',
            'address' => 'string|required',
            'chsi' => 'string|required',
            'nip' => 'string|required',
            'start_date' => 'date|required',
            'debit_sum' => 'numeric|required',
            'account_block_name' => 'string|required',
            'arrest_to' => 'string|required',
            'files' => 'array',
            'files.*' => 'file|mimes:pdf,doc,docx,xls,xlsx',
        ];
    }
}
