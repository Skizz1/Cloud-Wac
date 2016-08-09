<?php

class UploadsController extends AppController {

	function profil() {
		$this->loadmodel('User');
		$this->loadmodel('Folder');
		$user = AuthComponent::user('id');
		$username = AuthComponent::user('username');
		$file = $this->Upload->find('all', array('conditions' => array('user_id' => $user,'id_folder' => '0')));
		$follder = $this->Folder->find('all', array('conditions' => array('user_id' => $user)));
		$select = $this->Folder->query("SELECT * FROM folders");
		$tab=[];
		for ($i=0; $i < count($follder); $i++) {
			$idfolder = $follder[$i]["Folder"]["id"];
			$upload = $this->Upload->find('all', array('conditions' => array('id_folder' => $idfolder)));
			$tab=array_merge($tab,[$follder[$i]["Folder"]["name"] => $upload]);
		}
		$dbsize = $this->Upload->query("SELECT SUM(size) 'total' FROM uploads WHERE user_id = $user");
		$mo = ($dbsize[0][0]['total'] / 1024) / 1024;
		$round = round($mo, 1);
		$this->set('file', $file);
		$this->set('username', $username);
		$this->set('round', $round);
		$this->set('folder', $tab);
		$this->set('select', $select);
		return $user;
	}

	function newfolder() {
		$id = $this->profil();
		$this->loadmodel('Folder');
		$username = AuthComponent::user('username');
		if ($this->request->is('post')) {
			$post = $this->request->data['Upload']['folder'];
			$name = str_replace("/", "", $post);
			$directory = "files/ID:$id/$name";
			if (!file_exists($directory)) {
				mkdir($directory);
				chmod($directory, 0777);
				$save = ['user_id' => $id,'url' => "$directory",'name' => $name];

				$this->Folder->create();
				if ($this->Folder->save($save, true, array('user_id', 'url', 'name'))) {
					$this->redirect("/profil/$username", $this->Session->setFlash("Le dossier à bien été créé.", "alert"));
				}
			} else {
				$this->Session->setFlash("Le nom de dossier existe déjà.", "alert", array('type' => 'erreur','icon' => 'croix'));
			}
		}

	}

	function lookfile($id) {
		$this->profil();
		$this->loadmodel('User');
		$recup = $this->Upload->find('first', array('conditions' => array('id' => $id)));
		$this->set('url', $recup);
	}

	function upload() {
		$this->profil();
		$select = $this->Folder->query("SELECT * FROM folders");
		if ($this->request->is('post')) {
			$post = $this->request->data;
			$dossier = $post['folder'];
			$user = AuthComponent::user('id');
			$username = AuthComponent::user('username');
			$directory = "files/ID:$user/$dossier";
			$maxmb = '52428800';
			$minmb = '10485760';
			$dbsize = $this->Upload->query("SELECT SUM(size) 'total' FROM uploads WHERE user_id = $user");

			$taille = $dbsize[0][0]["total"];
			for ($h=0; $h < count($post['Upload']['files']) ; $h++) {
				$taille += $post['Upload']['files'][$h]['size'];
			}

			if (!file_exists($directory)) {
				mkdir($directory);
				chmod($directory, 0777);
			}

			if ($taille <= $maxmb) {
				for ($i=0; $i < count($post['Upload']) ; $i++) {
					if ($post['Upload']['files'][$i]['size'] <= $minmb) {
						$tmp_name = $post['Upload']['files'][$i]['tmp_name'];
						$name = $post['Upload']['files'][$i]['name'];
						$type = $post['Upload']['files'][$i]['type'];
						$size = $post['Upload']['files'][$i]['size'];
						move_uploaded_file($tmp_name, "$directory/$name");
						chmod("$directory/$name", 0777);
						if ($dossier != '') {
							$value = $this->Folder->find('first', array('conditions' => array('name' => $dossier)));
							$id_folder = $value['Folder']['id'];
							$direct = "files/ID:$user";
							$save = ['user_id' => $user,'id_folder' => $id_folder,'url' => "$direct/$name",'name' => $name,'type' => $type,'size' => $size];
							
						} else {
							$save = ['user_id' => $user,'id_folder' => '0','url' => "$directory/$name",'name' => $name,'type' => $type,'size' => $size];
						}
						$this->Upload->create();
						if ($this->Upload->save($save, true, array('user_id', 'id_folder', 'url', 'name', 'type', 'size'))) {
							$this->redirect("/profil/$username", $this->Session->setFlash("Le fichier à bien été uploadé.", "alert"));
						}

					} else {
						$this->Session->setFlash("La taille du fichier ne doit pas dépasser 10MB.", "alert", array('type' => 'erreur','icon' => 'croix'));
					}
				}

			} else {
				$this->Session->setFlash("La taille total du/des fichier(s) ne doivent pas être superieur à 50MB.", "alert", array('type' => 'erreur','icon' => 'croix'));
			}
		}
		$this->set('select', $select);
	}

