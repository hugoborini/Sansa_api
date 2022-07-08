'use strict';

class OpenPopup {
    constructor(triggerElem) {
        this.expandList = triggerElem.querySelector('.popup');
        this.svg = triggerElem.querySelector('svg');
        this.dots = document.querySelectorAll('.open-popup');
        this.toggle(triggerElem);
    }

    toggle(triggerElem) {
        triggerElem.addEventListener('click', () => {
            this.expandList.classList.toggle('d-n');
            this.svg.classList.toggle('bgc-blue-light');
            this.svg.classList.toggle('br-xl');
            this.closeAll(triggerElem);
        });
    };

    closeAll(triggerElem) {
        this.dots.forEach((dot) => {
            if(triggerElem !== dot ) {
                dot.querySelector('.popup').classList.add('d-n');
                dot.querySelector('svg').classList.remove('bgc-blue-light');
                dot.querySelector('svg').classList.remove('br-xl');
            }
        })
    }
}

document.querySelectorAll('.open-popup').forEach(el => {
  el = new OpenPopup(el)
});