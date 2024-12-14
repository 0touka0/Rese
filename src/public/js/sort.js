function handleSortChange() {
    const sortSelect = document.getElementById("sort-select");
    const selectedValue = sortSelect.value;

    if (selectedValue === "") {
        // クエリを削除してページをリロード
        window.location.href = "/";
    } else {
        // 通常通りフォーム送信
        sortSelect.closest("form").submit();
    }
}
