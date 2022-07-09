const SaveData = {
    inputsToSave: document.querySelectorAll(".dataToSave"),

    categories: ["identity", "mission", "coordonnees", "address", "schedules", "langages", "accueil_type", "appointement", "services"],
    
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
        "accueil_type": [],
        "appointement": [],
        "services": []
    },

    data: {
        "association_name": '',
        "siret": '',
        "rna_number": '',
        "mission": '',
        "email": '',
        "telephone": '',
        "site": '',
        "address": '',
        "schedules": {
            "Lundi": '',
            "Mardi": '',
            "Mercredi": '',
            "Jeudi": '',
            "Vendredi": '',
            "Samedi": '',
            "Dimanche": '',
        },
        "langages": [],
        "accueil_type": '',
        "appointement": false,
        "services": []
    },

    init: function() {
        this.categories.forEach(category => {
            this.initializeInput(category);
            this.saveIdentity(category);
        });

        // document.querySelector(("button[value='Continuer']".saveData)).addEventListener('click', () => {
        //     this.exportData();
        // });
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

    saveIdentity: function(category) {
        this.categoryInput[category].forEach(el => {
            el.addEventListener('change', (e) => {
                let name =  e.target.getAttribute('id');
                let choiceLangages = [];
                let choiceServices = [];
                let service = {}
                if(category === 'schedules'){
                    this.saveSchedules(e, name);
                    return;
                }

                if(category === 'langages'){
                    let choices = document.querySelectorAll('input[name="langages"]:checked');
                    choices.forEach(choice => {
                        choiceLangages.push(choice.value);
                        this.data[name] = choiceLangages;
                        this.writeInInput(e, choiceLangages, 3);
                    });
                    console.log(this.data);
                    return;
                }

                if(category === 'services'){
                    let choices = document.querySelectorAll('input[id="services"]:checked');                    
                    choices.forEach(choice => {
                        choiceServices.push(choice.value);
                        this.data[name] = choiceServices;
                    });
                    console.log(this.data);
                    return;
                }


                if(category === 'appointement'){
                    let choice = document.querySelector('input[name="appointement"]:checked');
                    this.data[name] = choice.value;
                    console.log(this.data);
                    return;
                }

                this.data[name] = e.target.value;
                console.log(this.data);
            });
        });
    },

    saveSchedules: function(e, name) {
        let selectSchedules = [e.target.parentNode.parentNode.parentNode.parentNode.querySelector('#schedules-select-open'), e.target.parentNode.parentNode.parentNode.parentNode.querySelector('#schedules-select-close')];
        let selectSchedules2 = [e.target.parentNode.parentNode.parentNode.parentNode.querySelector('#schedules-select-open2'), e.target.parentNode.parentNode.parentNode.parentNode.querySelector('#schedules-select-close2')];

        selectSchedules.forEach(select => {
            select.addEventListener('change', () => {
                this.data.schedules[name] = `${selectSchedules[0].value} - ${selectSchedules[1].value}`
            });
        });

        selectSchedules2.forEach(select => {
            select.addEventListener('change', () => {
                this.data.schedules[name] = `${selectSchedules[0].value} - ${selectSchedules[1].value} / ${selectSchedules2[0].value} - ${selectSchedules2[1].value}`
            });
        });

        this.data.schedules[name] = e.target.checked;
        console.log(this.data);
    },
}

SaveData.init();
export const data = SaveData.data;