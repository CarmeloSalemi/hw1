<?php
require_once 'auth.php';

if (!$userid = checkAuth()) {
    header('Location: login.php');
    exit();
}

header('Content-Type: application/json');

// Controllo parametro album_id
if (!isset($_GET['album_id'])) {
    echo json_encode(['error' => 'Missing album_id']);
    exit();
}

$album_id = intval($_GET['album_id']);

// Connessione al database
$conn = mysqli_connect(
    $dbconfig['host'],
    $dbconfig['user'],
    $dbconfig['password'],
    $dbconfig['name']
);

// Query album
$query_album = "SELECT * FROM albums WHERE images_id='$album_id'";

$res_album = mysqli_query($conn, $query_album);

if (!$res_album || mysqli_num_rows($res_album) === 0) {
    echo json_encode(['error' => 'Album not found or access denied']);
    mysqli_close($conn);
    exit();
}

$album = mysqli_fetch_assoc($res_album);
$id = $album['id'];

// Query tracce per l'album
$query_tracks = "
    SELECT * FROM tracks WHERE album_id = '$id'";

$res_tracks = mysqli_query($conn, $query_tracks);

$tracks = [];
while ($row = mysqli_fetch_assoc($res_tracks)) {
    $tracks[] = $row;
}

// Costruisci risposta
$response = [
    'album' => $album,
    'tracks' => $tracks
];

// Output JSON
echo json_encode($response);

// Pulizia
mysqli_free_result($res_album);
mysqli_free_result($res_tracks);
mysqli_close($conn);
?>
