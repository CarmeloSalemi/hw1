<?php
require_once 'auth.php';
if (!$userid=checkAuth()) {
    header('Location: login.php');
    exit();
}
if(!empty($_POST["new_foto"])) {
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    $userid = mysqli_real_escape_string($conn, $userid);
    $query = "SELECT * FROM profilo WHERE id = '$userid'";

    $res = mysqli_query($conn, $query);

    $pfp = $_POST["new_foto"];

    $pfp = mysqli_real_escape_string($conn, $pfp);

    if (mysqli_num_rows($res)>0){
         $query1 = "UPDATE profilo SET immagine = '$pfp' WHERE id = '$userid'";
        $res1 = mysqli_query($conn, $query1);
    }

    mysqli_close($conn);
}
?>

<html>
    <head>
        <title>Foto Profilo</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="home.css">
        <link rel="stylesheet" href="foto_profilo.css">
        <script src="foto_profilo.js" defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="Immagini/logo1.png">
    </head>

    <body>
        <nav id="navbar">
            <img src="Immagini/logo.png" class="logo">
            <a href="home.php" class="navitem">Home</a>
            <a href class="navitem">Esplora</a>
            <a href class="navitem">Raccolta</a>
            <a href class="navitem">Upgrade</a>

                <div class="profilo-container">
                <img class="profilo" />
                </div>

        </nav>

        <div id="contenitore">
            <form name="scegli_pfp" action="" method="POST" id="pfp_popup">
          <div id="pfp_popup_content">
            <h2>Modifica Foto Profilo</h2>
            <p>Scegli una nuova foto per il tuo profilo.</p>
            <div id="slideshow_container">
                <input type="hidden" name="new_foto" id="new_foto">
              <button class="arrow prev">&#10094;</button>
              <div id="slide">
                <img>
              </div>              
              <button class="arrow next">&#10095;</button>
            </div>
            <button type="submit" class="button">Salva immagine</button>
          </div>
        </form>
        </div>

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
    </body>

</html>