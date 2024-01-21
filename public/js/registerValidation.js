const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const passwordInput = form.querySelector('input[name="password"]');
const confirmedPasswordInput = form.querySelector('input[name="confirmed"]');

function isEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function arePasswordsSame(password, confirmedPassword) {
    return password === confirmedPassword;
}

function markValidation(element, condition) {
    element.classList.toggle('no-valid', !condition);
}

function validateEmail() {
    setTimeout(function () {
        if (emailInput.value.trim() === '') {
            markValidation(emailInput, true);
        } else {
            markValidation(emailInput, isEmail(emailInput.value));
        }
    }, 1000);
}

function validatePassword() {
    setTimeout(function () {
        const password = passwordInput.value;
        const confirmedPassword = confirmedPasswordInput.value;

        // Sprawdzenie, czy oba pola hasła są puste
        if (password.trim() === '' && confirmedPassword.trim() === '') {
            markValidation(passwordInput, true);
            markValidation(confirmedPasswordInput, true);
        } else {
            const condition = password !== '' && arePasswordsSame(password, confirmedPassword);
            markValidation(passwordInput, condition);
            markValidation(confirmedPasswordInput, condition);
        }
    }, 1000);
}

emailInput.addEventListener('input', validateEmail);
passwordInput.addEventListener('input', validatePassword);
confirmedPasswordInput.addEventListener('input', validatePassword);


