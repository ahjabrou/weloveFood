<script>
// $(document).ready(function() {
//     $('.like-btn, .dislike-btn').on('click', function() {
//         var id = <?php echo $_GET['id']; ?>;
//         var avis = $(this).hasClass('like-btn') ? 1 : 0;
        
//         // Vérifier si l'utilisateur a déjà voté pour ce contenu
//         var user_avis = $(this).hasClass('like-btn') ? 'user_like' : 'user_dislike';
//         var user_voted = parseInt(sessionStorage.getItem(user_avis));
        
//         // Si l'utilisateur a déjà voté et clique sur le même bouton, supprimer le vote
//         if (user_voted === avis) {
//             avis = -1;
//             sessionStorage.removeItem(user_avis);
//         } else {
//             sessionStorage.setItem(user_avis, avis);
//         }
        
//         $.ajax({
//             type: 'POST',
//             url: 'likeDislike.php',
//             data: { id: id, avis: avis },
//             dataType: 'json',
//             success: function(response) {
//                 $('.ron1').attr('value', response.like);
//                 $('.ron2').attr('value', response.dislike);
                
//                 if(response.user_avis == 1) {
//                     $('.like-btn').css('color', 'blue');
//                     $('.dislike-btn').css('color', 'black');
//                 } else if(response.user_avis == 0) {
//                     $('.like-btn').css('color', 'black');
//                     $('.dislike-btn').css('color', 'red');
//                 } else {
//                     $('.like-btn').css('color', 'black');
//                     $('.dislike-btn').css('color', 'black');
//                 }
                
//                 if(response.new_avis == -1) {
//                     $('.like-btn').css('color', 'black');
//                     $('.dislike-btn').css('color', 'black');
//                     $('.ron1').attr('value', parseInt($('.ron1').attr('value')) - 1);
//                     $('.ron2').attr('value', parseInt($('.ron2').attr('value')) - 1);
//                 }
                
//                 $('.like-btn').attr('disabled', false);
//                 $('.dislike-btn').attr('disabled', false);
                
//                 // Recharger la page après modification des votes
//                location.reload();
//             },
//             error: function(xhr, status, error) {
//                 console.log(xhr);
//             },
//             beforeSend: function() {
//                 alert("Action effectuée avec succès !");
//                 location.reload();
//             }
//         });
//     });
// });

$(document).ready(function() {
    $('.like-btn, .dislike-btn').on('click', function() {
        var id = <?php echo $_GET['id']; ?>;
        var avis = $(this).hasClass('like-btn') ? 1 : 0;
        
        $.ajax({
            type: 'POST',
            url: 'likeDislike.php',
            data: { id: id, avis: avis },
            dataType: 'json',
            success: function(response) {
                $('.ron1').attr('value', response.like);
                $('.ron2').attr('value', response.dislike);
                
                if(response.user_avis == 1) {
                    $('.like-btn').css('color', 'blue');
                    $('.dislike-btn').css('color', 'black');
                } else if(response.user_avis == 0) {
                    $('.like-btn').css('color', 'black');
                    $('.dislike-btn').css('color', 'red');
                } else {
                    $('.like-btn').css('color', 'black');
                    $('.dislike-btn').css('color', 'black');
                }
                
                if(response.new_avis == -1) {
                    $('.like-btn').css('color', 'black');
                    $('.dislike-btn').css('color', 'black');
                    $('.ron1').attr('value', parseInt($('.ron1').attr('value')) - 1);
                    $('.ron2').attr('value', parseInt($('.ron2').attr('value')) - 1);
                }
                
                $('.like-btn').attr('disabled', false);
                $('.dislike-btn').attr('disabled', false);
                
                // Afficher une alerte et recharger la page après modification des votes
                alert("Action effectuée avec succès !");
                location.reload();
            },
            error: function(xhr, status, error) {
                console.log(xhr);
                location.reload();
            }
        });
    });
});



</script>


<?php
// Récupération de l'ID de l'image à partir de la requête GET
$id = $_GET['id'];

// Connexion à la base de données
$conn = mysqli_connect('localhost', 'spcom_userahja', 'B99YIWJRB2KX', 'spcom_ahja');

// Requête SQL pour compter le nombre de likes pour cette image
$query_likes = "SELECT COUNT(*) as likes FROM avistwo WHERE avis = 1 AND publi_id = '$id'";

// Exécution de la requête
$result_likes = mysqli_query($conn, $query_likes);

// Récupération du nombre de likes
$likes = mysqli_fetch_assoc($result_likes)['likes'];

// Requête SQL pour compter le nombre de dislikes pour cette image
$query_dislikes = "SELECT COUNT(*) as dislikes FROM avistwo WHERE avis = 0 AND publi_id = '$id'";

// Exécution de la requête
$result_dislikes = mysqli_query($conn, $query_dislikes);

// Récupération du nombre de dislikes
$dislikes = mysqli_fetch_assoc($result_dislikes)['dislikes'];


// Création d'un tableau associatif pour renvoyer les données sous forme de réponse JSON
$response = array(
    'likes' => $likes,
    'dislikes' => $dislikes
);

// Encodage de la réponse en JSON
//echo json_encode($response);

mysqli_close($conn);
?>

<form method="POST" action="">
   <input type="number" name="like" value="1" class="ron1" hidden>
   <input type="number" name="id" value="<?php echo $_GET["id"]; ?>" hidden>
   <button type="submit" id="like-btn" name="count1" class="ron1 like-btn" style="background-color: blue;border: none;">
       <i class="fa fa-thumbs-up" style="color: white;"></i>
       <?php echo $likes; ?>
   </button>
</form>

<form class="pouss" method="POST" action="">
  <input type="number" name="dislike" value="0" class="ron2" hidden>
  <input type="number" name="id" value="<?php echo $_GET["id"]; ?>" hidden>
  <button type="submit" id="dislike-btn" name="count2" class="ron2 dislike-btn" style="background-color: red;border: none;">
       <i class="fa fa-thumbs-down" style="color: white;"></i>
       <?php echo $dislikes; ?>
  </button>
</form>


<style>
     .dislike-btn{
        /* margin-left:18rem;
        margin-top: -7rem */
        position: absolute;
        top: 26rem;
        left:18rem;
    } 
    .like-btn{
        /* top:-10rem;
        margin-left:14rem; */
        position: absolute;
        top: 26rem;
        left:14rem;
    }
    /* Styles pour les écrans de taille inférieure à 768px */
@media (max-width: 767px) {
  .dislike-btn{
    position: absolute;
        top: 27rem;
        left:18rem;
  } 
  .like-btn{
    position: absolute;
        top: 27rem;
        left:17rem;
  }
}
 @media (max-width: 1048px) {
  .dislike-btn{
    position: absolute;
        top: 26rem;
        left:17rem;
  } 
  .like-btn{
    position: absolute;
        top: 26rem;
        left:13rem;
  }
} 


@media (max-width: 460px) {
  .dislike-btn{
    position: absolute;
        top: 25rem;
        left:15rem;
  } 
  .like-btn{
    position: absolute;
        top: 25rem;
        left:8rem;
  }
} 
    
</style>