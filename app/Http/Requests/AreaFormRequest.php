<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class AreaFormRequest extends FormRequest
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
            'plantcode' => 'string|min:2|required',
            'departmentcode' => 'string|min:1|required',
            'area_incharge' => 'nullable',
            'areaname' => 'string|min:1|required',
            'status' => 'string|min:1|nullable',
            'due_alert_name' => 'string|min:1|nullable',
            'due_alert_email' => 'string|min:1|nullable',
            'due_alert_days' => 'string|min:1|nullable',
            'esclation_alert_name' => 'string|min:1|nullable',
            'esclation1_alert_email' => 'string|min:1|nullable',
            'esclation1_alert_days' => 'string|min:1|nullable',
            'esclation2_alert_name' => 'string|min:1|nullable',
            'esclation2_alert_email' => 'string|min:1|nullable',
            'esclation2_alert_days' => 'string|min:1|nullable',
            'esclation3_alert_name' => 'string|min:1|nullable',
            'esclation3_alert_email' => 'string|min:1|nullable',
            'esclation3_alert_days' => 'string|min:1|nullable',
            'finalesclation_alert_name' => 'string|min:1|nullable',
            'finalesclation_alert_email' => 'string|min:1|nullable',
            'finalesclation_alert_days' => 'string|min:1|nullable'
            
        ];
            
        }
        
        else
        {
            
            $rules = [
            'plantcode' => 'string|min:2|required',
            'departmentcode' => 'string|min:1|required',
            'area_incharge' => 'nullable',
            'areaname' => 'string|min:1|required',
            'status' => 'string|min:1|nullable',
            'due_alert_name' => 'string|min:1|nullable',
            'due_alert_email' => 'string|min:1|nullable',
            'due_alert_days' => 'string|min:1|nullable',
            'esclation1_alert_name' => 'string|min:1|nullable',
            'esclation1_alert_email' => 'string|min:1|nullable',
            'esclation1_alert_days' => 'string|min:1|nullable',
            'esclation2_alert_name' => 'string|min:1|nullable',
            'esclation2_alert_email' => 'string|min:1|nullable',
            'esclation2_alert_days' => 'string|min:1|nullable',
            'esclation3_alert_name' => 'string|min:1|nullable',
            'esclation3_alert_email' => 'string|min:1|nullable',
            'esclation3_alert_days' => 'string|min:1|nullable',
            'finalesclation_alert_name' => 'string|min:1|nullable',
            'finalesclation_alert_email' => 'string|min:1|nullable',
            'finalesclation_alert_days' => 'string|min:1|nullable'      
    
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
        $data = $this->only(['plantcode','departmentcode','areaname','status','area_incharge','due_alert_name','due_alert_email','due_alert_days','esclation1_alert_name','esclation1_alert_email','esclation1_days','esclation2_alert_name','esclation2_alert_email','esclation2_days','esclation3_alert_name','esclation3_alert_email','esclation3_days','finalesclation_alert_name','finalesclation_alert_email','finalesclation_days']);
        // if ($this->has('custom_delete_company_logo')) {
        //     $data['company_logo'] = null;
        // }
        // if ($this->hasFile('company_logo')) {
        //     $data['company_logo'] = $this->moveFile($this->file('company_logo'));
        // }

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