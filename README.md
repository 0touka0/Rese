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
- http://localhost/rating/shop_id
- http://localhost/done
- mailhog
- http://localhost:8025
- 管理者用のURL
- http://localhost/ownerCreate
- http://localhost/owners
- http://localhost/mail
- 店舗代表者用のURL
- http://localhost/shopCreate
- http://localhost/shopsConfirm
- http://localhost/shopEdit/shop_id
- http://localhost/reservations

## アプリケーションURL(デプロイ)
- http://13.208.191.95/
- http://13.208.191.95/register
- http://13.208.191.95/thanks
- http://13.208.191.95/login
- http://13.208.191.95/mypage/user_id
- http://13.208.191.95/detail/shop_id
- http://13.208.191.95/done
- mailhog
- http://13.208.191.95:8025
- 管理者用のURL
- http://13.208.191.95/ownerCreate
- http://13.208.191.95/owners
- http://13.208.191.95/mail
- 店舗代表者用のURL
- http://13.208.191.95/shopCreate
- http://13.208.191.95/shopsConfirm
- http://13.208.191.95/shopEdit/shop_id
- http://13.208.191.95/reservations

## 他のリポジトリ
無し

## 機能一覧
- 会員登録
- ログイン
- ログアウト
- 飲食店一覧取得
- 飲食店詳細取得
- 飲食店予約情報追加
- 飲食店予約情報削除
- 飲食店お気に入り追加
- 飲食店お気に入り削除
- 飲食店一覧ソート
- エリアで検索する
- ジャンルで検索する
- 店名で検索する
- ユーザー情報取得
- ユーザー飲食店予約情報取得
- ユーザー飲食店お気に入り一覧取得
- 飲食店評価追加
- 飲食店評価更新
- 飲食店評価削除

管理者
- 店舗代表者作成
- 店舗代表者一覧取得
- メール配信
- csvインポート(飲食店追加)

店舗代表者
- 飲食店追加
- 飲食店一覧取得(詳細)
- 飲食店情報更新
- 飲食店予約一覧取得

## 使用技術(実行環境)
- PHP 7.4.9
- Laravel 8
- MySQL 8.0.26
- nginx 1.21.1
- mailhog

## テーブル設計
### Users テーブル
| カラム名     | データ型          | 制約                             | 備考                   |
| ------------ | ----------------- | -------------------------------- | -------------------- |
| id           | BIGINT UNSIGNED   | PRIMARY KEY, AUTO_INCREMENT      | ユーザーの一意識別子   |
| name         | VARCHAR(255)      | NOT NULL                         | ユーザーの名前         |
| email        | VARCHAR(255)      | NOT NULL, UNIQUE                 | ユーザーのメールアドレス |
| password     | VARCHAR(255)      | NOT NULL                         | ユーザーのパスワード   |
| role         | TINYINT           | NOT NULL                         | ユーザーの役割         |
| created_at   | TIMESTAMP         |                                  | レコード作成日時       |
| updated_at   | TIMESTAMP         |                                  | レコード更新日時       |

### Shops テーブル
| カラム名     | データ型          | 制約                             | 備考                   |
| ------------ | ----------------- | -------------------------------- | -------------------- |
| id           | BIGINT UNSIGNED   | PRIMARY KEY, AUTO_INCREMENT      | 店舗の一意識別子       |
| address_id   | BIGINT UNSIGNED   | FOREIGN KEY REFERENCES addresses(id) | 店舗の住所の識別子   |
| category_id  | BIGINT UNSIGNED   | FOREIGN KEY REFERENCES categories(id) | 店舗のカテゴリ識別子  |
| user_id      | BIGINT UNSIGNED   | FOREIGN KEY REFERENCES users(id) | 店舗オーナーの識別子   |
| name         | VARCHAR(255)      | NOT NULL                         | 店舗の名前             |
| overview     | TEXT              |                                  | 店舗の概要             |
| image        | VARCHAR(255)      |                                  | 店舗の画像URL          |
| payment_url  | VARCHAR(255)      |                                  | 支払いURL              |
| created_at   | TIMESTAMP         |                                  | レコード作成日時       |
| updated_at   | TIMESTAMP         |                                  | レコード更新日時       |

### Reservations テーブル
| カラム名     | データ型          | 制約                             | 備考                   |
| ------------ | ----------------- | -------------------------------- | -------------------- |
| id           | BIGINT UNSIGNED   | PRIMARY KEY, AUTO_INCREMENT      | 予約の一意識別子       |
| user_id      | BIGINT UNSIGNED   | FOREIGN KEY REFERENCES users(id), NOT NULL | ユーザーID   |
| shop_id      | BIGINT UNSIGNED   | FOREIGN KEY REFERENCES shops(id), NOT NULL | 店舗ID       |
| datetime     | TIMESTAMP         | NOT NULL                         | 予約日時               |
| number       | INT               | NOT NULL                         | 予約人数               |
| created_at   | TIMESTAMP         |                                  | レコード作成日時       |
| updated_at   | TIMESTAMP         |                                  | レコード更新日時       |
| deleted_at   | TIMESTAMP         |                                  | レコード削除日時       |

