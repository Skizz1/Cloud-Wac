<div class="container">
	<div class="row">
		<div id="left" class="span3">
			<ul id="menu-group-1" class="nav menu">
				<li class="item-8 deeper parent active border">
					<a style="padding: 16px 49px 4px 11px; background-color: #ed145b;">
						<span data-toggle="collapse" data-parent="#menu-group-1" href="#sub-item-1" class="sign" >
							<img src="<?php echo $this->webroot.'img/home.png' ?>" />
						</span>
						<span class="lbl" style="color: white; position: relative; bottom: 6px;"><?php echo $username; ?></span>
						<span class="text-right"><?php echo $round." / 50 Mo utilisés" ?></span>
					</a>

					<ul class="children nav-child unstyled small collapse" id="sub-item-2">
						<?php
						for ($i=0; $i < count($file) ; $i++) {
							if ($file[$i]['Upload']['id_folder'] == 0) {
								$name = $file[$i]['Upload']['name'];
							}
							?>
							<li class="item-2 deeper parent active plein">
								<span data-toggle="collapse" data-parent="#menu-group-2" class="sign" style="background-color: #00aeef;">
									<img class="icon-file" src="<?php echo $this->webroot.'img/file.png' ?>" />
								</span>
								<span class="lbl" style="color: #004b66;"><?php echo $this->Html->link($name, array('action' => 'lookfile', 'controller' => 'uploads', 'id' => $file[$i]['Upload']['id']), array('class' => 'linkfile')); ?></span>
							</li>
							<?php
						}
						?>
					</ul>

					<?php

					foreach ($folder as $key => $value) {

						?>
						<ul id="menu-group-2" class="nav menu">
							<li class="item-1 deeper parent active">
								<a style="background-color: #ed145b; width: 33%;">
									<span data-toggle="collapse" data-parent="#menu-group-2" href="#sub-item-2" class="sign" style="background-color: #ed145b;">
										<img src="<?php echo $this->webroot.'img/folder-multiple.png' ?>" />
									</span>
									<span class="lbl" style="color: white; position: relative; bottom: 6px;"><?php echo $key; ?></span>
								</a>

								<?php
								for ($i=0; $i <count($value) ; $i++) {
									?>
								<ul class="children nav-child unstyled small collapse" id="sub-item-2">

									<li class="item-2 deeper parent active plein">
										<span data-toggle="collapse" data-parent="#menu-group-2" class="sign" style="background-color: #00aeef;">
											<img class="icon-file" src="<?php echo $this->webroot.'img/file.png' ?>" />
										</span>

										<span class="lbl" style="color: #004b66;"><?php echo $this->Html->link($value[$i]["Upload"]["name"], array('action' => 'lookfile', 'controller' => 'uploads', 'id' => $value[$i]["Upload"]["id"]), array('class' => 'linkfile')); ?></span>
									</li>

								</ul>
							<?php } ?>
							</ul>
							<?php  /*debug($tab);*/
						}
							?>
						</li>
					</ul>



		</div>
            <div class="file">
            	<h3 class="center">Nouveau dossier</h3>

            	<?php echo $this->Form->create("Upload"); ?>
                  <?php echo $this->Form->input('folder', array('label' => 'Nom du nouveau dossier :', 'required')); ?>
            	<?php echo $this->Form->end("Créer"); ?>
            </div>
	</div>
</div>
