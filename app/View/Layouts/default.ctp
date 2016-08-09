<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

// $cakeDescription = __d('cake_dev', 'Blog - CakePHP');
// 		$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php // echo $cakeDescription ?>
		<?php // echo $this->fetch('title'); ?>
		Cloud@cadémie
	</title>
	<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>-->
	<?php
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	echo $this->Html->meta('icon');
	echo $this->Html->css('cake.generic');
	echo $this->Html->script('jquery');
	echo $this->Html->script('upload');
	?>

</head>
<body>
	<div id="container">
		<div id="header">
			<div class="menu">
				<h1><?php //echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1>

				<ul class="account" style="margin-top: 20px;">
					<?php if (AuthComponent::user('id')): ?>
						<span><?php echo 'Bonjour '.AuthComponent::user('username'); ?></span>
						<!--<li>
							<?php //echo $this->Html->link("uploads", array('action' => 'upload', 'controller' => 'uploads')); ?>
						</li>-->
						<li><?php echo $this->Html->link("Se déconnecter", array('action' => 'logout', 'controller' => 'users')); ?>
						</li>
					<?php else: ?>
						<li><?php echo $this->Html->link("S'inscrire", array('action' => 'inscription', 'controller' => 'users')); ?>
						</li>
						<li><?php echo $this->Html->link("Se connecter", array('action' => 'login', 'controller' => 'users')); ?>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
		<div id="content">
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php //echo $this->Html->link(
					//$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					//'http://www.cakephp.org/',
					//array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
				//);
			?>
			<p>
				<?php //echo $cakeVersion; ?>
			</p>
		</div>
	</div>
	<?php // echo $this->element('sql_dump'); ?>
</body>
</html>