### Likes テーブル
| カラム名     | データ型          | 制約                             | 備考                   |
| ------------ | ----------------- | -------------------------------- | -------------------- |
| id           | BIGINT UNSIGNED   | PRIMARY KEY, AUTO_INCREMENT      | お気に入り登録の一意識別子 |
| user_id      | BIGINT UNSIGNED   | FOREIGN KEY REFERENCES users(id), NOT NULL | ユーザーID   |
| shop_id      | BIGINT UNSIGNED   | FOREIGN KEY REFERENCES shops(id), NOT NULL | 店舗ID       |
| favorite     | TINYINT(1)        | NOT NULL                         | お気に入り登録の状態   |
| created_at   | TIMESTAMP         |                                  | レコード作成日時       |
| updated_at   | TIMESTAMP         |                                  | レコード更新日時       |

### Ratings テーブル
| カラム名     | データ型          | 制約                             | 備考                   |
| ------------ | ----------------- | -------------------------------- | -------------------- |
| id           | BIGINT UNSIGNED   | PRIMARY KEY, AUTO_INCREMENT      | レビューの一意識別子   |
| user_id      | BIGINT UNSIGNED   | FOREIGN KEY REFERENCES users(id), NOT NULL | ユーザーID   |
| shop_id      | BIGINT UNSIGNED   | FOREIGN KEY REFERENCES shops(id), NOT NULL | 店舗ID       |
| score        | INT               | NOT NULL                         | 評価スコア             |
| comment      | TEXT              |                                  | 評価コメント           |
| image        | VARCHAR(255)      |                                  | 画像URL               |
| created_at   | TIMESTAMP         |                                  | レコード作成日時       |
| updated_at   | TIMESTAMP         |                                  | レコード更新日時       |

### Addresses テーブル
| カラム名     | データ型          | 制約                             | 備考                   |
| ------------ | ----------------- | -------------------------------- | -------------------- |
| id           | BIGINT UNSIGNED   | PRIMARY KEY, AUTO_INCREMENT      | 住所の一意識別子       |
| address      | VARCHAR(255)      | NOT NULL                         | 住所                  |
| created_at   | TIMESTAMP         |                                  | レコード作成日時       |
| updated_at   | TIMESTAMP         |                                  | レコード更新日時       |

### Categories テーブル
| カラム名     | データ型          | 制約                             | 備考                   |
| ------------ | ----------------- | -------------------------------- | -------------------- |
| id           | BIGINT UNSIGNED   | PRIMARY KEY, AUTO_INCREMENT      | カテゴリの一意識別子   |
| category     | VARCHAR(255)      | NOT NULL                         | カテゴリ名            |
| created_at   | TIMESTAMP         |                                  | レコード作成日時       |
| updated_at   | TIMESTAMP         |                                  | レコード更新日時       |


## ER図
![rese_ER図](https://github.com/user-attachments/assets/fbbda0a2-976f-4005-b524-b9735e09007f)

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

## CSVファイル構成
提出用CSVファイルの仕様
以下の形式でCSVファイルを作成し、提出してください。

各列の説明
| 列名    |	説明                           | 備考                               |
| ------- | ----------------------------- | --------------------------------- |
| 店舗名  | 店舗の正式な名前                | 例: 寿司太郎                       |
| 地域    | 店舗が位置する都道府県・地域名   | 例: 大阪府                         |
| ジャンル| 店舗のジャンルを記述             | 例: 寿司, カフェ, ラーメンなど      |
| 店舗概要| 店舗の簡単な説明・紹介文         | 例: 新鮮なネタの寿司屋              |
| 画像URL | 店舗の画像ファイルのURL         | 例: http://example.com/sushi.jpeg |

### サンプルデータ

以下の形式でCSVファイルを作成してください：

```csv
店舗名,地域,ジャンル,店舗概要,画像URL
寿司太郎,大阪府,寿司,新鮮なネタの寿司屋,http://example.com/sushi.jpeg
ラーメン花子,東京都,ラーメン,自家製麺が自慢のラーメン店,http://example.com/ramen.jpeg
カフェひまわり,愛知県,カフェ,落ち着いた雰囲気のカフェ,http://example.com/cafe.jpeg
```

## 注意事項
- ストレージはS3を使用しているので、ローカル環境では店舗作成時画像の保存が行えません

- csvファイルの注意事項

1. **カンマ `,` の使用禁止**
   - データ内にカンマを含めないこと
     - **NG**: 「美味しい、安い」
     - **OK**: 「美味しくて安い」

2. **ヘッダー行は必須**
   - 1行目に **列名** を記述すること

3. **URLの記述**
   - `http://` または `https://` から始まる正しい形式

4. **文字コード**
   - UTF-8形式で保存してください

### 入力必須項目の制限

| **項目名**   | **入力ルール**                    | **制限事項**              |
|--------------|----------------------------------|---------------------------|
| **店舗名**    | 店舗の正式な名前                 | 50文字以内               |
| **地域**      | 「東京都」「大阪府」「福岡県」のいずれか |                           |
| **ジャンル**   | 「寿司」「焼肉」「イタリアン」「居酒屋」「ラーメン」のいずれか |                           |
| **店舗概要**  | 店舗の簡単な説明を記述する       | 400文字以内              |
| **画像URL**   | JPEGまたはPNG形式                | 例: `http://example.com` |
