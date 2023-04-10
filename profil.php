<!DOCTYPE html>
<html>
<head>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>Profil</title>
	

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
   integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1,maximum-scale=1"/>
    

    <nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="images/logobrief.png" alt="welikefood" width="100" height="100">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item">
          <a class="nav-link" href="profil.php">Profil</a>
        </li>
</ul>
      <div class="ms-auto">
      <!-- <a href="profil.php"><input type="button" name="profil" id="profiluser" value="profil"></a> -->
      <a href="login.php"><button type="button" class="btn btn-dark">Connexion</button></a>
        <a href="signup.php"><button type="button" class="btn btn-dark">Inscription</button></a>
        <a href="deconnexion.php"><button type="button" class="btn btn-dark">Deconnexion</button></a>
      </div>
    </div>
  </div>
</nav>

    
  </head>
  <body>
  <?php
session_start();
include("update_profile.php");
?>

<!-- Your HTML code here -->
    
    <h1 class="text-center">Profil de <?php echo $user['pseudo']; ?></h1>
    
    <?php
      if (isset($message)) {
        echo "<p>$message</p>";
      }
    ?>
    <section class="container mx-auto">
      <div class="row col-8 card mx-auto">
        <div class="col-8 mx-auto text-center" style="padding: 10px;">
          <h3 style="color: #596CE5;">Bienvenue <?= $user['pseudo'] ?></h3>
          <div class="bd-example">
            <p style="color: black;">Email : <?= $user['email'] ?></p>
            <?php if (isset($user['profil'])) {
              $image_path = "profiluser/" . $user['profil'];
            ?>
              <img src="<?= $image_path ?>" alt="Profil de <?= $user['nom'] ?>" width="100">
            <?php } ?>
          </div>
          <hr>


          <div id="modification">
  <button class="btn btn-warning" onclick="showForm()">Modifier</button>
  <button class="btn btn-danger" onclick="hideForm()" style="display:none;">Annuler</button>
</div>
    <form id="form-modification" method="POST" enctype="multipart/form-data" action="update_profile.php" style="display: none;">
      <label>Nom complet :</label><br>
      <input type="text" name="nom" value="<?php echo $user['nom']; ?>" required><br><br>
    
      <label>Pseudo :</label><br>
      <input type="text" name="pseudo" value="<?php echo $user['pseudo']; ?>" required><br><br>
    
      <label>Adresse e-mail :</label><br>
      <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br><br>
    
      <label>Mot de passe :</label><br>
      <input type="password" name="motdepasse" required><br><br>
    
      <label>Image de profil :</label><br>
      <input type="file" name="profil"><br><br>
    
      <input type="submit" value="Mettre à jour">
    </form>
        </div>
      </div>
    </section>
    
    </body>
    <script>
function showForm() {
  document.getElementById('form-modification').style.display = 'block';
  document.getElementById('modification').getElementsByTagName('button')[0].style.display = 'none';
  document.getElementById('modification').getElementsByTagName('button')[1].style.display = 'block';
}

function hideForm() {
  document.getElementById('form-modification').style.display = 'none';
  document.getElementById('modification').getElementsByTagName('button')[0].style.display = 'block';
  document.getElementById('modification').getElementsByTagName('button')[1].style.display = 'none';
}
</script>
</html>
