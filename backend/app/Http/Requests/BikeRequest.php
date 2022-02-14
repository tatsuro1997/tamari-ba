<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BikeRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:50'],
            'maker_id' => ['required', 'max:20'],
            'type_id' => ['required', 'max:20'],
            'name' => ['required', 'string', 'regex:/\A([a-zA-Z0-9])+\z/u', 'max:20'],
            'engine_size' => ['required', 'integer', 'max:2000'],
            'description' => ['required', 'string', 'max:1000'],
            'image' => 'image|mimes:jpg, jpeg, png|max:2048',
            'files.*.image' => 'required|image|mimes:jpg, jpeg, png|max:2048',
            'tags.*' => 'numeric|exists:tags,id'
        ];
    }

    public function messages()
    {
        return [
            'regex' => '半角英数字で入力してください',
            'image' => '指定されたファイルが画像ではありません。',
            'image' => [
                'mimes' => '指定された拡張子(jpg/jpeg/png)でありません。',
                'max' => 'ファイルサイズは2MB以内にしてください。',
            ],
            'tags.*' => 'タグ'
        ];
    }
}
