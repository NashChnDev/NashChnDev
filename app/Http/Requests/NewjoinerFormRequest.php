<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class NewjoinerFormRequest extends FormRequest
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
            'empcode'=> 'string|min:1|nullable', 
            'name' => 'string|min:1|required',
            'email_id' => 'string|min:1|required',
            'joininglocation' => 'string|min:1|required',
            'department' => 'string|min:1|required',
            'designation' => 'string|min:1|required',
            'date_of_interview' => 'nullable',
            'date_of_joining' => 'nullable',
            'area' => 'nullable',
            'sub_area' => 'nullable',
            'functions' => 'nullable',
            'cost_center' => 'nullable',
            'gross_salary' => 'nullable',
            'ctc_salary' => 'nullable',
            'bonus' => 'nullable',
            'mobile' => 'nullable',
            'emprole' => 'nullable',
            'contractor' =>'nullable',
            'empaddress'=>'nullable',
            'status'=> 'nullable'
    
        ];
          }
        else
        {
            $rules = [
                'empcode'=> 'string|min:1|nullable', 
                'name' => 'string|min:1|required',
                'email_id' => 'string|min:1|required',
                'joininglocation' => 'string|min:1|required',
                'department' => 'string|min:1|required',
                'designation' => 'string|min:1|required',
                'date_of_interview' => 'nullable',
                'date_of_joining' => 'nullable',
                'area' => 'nullable',
                'sub_area' => 'nullable',
                'functions' => 'nullable',
                'cost_center' => 'nullable',
                'gross_salary' => 'nullable',
                'ctc_salary' => 'nullable',
                'bonus' => 'nullable',
                'mobile' => 'nullable',
                'emprole' => 'nullable',
                'contractor' =>'nullable',
                'empaddress'=>'nullable',
                'status'=> 'nullable'
    
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
        $data = $this->only(['empcode','name','email_id','joininglocation','department','designation','date_of_interview','date_of_joining','area','sub_area','functions','cost_center','gross_salary','ctc_salary','bonus','mobile','emprole','contractor','empaddress','status']);
      
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