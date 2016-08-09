<ul class="nav-admin">
	<li><?php echo $this->Html->link("Fichiers", array('controller' => 'admins', 'action' => 'files')); ?></li>
	<li><?php echo $this->Html->link("Accueil", array('controller' => 'admins', 'action' => 'index')); ?></li>
</ul>
<?php $paginator = $this->Paginator; ?>
<div id="container">
	<div id=contenu>
		<h3>Utilisateurs inscrits</h3>
		<table>
			<th class="th">Pseudo</th>
			<th class="th">Nom</th>
			<th class="th">Prénom</th>
			<th class="th">Email</th>
			<th class="th">Inscription</th>
			<th class="th">Active/Désactive</th>
			<th class="th">Rôle</th>
			<?php for ($i = 0; $i < count($user); $i++) {
                        $username = $user[$i]['User']['username'];
				?>
				<tr>
					<?php echo "<td>".$this->Html->link($user[$i]['User']['username'], array('controller'=>'admins', 'action'=> 'username/'.$user[$i]['User']['username']))."</td>"; ?>
					<?php echo "<td>".$user[$i]['User']['name']."</td>"; ?>
					<?php echo "<td>".$user[$i]['User']['lastname']."</td>"; ?>
					<?php echo "<td>".$user[$i]['User']['email']."</td>"; ?>
					<?php echo "<td>".$user[$i]['User']['created']."</td>"; ?>
					<?php echo "<td>".$user[$i]['User']['active']; ?>
					<?php echo $this->Form->create('Admin', array('action' => 'active/'.$user[$i]['User']['id'])); ?>
						<select name="active">
							<option value="0">0</option>
							<option value="1">1</option>
						</select>
						<?php echo $this->Form->end('Valider')."</td>"; ?>
					<?php echo "<td>".$user[$i]['User']['role']; ?>
						<?php echo $this->Form->create('Admin', array('action' => 'rule/'.$user[$i]['User']['id'])); ?>
						<select name="role">
							<option value="1">Admin</option>
							<option value="2">Utilisateur</option>
						</select>
						<?php echo $this->Form->end('Valider')."</td>"; ?>
				</tr>
				<?php
			}
			?>
		</table>
	</div>
	<?php
	echo "<div class='paging'>";

        // the 'first' page button
	echo $paginator->first("First");

        // 'prev' page button,
        // we can check using the paginator hasPrev() method if there's a previous page
        // save with the 'next' page button
	if($paginator->hasPrev()){
		echo $paginator->prev("Prev");
	}

        // the 'number' page buttons
	echo $paginator->numbers(array('modulus' => 2));

        // for the 'next' button
	if($paginator->hasNext()){
		echo $paginator->next("Next");
	}

        // the 'last' page button
	echo $paginator->last("Last");

	echo "</div>";
	?>
</div>
