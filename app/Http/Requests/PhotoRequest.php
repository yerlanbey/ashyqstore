<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoRequest extends FormRequest
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
        $rules = [
          'name' => 'required|min:1',
        ];
        return $rules;
    }
    public function messages(){
      return [
          'name.min' => 'Поле имя должно содержать не менее :min символов',
          'name.required' => 'Поле имя является обязательным'
      ];
    }
}
