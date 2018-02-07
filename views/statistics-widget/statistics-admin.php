<?php
extract( $instance );
?>
	<p>
		<label for="<?php echo $widget->get_field_id( 'title' ); ?>"><h4 class="wpmcp-widget-title"><?php _e( 'Title', 'wpmoviescore' ); ?></h4></label> 
		<input class="widefat" id="<?php echo $widget->get_field_id( 'title' ); ?>" name="<?php echo $widget->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	<p>
		<label for="<?php echo $widget->get_field_id( 'description' ); ?>"><h4 class="wpmcp-widget-title"><?php _e( 'Description', 'wpmoviescore' ); ?></h4></label> 
		<textarea class="widefat" id="<?php echo $widget->get_field_id( 'description' ); ?>" name="<?php echo $widget->get_field_name( 'description' ); ?>"><?php echo esc_textarea( $description ); ?></textarea>
	</p>
	<p>
		<label for="<?php echo $widget->get_field_id( 'format' ); ?>"><h4 class="wpmcp-widget-title"><?php _e( 'Format', 'wpmoviescore' ); ?></h4></label>
		<em><?php _e( 'You can edit the format of the Widget\'s content; basic HTML tags are allowed (ul, ol, li, p, span, em, i, p, strong, b, br). Format Tags are:', 'wpmoviescore' ) ?></em><br />
		<ul>
			<li><em><code>{total}</code>: <?php _e( 'Total number of movies', 'wpmoviescore' ) ?>.</em></li>
			<li><em><code>{collections}</code>: <?php _e( 'Number of Collections.', 'wpmoviescore' ) ?></em></li>
			<li><em><code>{genres}</code>: <?php _e( 'Number of Genres.', 'wpmoviescore' ) ?></em></li>
			<li><em><code>{actors}</code>: <?php _e( 'Number of Actors.', 'wpmoviescore' ) ?></em></li>
		</ul>
		<textarea class="widefat" id="<?php echo $widget->get_field_id( 'format' ); ?>" name="<?php echo $widget->get_field_name( 'format' ); ?>"><?php echo wp_kses( $format, array( 'ul' => array(), 'ol' => array(), 'li' => array(), 'p' => array(), 'span' => array(), 'em' => array(), 'i' => array(), 'p' => array(), 'strong' => array(), 'b' => array(), 'br' => array() ) ); ?></textarea>
	</p>
