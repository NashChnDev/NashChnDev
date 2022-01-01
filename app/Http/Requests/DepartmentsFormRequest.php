<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class DepartmentsFormRequest extends FormRequest
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
            'plant_id' => 'string|min:2|required',
            'deptname' => 'string|min:1|required',
            'deptphone' => 'nullable',
            'deptincharge' => 'string|min:1|required',
            'deptstatus' => 'string|min:1|nullable',
            // 'deptdescription'=> 'string|min:1|nullable'
        ];
            
        }
        
        else
        {
            
            $rules = [
                'plant_id' => 'string|min:2|required',
            'deptname' => 'string|min:1|required',
            'deptphone' => 'nullable',
            'deptincharge' => 'string|min:1|required',
            'deptstatus' => 'string|min:1|nullable',
            // 'deptdescription'=> 'string|min:1|nullable'
    
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
        $data = $this->only(['plant_id','deptname','deptphone','deptincharge','deptstatus']);
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