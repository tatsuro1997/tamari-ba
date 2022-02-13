<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoardRequest extends FormRequest
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
            'date' => ['required', 'date', 'after:tomorrow'],
            'location' => ['required', 'string', 'max:50'],
            'destination' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:1000'],
            'prefecture_id' => ['required'],
            // 'deadline' => ['required'],
            'image' => 'image|mimes:jpg, jpeg, png|max:2048',
            'files.*.image' => 'required|image|mimes:jpg, jpeg, png|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'image' => '指定されたファイルが画像ではありません。',
            'mimes' => '指定された拡張子(jpg/jpeg/png)でありません。',
            'max' => 'ファイルサイズは2MB以内にしてください。',
        ];
    }
}
