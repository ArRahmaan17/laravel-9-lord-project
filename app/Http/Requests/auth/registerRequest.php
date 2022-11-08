<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class registerRequest extends FormRequest
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
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8'
        ];
    }
    public function getUser()
    {
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
        return $data;
    }
}
