<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Auth;

class UsersFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->method()=="POST")
            $rules = [
                'name' => 'string|min:1|max:255|nullable',
                'email' => 'string|min:1|max:255|required|unique:users,email',
                'password' => 'required',
                'user_plants'=> 'nullable',
                'user_departs'=> 'nullable',
                'user_areas'=> 'nullable',
                'user_approve'=> 'nullable'


            ];
        else
        $rules = [
            'name' => 'string|min:1|max:255|nullable',
            'email' => 'string|min:1|max:255|required|unique:users,email,'.$this->segment(3),
            'user_plants'=> 'nullable',
            'user_departs'=> 'nullable',
            'user_areas'=> 'nullable',
            'user_approve'=> 'nullable'
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
        $data = $this->only(['name','email','password','plant_id','role_id','user_plants','user_departs','user_areas','user_approve']);
        $data['password']=Hash::make($data['password']);
        return $data;
    }

}
