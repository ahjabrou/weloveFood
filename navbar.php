<?php
  ob_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>welikefood</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1,maximum-scale=1"/>
  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php?page">
        <img src="images/logobrief.png" alt="welikefood" width="100" height="100">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <?php 
            
            if(isset($_SESSION['iduser'])) { 
          ?>
            <li class="nav-item">
              <a class="nav-link" href="profil.php">Profil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pagepub_user.php">Page de publication</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="formPublication.php">Publier</a>
            </li>
          <?php 
            } 
          ?>
        </ul>
        <div class="ms-auto">
          <?php 
            if(isset($_SESSION['iduser'])) { 
          ?>
            <a href="deconnexion.php"><button type="button" class="btn btn-dark">Deconnexion</button></a>
          <?php 
            } else { 
          ?>
            <a href="login.php"><button type="button" class="btn btn-dark">Connexion</button></a>
            <a href="signup.php"><button type="button" class="btn btn-dark">Inscription</button></a>
          <?php 
            } 
          ?>
        </div>
      </div>
    </div>
  </div>
</nav>
<br>
<div style="display: flex;align-items: center;">
  <!-- &nbsp;&nbsp;&nbsp;<img width="150" src="images/logobrief.png"> -->

  <!---formulaire pour la barre de recherche-->
  <section class="mx-auto">
  <form class="d-flex" role="search" action="search.php" method="GET">
        <input class="form-control me-2 large-input" type="search" placeholder="Recherche" name="query" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Recherche</button>
    </form>
    <form method="POST" action="">
    <div class="fil" style="display: flex;align-items: center;">
      Type de Publication: &nbsp;
      <select name="fonction" style="border-style: none;font-weight: bold;">
        <option selected value="">Choisir</option>
        <option value="Restaurant">Restaurant</option>
        <option value="Recette">Recette</option>
        <option value="Experience">Retourd'Experience</option>
        <option value="Conseil">Conseil</option>
      </select>
      &nbsp;&nbsp;&nbsp;&nbsp;
      <button type="submit">Filtre <img class="imj9" src="images/filtre.png"></button>

    </div>

  </form>
  
</section>