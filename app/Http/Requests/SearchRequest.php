<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'searching' => 'required|min:0',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'searching.min' => 'Поле поиск должно содержать цифру, строк, или букву',
            'searching.required' => 'Невозможно выполнить пустой поиск!'
        ];
    }
}
