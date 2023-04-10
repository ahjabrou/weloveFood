<?php
$conn = mysqli_connect($servername, $username, $password, $dbname);

if(isset($_GET['t'],$_GET['id']) AND !empty($_GET['t']) AND !empty($_GET['id'])){
    $getid =(int) $_GET['id'];
    $gett =(int) $_GET['t'];
    $check = $conn->prepare("SELECT id FROM publicationtwo WHERE id = ?");
    $check->execute(array($getid));

    if($check->rowCount() == 1){
        if ($gett == 1) {
            $ins = $conn->prepare("INSERT INTO likes (id) VALUES('')");
            $ins->execute(array($getid));
        } else if($gett == 2) {
            $ins = $conn->prepare("INSERT INTO dislikes (id) VALUES('')");
            $ins->execute(array($getid));
        }
        header('location: visuel.php?id='.$getid);   
    }
    // else{
    //     exit('Erreur fatale. <a href="http://localhost:8888/brief1/">Revenir à l \'accueil</a>');
    // }
}
// else{
//     exit('Erreur fatale. <a href="http://localhost:8888/brief1/">Revenir à l \'accueil</a>');
// } 

?>