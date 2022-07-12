const manageService = {
    services: document.querySelectorAll('.services'),
    lists: document.querySelectorAll('.service_list'),
    key: '',


    init: function() {
        this.services.forEach(service => {
            service.addEventListener('click', (el) => {
                this.key = service.innerText;
                this.toggleList(this.key, el);
                this.toggleBackground(this.key, el);
            });
        });
    },

    toggleList: function(key){
        this.lists.forEach(list => {
            let name = list.getAttribute('data-list');
            if(name == key) {
                list.classList.remove('d-n');
            } else {
                list.classList.add('d-n');
            }
        });
    },

    toggleBackground: function(key){
        this.services.forEach(service => {
            if(service.getAttribute('data-services') == key) {
                service.classList.add('bgc-black-3');
                service.classList.add('br-l');
                service.classList.add('fw-700');
            } else {
                service.classList.remove('bgc-black-3');
                service.classList.remove('br-l');
                service.classList.remove('fw-700');
            }
        });
    }
}


manageService.init();