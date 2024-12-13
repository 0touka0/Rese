<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RatingRequest extends FormRequest
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
            'score' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:400',
            'image' => 'nullable|file|mimes:jpeg,jpg,png'
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'score.required' => '星評価は必須項目です。',
            'score.integer' => '星評価は数値で入力してください。',
            'score.between' => '星評価は1から5の間で選択してください。',
            'comment.string' => 'コメントは文字列で入力してください。',
            'comment.max' => 'コメントは400文字以内で入力してください。',
            'image.file' => 'アップロードされたファイルが無効です。',
            'image.mimes' => '画像形式はJPEGまたはPNGのみ対応しています。',
        ];
    }
}
