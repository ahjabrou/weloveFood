<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['iduser'])) {
    header('Location: login.php');
    exit();
}

$servername = "localhost";
$username = "spcom_userahja";
$password = "B99YIWJRB2KX";
$dbname = "spcom_ahja";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);
// Vérifier la connexion
if ($conn->connect_error) {
  die("La connexion a échoué : " . $conn->connect_error);
}

if(isset($_POST['submit'])){
  $texte = addslashes($_POST['texte']);
  $publi_id = $_GET['id'];
  $iduser = $_SESSION['iduser'];

  if(empty($texte)) {
    echo "Erreur : le champ texte est vide";
  } else {
    $sql = "INSERT INTO `comment` (`texte`,`publi_id`,`date_pub`,`iduser`) VALUES ('$texte','$publi_id',NOW(),'$iduser')";
    if ($conn->query($sql) === TRUE) {
      echo "Les nouveaux enregistrements ont été ajoutés avec succès";
      
    } else {
      echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
  }
  $conn->close();
  header("Location: " . $_SERVER['REQUEST_URI']);// renvoie sur la même page
  exit();
}


?>
<form action="" method="post" class="form_comment">
  <input class="form-control commentaire" type="text" name="texte">
  <input class="button" type="submit" name="submit" value="commenter">
</form><br><br>

<style>
.commentaire{
  width: 60rem;
  border: 2px solid #596CE5;
}
.button{
  border-radius: 10px;
  display: flex;
  justify-content: center;
  border: 2px solid red;
}
.form_comment{
  display: flex;
  justify-content: center;
}
</style>
