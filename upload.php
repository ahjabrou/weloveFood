<?php
session_start();
$iduser=$_SESSION['iduser']; 

include('connect.php');
if(isset($_POST["submit"])){
    $nom = addslashes($_POST["titre"]);
    $fonc = addslashes($_POST["fonction"]);
    $test = $_POST["texte"];
    $iduser = $_POST["iduser"]; // Récupère la valeur de la clé étrangère

    // Vérifie si l'utilisateur avec l'ID spécifié existe dans la table parente
    $query = "SELECT * FROM utilisateur WHERE iduser = '$iduser'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 0) {
        echo "L'utilisateur avec l'ID spécifié n'existe pas.";
        exit;
    }

    $target_dir = "imagess/";
    $target_file = $target_dir . basename($_FILES["imagepub"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    $check = getimagesize($_FILES["imagepub"]["tmp_name"]);
    if($check !== false) {
        echo "C'est bien une image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Le fichier est différent d'une image.";
        $uploadOk = 0;
    }

    // Renommer l'image
    $temp = explode(".", $_FILES["imagepub"]["name"]);
    $newfilename = round(microtime(true)) . '.' .end($temp);
    $finaldestination = $target_dir .$newfilename;
    
    if($uploadOk == 0){
        echo "Image non enregistrée.";
    } else {
        if(move_uploaded_file($_FILES["imagepub"]["tmp_name"],"" . $finaldestination)) {
          var_dump($_SESSION);
            $sql = "INSERT INTO `publicationtwo` (titre, fonction, imagepub, texte, datepub, iduser)
             VALUES('$nom', '$fonc', '$finaldestination', '$test', NOW(), '$iduser')";
             header("location:pagepub_user.php");
    
        }
        if(mysqli_query($conn, $sql)){
          echo "Succès.";
        } else {
          echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}
?>
