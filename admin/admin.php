<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['nom'])) {
    header('Location: admin_login.php');
    exit();
}

// Afficher le contenu de la page d'administration
// echo "Bienvenue dans l'espace d'administration, ".$_SESSION['nom']."!";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

  </head>
<body>


<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin</a>
    <?php
    include 'admin_connect.php';
   
    if (isset($_SESSION['nom'])) {
      $nom = $_SESSION['nom'];
      $sql = "SELECT * FROM `admin` WHERE nom = '$nom'";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) { ?>
        <a class="nav-link" href="#">
          <p><?php echo $row['nom'] ?></p>
        </a>
      <?php }
    }
    ?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-auto">
        <a class="nav-link" href="utilisateurs.php">Utilisateurs</a>
        <a class="nav-link" href="publications.php">Publications</a>
        <a class="nav-link" href="commentaires.php">Commentaires</a>
        <a class="nav-link" href="logout.php">Déconnexion</a>
      </div>
    </div>
  </div>
</nav>

<p class="text-center">Bienvenue dans l'espace d'administration, <?php echo $_SESSION['nom'] ?> !</p>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
