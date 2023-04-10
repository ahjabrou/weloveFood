<?php
// Connexion à la base de données
$conn = new mysqli('localhost','spcom_userahja', 'B99YIWJRB2KX', 'spcom_ahja');

// Récupération des commentaires avec le pseudo de l'utilisateur
$sql = "SELECT comment.*, utilisateur.pseudo FROM `comment` 
        INNER JOIN `utilisateur` ON comment.iduser = utilisateur.iduser
        WHERE publi_id = ".$_GET['id'];

$result = mysqli_query($conn, $sql);

// Affichage des commentaires avec le pseudo de l'utilisateur
while ($row = mysqli_fetch_assoc($result)) { ?>

  <div class="card mx-auto" style="width:60rem;">
  <div class="card-body">
  <!-- <h5 class="card-title">Commentaires</h5> -->
  <h6 class="card-subtitle mb-2 text-muted"><?php echo $row['date_pub'] ?></h6>
  <p class="card-text"><?php echo $row['texte'] ?> par:</p>
  <p style="color:brown"> <?php echo $row['pseudo'] ?></p>
  </div>
</div>

<?php
}

// Fermeture de la connexion
$conn->close();
?>

