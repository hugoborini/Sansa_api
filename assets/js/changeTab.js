'use strict';

class changeTab {
    constructor(triggerElem, index) {
        this.views = document.querySelectorAll('.views');
        this.tabs = document.querySelectorAll('.tab');
        this.change(triggerElem, index);
    }

    change(triggerElem, index){
        triggerElem.addEventListener('click', () => {
            this.views[index].classList.add('active');
            triggerElem.classList.add('active');
            this.closeAll(index, triggerElem);
        });
    }

    closeAll(index, triggerElem){
        this.views.forEach((view, i) => {
            if(index !== i) {
                view.classList.remove('active');
            }
        });
        this.tabs.forEach((tab,i) => {
                if(index !== i) {
                tab.classList.remove('active');
            }
        })
    }
}

document.querySelectorAll('.tab').forEach((el, index) => {
    el = new changeTab(el, index)
});