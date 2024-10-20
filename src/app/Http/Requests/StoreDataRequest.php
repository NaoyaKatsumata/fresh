<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDataRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'required|integer|min:0|max:10000',
            'image' => 'required|file|mimes:jpeg,png|max:1000000',
            'description' => 'required|max:120',
            'spring' => 'nullable',
            'summer' => 'nullable',
            'autumn' => 'nullable',
            'winter' => 'nullable',
            'season' => 'required_without_all:spring,summer,autumn,winter',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.integer' => '数値で入力してください',
            'price.min' => '0~10000円以内で入力してください',
            'price.max' => '0~10000円以内で入力してください',
            'image.required' => '商品画像を登録してください',
            'image.file' => '商品画像を登録してください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
            'image.max' => '画像のサイズは1G以内にしてください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
            'season.required_without_all' => '季節を選択してください'
        ];
    }
}
