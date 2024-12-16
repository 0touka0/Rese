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

    <p>当日は以下のQRコードを店舗でご提示ください。</p>

    <div style="text-align: center; margin: 60px 0;">
        <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QRコード">
    </div>

    <p>ご不明な点がございましたら、お気軽にお問い合わせください。</p>
</body>
</html>