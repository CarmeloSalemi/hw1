<?php
require_once 'auth.php';
if (!$userid=checkAuth()) {
    header('Location: login.php');
    exit();
}
?>

<html>
    <head>
        <title>Youtube Music - Home</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="home.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="home.js" defer></script>
        <link rel="icon" type="image/png" href="Immagini/logo1.png">
    </head>

    <body>
        <div id="sidebar">
            <h2 class="sidebar-item-">Playlist consigliate</h2>
            <div class="sidebar-item">Autunno🍂🌰</div>
            <div class="sidebar-item">Amore🌹🌌</div>
            <div class="sidebar-item">Inverno🌃❄️</div>
            <div class="sidebar-item">Motivazione🔥💪</div>
        </br>
        </br>
            <h2 class="sidebar-item-">Canali consigliati</h2>
            <div class="sidebar-item">Gemitaiz🔴</div>
            <div class="sidebar-item">Amici🔴</div>
            <div class="sidebar-item">Briga🔴</div>
            <div class="sidebar-item">Irama🔴</div>
            <div id="loghetto"></div>

            <a href="logout.php" id="Logout">Logout</a>

        </div>
        
        <div id="main-content">
        <nav id="navbar">
            <img src="Immagini/logo.png" class="logo">
            <a href class="navitem">Home</a>
            <a href class="navitem">Esplora</a>
            <a href class="navitem">Raccolta</a>
            <a href class="navitem">Upgrade</a>

            <form id="barra">
                <input type="text" class="navitem" placeholder="Cerca...">
                <button type="submit"><img src="Immagini/lente.png" id="lente"></button>
            </form>

                <div class="profilo-container">
                <img class="profilo" />
                </div>

        </nav>

        <section id="cercato"></section>
  
            <h1 id="uscite">Ultime uscite</h1>
            <section id="album-view">

            </section>

            <section id="modal-view" class="hidden">

            </section>

        <header id="header">
            <h1 id="titolo">Ascolta qui</h1>
            <h2 id="sottotitolo">Sempre nuova musica in arrivo per te</h2>
        </header>

        <section id="section">
                <div class="card">
                    <img src="Immagini/music1.png" data-info="Mama (Gemitaiz)">
                    <a href="Audio/song1.mp3" class="overlay">Riproduci</a>
                    <button class="lyrics-btn" data-artist="Gemitaiz" data-title="Mama">Mostra Testo</button>
                </div>
                <section id="modal-view1" class="hidden1"></section>
                
                <div class="card">
                    <img src="Immagini/music2.png" data-info="Sole a mezzanotte (Gio Montana)">
                    <a href="Audio/song2.mp3" class="overlay">Riproduci</a>
                    <button class="lyrics-btn" data-artist="Gio Montana" data-title="Sole a mezzanotte">Mostra Testo</button>
                </div>

                <div class="card">
                    <img src="Immagini/music3.png" data-info="Nel male e nel bere (Briga)">
                    <a href="Audio/song3.mp3" class="overlay">Riproduci</a>
                    <button class="lyrics-btn" data-artist="Briga" data-title="Nel male e nel bere">Mostra Testo</button>
                </div>
        </section>

        <header id="header1">
            <h1 id="titolo1">Album Consigliati</h1>
        </header>
        
        <section id="album">
        </section>

    <header id="header2">
        <h1 id="titolo2">Abbonamenti</h1>
    </header>

    <section id="abbonamenti">
        <div class="abbonamento">
            <h2>Basic</h2>
        </br>
            <p>0€ per 1 mese</p></br>
            <p>Dopo 10,99€ al mese</p></br>
            <p>Ascolta musica senza limiti</p></br>
            <p>Ascolta musica senza pubblicità</p></br>
            <button>Inizia la prova gratuita</button>
        </div>

        <div class="abbonamento">
            <h2>Student</h2>
        </br>
            <p>0€ per 1 mese</p></br>
            <p>Dopo 5,99€ al mese</p></br>
            <p>Ascolta musica senza limiti</p></br>
            <p>Ascolta musica senza pubblicità</p></br>
            <button>Inizia la prova gratuita</button>
        </div>

        <div class="abbonamento">
            <h2>Family (5 Account)</h2>
        </br>
            <p>0€ per 1 mese</p></br>
            <p>Dopo 17,99€ al mese</p></br>
            <p>Ascolta musica senza limiti</p></br>
            <p>Ascolta musica senza pubblicità</p></br>
            <button>Inizia la prova gratuita</button>
        </div>
    </section>

        <footer id="footer">

            <form id="commento" name="box_commento" action="commento.php" method="post">
                <textarea placeholder="Lascia un commento..." maxlength="500" name="commento"></textarea>
                <button type="submit">Invia</button>
            </form>

        </footer>
        
        <footer id="footer_mobile">
            <a href class="item">Home</a>
            <a href class="item">Esplora</a>
            <a href class="item">Raccolta</a>
            <a href class="item">Upgrade</a>
        </footer>
    </div>
    </body>
</html>


