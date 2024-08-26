// 予約フォームの表示に関する機能
document.addEventListener('DOMContentLoaded', () => {
	const dateInput 	 = document.getElementById('reservation-date');
	const timeSelect 	 = document.getElementById('reservation-time');
	const numberSelect = document.getElementById('reservation-number');

	// 確認用のデータ
	const selectedDate   = document.getElementById('selected-date');
	const selectedTime   = document.getElementById('selected-time');
	const selectedNumber = document.getElementById('selected-number');

	const today 				= new Date();
	const year 					= today.getFullYear();
	const month 			  = String(today.getMonth() + 1).padStart(2, '0');
	const day 					= String(today.getDate()		 ).padStart(2, '0');
	const formattedDate = `${year}-${month}-${day}`;

	// フォームの初期値設定
	dateInput.value = formattedDate;
	dateInput.min 	= formattedDate; //	選択日時の最小にするため
	selectedDate.textContent   = dateInput.value;
	selectedTime.textContent	 = timeSelect.value;
	selectedNumber.textContent = numberSelect.options[numberSelect.selectedIndex].text;

// 時間選択肢の無効化関数
	const disablePastTimes = () => {
		const selectedDate = new Date(dateInput.value);
		const currentDate  = new Date(formattedDate);

		// 今日の日付が選択されている場合、過去の時間帯を無効化
		if (selectedDate.getTime() === currentDate.getTime()) {
			timeSelect.querySelectorAll('option').forEach(option => {
				const [hour, minute] = option.value.split(':');
				const optionDateTime = new Date(year, month - 1, day, hour, minute);

				option.disabled = optionDateTime.getTime() < today.getTime();
			});
		} else {
			// 今日以外の日付が選択された場合、すべての時間帯を有効化
			timeSelect.querySelectorAll('option').forEach(option => {
				option.disabled = false;
			});
		}
	};

	// ページロード時に無効化チェックを実行
	disablePastTimes();

	dateInput.addEventListener('change', () => {
		selectedDate.textContent = dateInput.value;
		disablePastTimes(); // 日付変更に伴い無効化チェックを再実行
	});

	timeSelect.addEventListener('change', () => {
		selectedTime.textContent = timeSelect.value;
	});

	numberSelect.addEventListener('change', () => {
		selectedNumber.textContent = numberSelect.options[numberSelect.selectedIndex].text;
	});
});