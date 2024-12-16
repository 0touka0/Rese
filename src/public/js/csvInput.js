document.addEventListener("DOMContentLoaded", function () {
    const fileInput = document.getElementById("csv"); // ファイル入力要素
    const fileLabel = document.getElementById("file-name"); // ファイル名を表示するラベル

    fileInput.addEventListener("change", function () {
        if (fileInput.files && fileInput.files.length > 0) {
            fileLabel.textContent = fileInput.files[0].name; // 選択されたファイル名を表示
        } else {
            fileNameSpan.textContent = "";
        }
    });
});
