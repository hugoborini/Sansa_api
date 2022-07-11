'use strict';

class changeForm {
    constructor(el) {
        this.form = el.parentNode.parentNode.querySelector('.customForm');
        this.data = el.parentNode.parentNode.querySelector('.data');
        this.toggleForm()
    }

    toggleForm() {
        this.form.classList.toggle('d-n');
        this.data.classList.toggle('d-n');
    }
}

document.querySelectorAll('.editData').forEach((el, index) => {
    el.addEventListener('click', () => {
        new changeForm(el)
    })
});