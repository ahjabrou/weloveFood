<?php
session_start();
include('connect.php');
if (!isset($_SESSION['iduser'])) {
  header('Location: login.php');
  exit();
}

?>
 <?php
  ob_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>welikefood</title>
  <link rel="stylesheet" href="css/styless.css">

    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1,maximum-scale=1"/>
  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
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


<style type="text/css">
div.gallery {
  border: 1px solid rgb(39, 150, 39);
  padding: 25px 10px 10px 40px;
  width: 310px;
  height: 245px;
  border-radius: 40px;
  margin-left: 3rem;

}


div.gallery img {
  width: 298px;
  height: 250px;  
}

.overlay {
  
  margin-left: 10px;
  opacity: 0;
  transition: .5s ease;
  color: white;
  vertical-align: text-bottom;
  font-size: 11px;
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
			font-size: 15px;
			width: 100px;
			margin-left: 50px;
      margin-right: 30px;
      margin-top: -30px;
		}
		.img_scroll {
			width: 30px;
			height: 35px;
			border-radius: 50%;
      padding-top: 10px;
      margin-left: 5px;
		}
    .container {
  display: flex;
  padding: -7rem;
  flex-direction: row;
  justify-content:space-between;
}

.other {
  /* styles pour la div card à droite */
  margin-right: 15rem;
  padding:2rem;
}
	</style>
<body>
<header>
 
</header>
      
<section id="deuxieme" style="width: 100%; padding-top: 20px;">
      
   <?php
    if(isset($_GET["id"])){
        $id= $_GET["id"];
    }
    
    $req ="SELECT * FROM `publicationtwo` WHERE id = $id";
    $result = mysqli_query($conn, $req);
    $har = mysqli_fetch_assoc($result);

    
    ?>

    <h2 class="text-center"style="color: #008518"><?=$har['fonction']?></h2>
    
      
      <div class="container">
      <div class="gallery">
        <a  href="#">
        <img style="width: 230px;height: 190px;position:relative;" src="<?=$har['imagepub']?>" alt="">
          <div class="contenant">
          </div>
        </a>
      </div>
 
 <div class="other">
  <h4><?=$har['titre']?></4>
  
    <p style="font-size:medium";><?=$har['texte']?></p>
    <h5 style="color:#596CE5";><?=$har['datepub']?></h6>

</div>
      </div>
   </section><br><br>

<?php
include 'likeDislike.php';
include 'likeajax.php';
?>
  

<?php
include 'comment.php';
?>

<?php
include 'display_comments.php';
?>


</body>
</html>