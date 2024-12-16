document.addEventListener("DOMContentLoaded", function () {
    const sortDropdown = document.querySelector(".sort-dropdown");
    const selectedOption = sortDropdown.querySelector(".sort-selected-option");
    const optionsList = sortDropdown.querySelector(".sort-options-list");
    const hiddenInput = document.getElementById("hidden-sort");
    const sortForm = document.getElementById("sort-form");

    // ドロップダウンの表示/非表示を切り替え
    selectedOption.addEventListener("click", function () {
        sortDropdown.classList.toggle("open");
    });

    // オプションをクリックした時の処理
    optionsList.addEventListener("click", function (event) {
        if (event.target.classList.contains("sort-option")) {
            const selectedValue = event.target.dataset.value;

            // 表示を更新
            selectedOption.textContent = event.target.textContent;

            // フォームに値を設定して送信
            hiddenInput.value = selectedValue;

            // フォームを送信
            sortForm.submit();
        }
    });

    // 外部クリックでドロップダウンを閉じる
    document.addEventListener("click", function (e) {
        if (!sortDropdown.contains(e.target)) {
            sortDropdown.classList.remove("open");
        }
    });
});
