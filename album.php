<?php
require_once 'auth.php';
if (!$userid = checkAuth()) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Album</title>
  <link rel="stylesheet" href="album.css">
  <script src="album.js" defer></script>
  <link rel="icon" type="image/png" href="Immagini/logo1.png">
</head>
<body>

<nav>
    <h1 id="album-title">Ascolta qui il tuo album</h1>
    <a href="home.php">
      <img src="Immagini/home-icon.png" class="home-icon">
    </a>
</nav>

<section>
  <div class="album-info">
  </div>

  <div class="tracklist">
  </div>
</section>

<footer>
 © 2025 YouTube Music. Tutti i diritti riservati.
</footer>

</body>
</html>
