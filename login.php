<?php
include('connect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css1/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css1/style.css">
</head>
<body>
<div class="main">
 <!--/connecter est utiliser pour la requête post et /connect
   pour afficher le formulaire-->
   <section class="login">
    <!-- <img src="images/signup-bg.jpg" alt=""> -->
    <div class="container">
        <div class="signup-content">
            <form method="POST" id="login-form" class="login-form" action=""  enctype="multipart/form-data">
                <h2 class="form-title">Connexion</h2>
                <div class="form-group">
                    <label for="">email</label>
                    <input type="email" class="form-input" name="email" id="email"/>
                </div> 
                <div class="form-group">
                    <label for="">password</label>
                    <input type="password" class="form-input" name="pass" id="pass"/>
                </div>
                <a class="text-center" style="text-decoration:none;" href="psw_reinit.php">mot de passe oublié ?</a>
                <div class="form-group">
                    <input type="submit" name="submit" id="submit" class="form-submit" value="Connecter"/>
                </div>
            </form>
            <a class="text-center" style="text-decoration:none;" href="signup.php">Vous n'avez pas de compte ? Inscrivez-vous !</a>
        </div>
    </div>
</section>
</div>

<!-- JS -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>

<?php
session_start(); // Démarrage de la session
if(isset($_POST['submit'])) {
 $email = mysqli_real_escape_string($conn, $_POST['email']);
 $pass = mysqli_real_escape_string($conn, $_POST['pass']);
 $query = mysqli_query($conn, "SELECT * FROM utilisateur WHERE email ='$email'");
 if(mysqli_num_rows($query) == 1) {
   $user = mysqli_fetch_assoc($query);
   if(password_verify($pass, $user['pass'])) {
     $_SESSION['logged_in'] = true;
     $_SESSION['iduser'] = $user['iduser'];
     $_SESSION['pseudo'] = $user['pseudo'];
     $_SESSION['email'] = $user['email'];
     header('location:index.php?page');
     exit(); // Terminer le script après la redirection
   } else {
     echo "<font color='red'>Email ou mot de passe invalide</font>";
   }
 } else {
   echo "<font color='red'>Email ou mot de passe invalide</font>";
 }
 mysqli_close($conn); // Fermer la connexion à la base de données
}
?>
