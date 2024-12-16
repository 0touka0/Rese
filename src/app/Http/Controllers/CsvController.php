<?php

namespace App\Http\Controllers;


use App\Models\Address;
use App\Models\Category;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CsvController extends Controller
{
    public function import(Request $request)
    {
        // 1. CSVファイルのバリデーション
        $request->validate([
            'csv' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        // 2. CSVファイルを開く
        $file = fopen($request->file('csv')->getRealPath(), 'r');
        $header = fgetcsv($file); // ヘッダー行を取得

        // 必須項目のチェック
        $requiredHeaders = ['店舗名', '地域', 'ジャンル', '店舗概要', '画像URL'];
        if ($header !== $requiredHeaders) {
            fclose($file);
            return back()->withErrors(['csv' => 'CSVのヘッダーが正しくありません。指定されたフォーマットを確認してください。']);
        }

        // データを1行ずつ処理
        while ($row = fgetcsv($file)) {
            $data = array_combine($header, $row);

            // 地域（address_id）の取得
            $address = Address::where('address', $data['地域'])->first();
            if (!$address) {
                fclose($file);
                return back()->withErrors(['csv' => "地域 '{$data['地域']}' が見つかりません。"]);
            }

            // ジャンル（category_id）の取得
            $category = Category::where('category', $data['ジャンル'])->first();
            if (!$category) {
                fclose($file);
                return back()->withErrors(['csv' => "ジャンル '{$data['ジャンル']}' が見つかりません。"]);
            }

            // データのバリデーション
            $validator = Validator::make($data, [
                '店舗名'     => 'required|string|max:50',
                '店舗概要' => 'required|string|max:400',
                '画像URL'    => 'url|ends_with:.jpg,.jpeg,.png',
            ]);

            if ($validator->fails()) {
                fclose($file);
                return back()->withErrors(['csv' => 'CSVの内容にエラーがあります: ' . implode(', ', $validator->errors()->all())]);
            }

            // データベースに保存（owner_id を現在ログイン中の管理者に設定）
            Shop::create([
                'name' => $data['店舗名'],
                'address_id' => $address->id,
                'category_id' => $category->id,
                'owner_id' => auth()->id(), // 現在ログインしている管理者のID
                'overview' => $data['店舗概要'],
                'image' => $data['画像URL'],
            ]);
        }
        // dd('保存成功');

        fclose($file);

        return back()->with('success', '店舗情報をインポートしました！');
    }
}
