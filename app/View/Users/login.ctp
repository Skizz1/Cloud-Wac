<h2>Se connecter</h2>

<?php echo $this->Form->create("User"); ?>
	<?php echo $this->Form->input('username',array('label' => "Pseudonyme : ")); ?>
	<?php echo $this->Form->input('password',array('label' => "Mot de passe : ")); ?>
<?php echo $this->Form->end("Connexion"); ?>