<h2>S'inscrire</h2>

<?php echo $this->Form->create("User"); ?>
	<?php echo $this->Form->input('username',array('label' => "Pseudonyme : ")); ?>
	<?php echo $this->Form->input('password',array('label' => "Mot de passe : ")); ?>
	<?php echo $this->Form->input('name',array('label' => "Nom : ")); ?>
	<?php echo $this->Form->input('lastname',array('label' => "Prenom : ")); ?>
	<?php echo $this->Form->input('birthdate',array('label' => "Date d'anniversaire : ")); ?>
	<?php echo $this->Form->input('email',array('label' => "Adresse email : ")); ?>
<?php echo $this->Form->end("Enregistrer"); ?>