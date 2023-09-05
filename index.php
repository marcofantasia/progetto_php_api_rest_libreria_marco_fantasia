
<?php
// Includi la classe Database
include_once 'config/database.php';
include_once 'models/libro.php';



// Istanzia la classe Database
$database = new Database();

// Ottieni una connessione al database
$db = $database->getConnection();

// Ottieni l'endpoint richiesto dalla URL
$endpoint = $_GET['endpoint'] ?? '';

// Definisci le funzioni API

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
    
    $data = json_decode(file_get_contents("php://input"));

  
    $query = "UPDATE libri SET titolo = :titolo, autore = :autore, anno_pubblicazione = :anno_pubblicazione, scadenza = :scadenza WHERE id = :id";
    $stmt = $db->prepare($query);

    // Associa i valori dei parametri
    $stmt->bindParam(":id", $data->id);
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
    // Leggi l'ID del libro da eliminare dalla richiesta DELETE
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

// Associa gli endpoint alle funzioni API
$apiFunctions = [
    'read' => 'read',
    'create' => 'create',
    'update' => 'update',
    'delete' => 'delete'
];

// Verifica se l'endpoint richiesto è valido
if (isset($apiFunctions[$endpoint])) {
    // Chiama la funzione API corrispondente
    $apiFunction = $apiFunctions[$endpoint];
    $apiFunction($db);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Endpoint non trovato."));
    exit;
}


// Includi il file di configurazione (config.php)


// Controlla il percorso della richiesta

?>






















