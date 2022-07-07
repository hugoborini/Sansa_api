'use strict';

class OpenPopup {
    constructor(triggerElem) {
        this.expandList = triggerElem.querySelector('.popup');
        this.svg = triggerElem.querySelector('svg');
        this.toggle(triggerElem);
    }

    toggle(triggerElem) {
        triggerElem.addEventListener('click', () => {
            this.expandList.classList.toggle('d-n');
            this.svg.classList.toggle('bgc-blue-light');
            this.svg.classList.toggle('br-xl');
        });
    };
}

document.querySelectorAll('.open-popup').forEach(el => {
  el = new OpenPopup(el)
});