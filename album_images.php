<?php
require_once 'auth.php';

if (!$userid = checkAuth()) {
    header('Location: login.php');
    exit();
}

header('Content-Type: application/json');

// Connessione al database
$conn = mysqli_connect(
    $dbconfig['host'],
    $dbconfig['user'],
    $dbconfig['password'],
    $dbconfig['name']
);

// Query per immagini dell'utente loggato
$query = "SELECT * FROM images WHERE ID_utente='$userid'";
$res = mysqli_query($conn, $query);

$copertine = [];

while ($row = mysqli_fetch_assoc($res)) {
    $copertine[] = $row;
}

echo json_encode($copertine);

mysqli_free_result($res);
mysqli_close($conn);
?>
