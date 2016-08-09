<?php

class UsersController extends AppController {

	function link() {
		if ($this->referer() == '/') {
			$this->redirect(['controller' => 'users', 'action' => 'login']);
		}
	}

	function inscription() {
		$this->link();
		$this->loadmodel('Folder');
		if ($this->request->is('post')) {
			$post = $this->request->data;
			$post['User']['id'] = null;
			$pseudo = $post['User']['username'];
			if (!empty($post['User']['password'])) {
				$post['User']['password'] = Security::hash($post['User']['password'], null, true);
			}
			if ($pseudo == 'Users' || $pseudo == 'users' || $pseudo == 'Files' || $pseudo == 'files') {
				$this->redirect('/inscription', $this->Session->setFlash("Les pseudonyme 'users' et 'files' ne sont pas autorisés", "alert", array(
					'type' => 'erreur',
					'icon' => 'croix')));
			}
			if ($this->User->save($post, true, array('username', 'password', 'name', 'lastname', 'birthdate', 'email'))) {
				$this->redirect("/profil/$pseudo", $this->Session->setFlash("Votre compte a bien été créé, connectez vous !", "alert"));
				$this->request->data = array();
			} else {
				$this->Session->setFlash("Merci de corriger vos erreurs", "alert", array(
					'type' => 'erreur',
					'icon' => 'croix'));
				}
		}
	}

	function login() {
		$this->link();
		if ($this->request->is('post')) {
			$user = $this->request->data;
			$active = $this->User->find('first', array(
			'conditions' => array('username' => $user['User']['username'])));
			if ($active) {
				if ($active['User']['active'] == '1') {
					if ($this->Auth->login()) {
						$this->Session->setFlash("Vous êtes maintenant connecté !", "alert");
						$this->redirect("/profil/".$user['User']['username']);
					} else {
						$this->Session->setFlash("Le pseudonyme ou le mot de passe est incorrect", "alert", array(
							'type' => 'erreur',
							'icon' => 'croix'));
					}
				}
			} else {
				$this->Session->setFlash("Votre compte à été désactivé !", "alert", array(
					'type' => 'erreur',
					'icon' => 'croix'));
			}
		}
	}

	function logout() {
		$this->link();
		$this->Auth->logout();
		$this->redirect(['controller' => 'users', 'action' => 'login']);
	}


}

?>
