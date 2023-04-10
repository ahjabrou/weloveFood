<?php
      include('connect.php');
      session_start();

      // Vérifier si l'utilisateur est connecté
      if (!isset($_SESSION['iduser'])) {
          header('Location: login.php');
          exit();
      }

      // Récupérer les informations de l'utilisateur
      $user_id = $_SESSION['iduser'];
      $query = mysqli_query($conn, "SELECT * FROM utilisateur WHERE iduser = $user_id");
      $user = mysqli_fetch_assoc($query);

      // Traitement du formulaire de modification
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Vérifier les champs obligatoires
        if (empty($_POST['nom']) || empty($_POST['pseudo']) || empty($_POST['email'])) {
          $message = "Veuillez remplir tous les champs obligatoires.";
        } else {
          // Mettre à jour les informations de l'utilisateur
          $id = $_SESSION['id']; 
          $nom = mysqli_real_escape_string($conn, $_POST['nom']);
          $pseudo = mysqli_real_escape_string($conn, $_POST['pseudo']);
          $email = mysqli_real_escape_string($conn, $_POST['email']);
          $hashed_password = password_hash($_POST['motdepasse'], PASSWORD_DEFAULT);
          
          // Traitement du champ "profil"
          if (isset($_FILES['profil']) && $_FILES['profil']['size'] > 0) {
            // Le champ "profil" a été soumis avec un fichier
            $profil = $_FILES['profil'];
            $image_path = "profiluser/";
            
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
            // Déplacer le fichier uploadé vers le dossier de profil utilisateur
            if (!move_uploaded_file($profil["tmp_name"], $image_path . $profil_file_name)) {
              die("Erreur lors de la copie du fichier dans le dossier des images");
            }
            
            // Mettre à jour la base de données avec le nom de fichier généré pour l'image
            $sql = "UPDATE utilisateur SET nom='$nom', pseudo='$pseudo', email='$email', pass='$hashed_password', profil='$profil_file_name' WHERE iduser=$user_id";      
          } else {
            // Le champ "profil" n'a pas été soumis avec un fichier
            $sql = "UPDATE utilisateur SET nom='$nom', pseudo='$pseudo', email='$email', pass='$hashed_password' WHERE iduser=$user_id";
            $profil_file_name = null; // Ou toute autre valeur par défaut que vous souhaitez utiliser
          }
          
          if (mysqli_query($conn, $sql)) {
            // Mettre à jour les variables de session avec les nouvelles valeurs du profil
            $_SESSION['nom'] = $nom;
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['email'] = $email;
            $_SESSION['profil'] = $profil_file_name;
        
            // After updating user data in the database
            $_SESSION['user'] = $user;
            
            // Rediriger vers la page de profil mise à jour
            header("Location: profil.php");
            exit();
        } else {
            $message = "Une erreur s'est produite lors de la mise à jour des informations de l'utilisateur. Veuillez réessayer ultérieurement.";
        }
        
          
        }
      }
    ?>