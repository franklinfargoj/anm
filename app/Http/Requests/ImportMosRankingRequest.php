<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportMosRankingRequest extends FormRequest
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
            'month' => 'required',
            'year' => 'required',
            'sample_file' => 'required',
            'rankings' => 'required|mimes:zip'
        ];
    }


    public function messages(){
        return [
            'month.required' => 'Select month',
            'year.required' => 'Select year',
            'sample_file.required' => 'Please upload excel',
            'sample_file.mimes' => 'Please upload valid excel',
            'rankings.required' => 'Please upload ranking pdf',
            'rankings.mimes' => 'Please upload valid zip'
        ];
    }
}
