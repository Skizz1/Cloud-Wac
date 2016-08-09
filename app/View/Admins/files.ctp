<ul class="nav-admin">
	<li><?php echo $this->Html->link("Fichiers", array('controller' => 'admins', 'action' => 'files')); ?></li>
	<li><?php echo $this->Html->link("Utilisateurs", array('controller' => 'admins', 'action' => 'users')); ?></li>
	<li><?php echo $this->Html->link("Accueil", array('controller' => 'admins', 'action' => 'index')); ?></li>
</ul>
<?php $paginator = $this->Paginator; ?>
<div id="container">
	<div id=contenu>
		<h3>Fichiers publiés</h3>
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
</div
