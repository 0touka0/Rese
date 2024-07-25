# Rese(リーズ)
ある企業のグループ会社の飲食店予約サービス
![Rese-home](https://github.com/user-attachments/assets/b29d80d7-70b8-436f-ae40-e99aa5f07966)

## 作成した目的
外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい為

## アプリケーションURL
- http://localhost/
- http://localhost/register
- http://localhost/thanks
- http://localhost/login
- http://localhost/mypage
- http://localhost/detail/:shop_id
- http://localhost/done

## 他のリポジトリ
無し

## 機能一覧
- 会員登録
- ログイン
- ログアウト
- ユーザー情報取得
- ユーザー飲食店お気に入り一覧取得
- ユーザー飲食店予約情報取得
- 飲食店一覧取得
- 飲食店詳細取得
- 飲食店お気に入り追加
- 飲食店お気に入り削除
- 飲食店予約情報追加
- 飲食店予約情報削除
- エリアで検索する
- ジャンルで検索する
- 店名で検索する

## 使用技術(実行環境)
- PHP 7.4.9
- Laravel 8
- MySQL 8.0.26
- nginx 1.21.1

## テーブル設計
![Rese-table](https://github.com/user-attachments/assets/0494ee62-21f7-4188-803a-8efbebaa3a85)

## ER図
![rese_ER図](https://github.com/user-attachments/assets/e52c9d03-c85c-4e12-a761-5d3cfd559312)

# 環境構築
Dockerビルド

1. `git clone git@github.com:0touka0/Rese.git`
2. `docker-compose up -d --build`

※MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせて、docker-compose.ymlファイルを編集してください。

Laravel環境構築

1. `docker-compose exec php bash`
2. `composer install`
3. `.env.example`ファイルから`.env`を作成し、環境変数を変更<br>
(セッションの値を保存する際にデータベースを利用するようにしているので上記に追加してSESSION_DRIVER=databaseに変更してください)
4. `php artisan key:generate`
5. `php artisan migrate`
6. `php artisan db:seed`

## 機能確認用ユーザー
- ユーザー名：テスト
- メールアドレス：test@example.com
- パスワード：testexample