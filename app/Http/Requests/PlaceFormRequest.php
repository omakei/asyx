<?php

namespace App\Http\Requests;

use App\Rules\Base64ImageValidation;
use App\Rules\Base64ImageValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PlaceFormRequest extends FormRequest
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
            'slug' => ['required', 'string', 'max:255', 'unique:places,slug'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'image' => ['required', 'string', new Base64ImageValidationRule()],

        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->name),
        ]);
    }

}
