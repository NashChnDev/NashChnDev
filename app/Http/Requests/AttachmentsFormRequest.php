<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class AttachmentsFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'gaugecode' => 'string|min:1|nullable',
            'attachmenttype' => 'string|min:1|nullable',
            'docdate' => 'string|min:1|nullable',
            'filename' => 'string|min:1|nullable',
    
        ];

        return $rules;
    }
    
    /**
     * Get the request's data from the request.
     *
     * 
     * @return array
     */
    public function getData()
    {
        $data = $this->only(['gaugecode','attachmenttype','docdate','filename']);

        return $data;
    }

}