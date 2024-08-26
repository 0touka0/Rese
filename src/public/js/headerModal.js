var headerBtn   = document.getElementById("modal-open");
var headerModal = document.getElementById("header-modal");
var headerClose = document.getElementsByClassName("header-modal__close")[0];

headerBtn.onclick = function() {
  headerModal.style.display = "block";
}
headerClose.onclick = function() {
  headerModal.style.display = "none";
}
window.onclick = function(event) {
	if (event.target == headerModal) {
		headerModal.style.display = "none";
	}
}