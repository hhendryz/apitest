<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                $rules = [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users,email',
                    'password' => 'required|string|min:8',
                ];
                break;
            case 'PATCH':
                $rules = [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users,email,'.$this->id,
                    'password' => 'string|min:8|nullable',
                ];
                break;
        }
        return $rules;
    }

    public function messages()
    {
        $messages = [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'password.required' => 'Password harus diisi',
            'email.unique' => 'Email sudah dipakai'
        ];

        return $messages;
    }
}