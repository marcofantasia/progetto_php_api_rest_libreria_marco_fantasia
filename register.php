


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
    <h1 class="display-1 text-center">Area registrazione</h1>
    <p class="display-5 text-center">Unisciti a noi.</p>
    <form action="utente/register_session.php" class="mt-4">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" name="nome"required><br>
            
        </div>
        <div class="mb-3">
            <label for="cognome" class="form-label">Cognome</label>
            <input type="text" class="form-control" name="cognome" required><br>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required><br>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required><br>
        </div>
        
        <button type="submit" href="../homepage.php" class="btn-reg mb-4">Registrati</button>
    </form>
    <img class="img-fluid" src="/samantha-borges-EeS69TTPQ18-unsplash.jpg" alt="">
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
