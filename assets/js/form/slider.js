import { data } from "./saveData";

const FormSlider = {
    items: document.querySelectorAll(".slider-item"),
    num_items: document.querySelectorAll(".slider-item").length,
    isFormValid: false,
    i: 1,

    init: function() {
        this.isValid();
		this.addEvents();
	},

    isValid: function() {
        let ctn = document.querySelector(`#step_${this.i}`);
        let requiredInput = ctn.querySelectorAll('.dataToSave:required');
        let inputArray = Array.from(requiredInput);

        requiredInput.forEach(e => {
            e.addEventListener('input', () => {
                const isRequired = (currentValue) => currentValue.value;
                this.isFormValid =  inputArray.every(isRequired);
                this.injectStyle();
            });
        });
    },

    injectStyle: function() {
        if(this.isFormValid) {
            document.querySelector("button[value='Continuer']").classList.add('active');
        } else {
            document.querySelector("button[value='Continuer']").classList.remove('active');
        }
    },

    addEvents: function() {
		// click on move item button
		document.querySelector("button[value='Continuer']").addEventListener('click', () => {
            if(this.isFormValid) {
                this.gotoNext();
                this.isFormValid = false;
                this.injectStyle();
                this.isValid();
            }
        });

        document.querySelector(".goBack").addEventListener('click', () => {
           this.goBack()
        });
	},
    gotoNext: function() {
		// translate from 0 to -100% 
		// we need transitionend to fire for this translation, so add transition CSS
		document.querySelector("#slider__ctn").classList.add('slider-container-transition');
        this.exportData();

        if(this.i < 8){
            document.querySelector("#slider__ctn").style.transform = `translateX(-${this.i}00%)`;
            document.querySelector('.progress-bar__current').style.width = `${this.i * 14.29}%`;

            if(this.i === 7) {
                document.querySelector("button[value='Continuer']").classList.toggle('d-n');
                document.querySelector(".final__button").classList.toggle('d-n');
            }
        }
        this.i++;
	},

    goBack: function() {
		document.querySelector("#slider__ctn").classList.add('slider-container-transition');
        document.querySelector("#slider__ctn").style.transform = `translateX(-${this.i-2}00%)`;
        document.querySelector('.progress-bar__current').style.width = `${(this.i - 2) * 14.29}%`;
        if(this.i === 8) {
            document.querySelector("button[value='Continuer']").classList.toggle('d-n');
            document.querySelector(".final__button").classList.toggle('d-n');
        }
        this.i--
    },

    exportData: function() {
        $.ajax({     
            type: "post",     
            url: `/bo/ajax/addOrga`,     
            data: {data},
            dataType: "JSON",     
            success:function(data){
                console.log(data)
            } 
        });
    }
}

FormSlider.init();