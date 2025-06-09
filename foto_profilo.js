// Cambio foto profilo
const PFP_LIST = [ // Lista di avatar disponibili
    'Immagini/profilo.png',
    'Immagini/profilo1.jpg',
    'Immagini/profilo2.png',
    'Immagini/profilo3.png',
    'Immagini/profilo4.png',
    'Immagini/profilo5.png',
    'Immagini/default.jpg'
]

const avatarPopup = document.querySelector('#pfp_popup');
const img = avatarPopup.querySelector('#slide img');
const hiddenInput = document.querySelector('#new_foto');

const prev = avatarPopup.querySelector('.prev');
const next = avatarPopup.querySelector('.next');

img.src = PFP_LIST[0]; // Imposta il primo avatar come predefinito
hiddenInput.value = PFP_LIST[0]; // Imposta il valore dell'input nascosto

function nextPfp(event) {
    event.preventDefault(); // Previene il comportamento predefinito del link
    let newIndex;
    for(let i = 0; i < PFP_LIST.length; i++)
    {
        if (img.src.includes(PFP_LIST[i])) {
            if( i === PFP_LIST.length - 1) {
                newIndex = 0; // Torna al primo avatar
            }
            else {
                newIndex = i + 1; // Passa al prossimo avatar
            }
        }
    }
    img.src = PFP_LIST[newIndex];
    hiddenInput.value = PFP_LIST[newIndex]; // Aggiorna il valore dell'input nascosto
}

function prevPfp(event) {
    event.preventDefault();
    let newIndex;
    for(let i = 0; i < PFP_LIST.length; i++)
    {
        if (img.src.includes(PFP_LIST[i])) {
            if( i === 0) {
                newIndex = PFP_LIST.length - 1; // Torna all'ultimo avatar
            }
            else {
                newIndex = i - 1; // Torna al precedente avatar
            }
        }
    }
    img.src = PFP_LIST[newIndex];
    hiddenInput.value = PFP_LIST[newIndex]; // Aggiorna il valore dell'input nascosto
}

prev.addEventListener('click', prevPfp);
next.addEventListener('click', nextPfp);

//* Sezione caricamento foto profilo
const avatar = document.querySelector('.profilo-container');
const foto= document.querySelector('.profilo-container img');

// Funzione per aggiornare l'immagine del profilo
function onJSONPfp(json) {
    if(json.pfp){
        foto.src= json.pfp;
    }
}

function onResponsePfp(response) {
    if (!response.ok) return null;
    return response.json();
}


fetch('get_profilo.php').then(onResponsePfp).then(onJSONPfp);

function vai_profilo() {
    window.location.href = "foto_profilo.php";
}

avatar.addEventListener('click', vai_profilo);