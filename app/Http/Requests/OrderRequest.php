<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        $rules  = [
            'name' => 'required|min:2',
            'phone' => 'required|min:11',
            'email' => 'required',
            'address' => 'required',
        ];
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'Поле имя является обязательным',
            'name.min' => 'Поле имя должно содержать не менее :min символов',
            'phone.required' => 'Поле Номер телефон является обязательным',
            'phone.min' => 'Поле Номер телефон должно содержать не менее :min символов',
            'email.required' => 'Поле Электронная почта является обязательным',
            'address.required' =>'Поле Адрес является обязательным',
        ];
    }
}
