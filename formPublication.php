<?php
include('connect.php');
session_start();
//var_dump($_SESSION);
$iduser = $_SESSION["iduser"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formpublication</title>
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
            <form method="POST" id="signup-form" class="signup-form" action="upload.php"  enctype="multipart/form-data">
            <h2 class="form-title">JE PUBLIE</h2>
                <div class="form-group">

                <input type="hidden" name="iduser" value="<?php echo $_SESSION['iduser']; ?>">
                    <label for="">Titre de la publication</label>
                    <input type="text" class="form-input" name="titre" id="name"/>
                </div>
                <div class="form-group">
                    <label for="">Type de la publication</label>
                    <select name="fonction">
                        <option selected>Faire un choix</option>
                        <option value="Restaurant">Restaurant</option>
                        <option value="Recette">Recette</option>
                        <option value="Experience" >Retourd'Experience</option>
                        <option value="Conseil">Conseil</option>
                    </select>
                </div> 
                <div class="form-group">
                    <label for="photo">Image</label>
                    <input  class="form-input" type="file" name="imagepub"/>
                </div>
                <div class="form-group">
                    <label for="texte">Message</label>
                    <textarea name="texte" id="" cols="58" rows="8"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" id="submit" class="form-submit" value="Publier"/>
                </div>
            </form>
                    <a style="text-decoration:none;"href="pagepub_user.php" style="text-align:center">Annuler</a>
   
        </div>
    </div>
</section>

</div>

<!-- JS -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>