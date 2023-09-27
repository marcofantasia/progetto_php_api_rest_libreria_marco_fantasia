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


$drop_libri_table_query = "DROP TABLE IF EXISTS libri";

try {
    $conn->exec($drop_libri_table_query);
    echo "Tabella 'libri' eliminata (se esisteva).";
} catch (PDOException $e) {
    echo "Errore durante l'eliminazione della tabella 'libri': " . $e->getMessage();
}


$create_libri_table_query = "
    CREATE TABLE libri (
        id INT AUTO_INCREMENT PRIMARY KEY,
        titolo VARCHAR(255) NOT NULL,
        autore VARCHAR(255) NOT NULL,
        anno_pubblicazione INT NOT NULL
    )
";

try {
    $conn->exec($create_libri_table_query);
    echo "Tabella 'libri' creata con successo!";
} catch (PDOException $e) {
    echo "Errore durante la creazione della tabella 'libri': " . $e->getMessage();
}


$drop_utenti_table_query = "DROP TABLE IF EXISTS utenti";

try {
    $conn->exec($drop_utenti_table_query);
    echo "Tabella 'utenti' eliminata (se esisteva).";
} catch (PDOException $e) {
    echo "Errore durante l'eliminazione della tabella 'utenti': " . $e->getMessage();
}


$create_utenti_table_query = "
    CREATE TABLE utenti (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(255) NOT NULL,
        cognome VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    )
";

try {
    $conn->exec($create_utenti_table_query);
    echo "Tabella 'utenti' creata con successo!";
} catch (PDOException $e) {
    echo "Errore durante la creazione della tabella 'utenti': " . $e->getMessage();
}


$add_column_query = "ALTER TABLE libri ADD scadenza DATE";
try {
    $conn->exec($add_column_query);
    echo "Colonna 'scadenza' aggiunta con successo!";
} catch (PDOException $e) {
    echo "Errore durante l'aggiunta della colonna: " . $e->getMessage();
}

$add_column_query = "ALTER TABLE libri ADD COLUMN categoria VARCHAR(255)";
try {
    $conn->exec($add_column_query);
    echo "Colonna 'categoria' aggiunta con successo!";
} catch (PDOException $e) {
    echo "Errore durante l'aggiunta della colonna: " . $e->getMessage();
}




$conn = null;
?>