	function update($id) {
		$this->lookfile($id);
		$recup = $this->Upload->find('first', array('conditions' => array('id' => $id)));
		$user = AuthComponent::user('id');
		$username = AuthComponent::user('username');
		if ($recup === []) {
			$this->redirect("/profil/$username");
		}
		$select = $this->Folder->query("SELECT * FROM folders");
		$this->set('filename', $recup['Upload']['name']);
		$this->set('select', $select);
		if ($user === $recup['Upload']['user_id']) {
			if ($this->request->is('post')) {
				$post = $this->request->data;
				$dossier = $post['folder'];
				$name = $post['Upload']['name'];

				if ($dossier != '') {
					$namefolder = $this->Folder->query("SELECT * FROM folders WHERE id = $dossier");
					$folder = $namefolder[0]['folders']['name'];
					$url = "files/ID:$user/$folder/$name";
					$save = ['id' => $recup['Upload']['id'], 'id_folder' => $dossier, 'url' => $url, 'name' => $name];
					if ($this->Upload->save($save, true, array('id', 'id_folder', 'url', 'name'))) {
						rename($recup['Upload']['url'], WWW_ROOT."files/ID:$user/$folder/$name");
						$this->Session->setFlash("Votre fichier à bien été modifié", "alert");
						$this->request->data = array();
						$this->redirect("/profil/$username");
					} else {
						$this->Session->setFlash("Merci de corriger vos erreurs", "alert", array('type' => 'erreur','icon' => 'croix'));
					}
				} else {
					$urlvide = "files/ID:$user/$name";
					$save = ['id' => $recup['Upload']['id'], 'id_folder' => '0', 'url' => $urlvide, 'name' => $name];
					if ($this->Upload->save($save, true, array('id', 'id_folder', 'url', 'name'))) {
						rename($recup['Upload']['url'], WWW_ROOT."files/ID:$user/$name");
						$this->Session->setFlash("Votre fichier à bien été modifié", "alert");
						$this->request->data = array();
						$this->redirect("/profil/$username");
					} else {
						$this->Session->setFlash("Merci de corriger vos erreurs", "alert", array('type' => 'erreur','icon' => 'croix'));
					}
				}
			}
		} else {
			$this->Auth->logout();
			$this->redirect(['controller' => 'users', 'action' => 'login']);
		}
	}

	function delete($id) {
		$recup = $this->Upload->find('first', array('conditions' => array('id' => $id)));
		$user = AuthComponent::user('id');
		$username = AuthComponent::user('username');

		if ($user === $recup['Upload']['user_id']) {
			$delete = $recup['Upload']['url'];
			unlink($delete);
			$this->Upload->delete($id);
			$this->redirect("/profil/$username", $this->Session->setFlash("Votre fichier, ".$recup['Upload']['name'].", à bien été supprimer", "alert"));
		} else {
			$this->Auth->logout();
			$this->redirect(['controller' => 'users', 'action' => 'login']);
		}
	}


}
?>
