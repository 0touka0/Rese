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

	// 初期化関数を実行
	initializeRatings();
});