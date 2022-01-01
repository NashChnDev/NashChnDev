<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ScrapreqheadersFormRequest extends FormRequest
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
        $rules = [
            'scrapreqno' => 'string|min:1|nullable',
            'scrapreqdate' => 'string|min:1|nullable',
            'scrapreqempcode' => 'string|min:1|nullable',
            'scrapreqempname' => 'string|min:1|nullable',
            'scrapreqempdept' => 'string|min:1|nullable',
            'gaugereqapprover' => 'string|min:1|nullable',
            'entrydate' => 'string|min:1|nullable',
            'createdby' => 'string|min:1|nullable',
            'company_id' => 'nullable',
    
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
        $data = $this->only(['scrapreqno','scrapreqdate','scrapreqempcode','scrapreqempname','scrapreqempdept','gaugereqapprover','entrydate','createdby','company_id']);

        return $data;
    }

}