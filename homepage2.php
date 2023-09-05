<?php
session_start(); 


if (isset($_SESSION["user_id"])) {
    
    $user_id = $_SESSION["user_id"]; 

    
    $host = "localhost";
    $db_name = "libreria";
    $username_db = "root";
    $password_db = "rootroot";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db_name", $username_db, $password_db);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $query = "SELECT nome FROM utenti WHERE id = :user_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $nome_utente = $row["nome"];
            $messaggio_benvenuto = "Benvenuto, $nome_utente!";
        } else {
            
            $messaggio_benvenuto = "Benvenuto!";
        }
    } catch (PDOException $e) {
        echo "Errore di connessione al database: " . $e->getMessage();
        
    }

    
    if (isset($_POST["logout"])) {
        
        session_destroy();
        header("Location: login.php");
        exit();
    }
} else {
   
    $messaggio_benvenuto = "Benvenuto!";
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
<a class="navbar-brand mx-3" href="#">LibroSmart</a>
<button class="navbar-toggler justify-content-start" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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


</ul>
</div>
</div>

<div class="container-fluid justify-content-center">
<a class="btn btn-register" href="../register.php">Registrati</a>
<a class="btn btn-login" href="../login.php">Accedi</a>
</div>

</nav>
<h3><?php echo $messaggio_benvenuto ?></h3>
<?php if (isset($_SESSION["user_id"])): ?>
       
        <p>Nome utente: <?php echo $nome_utente; ?></p>
        <form method="post">
            <input type="submit" name="logout" value="Logout">
        </form>
    <?php else: ?>
        
        <p>Non sei loggato.</p>
    <?php endif; ?>

<h1 class="display-1 text-center">LibroSmart</h1>
<p class="display-5 text-center">La tua libreria, un passo avanti.</p>
<p class="display-5 text-center">Scorri per vedere i libri.</p>
<img class="img-fluid" src="/paul-melki-bByhWydZLW0-unsplash.jpg" alt="">
<table class="table table-hover" id="book-table">
<tr class="justify-content-center">
<h1 class="display-3 text-center">I nostri libri</h1>
</tr>
<tbody>
<?php
$host = "localhost";
$db_name = "libreria";
$username = "root";
$password = "rootroot";

try {
  $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  // Query SQL per recuperare i dati dei libri
  $query = "SELECT * FROM libri";
  $result = $conn->query($query);
  
  if ($result !== false) {
    // La query è stata eseguita con successo
    echo '<table class="table table-hover">';
    
    
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      echo '<tr>';
      echo '<td>' . $row['id'] . '</td>';
      echo '<td>' . $row['titolo'] . '</td>';
      echo '<td>' . $row['autore'] . '</td>';
      echo '<td>' . $row['anno_pubblicazione'] . '</td>';
      echo '<td>' . $row['scadenza'] . '</td>';
      echo '<td>';
      echo '<a class="bottone" href="update_book.php?id=' . $row['id'] . '">Modifica</a>';
      echo '<a class="bottone mx-5" href="delete_book.php?id=' . $row['id'] . '">Elimina</a>';
      ;
      echo '</td>';
      echo '</tr>';
    }
    
    echo '</table>';
  } else {
    // La query ha fallito, gestisci l'errore
    echo "Errore nella query SQL: " . $conn->error;
  }
} catch (PDOException $e) {
  echo "Errore nella connessione al database: " . $e->getMessage();
}


?>
</tbody>
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
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
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

<script src="readbooks.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>