<?php
include('admin_connect.php');

// Vérifier si un ID est spécifié dans l'URL
if(isset($_GET['iduser'])) {
    $id = $_GET['iduser'];
        
    // Supprimer les commentaires qui font référence à l'utilisateur
    //     $sql1 = "DELETE FROM comment WHERE iduser = $id";
    //     $result1 = mysqli_query($conn, $sql1);

    //     $sql_avistwo = "DELETE FROM avistwo WHERE iduser = $id";
    //   $result_avistwo = mysqli_query($conn, $sql_avistwo);
    
      $sql_publicationtwo = "DELETE FROM publicationtwo WHERE iduser = $id";
    $result_publicationtwo = mysqli_query($conn, $sql_publicationtwo);
    // Supprimer la ligne correspondant à l'ID spécifié
    $sql = "DELETE FROM utilisateur WHERE iduser = $id";
    $result = mysqli_query($conn, $sql);
  
    if( $result) {
        echo "utilisateur supprimé avec succès.";
        header('Location: utilisateurs.php');
    } else {
        echo "Erreur lors de la suppression de l'utilisateur : " . mysqli_error($conn);
    }
    
    

    exit();
}   

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Supprimer les enregistrements de la table avistwo liés à la publication à supprimer
    $sql_avistwo = "DELETE FROM avistwo WHERE publi_id = $id";
    $result_avistwo = mysqli_query($conn, $sql_avistwo);

    // Supprimer la publication de la table publicationtwo
    $sql_publicationtwo = "DELETE FROM publicationtwo WHERE id = $id";
    $result_publicationtwo = mysqli_query($conn, $sql_publicationtwo);
  
    if($result_publicationtwo) {
        echo "publication supprimée avec succès.";
        header('Location: publications.php');
    } else {
        echo "Erreur lors de la suppression de la publication : " . mysqli_error($conn);
    }

    exit();
    mysqli_close($conn);
}  






?>
