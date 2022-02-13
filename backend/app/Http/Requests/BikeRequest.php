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
            'bike_brand' => ['required', 'string', 'max:20'],
            'bike_type' => ['required', 'string', 'max:20'],
            'bike_name' => ['required', 'string', 'max:20'],
            'engine_size' => ['required', 'integer', 'max:1500'],
            'description' => ['required', 'string', 'max:1000'],
            'image' => 'image|mimes:jpg, jpeg, png|max:2048',
            'files.*.image' => 'required|image|mimes:jpg, jpeg, png|max:2048',
            'tags.*' => 'numeric|exists:tags,id'
        ];
    }

    public function messages()
    {
        return [
            'image' => '指定されたファイルが画像ではありません。',
                'image' => [
                    'mimes' => '指定された拡張子(jpg/jpeg/png)でありません。',
                    'max' => 'ファイルサイズは2MB以内にしてください。',
                ],
            'tags.*' => 'タグ'
        ];
    }
}
