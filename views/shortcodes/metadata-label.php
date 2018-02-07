<?php
/**
 * Labeled Metadata Shortcode view Template
 * 
 * Showing a specific movie metadata.
 * 
 * @since    1.2
 * 
 * @uses    $movies
 */
?>

	<div class="wpmcp shortcode block">
		<span class="wpmcp shortcode item meta <?php echo $key ?> title"><?php echo $title ?></span>
		<span class="wpmcp shortcode item meta <?php echo $key ?> value"><?php echo $meta ?></span>
	</div>
