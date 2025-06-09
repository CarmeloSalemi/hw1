// Funzione per creare le immagini nella vista album
function createImage(src) {
    const image = document.createElement('img');
    image.src = src;
    image.alt = "Cover album"; 
    return image;
}

// Caricamento immagini nell'album
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

document.querySelectorAll('.lyrics-btn').forEach(button => {
    button.addEventListener('click', async () => {
      const artist = button.getAttribute('data-artist');
      const title = button.getAttribute('data-title');
  
      try {
        const response = await fetch(`https://api.lyrics.ovh/v1/${artist}/${title}`);
        const data = await response.json();
  
        if (data.lyrics) {
          showLyrics(data.lyrics);
        } else {
          showLyrics('Testo non trovato');
        }
      } catch (error) {
        showLyrics('Errore nel caricare il testo.');
        console.error(error);
      }
    });
  });
  
  function showLyrics(lyrics) {
    const modal = document.getElementById('modal-view1');
    modal.innerHTML = `
      <button id="close-modal1">Chiudi</button>
      <pre>${lyrics}</pre>
    `;
    document.body.classList.add('no-scroll');
    modal.classList.remove('hidden1');

    document.getElementById('close-modal1').addEventListener('click', () => {
    document.body.classList.remove('no-scroll');
      modal.classList.add('hidden1');
    });
}


function onJson(json) {
  console.log('JSON ricevuto');
  // Svuotiamo la libreria
  const library = document.querySelector('#cercato');
  library.innerHTML = '';
  // Leggi il numero di risultati
  const results = json.albums.items;
  let num_results = results.length;
  // Mostriamone al massimo 10
  if(num_results > 10)
    num_results = 10;
  // Processa ciascun risultato
  for(let i=0; i<num_results; i++)
  {
    // Leggi il documento
    const album_data = results[i]
    // Leggiamo info
    const title = album_data.name;
    const selected_image = album_data.images[0].url;
    // Creiamo il div che conterrà immagine e didascalia
    const album = document.createElement('div');
    album.classList.add('albumcercato'); //Da implementare in CSS
    // Creiamo l'immagine
    const img = document.createElement('img');
    img.src = selected_image;
    // Creiamo la didascalia
    const caption = document.createElement('span');
    caption.textContent = title;
    // Aggiungiamo immagine e didascalia al div
    album.appendChild(img);
    album.appendChild(caption);
    // Aggiungiamo il div alla libreria
    library.appendChild(album);
  }
}

function onResponse(response) {
  console.log('Risposta ricevuta');
  return response.json();
}

function search(event)
{
  // Impedisci il submit del form
  event.preventDefault();
  // Leggi valore del campo di testo
  const album_input = document.querySelector('#barra input[type="text"]');
  const album_value = encodeURIComponent(album_input.value);
  console.log('Eseguo ricerca: ' + album_value);
  // Esegui la richiesta
  fetch("https://api.spotify.com/v1/search?type=album&q=" + album_value,
    {
      headers:
      {
        'Authorization': 'Bearer ' + token
      }
    }
  ).then(onResponse).then(onJson);
}

function onTokenJson(json)
{
  // Imposta il token global
  token = json.access_token;
}

function onTokenResponse(response)
{
  return response.json();
}

const client_id = 'secret'; //Inserire client_id ottenuta da Spotify
const client_secret = 'secret'; //Inserire client_secret ottenuta da Spotify
// Dichiara variabile token
let token;
// All'apertura della pagina, richiediamo il token
fetch("https://accounts.spotify.com/api/token",
	{
   method: "post",
   body: 'grant_type=client_credentials',
   headers:
   {
    'Content-Type': 'application/x-www-form-urlencoded',
    'Authorization': 'Basic ' + btoa(client_id + ':' + client_secret)
   }
  }
).then(onTokenResponse).then(onTokenJson);
// Aggiungi event listener al form
const form = document.querySelector('#barra');
form.addEventListener('submit', search)


// Funzione per aggiornare l'immagine del profilo
const avatar = document.querySelector('.profilo-container');
const foto = document.querySelector('.profilo-container img');
function onJSONPfp(json) {
    if(json.pfp){
        foto.src=json.pfp;
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


//Caricamento DINAMICO
document.addEventListener('DOMContentLoaded', () => {
    fetch('album_images.php')
        .then(response => {
            if (!response.ok) throw new Error("Errore nel caricamento copertine");
            return response.json();
        })
        .then(artists => {
            const albumSection = document.getElementById('album');
            albumSection.innerHTML = ''; // Pulisce l'area prima di riempirla

            if (artists.length === 0) {
                // Mostra un messaggio amichevole
                const msg = document.createElement('p');
                msg.textContent = "Non hai ancora album consigliati😕";
                
                const sugg = document.createElement('p');
                sugg.textContent = "Inizia ad ascoltare musica per ricevere suggerimenti personalizzati!🎧";

                msg.classList.add('no-albums-msg');
                sugg.classList.add('no-albums-sugg');

                albumSection.appendChild(msg);
                albumSection.appendChild(sugg);
                return;
            }

            artists.forEach(artist => {
                const container = document.createElement('div');
                container.classList.add('copertine');
                container.dataset.id= artist.id;
                container.addEventListener('click', onCopertinaClick);

                const img = document.createElement('img');
                img.src = artist.url;
                img.alt = artist.nome_artista;

                const p = document.createElement('p');
                p.classList.add('overlay');
                p.textContent = artist.nome_artista;

                container.appendChild(img);
                container.appendChild(p);
                albumSection.appendChild(container);
            });
        })
        .catch(error => {
            console.error('Errore caricamento copertine:', error);
        });
});


function onCopertinaClick(event) {
    const copertina = event.currentTarget;
    const albumId = copertina.dataset.id;

    // Reindirizza alla pagina dell'album con l'ID specificato
    window.location.href = `album.php?id=${albumId}`;
}