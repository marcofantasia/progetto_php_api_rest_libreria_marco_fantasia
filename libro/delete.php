<?php


$id = $_GET['id']; 


try {
    $pdo = new PDO('mysql:host=localhost;dbname=libreria', 'root', 'rootroot');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "DELETE FROM libri WHERE id = :id";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        http_response_code(204); 
    } else {
        http_response_code(500); 
        echo json_encode(['message' => 'Errore durante l\'eliminazione del libro']);
    }
} catch (PDOException $e) {
    http_response_code(500); 
    echo json_encode(['message' => 'Errore nel database: ' . $e->getMessage()]);
}
?>
