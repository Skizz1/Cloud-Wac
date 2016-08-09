<h3>Fichiers de <?php echo $username ?></h3>
<table>
      <th class="th">Nom</th>
      <th class="th">Type</th>
      <th class="th">Url</th>
      <th class="th">Taille</th>
      <th class="th">Création</th>
<?php for ($i = 0; $i < count($file); $i++) {
?>
            <tr>
                  <?php echo "<td>".$file[$i]['uploads']['name']."</td>"; ?>
                  <?php echo "<td>".$file[$i]['uploads']['type']."</td>"; ?>
                  <?php echo "<td>".$file[$i]['uploads']['url']."</td>"; ?>
                  <?php echo "<td>".$file[$i]['uploads']['size']."</td>"; ?>
                  <?php echo "<td>".$file[$i]['uploads']['created']."</td>"; ?>
            </tr>
<?php
      }
?>
</table>
