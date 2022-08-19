<div class="wrap">
	<h2><?php echo get_admin_page_title() ?></h2>

	<form action="options.php" method="POST">
		<?php
			settings_fields( 'option_group' );
			do_settings_sections( 'npbwsp' );
			submit_button();
		?>
	</form>
</div>
