<?php
class User extends AppModel {

/**
* $validate (vérifie les champs du formulaire d'inscription):
*	allowEmpty = Le champ doit obligatoirement être remplit
*	rule (règle) = 'alphanumeric' || 'email' || 'isUnique' || 'notEmpty'
*/
	public $validate = array(
		'username' => array(
			array('rule' => 'alphanumeric',
				  'required' => true,
				  'allowEmpty' => false,
				  'message' => "Votre pseudonyme n'est pas valide"
			),
			array('rule' => 'isUnique',
				  'message' => "Ce pseudo est déjà pris"
			)
		),
		'email' => array(
			array('rule' => 'email',
				  'required' => true,
				  'allowEmpty' => false,
				  'message' => "Votre adresse email n'est pas valide"
			),
			array('rule' => 'isUnique',
				  'message' => "Cette adresse email est déjà prise"
			)
		),
		'password' => array(
			'rule' => 'notEmpty',
			'allowEmpty' => false,
			'message' => "Vous devez entrer un mot de passe"
		)
	);

}

?>