<?php


$id = $_GET['id']; 

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if ($data === null) {
    http_response_code(400);
    echo json_encode(['message' => 'Dati JSON non validi']);
    exit();
}


try {
    $pdo = new PDO('mysql:host=localhost;dbname=libreria', 'root', 'rootroot');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "UPDATE libri SET titolo = :titolo, autore = :autore, anno_pubblicazione = :anno_pubblicazione, scadenza = :scadenza, categoria = :categoria WHERE id = :id";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(':titolo', $data['titolo']);
    $stmt->bindParam(':autore', $data['autore']);
    $stmt->bindParam(':anno_pubblicazione', $data['anno_pubblicazione']);
    $stmt->bindParam(':scadenza', $data['scadenza']);
    $stmt->bindParam(':categoria', $data['categoria']);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        http_response_code(200); 
        echo json_encode(['message' => 'Libro aggiornato con successo']);
    } else {
        http_response_code(500); 
        echo json_encode(['message' => 'Errore durante l\'aggiornamento del libro']);
    }
} catch (PDOException $e) {
    http_response_code(500); 
    echo json_encode(['message' => 'Errore nel database: ' . $e->getMessage()]);
}
?>
