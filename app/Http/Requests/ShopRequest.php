<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'slug' => 'required|min:3|max:255|unique:shops,slug',
            'name' => 'required|min:3|max:255',
            'theme_code' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ];

        return $rules;
    }
    public function messages()
    {
        return [
            'slug.min' => 'Поле код должно содержать не менее :min символов',
            'slug.required' => 'Поле код является обязательным!',
            'slug.unique' => 'ТК с таким кодом уже существует, выберите другую',
            'name.min' => 'Поле имя должно содержать не менее :min символов',
            'name.required' => 'Поле название является обязательным!',
            'theme_code.required' => 'Поле тип ТК является обязательным!',
            'address.required' => 'Поле Адрес является обязательным',
            'phone.required' => 'Поле Контактные данные является обязательным',
        ];
    }
}
