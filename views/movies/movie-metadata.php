<?php
/**
 * Movie Metadata view Template
 * 
 * Showing a movie's metadata.
 * 
 * @since    1.2
 * 
 * @uses    $items
 */
?>

	<div class="wpmcp block meta">
		<dl class="wpmcp movie">
<?php foreach ( $items as $item ) : ?>
			<dt class="wpmcp movie meta <?php echo $item['slug'] ?> title"><?php echo $item['title'] ?></dt>
			<dd class="wpmcp movie meta <?php echo $item['slug'] ?> value"><?php echo $item['value'] ?></dd>

<?php endforeach; ?>
		</dl>
	</div>
