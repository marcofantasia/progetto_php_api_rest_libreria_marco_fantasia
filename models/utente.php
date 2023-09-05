<?php
class Utente {
    private $conn;
    private $table_name = "utenti";

    public $id;
    public $nome;
    public $cognome;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    
    function registrazione() {
        $query = "INSERT INTO " . $this->table_name . " (nome, cognome, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        
        $hashed_password = password_hash($this->password, PASSWORD_BCRYPT);

        
        $stmt->bindParam(1, $this->email);
        $stmt->bindParam(2, $hashed_password);
        $stmt->bindParam(3, $this->email);

        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    
    function login() {
        $query = "SELECT id, nome, cognome, email, password FROM " . $this->table_name . " WHERE email = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);

        
        $stmt->bindParam(1, $this->email);
        
       
        $stmt->execute();

      
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row && password_verify($this->password, $row['password'])) {
           
            session_start();
            $_SESSION['user_id'] = $row['id'];
            return true;
        } else {
            return false;
        }
    }

    
    function logout() {
        
        session_start();
        session_destroy();
        return true;
    }
}
?>
