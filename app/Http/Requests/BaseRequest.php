<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|email|max:255|unique:users',
        
            'city' => 'required',
            // paying attention to the mimes set because it can be injects a file which has extinsion of jpg for example
            // and not be image (the structure is not mime)
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'roles' => 'required',

        ];
    }
}
