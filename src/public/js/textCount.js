document.addEventListener("DOMContentLoaded", function () {
    // テキストエリアのカウント機能
    const textarea = document.getElementById("comment"); // textarea要素
    const currentCount = document.getElementById("current-count"); // 現在の文字数表示

    // ページロード時に現在の文字数を表示
    currentCount.textContent = textarea.value.length;

    // 入力イベントで文字数を更新
    textarea.addEventListener("input", function () {
        currentCount.textContent = this.value.length; // 現在の文字数
    });
});