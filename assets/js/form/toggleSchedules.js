const toggleOpenings = document.querySelectorAll('.toggleOpening');
const inputSchedules = document.querySelectorAll('input[name="schedules"]');
const selectSchedules = document.querySelectorAll('.selectSchedule');
const selectSchedules2 = document.querySelectorAll('.selectSchedule2');
const addSchedules = document.querySelectorAll('.addSchedule');
const closeCross = document.querySelectorAll('.closeCross');
const closeCross2 = document.querySelectorAll('.closeCross2');

if(toggleOpenings) {
    toggleOpenings.forEach((toggleOpening, index) => {
        inputSchedules[index].addEventListener('change', () => {
            if(inputSchedules[index].checked) {
                toggleOpening.innerHTML = "Ouvert";
                selectSchedules[index].style.display = 'flex';
            } else {
                toggleOpening.innerHTML = "Fermé";
                selectSchedules[index].style.display = 'none';
            }
        });
    });
};

addSchedules.forEach((el, index) => {
    el.addEventListener('click', () => {
        selectSchedules2[index].style.display = 'flex';
        el.style.display = 'none';
    });
});

closeCross.forEach((el, index) => {
    el.addEventListener('click', () => {
        selectSchedules[index].style.display = 'none';
    })
});

closeCross2.forEach((el, index) => {
    el.addEventListener('click', () => {
        selectSchedules2[index].style.display = 'none';
    })
});