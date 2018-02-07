<?php
extract( $instance );
?>
	<p>
		<label for="<?php echo $widget->get_field_id( 'title' ); ?>"><strong class="wpmcp-widget-title"><?php _e( 'Title', 'wpmoviescore' ); ?></strong></label> 
		<input class="widefat" id="<?php echo $widget->get_field_id( 'title' ); ?>" name="<?php echo $widget->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	<p>
		<label for="<?php echo $widget->get_field_id( 'description' ); ?>"><strong class="wpmcp-widget-title"><?php _e( 'Description', 'wpmoviescore' ); ?></strong></label> 
		<textarea class="widefat" id="<?php echo $widget->get_field_id( 'description' ); ?>" name="<?php echo $widget->get_field_name( 'description' ); ?>"><?php echo esc_textarea( $description ); ?></textarea>
	</p>
	<p>
		<label for="<?php echo $widget->get_field_id( 'detail' ); ?>"><strong class="wpmcp-widget-title"><?php _e( 'Detail', 'wpmoviescore' ); ?></strong></label><br />
		<select id="<?php echo $widget->get_field_id( 'detail' ); ?>" name="<?php echo $widget->get_field_name( 'detail' ); ?>">
<?php
$supported = WPMCP_Settings::get_supported_movie_details();
foreach ( $supported as $slug => $s ) :
?>
			<option value="<?php echo $slug ?>" <?php selected( $slug, $detail ); ?>><?php _e( $s['title'], 'wpmoviescore' ); ?></option>

<?php endforeach; ?>
		</select>
	</p>
	<p>
		<input id="<?php echo $widget->get_field_id( 'list' ); ?>" name="<?php echo $widget->get_field_name( 'list' ); ?>" type="checkbox" value="1" <?php checked( $list, 1 ); ?> /> 
		<label for="<?php echo $widget->get_field_id( 'list' ); ?>"><?php _e( 'Show as dropdown', 'wpmoviescore' ); ?></label><br />
		<input id="<?php echo $widget->get_field_id( 'css' ); ?>" name="<?php echo $widget->get_field_name( 'css' ); ?>" type="checkbox" value="1" <?php checked( $css, 1 ); ?> /> 
		<label for="<?php echo $widget->get_field_id( 'css' ); ?>"><?php _e( 'Custom Style (only for dropdown)', 'wpmoviescore' ); ?></label>
	</p>