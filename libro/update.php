<?php
// update.php

$id = $_GET['id']; // Assicurati di validare e sanificare l'input.

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if ($data === null) {
    http_response_code(400); // Richiesta non valida
    echo json_encode(['message' => 'Dati JSON non validi']);
    exit();
}

// Connessione al database utilizzando PDO (sostituisci con la tua configurazione).
try {
    $pdo = new PDO('mysql:host=localhost;dbname=libreria', 'root', 'rootroot');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "UPDATE libri SET titolo = :titolo, autore = :autore, anno_pubblicazione = :anno_pubblicazione, scadenza = :scadenza WHERE id = :id";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(':titolo', $data['titolo']);
    $stmt->bindParam(':autore', $data['autore']);
    $stmt->bindParam(':anno_pubblicazione', $data['anno_pubblicazione']);
    $stmt->bindParam(':scadenza', $data['scadenza']);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        http_response_code(200); // Successo
        echo json_encode(['message' => 'Libro aggiornato con successo']);
    } else {
        http_response_code(500); // Errore del server
        echo json_encode(['message' => 'Errore durante l\'aggiornamento del libro']);
    }
} catch (PDOException $e) {
    http_response_code(500); // Errore del server
    echo json_encode(['message' => 'Errore nel database: ' . $e->getMessage()]);
}
?>
