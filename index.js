// Funzione per creare le immagini nella vista album
function createImage(src) {
    const image = document.createElement('img');
    image.src = src;
    image.alt = "Cover album"; 
    return image;
}

const PHOTO_LIST = [
    'Immagini/Piccolo.png', 'Immagini/Battito.png','Immagini/Lentamente.png', 'Immagini/Alibi.png', 'Immagini/VolevoEssereUnDuro.png', 'Immagini/Autodistruzione.png',
     'Immagini/TanaDelGranchio.png',  'Immagini/Amarcord.png', 'Immagini/VieniConMe.png', 'Immagini/NextSummer.png', 'Immagini/RadioSakura.png',  
];

const albumView = document.querySelector('#album-view');
PHOTO_LIST.forEach(photoSrc => {
    const image = createImage(photoSrc);
    image.addEventListener('click', onThumbnailClick);
    albumView.appendChild(image);
});

// Funzione per visualizzare l'immagine in un modal
function onThumbnailClick(event) {
    const modalView = document.querySelector('#modal-view');
    const image = createImage(event.currentTarget.src);
    document.body.classList.add('no-scroll');
    modalView.style.top = window.scrollY + 'px';
    modalView.appendChild(image);
    modalView.classList.remove('hidden');
    document.addEventListener('keydown', scroll);
}

// Funzione per chiudere il modal
function onModalClick() {
    const modalView = document.querySelector('#modal-view');
    document.body.classList.remove('no-scroll');
    modalView.classList.add('hidden');
    modalView.innerHTML = ''; // Pulisce il modal
    document.removeEventListener('keydown', scroll);
}

document.querySelector('#modal-view').addEventListener('click', onModalClick);

// Funzione per navigare tra le immagini nel modal
function scroll(event) {
    const modalView = document.querySelector('#modal-view');
    const image = modalView.querySelector('img');
    let index;
    for (let i = 0; i < PHOTO_LIST.length; i++) {
        if (image.src.includes(PHOTO_LIST[i])) {
            switch (event.key) {
                case 'ArrowRight':
                    index = (i === PHOTO_LIST.length - 1) ? 0 : i + 1;
                    break;
                case 'ArrowLeft':
                    index = (i === 0) ? PHOTO_LIST.length - 1 : i - 1;
                    break;
            }
        }
    }
    image.src = PHOTO_LIST[index];
}