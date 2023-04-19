<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */


     function __construct(BaseRequest $base_request)
     {
        $this->$base_request = $base_request;
     }
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
            'name' => 'required|max:50',
            'email' => 'required|email|max:255|unique:users',
          
          
            // paying attention to the mimes set because it can be injects a file which has extinsion of jpg for example
            // and not be image (the structure is not mime)
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'github_acc' => 'required|url',
            


        ];
    }
}
