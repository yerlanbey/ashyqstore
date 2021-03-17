<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'code' => 'required|min:3|max:255|unique:categories,code',
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:5',
        ];

        if ($this->route()->named('categories.update')) {
            $rules['code'] .= ',' . $this->route()->parameter('category')->id;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'code.min' => 'Поле код должно содержать не менее :min символов',
            'code.required' => 'Поле код является обязательным!',
            'code.unique' => 'Такая категория уже существует выберите другую',
            'name.min' => 'Поле имя должно содержать не менее :min символов',
            'name.required' => 'Поле имя является обязательным!',
            'description.min' => 'Поле описание должно содержать не менее :min символов',
            'description.required' => 'Поле описание является обязательным!',
        ];
    }
}
