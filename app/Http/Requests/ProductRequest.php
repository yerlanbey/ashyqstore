<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'slug' => 'required|min:3|max:255|unique:products,slug',
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:5',
            'price' => 'required',
            'count' => 'required|numeric|min:0'
        ];

        if ($this->route()->named('products.update')) {
            $rules['slug'] .= ',' . $this->route()->parameter('product')->id;
        }

        return $rules;
    }
    public function messages()
    {
        return [
            'slug.min' => 'Поле код должно содержать не менее :min символов',
            'slug.required' => 'Поле код является обязательным!',
            'slug.unique' => 'Продукт с таким кодом уже существует, выберите другую',
            'name.min' => 'Поле имя должно содержать не менее :min символов',
            'name.required' => 'Поле название является обязательным!',
            'description.min' => 'Поле описание должно содержать не менее :min символов',
            'description.required' => 'Поле описание является обязательным!',
            'price.required' => 'Поле цена является обязательным!',
            'count.numeric' => 'В этой поле вы не можете использовать буквы',
            'count.required' => 'Поле количество обязательный',
        ];
    }
}
