<?php
/********************************************************
   Controlla che l'utente sia gia' autenticato, per non 
   dover chiedere il login ogni volta                   
*********************************************************/
require_once 'dbconfig.php';
session_start();

function checkAuth() {
    // Se esiste gia' una sessione valida, restituisce l'ID utente, altrimenti 0
    if (isset($_SESSION['ytmusic_user_id'])) {
        return $_SESSION['ytmusic_user_id'];
    } else {
        return 0;
    }
}
?>
