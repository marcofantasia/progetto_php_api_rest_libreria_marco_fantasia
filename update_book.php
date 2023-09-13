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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['titolo']) && isset($_POST['autore']) && isset($_POST['anno_pubblicazione']) && isset($_POST['scadenza'])) {
        $titolo = $_POST['titolo'];
        $autore = $_POST['autore'];
        $anno_pubblicazione = $_POST['anno_pubblicazione'];
        $scadenza = $_POST['scadenza'];
        $id = $_POST['id']; // L'ID del libro da aggiornare

        $update_query = "UPDATE libri SET titolo = :titolo, autore = :autore, anno_pubblicazione = :anno_pubblicazione, scadenza = :scadenza WHERE id = :id";

        $stmt = $conn->prepare($update_query);

        // Associa i valori dei parametri
        $stmt->bindParam(':titolo', $titolo);
        $stmt->bindParam(':autore', $autore);
        $stmt->bindParam(':anno_pubblicazione', $anno_pubblicazione);
        $stmt->bindParam(':scadenza', $scadenza);
        $stmt->bindParam(':id', $id);

        // Esegui la query
        if ($stmt->execute()) {
            header("Location: ../homepage.php");
            echo "Libro aggiornato con successo!";
        } else {
            echo "Errore durante l'aggiornamento del libro.";
        }
    } else {
        echo "Parametri mancanti.";
    }
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Recupera le informazioni sul libro dalla tabella
    $select_query = "SELECT * FROM libri WHERE id = :id";
    $stmt = $conn->prepare($select_query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $titolo = $row['titolo'];
        $autore = $row['autore'];
        $anno_pubblicazione = $row['anno_pubblicazione'];
        $scadenza = $row['scadenza'];
    } else {
        echo "Libro non trovato.";
        exit;
    }
} else {
    echo "ID del libro mancante.";
    exit;
}
?>





<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>LibroSmart</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="style/homepage.css">
</head>
<body>
<nav class="navbar navbar-expand-lg">
<div class="container-fluid">
<a class="navbar-brand" href="#">LibroSmart</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav">
<li class="nav-item">
<a class="nav-link" aria-current="page" href="../vista_scadenze.php">Last minute</a>
</li>
<li class="nav-item">
<a class="nav-link" href="../create_book.php">Inserisci libro</a>
</li>
<li class="nav-item">
<a class="nav-link" href="../homepage.php">Torna alla home</a>
</li>

</ul>
</div>
</div>
</nav>
<h1 class="display-1 text-center">Aggiorna il tuo libro</h1>
<p class="display-5 text-center">Dacci più informazioni su ciò che arricchisce la tua cultura</p>





<form  method="POST" class="mt-4">


<input type="hidden" name="id" value="<?php echo $id; ?>">

<div class="mb-3">
<label for="titolo" class="form-label">Titolo</label>
<input type="text" value="<?php echo $titolo; ?>"  class="form-control" name="titolo"required><br>

</div>
<div class="mb-3">
<label for="autore" class="form-label">Autore</label>
<input type="text" value="<?php echo $autore; ?>"  class="form-control" name="autore" required><br>
</div>
<div class="mb-3">
<label for="anno_pubblicazione" class="form-label">Anno di pubblicazione</label>
<input type="number" value="<?php echo $anno_pubblicazione; ?>"  class="form-control" name="anno_pubblicazione" required><br>
</div>
<div class="mb-3">
<label for="scadenza" class="form-label">Scadenza</label>
<input type="date" value="<?php echo $scadenza; ?>"  class="form-control" name="scadenza" required><br>
</div>

<button type="submit" href="../homepage.php" class="btn-reg mb-4">Aggiorna</button>
</form>
<img class="img-fluid" src="/ed-robertson-eeSdJfLfx1A-unsplash.jpg" alt="">

<footer class="text-center text-lg-start text-muted">
<!-- Section: Social media -->
<section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">

<div>
<a href="" class="me-4 text-reset">
<i class="fab fa-facebook-f"></i>
</a>
<a href="" class="me-4 text-reset">
<i class="fab fa-twitter"></i>
</a>
<a href="" class="me-4 text-reset">
<i class="fab fa-google"></i>
</a>
<a href="" class="me-4 text-reset">
<i class="fab fa-instagram"></i>
</a>
<a href="" class="me-4 text-reset">
<i class="fab fa-linkedin"></i>
</a>
<a href="" class="me-4 text-reset">
<i class="fab fa-github"></i>
</a>
</div>

</section>

<section class="">
<div class="container text-center text-md-start mt-5">

<div class="row mt-3">

<div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

<h6 class="text-uppercase fw-bold mb-4">
<i class="fas fa-gem me-3"></i>Su di noi
</h6>
<p>
Abbiamo deciso di fare un salto verso il futuro, mixando la cultura con la tecnologia. Un futuro sempre più grande, fatto di innovazione e di speranze per un mondo migliore.
</p>
</div>

<div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
<!-- Links -->
<h6 class="text-uppercase fw-bold mb-4">
Linguaggi e programmi
</h6>
<p>
HTML
</p>
<p>
CSS, Bootstrap
</p>
<p>
Javascript (Manipolazione del DOM)
</p>
<p>
PHP e API RESTful 
</p>
</div>

</div>

</div>
</section>

<div class="text-center p-4 parte-finale">
© 2023 Copyright:
<a class="text-reset fw-bold" href="https://mdbootstrap.com/">Marco Scalise Fantasia Junior Full Stack Web Developer</a>
</div>

</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>