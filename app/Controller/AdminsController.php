<?php

class AdminsController extends AppController {

	function index() {
		$this->bloque();
		$this->admin();
	}

	function bloque() {
		$this->loadmodel('User');
        $logged = AuthComponent::user('role');
		if ($logged != "1") {
        	$this->redirect('/inscription');
        }
	}

	function admin() {
		$this->loadmodel('User');
		$user = $this->User->find('all', array(
			'limit' => '10',
			'order' => array('created' => 'desc')));
		$this->set('user', $user);

		$this->loadmodel('Upload');
		$fichier = $this->Upload->find('all', array(
			'limit' => '10',
			'order' => array('created' => 'desc')));
		$this->set('publies', $fichier);
	}

	function users() {
		$this->bloque();
		$this->loadmodel('User');
		$this->paginate = array(
			'limit' => 10,
			'order' => array('id' => 'desc')
			);
		$user = $this->paginate('User');
		$this->set('user', $user);
	}

	function files() {
		$this->bloque();
		$this->loadmodel('Upload');
		$this->paginate = array(
			'limit' => 10,
			'order' => array('id' => 'desc')
			);
		$file = $this->paginate('Upload');
		$this->set('publies', $file);
	}

	function rule($id) {
		$this->bloque();
		$this->loadmodel('User');
		if ($this->request->is('post')) {
			$post = $this->request->data;
			$this->User->id = $id;
			$rule = $post['role'];
			if ($this->User->saveField('rule', $rule)) {
				$this->Session->setFlash("Le rôle du membre à bien été modifié !", "alert");
				$this->request->data = array();
				$this->redirect('/admins/users');
			} else {
				$this->Session->setFlash("Merci de corriger vos erreurs", "alert", array(
					'type' => 'erreur',
					'icon' => 'croix'));
				$this->redirect('/admins/users');
			}
		}
	}

	function active($id) {
		$this->bloque();
		$this->loadmodel('User');
		if ($this->request->is('post')) {
			$post = $this->request->data;
			$this->User->id = $id;
			$active = $post['active'];
			if ($this->User->saveField('active', $active)) {
				$this->Session->setFlash("Le compte à bien été modifié !", "alert");
				$this->request->data = array();
				$this->redirect('/admins/users');
			} else {
				$this->Session->setFlash("Une erreur est survenue ! Merci de corriger vos erreurs.", "alert", array(
					'type' => 'erreur',
					'icon' => 'croix'));
				$this->redirect('/admins/users');
			}
		}
	}

      function username($username) {
            $this->loadmodel('User');
            $this->loadmodel('Upload');
            $name = $this->User->find('first', array('conditions' => array('username' => $username)));
            $user = $name['User']['id'];
            $file = $this->Upload->query("SELECT uploads.name, uploads.type, uploads.url, uploads.size, uploads.created FROM uploads INNER JOIN users ON uploads.user_id = users.id WHERE users.id = $user");
            $this->set('file', $file);
            $this->set('username', $username);
      }

}

?>
