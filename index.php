
<?php

include_once 'config/database.php';
include_once 'models/libro.php';




$database = new Database();


$db = $database->getConnection();


$endpoint = $_GET['endpoint'] ?? '';



function read($db) {
    $query = "SELECT * FROM libri";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
}

function create($db) {
    
    $data = json_decode(file_get_contents("php://input"));

    
    $query = "INSERT INTO libri (titolo, autore, anno_pubblicazione, scadenza) VALUES (:titolo, :autore, :anno_pubblicazione, :scadenza)";
    $stmt = $db->prepare($query);

    
    $stmt->bindParam(":titolo", $data->titolo);
    $stmt->bindParam(":autore", $data->autore);
    $stmt->bindParam(":anno_pubblicazione", $data->anno_pubblicazione);
    $stmt->bindParam(":scadenza", $data->scadenza);

    if ($stmt->execute()) {
        echo json_encode(array("message" => "Libro creato con successo."));
    } else {
        echo json_encode(array("message" => "Errore durante la creazione del libro."));
    }
}

function update($db) {
   
    $id = $_GET['id'] ?? null;

    if (!$id) {
        http_response_code(400);
        echo json_encode(array("message" => "ID del libro mancante."));
        return;
    }

  
    $data = json_decode(file_get_contents("php://input"));

    if (!$data) {
        http_response_code(400);
        echo json_encode(array("message" => "Dati di aggiornamento mancanti o non validi."));
        return;
    }

    
    $query = "UPDATE libri SET titolo = :titolo, autore = :autore, anno_pubblicazione = :anno_pubblicazione, scadenza = :scadenza WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":titolo", $data->titolo);
    $stmt->bindParam(":autore", $data->autore);
    $stmt->bindParam(":anno_pubblicazione", $data->anno_pubblicazione);
    $stmt->bindParam(":scadenza", $data->scadenza);

    if ($stmt->execute()) {
        echo json_encode(array("message" => "Libro aggiornato con successo."));
    } else {
        echo json_encode(array("message" => "Errore durante l'aggiornamento del libro."));
    }
}


function delete($db) {
    
    $id = $_GET['id'] ?? null;

    if (!$id) {
        http_response_code(400);
        echo json_encode(array("message" => "ID del libro mancante."));
        return;
    }

    $query = "DELETE FROM libri WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":id", $id);

    if ($stmt->execute()) {
        echo json_encode(array("message" => "Libro eliminato con successo."));
    } else {
        echo json_encode(array("message" => "Errore durante l'eliminazione del libro."));
    }
}


$apiFunctions = [
    'read' => 'read',
    'create' => 'create',
    'update' => 'update',
    'delete' => 'delete'
];

if (isset($apiFunctions[$endpoint])) {
    
    $apiFunction = $apiFunctions[$endpoint];
    $apiFunction($db);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Endpoint non trovato."));
    exit;
}






?>






















