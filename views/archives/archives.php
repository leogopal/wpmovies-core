 <?php
/**
 * Taxonomies Archive Template
 * 
 * @since    1.2
 * 
 * @uses    $taxonomy
 * @uses    $links
 */

?>

	<ul class="wpmcp archives taxonomy list <?php echo $taxonomy; ?>">
<?php foreach ( $links as $link ) : ?>

		<li class="wpmcp archives taxonomy list item"><a class="wpmcp archives taxonomy list item link" href="<?php echo $link['url']; ?>" title="<?php echo $link['attr_title']; ?>"><span class="wpmcp archives taxonomy list item link title"><?php echo $link['title']; ?></span> <span class="wpmcp archives taxonomy list item link count">(<?php echo $link['count']; ?>)</span></a></li>
<?php endforeach; ?>

	</ul>