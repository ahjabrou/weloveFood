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
  <title>Publications</title>
</head>

<body>
  <div class="container">
    <table id="" class="display" style="width:100%">
      <thead>
        <tr>
          <th>id</th>
          <th>titre</th>
          <th>fonction</th>
          <th>imagepub</th>
          <th>texte</th>
          <th>utilisateur ID</th>
          <th>actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Requête SQL pour récupérer les données
        $sql = "SELECT * FROM publicationtwo";
        $result2 = mysqli_query($conn, $sql);

        // Boucle pour afficher les données dans le tableau
        while ($row = mysqli_fetch_assoc($result2)) {
          echo "<tr>";
          echo "<td>" . $row['id'] . "</td>";
          echo "<td>" . $row['titre'] . "</td>";
          echo "<td>" . $row['fonction'] . "</td>";
          echo "<td>" . $row['imagepub'] . "</td>";
          echo "<td>" . $row['texte'] . "</td>";
          echo "<td>" . $row['iduser'] . "</td>";
          echo "<td><a href='delete.php?id=" . $row['id'] . "' class='btn btn-warning' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer cette publication ?')\">Supprimer</a></td>";
          echo "</tr>";
        }
        ?>

      </tbody>
      <tfoot>
        <tr>
          <th>id</th>
          <th>titre</th>
          <th>fonction</th>
          <th>imagepub</th>
          <th>texte</th>
          <th>utilisateur ID</th>
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