<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//use Auth;

class SubareaFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return  true;
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
            'areacode' => 'string|min:1|required',
            'subarea_incharge' => 'nullable',
            'subareaname' => 'string|min:1|required',
            'status' => 'string|min:1|nullable'
            
        ];
            
        }
        
        else
        {
            
            $rules = [
            'plantcode' => 'string|min:2|required',
            'departmentcode' => 'string|min:1|required',
            'areacode' => 'string|min:1|required',
            'subareaincharge' => 'nullable',
            'subareaname' => 'string|min:1|required',
            'status' => 'string|min:1|nullable'    
    
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
        $data = $this->only(['plantcode','departmentcode','areacode','subareaname','status','subareaincharge']);
        // if ($this->has('custom_delete_company_logo')) {
        //     $data['company_logo'] = null;
        // }
        // if ($this->hasFile('company_logo')) {
        //     $data['company_logo'] = $this->moveFile($this->file('company_logo'));
        // }
            // dd($data);
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

