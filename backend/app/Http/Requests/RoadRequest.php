<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoadRequest extends FormRequest
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
            'latitude' => ['required', 'numeric', 'regex:/^[-]?((([0-8]?[0-9])(\.[0-9]{7}))|90(\.0{7})?)$/'], // 緯度 ex)89.999999
            'longitude' => ['required', 'numeric', 'regex:/^[-]?(((([1][0-7][0-9])|([0-9]?[0-9]))(\.[0-9]{7}))|180(\.0{7})?)$/'], // 経度 ex)179.999999
            'description' => ['required', 'string', 'max:1000'],
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
