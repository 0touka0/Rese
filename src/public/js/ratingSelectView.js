document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".star"); // 星の要素を取得
    const scoreInput = document.getElementById("score"); // 隠しフィールド

    // ページロード時に評価値を取得して塗りつぶす
    const initialRating = scoreInput.value; // 隠しフィールドに既に設定されている評価値

    if (initialRating) {
        highlightStars(initialRating); // 初期評価値で星を塗りつぶす
    }

    // 星をクリックして評価を選択
    stars.forEach((star) => {
        star.addEventListener("click", function () {
            const rating = this.dataset.value; // クリックした星の評価値
            scoreInput.value = rating; // 隠しフィールドに評価値をセット
            highlightStars(rating); // 星を塗りつぶす
        });
    });

    // 星の塗りつぶし処理
    function highlightStars(rating) {
        stars.forEach((star) => {
            if (star.dataset.value <= rating) {
                star.innerHTML = "&#9733;"; // 塗りつぶし星
                star.style.color = "rgb(46, 102, 255)";
            } else {
                star.innerHTML = "&#9733;"; // 空星
                star.style.color = "#d9d9d9";
            }
        });
    }
});