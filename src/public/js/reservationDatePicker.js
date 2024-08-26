document.addEventListener('DOMContentLoaded', function() {
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
});
