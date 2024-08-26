$(document).ready(function() {
	// 評価フォーム表示条件
	$('.reservation-card').each(function() {
		var reservationCard = $(this);
		var datetime = reservationCard.data('datetime');
		var datetimeDate = new Date(datetime);
		var now = new Date();
		var oneHourLater = new Date(datetimeDate.getTime() + 60 * 60 * 1000);

		if (now >= oneHourLater) {
			showOverlay(reservationCard);
		} else {
			var timeRemaining = oneHourLater - now;
			setTimeout(function() {
				showOverlay(reservationCard);
			}, timeRemaining);
		}
	});
	// 評価フォーム表示機能
	function showOverlay(reservationCard) {
		var overlay = $('<div class="overlay"></div>');
		var overlayContent = $('<div class="overlay-content"></div>');
		var closeButton = $('<button class="close-button">閉じる</button>');

		closeButton.on('click', function() {
			overlay.remove();
		});

		overlayContent.append(closeButton);
		overlayContent.append(reservationCard.find('.rating-form').clone().show());
		overlay.append(overlayContent);
		reservationCard.append(overlay);
	}

	// 予約情報変更ボタンを表示
	$('.auto-save').on('input change', function() {
		var reservationId = $(this).data('id');
		$('#reservation-form-' + reservationId + ' .reservation-detail__btn--submit').show();
	});
});
