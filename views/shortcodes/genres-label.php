<?php
/**
 * Labeled Genres Shortcode view Template
 * 
 * Showing a specific movie genres.
 * 
 * @since    1.2
 * 
 * @uses    $title
 * @uses    $genres
 */
?>

	<div class="wpmcp shortcode block">
		<span class="wpmcp shortcode item genre title"><?php echo $title ?></span>
		<span class="wpmcp shortcode item genre value"><?php echo $genres ?></span>
	</div>
