document.addEventListener("DOMContentLoaded", function () {
    // 画像アップロード機能
    const imageInputContainer = document.querySelector("#image-input");
    const fileInput = document.querySelector("#image-upload");
    const textLarge = document.querySelector(".image-input__large-text");
    const textSmall = document.querySelector(".image-input__small-text");
    const errorMessage = document.querySelector("#error-message"); // エラーメッセージ
    const previewImage = document.querySelector(".image-input__image"); // プレビュー画像
    imageInputContainer.appendChild(previewImage); // プレビュー画像を追加

    // ページロード時に既存の画像を表示
    const existingImageSrc = previewImage.getAttribute("data-existing-src"); // data属性から既存画像のURLを取得

    if (existingImageSrc) {
        previewImage.src = existingImageSrc; // 既存画像をプレビューに設定
        previewImage.style.display = "block"; // プレビューを表示

        textLarge.style.display = "none"; // 説明テキストを非表示
        textSmall.style.display = "none";
    }

    // クリックでファイル選択ダイアログを表示
    imageInputContainer.addEventListener("click", function () {
        fileInput.click(); // ファイル選択トリガー
    });

    // ファイルが選択された時の処理
    fileInput.addEventListener("change", handleFileSelect);

    // ドラッグアンドドロップ機能
    imageInputContainer.addEventListener("dragover", function (e) {
        e.preventDefault();
        imageInputContainer.classList.add("dragover"); // 視覚的にドラッグ中を表示
    });

    imageInputContainer.addEventListener("dragleave", function () {
        imageInputContainer.classList.remove("dragover"); // ドラッグ中のスタイルを削除
    });

    imageInputContainer.addEventListener("drop", function (e) {
        e.preventDefault();
        imageInputContainer.classList.remove("dragover");

        const file = e.dataTransfer.files[0]; // ドロップされたファイルを取得

        // ドロップされたファイルを <input> に設定
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
		fileInput.files = dataTransfer.files;

        handleFile(file);
    });

    // ファイル選択またはドロップ時の処理
    function handleFileSelect(event) {
		const file = event.target.files[0];
        handleFile(file);
    }

    function handleFile(file) {
        const reader = new FileReader();

        // ファイルを読み込んでプレビューに表示
        reader.onload = function (e) {
            previewImage.src = e.target.result; // 選択された画像をプレビュー
            previewImage.style.display = "block"; // プレビューを表示

            textLarge.style.display = "none";
            textSmall.style.display = "none";
        };

        // ファイルが選択され、形式が正しい場合のみ処理を続行
        if (file) {
            const allowedTypes = ["image/jpeg", "image/png"];
            if (allowedTypes.includes(file.type)) {
                errorMessage.textContent = ""; // エラーメッセージをリセット
                reader.readAsDataURL(file); // ファイルを読み込む
            } else {
                errorMessage.textContent =
                    "JPEGまたはPNG形式のみアップロード可能です。";
                previewImage.style.display = "none"; // プレビューを非表示
            }
        }
    }
});
