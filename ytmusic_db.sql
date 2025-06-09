CREATE DATABASE IF NOT EXISTS ytmusic_db;
USE ytmusic_db;


CREATE TABLE IF NOT EXISTS ytm_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(50) NOT NULL,
    surname VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS commento (
		ID_commento INTEGER AUTO_INCREMENT PRIMARY KEY,
		ID_utente INTEGER,
		data_commento DATETIME DEFAULT CURRENT_TIMESTAMP,
		commento VARCHAR(500),
		FOREIGN KEY (ID_utente) REFERENCES ytm_users(id)
);


CREATE TABLE IF NOT EXISTS profilo (
	id INT AUTO_INCREMENT PRIMARY KEY,
	immagine VARCHAR(255),
	ID_utente INTEGER REFERENCES ytm_users(id)
);


CREATE TABLE IF NOT EXISTS images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    url VARCHAR(255) NOT NULL,
    nome_artista VARCHAR(255) NOT NULL,
    ID_utente INTEGER REFERENCES ytm_users(id)
);


CREATE TABLE IF NOT EXISTS albums (
    id INT AUTO_INCREMENT PRIMARY KEY,
    url_copertina VARCHAR(255) NOT NULL,
    titolo VARCHAR(100) NOT NULL,
    artista VARCHAR(100) NOT NULL,
    nome_reale VARCHAR(100),
    genere VARCHAR(100),
    etichetta VARCHAR(100),
    distribuzione VARCHAR(100),
    anno YEAR,
    descrizione TEXT,
    user_id INT NOT NULL,
    images_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES ytm_users(id),
    FOREIGN KEY (images_id) REFERENCES images(id)
);


CREATE TABLE IF NOT EXISTS tracks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    album_id INT NOT NULL,
    url_traccia_icon VARCHAR(255),
    numero INT NOT NULL,
    titolo VARCHAR(255) NOT NULL,
    FOREIGN KEY (album_id) REFERENCES albums(id) 
);


INSERT INTO albums (
	 url_copertina,
    titolo,
    artista,
    nome_reale,
    genere,
    etichetta,
    distribuzione,
    anno,
    descrizione,
    user_id, 
    images_id
) VALUES (
	 'Immagini/NeverAgain.png', 
    'Never Again',
    'Briga',
    'Mattia Bellegrandi',
    'Pop rap, urban',
    'Honiro Label',
    'Universal Music Group',
    2015,
    'Never Again segna un\'evoluzione nel sound di Briga, con un approccio più melodico rispetto ai precedenti lavori. L\'album è caratterizzato da testi introspettivi e collaborazioni con artisti di rilievo della scena musicale italiana e internazionale.',
    2, 1
);


INSERT INTO tracks (album_id, url_traccia_icon, numero, titolo) VALUES
(1, 'Immagini/Briga.png', 1, 'Never Again'),
(1, 'Immagini/Briga.png', 2, 'Giunto alla linea (Indietro) - feat. Tiziano Ferro'),
(1, 'Immagini/Briga.png', 3, 'Talento de Barrio - feat. Elio Toffana & Kompayde'),
(1, 'Immagini/Briga.png', 4, 'L\'amore è qua'),
(1, 'Immagini/Briga.png', 5, 'Nessuna è più bella di te (con Gemello)'),
(1, 'Immagini/Briga.png', 6, 'Non più una bugia'),
(1, 'Immagini/Briga.png', 7, 'Sei di mattina (Acoustic Version)'),
(1, 'Immagini/Briga.png', 8, 'Tu'),
(1, 'Immagini/Briga.png', 9, 'Le stesse molecole'),
(1, 'Immagini/Briga.png', 10, 'L\'amo (con Primo & Martina May)'),
(1, 'Immagini/Briga.png', 11, 'Naufrago'),
(1, 'Immagini/Briga.png', 12, 'Dicembre Roma'),
(1, 'Immagini/Briga.png', 13, 'Esistendo'),
(1, 'Immagini/Briga.png', 14, 'Tu (Piano Edit) (con Enzo Campagnoli)');


