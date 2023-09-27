<?php

class Libro
{  
    private $conn;
    private $table_name = "libri";
    // proprietà di un libro
    public $id;
    public $titolo;
    public $autore;
    public $anno_pubblicazione;
    public $scadenza;
    public $categoria;
    // costruttore
    public function __construct($db)
    {
        $this->conn = $db;
    }

    
  
    // READ libri
    function read() {
        $query = "SELECT titolo, autore, anno_pubblicazione, scadenza, categoria FROM " . $this->table_name;
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        } catch(PDOException $e) {
            echo "Errore durante la query: " . $e->getMessage();
        }
    }

    function create() {
        $query = "INSERT INTO " . $this->table_name . " (titolo, autore, anno_pubblicazione, scadenza, categoria) VALUES (:titolo, :autore, :anno_pubblicazione, :scadenza, :categoria)";
        
        try {
            $stmt = $this->conn->prepare($query);
        
            $stmt->bindParam(":titolo", $this->titolo);
            $stmt->bindParam(":autore", $this->autore);
            $stmt->bindParam(":anno_pubblicazione", $this->anno_pubblicazione);
            $stmt->bindParam(":scadenza", $this->scadenza);
            $stmt->bindParam(":categoria", $this->categoria);
            
            if ($stmt->execute()) {
                return true;
            }
            
            return false;
        } catch (PDOException $e) {
            echo "Errore durante la creazione del libro: " . $e->getMessage();
            return false;
        }
    }
    

    public function update() {
        // Verifica che l'ID del libro sia stato impostato
        if (!$this->id) {
            return false;
        }
    
        // Crea la query di aggiornamento
        $query = "UPDATE " . $this->table_name . "
                  SET titolo = :titolo, autore = :autore, anno_pubblicazione = :anno_pubblicazione, scadenza = :scadenza, categoria = :categoria
                  WHERE id = :id";
    
        try {
            // Prepara la query
            $stmt = $this->conn->prepare($query);
    
            // Associa i parametri
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":titolo", $this->titolo);
            $stmt->bindParam(":autore", $this->autore);
            $stmt->bindParam(":anno_pubblicazione", $this->anno_pubblicazione);
            $stmt->bindParam(":scadenza", $this->scadenza);
            $stmt->bindParam(":categoria", $this->categoria);
    
            // Esegui la query di aggiornamento
            if ($stmt->execute()) {
                return true;
            }
    
            return false;
        } catch (PDOException $e) {
            echo "Errore durante l'aggiornamento del libro: " . $e->getMessage();
            return false;
        }
    }
    
    
    

    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $this->id);
            
            if ($stmt->execute()) {
                return true;
            }
            
            return false;
        } catch (PDOException $e) {
            echo "Errore durante l'eliminazione del libro: " . $e->getMessage();
            return false;
        }
    }
    
     
    
}




?>











