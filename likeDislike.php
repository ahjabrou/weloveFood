<?php
include('connect.php');
session_start(); // démarrer une session pour stocker l'identifiant de l'utilisateur connecté
if(isset($_SESSION['iduser'])){
  $iduser = $_SESSION['iduser']; // récupérer l'identifiant de l'utilisateur connecté depuis la session
  //var_dump($_SESSION); 
}
else{
  // gérer le cas où l'utilisateur n'est pas connecté
  exit;
}

        
// if(isset($_GET["id"])){
 

//   $id= $_GET["id"];
    
//   $sql = "SELECT*FROM `avistwo` WHERE publi_id = '$id' AND avis = '1'";

//   $result = mysqli_query($conn, $sql);
//   $count1 = mysqli_num_rows($result);

//   $sql2 = "SELECT*FROM `avistwo` WHERE publi_id = '$id' AND avis = '0'";

//   $result1 = mysqli_query($conn, $sql2);
//   $count2 = mysqli_num_rows($result1);
  
// }
//   ?>


<!-- <div style="margin-left: 380px;margin-top: -20px;position: absolute;width: 170px;height:40px;background-color: white;paddinf-left: 30px;display:flex">

<form method="POST" action="">
   <input  type="number" name="avis"  value="1" class="ron1" hidden>
   <input  type="number" name="id"  value="<?php echo $_GET["id"]; ?>" hidden>
   <input type="submit" name="count1"  value="<?php echo $count1 ?>" class="ron1" disabled>
   <button type="submit" name="submit" style="background-color: white;border: none;">
   <i class="fa fa-thumbs-up like-btn" class="fa fa-thumbs-o-up like-btn" class="imj1" style="color: blue;"></i>
   </button>
</form> 
   
<form class="pouss" method="POST" action="">
  <button style="background-color: white;border: none;">
  <i class="fa fa-thumbs-down dislike-btn" 
        class="fa fa-thumbs-o-down dislike-btn" style="color: red;" data-id=""></i>

  </button>
  <input  type="number" name="avis"  value="0" class="ron1" hidden>
  <input  type="number" name="id"  value="<?php echo $_GET["id"]; ?>" hidden>
  <input type="submit" name="count2" value="<?php echo $count2 ?>" class="ron2" disabled>

</form>
 <div id="vote-form">
    <form id="vote-form" method="POST">
        <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
        <button type="button" class="like-btn" data-value="1">
            <i class="fa fa-thumbs-up"></i>
        </button>
        <button type="button" class="dislike-btn" data-value="0">
            <i class="fa fa-thumbs-down"></i>
        </button>
    </form>
</div> -->


</div>

<?php
if(isset($_POST["id"]) && isset($_POST["avis"])) {
    $id = $_POST["id"];
    $avis = $_POST["avis"];
    $iduser = $_SESSION['iduser'];  // remplacez cette valeur par l'identifiant de l'utilisateur connecté
    
    // Vérifier si l'utilisateur a déjà voté pour cette publication
    $sql = "SELECT avis FROM avistwo WHERE publi_id = $id AND iduser = $iduser";
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) > 0) {
        // L'utilisateur a déjà voté, mettre à jour son vote
        $row = mysqli_fetch_assoc($result);
        $old_avis = $row["avis"];
        
        if($old_avis == $avis) {
          // L'utilisateur a cliqué deux fois sur le même bouton, supprimer son vote
          $sql = "UPDATE avistwo SET avis = -1 WHERE publi_id = $id AND iduser = $iduser";
          mysqli_query($conn, $sql);
          $new_avis = -1; // indique que le vote a été supprimé
      } 
        // if($old_avis == $avis) {
        //     // L'utilisateur a cliqué deux fois sur le même bouton, mettre à jour son vote à 0
        //     $sql = "UPDATE avistwo SET avis = 0 WHERE publi_id = $id AND iduser = $iduser";
        //     mysqli_query($conn, $sql);
        //     $new_avis = 0; // indique que le vote a été mis à jour à 0
        // }
        else {
            // L'utilisateur a changé d'avis, mettre à jour son vote
            $sql = "UPDATE avistwo SET avis = $avis WHERE publi_id = $id AND iduser = $iduser";
            mysqli_query($conn, $sql);
            $new_avis = $avis;
        }
    } else {
        // L'utilisateur n'a pas encore voté, ajouter son vote
        $sql = "INSERT INTO avistwo (publi_id, iduser, avis) VALUES ($id, $iduser, $avis)";
        mysqli_query($conn, $sql);
        $new_avis = $avis;
    }
    
    // Récupérer le nombre de likes et dislikes pour cette publication
    // $sql = "SELECT COUNT(*) AS nb_votes, avis FROM avistwo WHERE publi_id = $id GROUP BY avis";
    // $result = mysqli_query($conn, $sql);
    
    // $likes = 0;
    // $dislikes = 0;
    
    // while($row = mysqli_fetch_assoc($result)) {
    //     if($row["avis"] == 1) {
    //         $likes = $row["nb_votes"];
    //     } else {
    //         $dislikes = $row["nb_votes"];
    //     }
    // }
    
    // // Retourner le nombre de likes et dislikes au format JSON
    // echo json_encode([ "like" => $likes, "dislike" => $dislikes, "user_avis" => $new_avis ]);
}
mysqli_close($conn);
?>



