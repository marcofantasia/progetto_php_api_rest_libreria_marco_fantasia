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
<a class="navbar-brand mx-3" href="#">LibroSmart</a>
<button class="navbar-toggler justify-content-start" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav">
<li class="nav-item">
<a class="nav-link" aria-current="page" href="../homepage.php">Torna alla home</a>
</li>
<li class="nav-item">
<a class="nav-link" href="../create_book.php">Inserisci libro</a>
</li>


</ul>
</div>
</div>

<div class="container-fluid justify-content-center">
<a class="btn btn-register" href="../register.php">Registrati</a>
<a class="btn btn-login" href="../login.php">Accedi</a>
</div>

</nav>

<h1 class="display-1 text-center">Last minute</h1>
<p class="display-5 text-center">Affrettati, mancano gli ultimi giorni per questi libri!</p>
<p class="display-5 text-center">Scorri per vederli.</p>
<img class="img-fluid" src="/last minute.webp" alt="">


<table class="table table-hover" id="bookred-table">
<tr class="justify-content-center">
<h1 class="display-3 text-center">Libri last minute</h1>
</tr>
<?php

$host = "localhost";
$db_name = "libreria";
$username_db = "root";
$password_db = "rootroot";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username_db, $password_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $oggi = date("Y-m-d");
    $data_scadenza = date("Y-m-d", strtotime("+5 days"));

    
    $query = "SELECT * FROM libri WHERE scadenza BETWEEN :oggi AND :data_scadenza";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":oggi", $oggi);
    $stmt->bindParam(":data_scadenza", $data_scadenza);
    $stmt->execute();

    
    

    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['titolo'] . '</td>';
        echo '<td>' . $row['autore'] . '</td>';
        echo '<td>' . $row['anno_pubblicazione'] . '</td>';
        echo '<td style="color: red;">' . $row['scadenza'] . '</td>';
        echo '</tr>';
    }

    // Chiudi la tabella HTML
    echo '</table>';
} catch (PDOException $e) {
    echo "Errore di connessione al database: " . $e->getMessage();
}
?>

</table>

<footer class="text-center text-lg-start text-muted">
  
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
<script src="5daysbooks.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>

<?php
