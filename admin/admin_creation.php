<?php
include 'admin_connect.php';

$psw='ahjaboring';
$psw_crypt=password_hash($psw, PASSWORD_DEFAULT);

$sql = "INSERT INTO `admin` (nom,admin, psw) VALUES ('ahja','ahjagraceermadinebrou@gmail.com', '$psw_crypt')";
mysqli_query($conn, $sql);
?>
