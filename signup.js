function checkName(event) {
    const input = event.currentTarget;
    
    if (formStatus[input.name] = input.value.length > 0) {
        input.classList.remove('errore');
    } else {
        input.classList.add('errore');
    }
}

function checkSurname(event) {
    const input = event.currentTarget;
    
    if (formStatus[input.surname] = input.value.length > 0) {
        input.classList.remove('errore');
    } else {
        input.classList.add('errore');
    }
}

function jsonCheckUsername(json) {
    // Controllo il campo exists ritornato dal JSON
    if (formStatus.username = !json.exists) {
        document.querySelector('#yt_username').classList.remove('errore');
    } else {
        document.querySelector('#errore_user').textContent = "Nome utente già utilizzato";
        document.querySelector('#yt_username').classList.add('errore');
    }
}

function jsonCheckEmail(json) {
    // Controllo il campo exists ritornato dal JSON
    if (formStatus.email = !json.exists) {
        document.querySelector('#yt_email').classList.remove('errore');
    } else {
        document.querySelector('#errore_mail').textContent = "Email già utilizzata";
        document.querySelector('#yt_email').classList.add('errore');
    }
}

function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
}

function checkUsername() {
    const input = document.querySelector('#yt_username');

    if(!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)) {
       document.querySelector('#errore_user').textContent = "Sono ammesse lettere, numeri e underscore. Max. 15";
        input.classList.add('errore');
        formStatus.username = false;

    } else {
        fetch("check_username.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(jsonCheckUsername);
    }    
}

function checkEmail() {
    const emailInput = document.querySelector('#yt_email');
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(emailInput.value).toLowerCase())) {
        document.querySelector('#errore_mail').textContent = "Email non valida";
        document.querySelector('#yt_email').classList.add('errore');
        formStatus.email = false;

    } else {
        fetch("check_email.php?q="+encodeURIComponent(String(emailInput.value).toLowerCase())).then(fetchResponse).then(jsonCheckEmail);
    }
}

function checkPassword() {
    const passwordInput = document.querySelector('#yt_password');
    if (formStatus.password = passwordInput.value.length >= 8) {
        document.querySelector('#yt_password').classList.remove('errore');
    } else {
        document.querySelector('#yt_password').classList.add('errore');
    }

}

function checkConfirmPassword() {
    const confirmPasswordInput = document.querySelector('#yt_confirm_password');
    if (formStatus.confirmPassord = confirmPasswordInput.value === document.querySelector('#yt_confirm_password').value) {
        document.querySelector('#yt_confirm_password').classList.remove('errore');
    } else {
        document.querySelector('#yt_confirm_password').classList.add('errore');
    }
}




function checkSignup(event) {
    const checkbox = document.querySelector('#yt_allow');
    formStatus[checkbox.name] = checkbox.checked;
    if (Object.keys(formStatus).length !== 8 || Object.values(formStatus).includes(false)) {
        event.preventDefault();
    }
}

const formStatus = {'upload': true};
document.querySelector('#yt_firstname').addEventListener('blur', checkName);
document.querySelector('#yt_lastname').addEventListener('blur', checkSurname);
document.querySelector('#yt_username').addEventListener('blur', checkUsername);
document.querySelector('#yt_email').addEventListener('blur', checkEmail);
document.querySelector('#yt_password').addEventListener('blur', checkPassword);
document.querySelector('#yt_confirm_password').addEventListener('blur', checkConfirmPassword);
document.querySelector('form').addEventListener('submit', checkSignup);
