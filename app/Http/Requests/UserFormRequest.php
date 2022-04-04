<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserFormRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', Password::min(8)
                            ->mixedCase()
                            ->letters()
                            ->numbers()
                            ->symbols()
            ],
        ];
    }


    protected function prepareForValidation()
    {
        $this->merge([
            'email_verified_at' => now(),
        ]);
    }

    protected function passedValidation()
    {

        $this->merge([
            'password' => Hash::make($this->password),
            'email_verified_at' => now(),
        ]);

    }
}
