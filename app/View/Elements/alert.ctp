<div class="<?php echo isset($type)? $type : 'valide' ?>">
	<p class="notification">
		<span>
			<?php
				if (isset($icon)) {
					echo '<img src="../img/ic_report_problem_white_24px.svg" alt="error" />';
				} else {
					echo '<img src="../img/ic_done_white_24px.svg" alt="valide" />';
				}
			?>
		</span>
		<?php echo $message; ?>
	</p>
</div>
