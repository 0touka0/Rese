// 評価と評価モーダルのスクリプト
document.addEventListener('DOMContentLoaded', function () {
	function renderStars(rating, element) {
		element.innerHTML = '';
		const fullStars = Math.floor(rating);
		const hasHalfStar = rating % 1 >= 0.5;
		for (let i = 1; i <= 5; i++) {
			if (i <= fullStars) {
				element.innerHTML += '<i class="fas fa-star"></i>';
			} else if (i === fullStars + 1 && hasHalfStar) {
				element.innerHTML += '<i class="fas fa-star-half-alt"></i>';
			}	else {
				element.innerHTML += '<i class="far fa-star"></i>';
			}
		}
	}

	// 評価アイコンの表示
	function initializeRatings() {
		const ratingElements = document.querySelectorAll('.rating');
		ratingElements.forEach(function (ratingElement) {
			const rating = parseFloat(ratingElement.getAttribute('data-rating'));
			renderStars(rating, ratingElement);
		});

		const ratingIcons = document.querySelectorAll('.rating__icon');
		ratingIcons.forEach(function (ratingIcon) {
			const rating = parseFloat(ratingIcon.getAttribute('data-rating'));
			renderStars(rating, ratingIcon);
		});
	}

	// 評価モーダルの表示
	function initializeModal() {
		const ratingElements = document.querySelectorAll('.rating');
		ratingElements.forEach(function (ratingElement) {
			ratingElement.addEventListener('click', function () {
				const modalId = ratingElement.dataset.modalId; // 店舗IDをデータ属性から取得
				const ratingModal = document.getElementById(modalId); // 対応するモーダルを取得
				if (ratingModal) {
					ratingModal.style.display = 'block';
				}
			});
		});

		const ratingCloseElements = document.querySelectorAll('.rating-modal__close');
		ratingCloseElements.forEach(function (ratingClose) {
			ratingClose.addEventListener('click', function() {
				const modals = document.querySelectorAll('.modal');
				modals.forEach(function (modal) {
					modal.style.display = 'none';
				});
			});
		});

		window.addEventListener('click', function(event) {
			const modals = document.querySelectorAll('.modal');
			modals.forEach(function (modal) {
				if (event.target == modal) {
					modal.style.display = 'none';
				}
			});
		});
	}

	// 初期化関数を実行
	initializeRatings();
	initializeModal();
});