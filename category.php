
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
<a class="nav-link" aria-current="page" href="../homepage.php">Torna alla home</a>
</li>
<li class="nav-item">
<a class="nav-link" href="../create_book.php">Inserisci libro</a>
</li>


</ul>
</div>
</div>



</nav>

<h1 class="display-1 text-center">Categorie libri</h1>
<p class="display-5 text-center">Scegli il tuo libro in base alle tue preferenze.</p>

<img class="img-fluid" src="/tom-hermans-9BoqXzEeQqM-unsplash.jpg" alt="">

<?php

include_once 'config/database.php';


include_once 'models/libro.php';

$database = new Database();
$db = $database->getConnection();
$libro = new Libro($db);


$categorie = ["Fantasia", "Romanzo", "Azione", "Giallo"];




foreach ($categorie as $categoria) {
    echo "<h2>Categoria: $categoria</h2>";

   
    $sql = "SELECT * FROM libri WHERE categoria = :categoria";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);

    try {
        // Esegui la query
        $stmt->execute();

       
        $libri = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($libri) > 0) {
            echo '<table class="table table-hover">';
            
            foreach ($libri as $libro) {
                echo "<tr>";
                echo "<td>" . $libro["titolo"] . "</td>";
                echo "<td>" . $libro["autore"] . "</td>";
                echo "<td>" . $libro["anno_pubblicazione"] . "</td>";
                echo "<td>" . $libro["scadenza"] . "</td>";
                echo "<td>" . $libro["categoria"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Nessun libro trovato in questa categoria.";
        }
    } catch (PDOException $e) {
        
        die("Errore durante l'esecuzione della query: " . $e->getMessage());
    }
}



?>

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

<script src="readbooks.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
