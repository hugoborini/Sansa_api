'use strict';

class expandListToggle {
    constructor(triggerElem) {
        this.expandList = triggerElem.parentNode.querySelector('.expandList');

        this.toggle(triggerElem);
    }

    toggle(triggerElem) {
        triggerElem.addEventListener('click', () => {
            this.expandList.classList.toggle('d-n');
        });
    };
}

document.querySelectorAll('.expandInput').forEach(el => {
  el.expandListToggle = new expandListToggle(el)
});