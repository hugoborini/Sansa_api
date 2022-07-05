
let max = 3;
const inputs = document.querySelectorAll('.expandInput--services');
if(inputs.length > 1){
    max = 1;
}

function fillArray(e, choices) {
    if(e.target.checked) {
        choices.push(e.target.value);
    } else {
      var i = choices.indexOf(e.target.value);
      choices.splice(i,1)
    }
    write(e, choices);
}

function write(e, choices) {
    const innerInput = e.target.parentNode.parentNode.parentNode.querySelector('.langages');
    const counter = e.target.parentNode.parentNode.parentNode.querySelector('.counter');

    innerInput.innerHTML = '';
    counter.innerHTML = '';
    choices.forEach((d, i) => {
        if(i < max) {
            innerInput.innerHTML += `<span class="ff-body fs-xxs c-black pt-0c5 pb-0c5 pl-1 pr-1 bgc-black-5 br-xl mr-0c5">${d}</span>`;
        } else {
            counter.innerHTML = `<span class="ff-body fs-xxs c-black pt-0c5 pb-0c5 pl-1 pr-1 bgc-black-5 br-xl mr-0c5">+${i - (max - 1)}</span>`;
        }
    });
}

function multipleChoice(choices) {
    const mutlipleChoice = document.querySelectorAll('.mutliple-select');
    mutlipleChoice.forEach((input) => {
        input.addEventListener('change', (e) => {
            fillArray(e, choices);
        });
    });
}


inputs.forEach((el) => {
    el.addEventListener('click', () => {
        let choices = [];
        multipleChoice(choices);
    })
});