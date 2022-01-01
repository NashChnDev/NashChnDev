<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CompaniesFormRequest extends FormRequest
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
       
        if($this->method() == 'POST')
        {
        
        $rules = [
            'company_code' => 'string|min:1|unique:companies,company_code,',
            'company_name' => 'string|min:1|required',
            'company_address' => 'string|min:1|nullable',
            'company_country' => 'required',
            'company_state' => 'string|min:1|required',
            'company_city' => 'string|min:1|required',
            'company_email' => 'nullable',
            'company_phone' => 'nullable',
            'company_mobile' => 'nullable',
            'company_website' => 'nullable',
            'company_gstinno' => 'nullable',
            'company_logo' => ['nullable','file'],
            'company_status' => 'string|min:1|required',
    
        ];
            
        }
        
        else
        {
            
            $rules = [
            'company_code' => 'string|min:1|required',
            'company_name' => 'string|min:1|required',
            'company_address' => 'string|min:1|nullable',
            'company_country' => 'required',
            'company_state' => 'required',
            'company_city' => 'required',
            'company_email' => 'nullable',
            'company_phone' => 'nullable',
            'company_mobile' => 'nullable',
            'company_website' => 'nullable',
            'company_gstinno' => 'nullable',
            'company_logo' => ['nullable','file'],
            'company_status' => 'string|min:1|required',
    
        ];
            
        }

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
        $data = $this->only(['company_code','company_name','company_address','company_country','company_state','company_city','company_email','company_phone','company_mobile','company_website','company_gstinno','company_status']);
        if ($this->has('custom_delete_company_logo')) {
            $data['company_logo'] = null;
        }
        if ($this->hasFile('company_logo')) {
            $data['company_logo'] = $this->moveFile($this->file('company_logo'));
        }


        return $data;
    }
  
    /**
     * Moves the attached file to the server.
     *
     * @param Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return string
     */
    protected function moveFile($file)
    {
        if (!$file->isValid()) {
            return '';
        }
        
        $path = config('codegenerator.files_upload_path', 'uploads');
        $saved = $file->store('public/' . $path, config('filesystems.default'));

        return substr($saved, 7);
    }
}