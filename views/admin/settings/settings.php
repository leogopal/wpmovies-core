<div id="wpmcp-settings" class="wrap">

	<h2><?php esc_html_e( WPMCP_NAME ); ?> Settings</h2>

	<?php settings_errors(); ?>

	<div id="wpmcp-tabs">

		<form action="options.php" method="post">

			<ul class="wpmcp-tabs-nav">
			    <li class="wpmcp-tabs-nav<?php if ( 'api' == $_section || '' == $_section ) echo ' active'; ?>"><a href="<?php echo admin_url( 'admin.php?page=wpmcp_edit_settings&amp;wpmcp_section=api#wpmcp_section_api' ) ?>" data-section="wpmcp_section=api"><h4><?php _e( 'API', 'wpmoviescore' ); ?></h4></a></li>
			    <li class="wpmcp-tabs-nav<?php if ( 'movies' == $_section ) echo ' active'; ?>"><a href="<?php echo admin_url( 'admin.php?page=wpmcp_edit_settings&amp;wpmcp_section=wpmcp#wpmcp_section_wpmcp' ) ?>" data-section="wpmcp_section=wpmcp"><h4><?php _e( 'Movies', 'wpmoviescore' ); ?></h4></a></li>
			    <li class="wpmcp-tabs-nav<?php if ( 'images' == $_section ) echo ' active'; ?>"><a href="<?php echo admin_url( 'admin.php?page=wpmcp_edit_settings&amp;wpmcp_section=images#wpmcp_section_images' ) ?>" data-section="wpmcp_section=images"><h4><?php _e( 'Images', 'wpmoviescore' ); ?></h4></a></li>
			    <li class="wpmcp-tabs-nav<?php if ( 'taxonomies' == $_section ) echo ' active'; ?>"><a href="<?php echo admin_url( 'admin.php?page=wpmcp_edit_settings&amp;wpmcp_section=taxonomies#wpmcp_section_taxonomies' ) ?>" data-section="wpmcp_section=taxonomies"><h4><?php _e( 'Taxonomies', 'wpmoviescore' ); ?></h4></a></li>
			    <li class="wpmcp-tabs-nav<?php if ( 'deactivate' == $_section ) echo ' active'; ?>"><a href="<?php echo admin_url( 'admin.php?page=wpmcp_edit_settings&amp;wpmcp_section=deactivate#wpmcp_section_deactivate' ) ?>" data-section="wpmcp_section=deactivate"><h4><?php _e( 'Deactivate', 'wpmoviescore' ); ?></h4></a></li>
			    <li class="wpmcp-tabs-nav<?php if ( 'uninstall' == $_section ) echo ' active'; ?>"><a href="<?php echo admin_url( 'admin.php?page=wpmcp_edit_settings&amp;wpmcp_section=uninstall#wpmcp_section_uninstall' ) ?>" data-section="wpmcp_section=uninstall"><h4><?php _e( 'Uninstall', 'wpmoviescore' ); ?></h4></a></li>
			    <li class="wpmcp-tabs-nav<?php if ( 'cache' == $_section ) echo ' active'; ?>"><a href="<?php echo admin_url( 'admin.php?page=wpmcp_edit_settings&amp;wpmcp_section=cache#wpmcp_section_cache' ) ?>" data-section="wpmcp_section=cache"><h4><?php _e( 'Cache', 'wpmoviescore' ); ?></h4></a></li>
			    <li class="wpmcp-tabs-nav<?php if ( 'legacy' == $_section ) echo ' active'; ?>"><a href="<?php echo admin_url( 'admin.php?page=wpmcp_edit_settings&amp;wpmcp_section=legacy#wpmcp_section_legacy' ) ?>" data-section="wpmcp_section=legacy"><h4><?php _e( 'Legacy', 'wpmoviescore' ); ?></h4></a></li>
			    <li class="wpmcp-tabs-nav<?php if ( 'maintenance' == $_section ) echo ' active'; ?>"><a href="<?php echo admin_url( 'admin.php?page=wpmcp_edit_settings&amp;wpmcp_section=maintenance#wpmcp_section_maintenance' ) ?>" data-section="wpmcp_section=maintenance"><h4><?php _e( 'Maintenance', 'wpmoviescore' ); ?></h4></a></li>
			</ul>

<?php settings_fields( 'wpmcp_edit_settings' ); ?>

			<div class="wpmcp-tabs-panels">

<?php do_settings_sections( 'wpmcp_settings' ); ?>

				<h3><?php _e( 'Maintenance', 'wpmoviescore' ); ?></h3>
				<span id="wpmcp_section_maintenance"></span>
				<table class="form-table" style="display: none;">
					<tbody>
						<tr>
							<th scope="row"><?php _e( 'Restore Default Settings', 'wpmoviescore' ); ?></th>
							<td>
								<p class="description"><?php _e( 'You may want to restore WPMoviesCore default settings.', 'wpmoviescore' ); ?></p>
								<p class="description"><?php _e( '<strong>Caution!</strong> Doing this you will erase permanently all your custom settings. Don&rsquo;t do this unless you are positively sure of what you&rsquo;re doing!', 'wpmoviescore' ); ?></p>
								<p style="text-align:center">
									<a href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=wpmcp_edit_settings&wpmcp_section=maintenance&wpmcp_restore_default=true' ), 'wpmcp-restore-default-settings', '_nonce') ?>" class="button button-secondary"><?php _e( 'Restore', 'wpmoviescore' ) ?></a>
								</p>
								
							</td>
						</tr>
						<tr>
							<th scope="row"><?php _e( 'Empty Cache', 'wpmoviescore' ); ?></th>
							<td>
								<p class="description"><?php _e( 'Delete all temporarily stored data. This can solve issues like incomplete movie metadata repeatedly returned, outdated Widgets or Shortcodes display...', 'wpmoviescore' ); ?></p>
								<p style="text-align:center">
									<a href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=wpmcp_edit_settings&wpmcp_section=maintenance&wpmcp_empty_cache=true' ), 'wpmcp-empty-cache', '_nonce') ?>" class="button button-secondary"><?php _e( 'Empty cache', 'wpmoviescore' ) ?></a>
								</p>
							</td>
						</tr>
					</tbody>
				</table>

			</div>

			<p class="submit">
				<input type="hidden" name="<?php echo WPMCP_SETTINGS_SLUG . '[' . WPMCP_SETTINGS_REVISION_NAME . ']' ?>" id="<?php echo WPMCP_SETTINGS_REVISION_NAME ?>" value="<?php echo WPMCP_SETTINGS_REVISION ?>" />
				<input type="submit" name="submit" id="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes' ); ?>" />
			</p>

		</form>

	</div>

	<?php echo self::render_admin_template( 'help.php' ); ?>

</div> <!-- .wrap -->