<?php
class Utente
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Metodo per la registrazione dell'utente
    public function register($nome, $cognome, $email, $password)
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO utenti (nome, cognome, email, password) VALUES (:nome, :cognome, :email, :password)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":cognome", $cognome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $hashed_password);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Metodo per il login dell'utente
    public function login($email, $password)
    {
        $query = "SELECT id, nome, password FROM utenti WHERE email = :email";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0) {
            $id = $row['id'];
            $nome = $row['nome'];
            $hashed_password = $row['password'];

            if (password_verify($password, $hashed_password)) {
                return array("id" => $id, "nome" => $nome);
            } else {
                return false; // Password non corretta
            }
        } else {
            return false; // Utente non trovato
        }
    }

    // Metodo per il logout dell'utente
    public function logout()
    {
        session_start();
        session_destroy();
    }
}
?>
