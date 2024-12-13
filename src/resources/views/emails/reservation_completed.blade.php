<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>予約完了のお知らせ</title>
</head>
<body>
    <p>{{ $reservation->user->name }}様</p>
    <p>ご予約ありがとうございます。以下の内容で予約が完了しました。</p>

    <p>予約日時: {{ $reservation->datetime }}</p>

    <p>QRコードを添付ファイルとしてお送りします。このQRコードを店舗で提示してください。</p>

    <p>ご不明な点がございましたら、お気軽にお問い合わせください。</p>
</body>
</html>