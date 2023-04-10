
<?php
include('connect.php');

session_start();

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
  // L'utilisateur est connecté
  include('update_profile.php');
 // var_dump($_SESSION); 
  echo "Bonjour ".$_SESSION['pseudo']."!";
} else {
  // L'utilisateur n'est pas connecté
  echo "Vous n'êtes pas connecté.";
  header('Location: login.php');
}
?>
<!DOCTYPE html>
<html>

		<style type="text/css">

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
	.container{
    display:none;
  }


		</style>
<!-- </head> -->
<body>
	&nbsp;
  <header>
    <?php
    // include 'header.php';
    include 'navbar.php';
    ?>
      
      <?php

    if (isset($_POST['fonction'])) {

      $fonction = $_POST['fonction'];
    
      $sql = "SELECT p.*, u.pseudo 
      FROM publicationtwo p 
      INNER JOIN utilisateur u ON p.iduser = u.iduser 
      WHERE fonction = '$fonction'";
      
      $result1 = mysqli_query($conn, $sql);
      $result2 = mysqli_query($conn, $sql);

  

  if (mysqli_num_rows($result1) > 0 && mysqli_num_rows($result2) > 0) {
  $data1 = $result1;
  $data2 = $result2;
  }else {
    $req ="SELECT p.*, u.pseudo 
    FROM publicationtwo p 
    INNER JOIN utilisateur u ON p.iduser = u.iduser 
    ORDER BY p.datepub DESC";

    $result3 = mysqli_query($conn, $req);
    $result4 = mysqli_query($conn, $req);
    $data1 = $result3;
    $data2 = $result4;
  
  }

}else {
  

  $req ="SELECT p.*, u.pseudo 
  FROM publicationtwo p 
  INNER JOIN utilisateur u ON p.iduser = u.iduser 
  ORDER BY p.datepub DESC";

  $result5 = mysqli_query($conn, $req);
  $result6 = mysqli_query($conn, $req);
  $data1 = $result5;
  $data2 = $result6;
}
?>
      </div>
    
  </header>
 
 


	 <!--galerie image-->
   <section id="deuxieme" style="width: 100%;padding-top: 20px; padding-right: 30px;">
   <?php

    
    while($har = mysqli_fetch_assoc($data2)){
    ?>
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
          <p class="para">publié par: <span style="color:brown"><?=$har['pseudo']?> </span>le: <?=$har['datepub']?></p>
      </div>
      </div>
      </div>
      <?php
      } 
       mysqli_close($conn);
       
      ?>

</div>  
   </section>


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
  
<a class="page-link">
<div class="text-center">
<form action="" method="post">
<button class="btn1" type="submit">Voir plus...</button>
</div>
</form>
</a>

	



</body>
<?php
  include 'footer.php';
  ?>
</html>
