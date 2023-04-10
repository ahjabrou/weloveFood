<?php
include('connect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscription</title>
    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css1/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css1/style.css">
</head>
<body>
<div class="main">

<section class="signup">
    <!-- <img src="images/signup-bg.jpg" alt=""> -->
    <div class="container">
        <div class="signup-content">
            <form method="POST" id="signup-form" class="signup-form" action=""  enctype="multipart/form-data">
                <h2 class="form-title">Inscription</h2>
                <div class="form-group">
                    <label for="">Nom & prénoms</label>
                    <input type="text" class="form-input" name="nom" id="nom"/>
                </div>
                <div class="form-group">
                    <label for="">pseudo</label>
                    <input type="text" class="form-input" name="pseudo" id="pseudo"/>
                </div> 
                <div class="form-group">
                    <label for="">email</label>
                    <input type="email" class="form-input" name="email" id="email"/>
                </div> 
                <div class="form-group">
                    <label for="">password</label>
                    <input type="password" class="form-input" name="pass" id="pass"/>
                </div>
                <div class="form-group">
                    <label for="photo">profil</label>
                    <input  class="form-input" type="file" name="profil"/>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" id="submit" class="form-submit" value="s'inscrire"/>
                </div>
            </form>
            <a class="text-center" style="text-decoration:none;" href="login.php"> Vous avez déjà un compte ? Connectez-vous ! </a>
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
include('connect.php');

// Définir le chemin où vous souhaitez enregistrer le fichier téléchargé
$image_path = "profiluser/";

if (isset($_POST['submit'])) {
    $nom = addslashes($_POST['nom']);
    $pseudo = addslashes($_POST['pseudo']);
    $email = addslashes($_POST['email']);
    $pass = $_POST['pass']; // Ne plus hacher le mot de passe ici
    $profil = $_FILES['profil'];
    $query = mysqli_query($conn, "SELECT * FROM utilisateur WHERE email ='$email'");


    if ($profil["error"] == UPLOAD_ERR_OK) {

        // Vérifier le type de fichier
        $allowed_types = array("image/jpeg", "image/png");
        $file_type = mime_content_type($profil["tmp_name"]);
        if (!in_array($file_type, $allowed_types)) {
            die("Type de fichier non autorisé. Les types autorisés sont: " . implode(", ", $allowed_types));
        }
    
        // Vérifier la taille du fichier
        $max_file_size = 500000; // 500 Ko
        if ($profil["size"] > $max_file_size) {
            die("Taille de fichier maximale autorisée: " . $max_file_size . " octets");
        }
    
        // Générer un nom de fichier unique pour éviter les collisions de noms de fichiers
        $profil_file_name = uniqid() . "." . pathinfo($profil["name"], PATHINFO_EXTENSION);
    
        // Déplacer le fichier téléchargé vers le dossier des images
        if (!move_uploaded_file($profil["tmp_name"], $image_path . $profil_file_name)) {
            die("Erreur lors de la copie du fichier dans le dossier des images");
        }
    
        // Enregistrer l'utilisateur dans la base de données avec le nom de fichier généré pour l'image
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO utilisateur (nom, pseudo, email, pass, profil) VALUES ('$nom', '$pseudo', '$email', '$hashed_password', '$profil_file_name')";
        if (mysqli_query($conn, $sql)) {
            echo "Utilisateur enregistré avec succès";
        } else {
            echo "Erreur d'enregistrement de l'utilisateur: " . mysqli_error($conn);
        }
    
    } else {
        die("Erreur de téléchargement du profil: " . $profil["error"]);
    }

}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>
