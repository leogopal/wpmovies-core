<?php
/**
 * Empty Template
 * 
 * Showing when there's nothing else to show.
 * 
 * @since    1.2
 * 
 * @uses    $message
 */

if ( ! isset( $message ) )
	$message = __( 'Nothing to display.', 'wpmoviescore' );
?>
	<div class="wpmcp-empty">
		<em><?php echo $message ?></em>
	</div>