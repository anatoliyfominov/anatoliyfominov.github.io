let tariffItems = document.querySelectorAll('.tariff-item');
let tariffModal = document.querySelector('#modal');

[].forEach.call( tariffItems, function(el) {
	el.onclick = function(e) {
		showModal(this.cloneNode(true));
	}
});

tariffModal.onclick = function(e) {
	let target = e.target;
	if ( target.id == 'modal' || target.className == 'modal__close' ) {
		hideModal(this);
	}
}

function showModal(el) {
	let modal = document.querySelector('#modal');
	let bodyModal = modal.querySelector('.modal__body');
	bodyModal.innerHTML = '';
	bodyModal.append(el);
	modal.setAttribute("class", "modal modal_active");
}

function hideModal(modal) {
    modal.setAttribute("class", "modal modal_hidden");
}