<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>welikefood</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1,maximum-scale=1"/>

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


<div class="container">

  <h2 style="text-align:center;">Modifier votre mot de passe</h2>
<div class="container"style="display:flex; align-items:center; width:600px;height: 200px;">
  <form class="form-control" style="display:flex; align-items:center; width:600px;height: 200px;" action="" method = "POST">
    
   <div class="form-group">
      <label for="email">Votre mail :</label><br>
      <input type="text" name = "email" id="email" placeholder="Entrer votre mail" ><br>
      <label for="email">Votre nouveau mot de passe :</label><br>
      <input type="password" name = "psw" id="psw" placeholder="Entrer votre mot de passe" >
    </div>

    <button type="submit" name = "submit" class="btn btn-light">MODIFIER</button>
  </form>
</div>

<?php
include 'connect.php';
  if(isset($_POST['submit'])){
    if(!empty($_POST ['email'])){
      $email = $_POST ['email'];
      $query = mysqli_query($conn, "SELECT * FROM utilisateur WHERE email ='$email'");
      $rows = mysqli_num_rows($query);
    
      if($rows==1){
      $array = $query->fetch_assoc();
      $id_user = $array['iduser'];
      $hashed_password = password_hash($_POST['psw'], PASSWORD_DEFAULT);
      $sql = "UPDATE utilisateur SET pass ='$hashed_password' WHERE iduser='$id_user'";
  	  $conn->query($sql);


     
     

      echo "<p>";
      echo "Modification réussie";
      echo "<br>";
      }else{
        
      echo "<font color = 'red'>";
      echo "Cet email n'est pas dans notre base de donnée.";
      echo "</font>";
      }
        }
      }
      mysqli_close($conn);
  ?>

</div>
</body>
<?php
include 'footer.php';
?>
</html>
