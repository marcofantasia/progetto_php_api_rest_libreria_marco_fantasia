<?php

include_once '../config/database.php';
include_once '../models/utente.php';



$database = new Database();
$db = $database->getConnection();

$libro = new Utente($db);

if (isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Connessione al database (modifica le credenziali di connessione)
    $host = "localhost";
    $db_name = "libreria";
    $username_db = "root";
    $password_db = "rootroot";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db_name", $username_db, $password_db);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verifica se l'username o l'email esistono già nel database
        $query = "SELECT * FROM utenti WHERE email = :email OR password = :password";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // L'username o l'email esistono già
            echo "Username o email già esistenti.";
        } else {
            // L'username e l'email sono unici, procedi con l'inserimento
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $insert_query = "INSERT INTO utenti (nome, cognome, email, password) VALUES (:nome, :cognome, :email, :password)";
            $insert_stmt = $conn->prepare($insert_query);
            $insert_stmt->bindParam(":nome", $nome);
            $insert_stmt->bindParam(":cognome", $cognome);
            $insert_stmt->bindParam(":email", $email);
            $insert_stmt->bindParam(":password", $hashed_password);

            if ($insert_stmt->execute()) {
                // Registrazione completata con successo
                echo "Registrazione completata con successo!";
                header("Location: ../homepage.php");
            } else {
                echo "Errore durante la registrazione.";
            }
        }
    } catch (PDOException $e) {
        echo "Errore di connessione al database: " . $e->getMessage();
    }
}
?>

