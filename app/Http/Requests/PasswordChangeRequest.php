<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordChangeRequest extends FormRequest
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
            'newPassword' => 'required|min:6',
            'oldPassword' => 'required',
        ];
    }

    /**
     * do some extra checks when plain validation is done.
     *
     * @param \Illuminate\Validation\Validator $validator
     */
    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->passwordsAreTheSame()) {
                $validator->errors()->add('newPassword', 'Please Enter A different Password');
            }
            if ($this->oldPasswordIsWrong()) {
                $validator->errors()->add('oldPassword', 'Your Old Password is Wrong.. Please ask the admin to reset it if you have forgotten it');
            }
        });
    }

    /**
     * checks to see if the passwords are the same.
     *
     * @return bool
     */
    protected function passwordsAreTheSame()
    {
        return $this->oldPassword == $this->newPassword;
    }

    /**
     * checks to see if the old password is right.
     *
     * @return bool
     */
    protected function oldPasswordIsWrong()
    {
        return !password_verify($this->oldPassword, auth()->user()->password);
    }
}
