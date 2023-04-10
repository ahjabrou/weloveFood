
<?php
include('connect.php');

session_start();

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
  // L'utilisateur est connecté
  // include('update_profile.php');
  //var_dump($_SESSION); 
  echo "Bonjour ".$_SESSION['pseudo']."!";
} else {
  // L'utilisateur n'est pas connecté
  echo "Vous n'êtes pas connecté.";
}
?>


<!DOCTYPE html>
<html>

<style type="text/css">
.title{
  color:rgb(151, 134, 134);
  text-align: center;
}
.container{
  display: none;
}
div.gallery {
border: 1px solid #ccc;
width: 270px;
height: 245px;
border-radius: 10px;


}

div.gallery:hover {
box-shadow: 2px 2px 8px lightgray;
}

div.gallery img {
width: 298px;
height: 250px;
border-top-left-radius: 10px;
border-top-right-radius: 10px;

}
.para{
width: 270px;
margin-top: -4px;
font-size: 12px;
margin-left: 10px;
}
.para1{
margin-left: 10px;
margin-top: -10px;
font-size: 12px;
width: 270px;
}
div.desc1{
padding-left: 15px;
text-align: center;
width: 250px;
height: 100px;
background-color: blue;
}

.contenant {
height: 200px;
width: 270px;
border-top-left-radius: 10px;
border-top-right-radius: 10px;
margin-top: -200px;
position: absolute;
}
.contenant:hover {
position: absolute;
opacity: 1;
box-shadow: inset 0 -60px 10px 4px rgba(0, 0, 0, 0.5);

}
.contenant:hover .overlay {
opacity: 1;
}
.contenant:hover .img_plus {
opacity: 1;
}




/* texte dans image */
.overlay {

margin-left: 10px;
opacity: 0;
transition: .5s ease;
color: white;
vertical-align: text-bottom;
font-size: 20px;
float: left;
text-align: left;
margin-top: 150px;

}

/* la petite image sur l'image */
.img_plus {

opacity: 0;
transition: .5s ease;  
text-align: right;
height:40px;
width:40px;

}


  .div_text_scroll {
    font-size: 12px;
    width: 150px;
    margin-left: 40px;
   
    margin-top: -30px;
  }
  .img_scroll {
    width: 30px;
    height: 35px;
    border-radius: 50%;
    padding-top: 10px;
    margin-left: 5px;
  }

  /* head {
    min-width: 1000px;
  }
  body {
    min-width: 1000px;
  } */

  </style>
<body>
  <header>
  <?php 
include 'navbar.php';

?>

  </header>
  <div class="title">
<h1 class="">Bienvenue sur votre page ! </h1>
<p>ici vous trouverez vos publications</p>
</div>
  <?php

// Récupérer l'id de l'utilisateur actuellement connecté
$iduser = $_SESSION["iduser"];

// Requête SQL pour récupérer les publications de l'utilisateur actuel
$sql="SELECT * FROM publicationtwo WHERE iduser = $iduser ";

$result = mysqli_query($conn, $sql);

// Vérifier s'il y a des publications
if (mysqli_num_rows($result) > 0) {
  // Afficher chaque publication
  while ($har = mysqli_fetch_assoc($result)) {?>
    
    <div style="display: inline-flex;justify-content: space-around;margin-left: 5px;margin-bottom:10px" >
    <div class="container">
      <div class="gallery" class="boite" >
        <a  href="visuel.php?id=<?=$har['id']?>">
        <!-- <p><?=$har['iduser']?></p> -->
        <img style="width: 268px;height: 200px;position:relative;" src="<?=$har['imagepub']?>" alt="">
          <div class="contenant">

          <div class="overlay" ><?=$har['titre']?></div>
          <img class="img_plus" style="height: 40px;width: 40px;float: right;" src="images/img_plus.png">
      
          </div>
        </a>
          <p class="para"> <?=$har['texte']?> </p>
          <p class="para">publié le: <span style="color:brown"><?=$har['datepub']?></span></p>
      </div>

      </div>
      </div>
  <?php }
} else {
  echo "Aucune publication trouvée.";
}

mysqli_close($conn);
?>

<!-- <?php

// Créer une connexion
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Vérifier la connexion
// if ($conn->connect_error) {
//   die("La connexion a échoué : " . $conn->connect_error);
// }

// if(isset($_POST['submit'])){
//   $texte = addslashes($_POST['texte']);
//   $publi_id = $_GET['id'];
//   $iduser = $_SESSION['iduser'];

//   $sql1 = "SELECT * FROM `comment`";
//   $result = $conn->query($sql1);
//   while($row = $result->fetch_assoc()) {
//       echo "id: " . $row["id"]. " - Texte: " . $row["texte"]. "<br>";
//   }
  
//   $conn->close();
// }




?>  -->
<a class="page-link">
  <div class="text-center">
<form action="" method="post">
  <!-- <input type="number" name="add" hidden> -->
<button class="btn1" type="submit">Voir plus...</button>
</form>
</div>
</a>

<script>
     $(document).ready(function(){
         $('.container').slice(0,4).show();
         $('.page-link').on('click',function(){

            $('.container:hidden').slice(0,4).slideDown('slow');
            if($('.container:hidden').length == 0){
                $(this).fadeOut('slow');
            }
            $('html,body').animate({
                scrollTop: $(this).offset().top
            },500);
            return false;
         });
     });
     </script>

</body>
</html>

