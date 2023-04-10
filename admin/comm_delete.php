<?php
include('admin_connect.php');
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql_comment = "DELETE FROM comment WHERE id = $id";
    $result_comment = mysqli_query($conn, $sql_comment);
  
    if($result_comment) {
        echo "commentaire supprimé avec succès.";
        header('Location: commentaires.php');
    } else {
        echo "Erreur lors de la suppression du commentaire : " . mysqli_error($conn);
    }

    exit();
    mysqli_close($conn);
}
?>