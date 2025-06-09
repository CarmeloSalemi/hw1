document.addEventListener('DOMContentLoaded', () => {
    // Recupera l'album_id dalla URL
    const params = new URLSearchParams(window.location.search);
    const albumId = params.get('id');

    if (!albumId) {
        document.querySelector('.album-info').innerText = 'Album non trovato.';
        return;
    }

    // Richiama get_album.php passando album_id
    fetch(`get_album_data.php?album_id=${albumId}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                document.getElementById('album-info').innerText = data.error;
                return;
            }

            // Visualizza le informazioni dell'album
            displayAlbumInfo(data.album);

            // Visualizza la tracklist
            displayTracklist(data.tracks);
        })
        .catch(error => {
            console.error('Errore:', error);
            document.getElementById('album-info').innerText = 'Errore nel caricamento dell\'album.';
        });
});

function displayAlbumInfo(album) {
    const albumInfoDiv = document.querySelector('.album-info');
    albumInfoDiv.innerHTML = ''; // Pulisce il contenuto precedente
    albumInfoDiv.innerHTML = `
        <img src="${album.url_copertina}">
        <h2>${album.titolo}</h2>
        <p><strong>Artista:</strong> ${album.artista}</p>
        <p><strong>Nome reale:</strong> ${album.nome_reale}</p>
        <p><strong>Genere:</strong> ${album.genere}</p>
        <p><strong>Etichetta:</strong> ${album.etichetta}</p>
        <p><strong>Distribuzione:</strong> ${album.distribuzione}</p>
        <p><strong>Anno:</strong> ${album.anno}</p></br>
        <p><strong>Descrizione:</strong> ${album.descrizione}</p>
    `;
}

function displayTracklist(tracks) {
    const tracklistDiv = document.querySelector('.tracklist');

    if (tracks.length === 0) {
        tracklistDiv.innerHTML += '<p>Nessuna traccia disponibile.</p>';
        return;
    }

    tracks.forEach(track => {
        const trackDiv = document.createElement('div');
        trackDiv.classList.add('track');

        trackDiv.innerHTML = `
            <img src="${track.url_traccia_icon}">
            <span><strong>${track.numero}.</strong> ${track.titolo}</span>
        `;

        tracklistDiv.appendChild(trackDiv);
    }); 
}
