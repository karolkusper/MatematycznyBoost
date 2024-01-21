
const emailInput = document.querySelector('.inputs input[name="email"]');

function isEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
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

emailInput.addEventListener('input', validateEmail);
