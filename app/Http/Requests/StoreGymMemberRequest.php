<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\Rule;

class StoreGymMemberRequest extends FormRequest
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
            'avatar_image' => ['required','mimes:png,jpg','max:2048'],
            'email' => ['required','email',Rule::unique('users', 'email')->ignore($this->id, 'id')],
            'name' => ['required', 'min:3'],
            'password' => [Password::min(8)],
            'national_id' => ['required', Rule::unique('users', 'national_id')->ignore($this->id, 'id'), 'min:14'],
            'gender' => ['required',Rule::in(['male','female','Male','Female'])],
            'date_of_birth' => ['required','date'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'An email is required',
            'email.unique' => 'An email must be unique',
            'name.required' => 'A name is required',
            'name.min' => 'A name must be more than 3 characters',
            'national_id.required' => 'National Id is required',
            'national_id.min' => 'National Id must be 14 numbers',
            'avatar_image.required' => 'An avatar_image is required',
            'password.min' => 'A password must at least 8 characters',
        ];
    }
}
