<?php
include('admin_connect.php');
include('admin.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Commentaires</title>
</head>

<body>
  <div class="container">
  <table id="" class="display" style="width:100%">
      <thead>
        <tr>
          <th>id</th>
          <th>texte</th>
          <th>date de publication</th>
          <th>id de publication</th>
          <th>id de l'utilisateur</th>
          <th>actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Requête SQL pour récupérer les données
        $sql = "SELECT * FROM comment";
        $result3 = mysqli_query($conn, $sql);

        // Boucle pour afficher les données dans le tableau
        while ($row = mysqli_fetch_assoc($result3)) {
          echo "<tr>";
          echo "<td>" . $row['id'] . "</td>";
          echo "<td>" . $row['texte'] . "</td>";
          echo "<td>" . $row['date_pub'] . "</td>";
          echo "<td>" . $row['publi_id'] . "</td>";
          echo "<td>" . $row['iduser'] . "</td>";
          echo "<td><a href='comm_delete.php?id=" . $row['id'] . "' class='btn btn-warning' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')\">Supprimer</a></td>";
          echo "</tr>";
        }
        ?>

      </tbody>
      <tfoot>
        <tr>
          <th>id</th>
          <th>texte</th>
          <th>date de publication</th>
          <th>id de publication</th>
          <th>id de l'utilisateur</th>
          <th>actions</th>
        </tr>
      </tfoot>
    </table>
    <script>
      $(document).ready(function() {
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
include("admin_footer.php");
?>

</html>