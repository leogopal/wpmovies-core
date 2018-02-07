<?php
/**
 * Movie Metadata view Template
 * 
 * Showing a movie's head box, Allociné style.
 * 
 * @since    2.1.4
 * 
 * @uses    $id
 * @uses    $theme
 * @uses    $title
 * @uses    $menu
 * @uses    $tabs
 */
?>

	<div id="movie-headbox-<?php echo $id ?>" class="wpmcp block headbox allocine contained <?php echo $theme ?>">
		<div class="wpmcp headbox allocine movie">
			<div class="wpmcp headbox allocine movie section title">
<?php if ( ! empty( $title ) ) : ?>
				<h2 class="wpmcp headbox allocine movie meta title"><?php echo $title; ?></h2>
<?php endif; ?>
			</div>
<?php echo $menu; ?>

<?php echo $tabs; ?>

		</div>
		<div style="clear:both"></div>
	</div>
