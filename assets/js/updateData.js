const updateData = {
    inputsToSave: document.querySelectorAll(".dataToUpdate"),

    categories: ["identity", "mission", "coordonnees", "address", "schedules", "langages", "accueil", "appointement", "services"],
    
    services: {
        acceuil: ['Espace de repos', 'Halte de nuit', 'Domiciliation' , 'Accueil de jour', 'Vêtements', 'Téléphone', 'Boutique solidaire', 'Bagagerie'],
        alimentation: ['Épicerie Sociale et Solidaire', 'Colis Alimentaire', 'Restauration assise', 'Distribution de repas'],
        sante: ['Médecin généraliste', 'Soins enfants', 'Dépistage', 'Suivi grossesse', 'Infirmière'],
        medecine: ['Dermatologie', 'Addiction', 'Psychologie', 'Pédicure', 'Dentaire', 'Vétérinaire'],
        hygiene: ['Douche', 'Toilettes', 'Protections périodiques', 'Fontaine à eau', 'Laverie', 'Bien-être'],
        conseil: ['Permanence juridique', 'Accompagnement à l\'emploi', 'Conseil administratif', 'Conseil logement', 'Accompagnement social'],
        activity: ['Activités sportives', 'Musée', 'Bibliothèque'],
        technologie: ['Ordinateur', 'Wifi', 'Prise', 'Atelier numérique', 'Cours de français', 'Soutien scolaire']
    },

    categoryInput: {
        "identity": [],
        "mission": [],
        "coordonnees": [],
        "address": [],
        "schedules": [],
        "langages": [],
        "accueil": [],
        "appointement": [],
        "services": []
    },

    data: {
    },

    schedules: {
        "Lundi": "",
        "Mardi": "",
        "Mercredi": "",
        "Jeudi": "",
        "Vendredi": "",
        "Samedi": "",
        "Dimanche": "",
    },

    init: function() {
        this.categories.forEach(category => {
            this.initializeInput(category);
        });
        this.updateCoordonnees();
        this.updateMission();
        this.updateAcceuil();
        this.updateSchedules();
        this.updateServices();
        console.log((this.categoryInput));
	},

    initializeInput: function(category) {
        this.inputsToSave.forEach(input => {
            if(input.getAttribute('name') === category){
                this.categoryInput[category].push(input);
            }
        });
    },

    writeInInput: function(e, choices, max) {
        const innerInput = e.target.parentNode.parentNode.parentNode.querySelector('.langages');
        const counter = e.target.parentNode.parentNode.parentNode.querySelector('.counter');
    
        innerInput.innerHTML = '';
        counter.innerHTML = '';
        choices.forEach((choice, i) => {
            if(i < max) {
                innerInput.innerHTML += `<span class="ff-body fs-xxs c-black pt-0c5 pb-0c5 pl-1 pr-1 bgc-black-5 br-xl mr-0c5">${choice}</span>`;
            } else {
                counter.innerHTML = `<span class="ff-body fs-xxs c-black pt-0c5 pb-0c5 pl-1 pr-1 bgc-black-5 br-xl mr-0c5">+${i - (max - 1)}</span>`;
            }
        })
    },

    updateCoordonnees: function() {
        this.categoryInput['coordonnees'].forEach(el => {
            el.addEventListener('change', (e) => {
                let name =  e.target.getAttribute('id');
                this.data[name] = e.target.value;
                console.log(this.data);
            });
        })
    },

    updateMission: function() {
        this.categoryInput['mission'].forEach(el => {
            el.addEventListener('change', (e) => {
                this.data['mission'] = e.target.value;
                console.log(this.data);
            });
        })
    },

    updateAcceuil: function() {
        this.categoryInput['accueil'].forEach(el => {
            el.addEventListener('change', (e) => {
                let choiceLangages = [];
                let name =  e.target.getAttribute('id');

                if(name === 'langages') {
                    let choices = document.querySelectorAll('input[id="langages"]:checked');

                    choices.forEach(choice => {
                        choiceLangages.push(choice.value);
                        this.data[name] = choiceLangages;
                        this.writeInInput(e, choiceLangages, 3);
                    });

                    return;
                }

                this.data[name] = e.target.value;
            });
        })
    },

    updateSchedules: function() {
        this.categoryInput['schedules'].forEach(el => {
            el.addEventListener('change', (e) => {
                let name =  e.target.getAttribute('id');
                console.log(name);

                let selectSchedules = [e.target.parentNode.parentNode.parentNode.parentNode.querySelector('#schedules-select-open'), e.target.parentNode.parentNode.parentNode.parentNode.querySelector('#schedules-select-close')];
                let selectSchedules2 = [e.target.parentNode.parentNode.parentNode.parentNode.querySelector('#schedules-select-open2'), e.target.parentNode.parentNode.parentNode.parentNode.querySelector('#schedules-select-close2')];

                this.schedules[name] = e.target.checked;

                selectSchedules.forEach(select => {
                    select.addEventListener('change', () => {
                        console.log('okk 1 is change');
                        this.schedules[name] = `${selectSchedules[0].value} - ${selectSchedules[1].value}`
                        console.log(this.schedules);
                    });
                });
        
                selectSchedules2.forEach(select => {
                    select.addEventListener('change', () => {
                        this.schedules[name] = `${selectSchedules[0].value} - ${selectSchedules[1].value} / ${selectSchedules2[0].value} - ${selectSchedules2[1].value}`
                        console.log(this.schedules);
                    });
                });
        
                this.data['schedules'] = this.schedules;
                console.log(this.data);
            })
        })
    },


    updateServices: function() {
        this.categoryInput['services'].forEach(el => {
            el.addEventListener('change', (e) => {
                let choiceServices = [];
                let choices = document.querySelectorAll('input[id="services"]:checked');                    
                choices.forEach(choice => {
                    choiceServices.push(choice.value);
                    this.data['services'] = choiceServices;
                });
                console.log(this.data);
                return;
            })
        })
    }

    // exportData: function() {
    //     $.ajax({     
    //         type: "post",     
    //         url: `/bo/ajax/addOrga`,
    //         data: {data},
    //         dataType: "JSON",     
    //         success:function(data){
    //             console.log(data)
    //         } 
    //     });
    // }

    // saveIdentity: function(category) {
    //     this.categoryInput[category].forEach(el => {
    //         el.addEventListener('change', (e) => {
    //             let name =  e.target.getAttribute('id');
    //             let choiceLangages = [];
    //             let choiceServices = [];
    //             let service = {}
    //             if(category === 'schedules'){
    //                 this.saveSchedules(e, name);
    //                 return;
    //             }

    //             if(category === 'langages'){
    //                 let choices = document.querySelectorAll('input[name="langages"]:checked');
    //                 choices.forEach(choice => {
    //                     choiceLangages.push(choice.value);
    //                     this.data[name] = choiceLangages;
    //                     this.writeInInput(e, choiceLangages, 3);
    //                 });
    //                 console.log(this.data);
    //                 return;
    //             }

    //             if(category === 'services'){
    //                 let choices = document.querySelectorAll('input[id="services"]:checked');                    
    //                 choices.forEach(choice => {
    //                     choiceServices.push(choice.value);
    //                     this.data[name] = choiceServices;
    //                 });
    //                 console.log(this.data);
    //                 return;
    //             }


    //             if(category === 'appointement'){
    //                 let choice = document.querySelector('input[name="appointement"]:checked');
    //                 this.data[name] = choice.value;
    //                 console.log(this.data);
    //                 return;
    //             }

    //             this.data[name] = e.target.value;
    //             console.log(this.data);
    //         });
    //     });
    // },

    
}

updateData.init();