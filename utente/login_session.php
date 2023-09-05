<?php
session_start(); 

if (isset($_POST["email"]) && isset($_POST["password"])) {
    
    $email = $_POST["email"];
    $password = $_POST["password"];

    
    $host = "localhost";
    $db_name = "libreria";
    $username_db = "root";
    $password_db = "rootroot";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db_name", $username_db, $password_db);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $query = "SELECT id, password FROM utenti WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashed_password = $row["password"];
            
            
            if (password_verify($password, $hashed_password)) {
                $_SESSION["user_id"] = $row["id"];
                header("Location: ../homepage2.php"); 
                exit();
            } else {
                echo "Password errata. Riprova.";
            }
        } else {
            echo "Utente non trovato. Riprova.";
        }
    } catch (PDOException $e) {
        echo "Errore di connessione al database: " . $e->getMessage();
    }
}
?>



