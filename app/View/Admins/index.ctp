
<ul class="nav-admin">
	<li><?php echo $this->Html->link("Fichiers", array('controller' => 'admins', 'action' => 'files')); ?></li>
	<li><?php echo $this->Html->link("Utilisateurs", array('controller' => 'admins', 'action' => 'users')); ?></li>
</ul>
<div id="container">
	<div id=contenu>
		<h3>10 derniers utilisateurs inscrits</h3>
		<table>
			<th class="th">Pseudo</th>
			<th class="th">Nom</th>
			<th class="th">Prénom</th>
			<th class="th">Email</th>
			<th class="th">Inscription</th>
		<?php for ($i = 0; $i < count($user); $i++) {
		?>
				<tr>
					<?php echo "<td>".$user[$i]['User']['username']."</td>"; ?>
					<?php echo "<td>".$user[$i]['User']['name']."</td>"; ?>
					<?php echo "<td>".$user[$i]['User']['lastname']."</td>"; ?>
					<?php echo "<td>".$user[$i]['User']['email']."</td>"; ?>
					<?php echo "<td>".$user[$i]['User']['created']."</td>"; ?>
				</tr>
		<?php
			}
		?>
		</table>
	</div>
	<div>
		<h3>10 derniers fichiers publiés</h3>
		<table>
			<th class="th">Nom</th>
			<th class="th">Type</th>
			<th class="th">Taille</th>
			<th class="th">Création</th>
		<?php for ($i = 0; $i < count($publies); $i++) {
		?>
				<tr>
					<?php echo "<td>".$publies[$i]['Upload']['name']."</td>"; ?>
					<?php echo "<td>".$publies[$i]['Upload']['type']."</td>"; ?>
					<?php echo "<td>".$publies[$i]['Upload']['size']."</td>"; ?>
					<?php echo "<td>".$publies[$i]['Upload']['created']."</td>"; ?>
				</tr>
		<?php
			}
		?>
		</table>
	</div>
</div>
