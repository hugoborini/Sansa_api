'use strict';

class expandListToggle {
    constructor(triggerElem) {
        this.expandList = triggerElem.parentNode.querySelector('.expandList');

        this.toggle(triggerElem);
    }

    toggle(triggerElem) {
        triggerElem.addEventListener('click', () => {
            document.querySelector('.expandList.multiple.active')?.classList.remove('active');
            this.expandList.classList.toggle('active');
        });
    };
}

document.querySelectorAll('.expandInput').forEach(el => {
  el.expandListToggle = new expandListToggle(el)
});