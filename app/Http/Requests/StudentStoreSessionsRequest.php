<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StudentStoreSessionsRequest extends FormRequest
{

    public function authorize(){
        return true;
    }

    public function rules()
    {
        return [
            'sessions_start_date' => 'required|date',
            'available_days_per_week' => 'required|array|min:1|in:1,2,3,4,5,6,7',
            'finishing_session_num' => 'required',
        ];
    }
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }


}
