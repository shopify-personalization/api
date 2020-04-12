<?php

namespace Tutorial\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class UserTutorialCreateRequest extends FormRequest
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
            'user_id' => 'required',
'tutorial_id' => 'required',

        ];
    }

    public function messages()
    {
        return [
            
        ];
    }
}
