<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CsvImportRequest extends FormRequest
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
            'csv' => 'required|file|mimes:csv,txt|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'csv.required' => 'CSVファイルは必須です。',
            'csv.file' => 'アップロードされたファイルが無効です。',
            'csv.mimes' => 'CSVファイル形式でアップロードしてください。',
            'csv.max' => 'CSVファイルは2MB以下でアップロードしてください。',
        ];
    }

}
