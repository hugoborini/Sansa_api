const inputPassword = document.querySelector('.tooglePassword');

function togglePassword(inputPassword) {
    inputPassword.addEventListener('click', () => {
        var eye = inputPassword.nextElementSibling.firstElementChild
        if (eye.type == "password") {
            eye.type = "text";
        } else {
            eye.type = "password";
        }
    });
}

togglePassword(inputPassword);