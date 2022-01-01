<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class EmployeesFormRequest extends FormRequest
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
            'empcode' => 'string|min:1|required|unique:employees,empcode,',
            'empname' => 'string|min:1|required',
            'department_id' => 'required',
            'empemail' => 'nullable',
            'empmobile' => 'required',
            'empaddress' => 'required',
            'company_country' => 'required',
            'company_state' => 'required',
            'company_city' => 'required',
            'empplace' => 'nullable',
            'empphoto' => ['nullable','file'],
            'empstatus' => 'required',
            'empremarks' => 'nullable',
    
        ];
          }
        else
        {
            $rules = [
            'empcode' => 'string|min:1|required',
            'empname' => 'string|min:1|required',
            'department_id' => 'required',
            'empemail' => 'nullable',
            'empmobile' => 'required',
            'empaddress' => 'required',
            'company_country' => 'required',
            'company_state' => 'required',
            'company_city' => 'required',
            'empplace' => 'nullable',
            'empphoto' => ['nullable','file'],
            'empstatus' => 'required',
            'empremarks' => 'nullable',
    
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
        $data = $this->only(['empcode','empname','department_id','empemail','empmobile','empaddress','company_country','company_state','company_city','empplace','empstatus','empremarks','deptname','deptdescription','plant_id','company_id','company_name','createdby']);
        if ($this->has('custom_delete_empphoto')) {
            $data['empphoto'] = null;
        }
        if ($this->hasFile('empphoto')) {
            $data['empphoto'] = $this->moveFile($this->file('empphoto'));
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