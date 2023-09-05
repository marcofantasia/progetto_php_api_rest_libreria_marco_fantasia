<?php

include_once 'utente.php';


$utente = new Utente(null);


if ($utente->logout()) {
    echo json_encode(array("message" => "Logout effettuato con successo."));
} else {
    echo json_encode(array("message" => "Errore durante il logout."));
}
?>
