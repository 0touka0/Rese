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
- http://localhost/mypage/user_id
- http://localhost/detail/shop_id
- http://localhost/done
- http://localhost:8025(mailhog)
- 管理者用のURL
- http://localhost/ownerCreate
- http://localhost/owners
- http://localhost/mail
- 店舗代表者用のURL
- http://localhost/shopCreate
- http://localhost/shopsConfirm
- http://localhost/shopEdit/{shop_id}
- http://localhost/reservations

## アプリケーションURL(デプロイ)
- http://13.208.191.95/
- http://13.208.191.95/register
- http://13.208.191.95/thanks
- http://13.208.191.95/login
- http://13.208.191.95/mypage/user_id
- http://13.208.191.95/detail/shop_id
- http://13.208.191.95/done
- http://13.208.191.95:8025(mailhog)
- 管理者用のURL
- http://13.208.191.95/ownerCreate
- http://13.208.191.95/owners
- http://13.208.191.95/mail
- 店舗代表者用のURL
- http://13.208.191.95/shopCreate
- http://13.208.191.95/shopsConfirm
- http://13.208.191.95/shopEdit/{shop_id}
- http://13.208.191.95/reservations

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
- 店舗代表者作成
- 店舗代表者一覧取得
- メール配信
- 店舗追加
- 店舗一覧取得
- 店舗編集
- 店舗予約一覧取得

## 使用技術(実行環境)
- PHP 7.4.9
- Laravel 8
- MySQL 8.0.26
- nginx 1.21.1
- mailhog

## テーブル設計
![Rese-table](https://github.com/user-attachments/assets/0494ee62-21f7-4188-803a-8efbebaa3a85)

## ER図
![rese_ER図](https://github.com/user-attachments/assets/f4498123-4c25-4646-8938-ae99817c3ae9)

# 環境構築
Dockerビルド

1. `git clone git@github.com:0touka0/Rese.git`
2. `docker-compose up -d --build`

※MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせて、docker-compose.ymlファイルを編集してください。

Laravel環境構築

1. `docker-compose exec php bash`
2. `composer install`
3. `.env.example`ファイルから`.env`を作成し、環境変数を変更<br>
- DBの設定を行って下さい
- セッションの値をDBに保存しているので`SESSION_DRIVER=database`に変更してください
- `MAIL_FROM_ADDRESS`に`mailtest@example.com`等のような送信側のメールアドレス設定を行ってください
4. `php artisan key:generate`
5. `php artisan migrate`
6. `php artisan db:seed`

## 機能確認用ユーザー
- ユーザー名：管理者
- メールアドレス：admin@example.com
- パスワード：adminexample

- ユーザー名：店舗代表者
- メールアドレス：owner@example.com
- パスワード：ownerexample

## 注意事項
- ストレージはS3を使用しているのでローカル環境では店舗作成時画像の保存が行えません