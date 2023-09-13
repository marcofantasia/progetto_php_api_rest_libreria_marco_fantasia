<?php
// Inizia o riprendi una sessione
session_start();

// Distruggi la sessione corrente
session_destroy();

// Reindirizza l'utente a una pagina di login o ad altra pagina
header("Location: homepage.php"); // Cambia "login.php" con la tua pagina di login
exit();
?>
