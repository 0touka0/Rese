document.addEventListener('DOMContentLoaded', function () {
  // カレンダーの表示機能
	var dateInputs = document.querySelectorAll('.reservation-card__detail-input');

	dateInputs.forEach(function(dateInput) {
		dateInput.addEventListener('click', function() {
			if (typeof this.showPicker === 'function') {
				this.showPicker();
			} else {
				console.warn('showPicker() is not supported on this browser.');
			}
		});
	});

  // すべての予約リンクを取得
  var paymentLinks = document.querySelectorAll('.reservation-card__payment-link');

  paymentLinks.forEach(function(link) {
    // データ属性から予約日時を取得
    var reservationDatetime = link.getAttribute('data-reservation-datetime');
    var reservationTime = new Date(reservationDatetime);

    // 現在の日時を取得
    var now = new Date();

    // 現在の日時が予約時間を過ぎている場合、リンクを非表示にしフォームを無効化
    if (now >= reservationTime) {
      link.style.display = 'none';

      // 親要素であるカードからフォームを取得
      var card = link.closest('.reservation-card__detail');
      var form = card.querySelector('form');

      // フォームの要素をすべて無効化
      if (form) {
        var elements = form.querySelectorAll('input, select, button');
        elements.forEach(function(element) {
          element.disabled = true; // 無効化
        });

        // フォームの送信を無効化
        form.addEventListener('submit', function(event) {
          event.preventDefault(); // フォーム送信をキャンセル
        });
      }
    }
  });

	// 変更中にリンクを非表示にする機能
  var reservationForms = document.querySelectorAll('.reservation-card__detail');

  reservationForms.forEach(function(form) {
    var paymentLink = form.querySelector('.reservation-card__payment-link'); // リンクを取得
    var autoSaveElements = form.querySelectorAll('.auto-save'); // 変更を監視する要素を取得

    autoSaveElements.forEach(function(element) {
      element.addEventListener('change', function() {
        // 変更があったときにリンクを非表示
        if (paymentLink) {
          paymentLink.style.display = 'none';
        }
      });
    });

    form.addEventListener('submit', function() {
      // フォーム送信時にリンクを再表示
      if (paymentLink) {
        paymentLink.style.display = 'block';
      }
    });
  });
});
