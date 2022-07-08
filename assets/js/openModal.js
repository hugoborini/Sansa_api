let modalsCta = document.querySelectorAll('.openModal');
let closesCta = document.querySelectorAll('.closeModal');
let modal = document.querySelectorAll('.modal');

modalsCta.forEach((modalCta, i) => {
    modalCta.addEventListener('click', () => {
        modal[i].classList.add('d-b');
        modal[i].classList.remove('d-n');
        document.body.classList.add('o-h');
    });
});

closesCta.forEach((closeCta,i) => {
    closeCta.addEventListener('click', () => {
        modal[i].classList.remove('d-b');
        modal[i].classList.add('d-n');
        document.body.classList.remove('o-h');
    });
});