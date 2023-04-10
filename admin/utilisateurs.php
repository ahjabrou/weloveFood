<?php
include ('admin_connect.php');
include('admin.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs</title>
</head>
<body>
    <div class="container">
    <table id="" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Pseudo</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
  <?php
      // Requête SQL pour récupérer les données
      $sql = "SELECT * FROM utilisateur";
      $result1 = mysqli_query($conn, $sql);

      // Boucle pour afficher les données dans le tableau
      while($row = mysqli_fetch_assoc($result1)) {
        echo "<tr>";
        echo "<td>" . $row['iduser'] . "</td>";
        echo "<td>" . $row['nom'] . "</td>";
        echo "<td>" . $row['pseudo'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td><a href='delete.php?iduser=".$row['iduser']."' class='btn btn-warning' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')\">Supprimer</a></td>";
        echo "</tr>";
      }
    ?>

</tbody>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Pseudo</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>      
    <script>
        $(document).ready(function () {
    $('table.display').DataTable();
});
    </script>
    <style>
        div.dataTables_wrapper {
        margin-bottom: 3em;
    }
    </style>
</div>
</body>
<?php
include ("admin_footer.php");
?>
</html>