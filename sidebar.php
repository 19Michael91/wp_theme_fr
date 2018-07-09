<div class="right-sidebar col-sm-3">
	<?php
	if ( is_active_sidebar( 'foodrecipe-sidebar' ) ) : ?>
	<ul id="sidebar">
		<?php dynamic_sidebar( 'foodrecipe-sidebar' ); ?>
	</ul><!-- #sidebar -->
	<?php endif; ?>
</div><!-- .right-sidebar -->
