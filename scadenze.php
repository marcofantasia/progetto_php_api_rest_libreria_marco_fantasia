<?php

$host = "localhost";
$db_name = "libreria";
$username_db = "root";
$password_db = "rootroot";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username_db, $password_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Data attuale
    $data_attuale = date('Y-m-d');

    
    $query = "SELECT * FROM libri WHERE scadenza <= DATE_ADD('$data_attuale', INTERVAL 5 DAY)";
    $stmt = $conn->prepare($query);
    $stmt->execute();

   
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Titolo</th><th>Autore</th><th>Anno di Pubblicazione</th><th>Scadenza</th></tr>";

    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
       
        $scadenza = $row['scadenza'];
        $data_scadenza = strtotime($scadenza);
        $data_limite = strtotime('+5 days', strtotime($data_attuale));
        $scadenza_in_rosso = ($data_scadenza <= $data_limite) ? 'style="color: red;"' : '';

        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['titolo'] . "</td>";
        echo "<td>" . $row['autore'] . "</td>";
        echo "<td>" . $row['anno_pubblicazione'] . "</td>";
        echo "<td>" . $row['categoria'] . "</td>";
        echo "<td $scadenza_in_rosso>" . $row['scadenza'] . "</td>";
        echo "</tr>";
    }

    
    echo "</table>";
} catch (PDOException $e) {
    echo "Errore di connessione al database: " . $e->getMessage();
}
?>
