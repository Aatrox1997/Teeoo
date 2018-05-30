<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MestsRequests extends FormRequest
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
            'types' => 'required|unique:metas,types',
            'order' => 'numeric',
        ];

    }

    public function messages()
    {
        return [
            'types.required' => '分类不能为空',
            'types.unique' => '该分类已存在',
            'order' => '排序必须为数字',
        ];
    }
}
