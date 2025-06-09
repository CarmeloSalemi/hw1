<?php
require_once 'auth.php';
if (!$userid=checkAuth()) {
    header('Location: login.php');
    exit();
}

if(!$_SERVER["REQUEST_METHOD"] === "POST") {
    header('Location: home.php');
    exit();
}

$connDB= mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
$userid = mysqli_real_escape_string($connDB, $userid);
$commento = mysqli_real_escape_string($connDB, $_POST['commento']);

$query = "INSERT into commento (ID_utente, commento) VALUES ('$userid', '$commento')";
$result = mysqli_query($connDB, $query);
mysqli_close($connDB);
header('Location: home.php');
exit();
?>