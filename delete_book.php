<?php
$host = "localhost";
$db_name = "libreria";
$username = "root";
$password = "rootroot";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Errore di connessione al database: " . $e->getMessage());
}


$id = $_GET["id"];


$delete_query = "DELETE FROM libri WHERE id = :id";

try {
    $stmt = $conn->prepare($delete_query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    header("Location: ../homepage.php");
    echo "Libro eliminato con successo!";
} catch (PDOException $e) {
    echo "Errore durante l'eliminazione del libro: " . $e->getMessage();
}
?>
