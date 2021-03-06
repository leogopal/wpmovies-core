
							<div id="wpmcp-most-rated-movies-widget-config"<?php if ( ! $editing ) echo ' class="main-config"'; ?>>
								<form method="post" action="<?php echo admin_url( "admin.php?page=wpmoviescore#{$widget_id}" ) ?>">
									<?php wpmcp_nonce_field( "save-{widget_id}" ) ?>
									<?php wpmcp_nonce_field( 'load-more-widget-movies' ) ?>
									<table class="wp-list-table">
										<tbody>
											<tr>
												<td colspan="3">
													<em><?php _e( 'Use the following options to customize this Widget.', 'wpmoviescore' ) ?></em>
												</td>
											</tr>
											<tr>
												<td style="vertical-align:top;width:20%">
													<label><strong><?php _e( 'Number of movies:', 'wpmoviescore' ) ?></strong>
													<br /><input step="1" min="1" max="999" class="screen-per-page" name="<?php echo $widget_id ?>[movies_per_page]" id="most_rated_movies_movies_per_page" maxlength="3" value="<?php echo $settings['movies_per_page'] ?>" type="number" /> <?php _e( 'movies', 'wpmoviescore' ) ?></label>
												</td>
												<td style="vertical-align:top;width:40%">
													<label><input id="most_rated_movies_show_year" name="<?php echo $widget_id ?>[show_year]"<?php checked( $settings['show_year'], '1' ) ?> type="checkbox" value="1" /> <strong><?php _e( 'Show year', 'wpmoviescore' ) ?></strong></label><br />
													<em><?php _e( 'Show movies release years below the poster.', 'wpmoviescore' ) ?></em><br />
													<label><input id="most_rated_movies_show_rating" name="<?php echo $widget_id ?>[show_rating]"<?php checked( $settings['show_rating'], '1' ) ?> type="checkbox" value="1" /> <strong><?php _e( 'Show rating', 'wpmoviescore' ) ?></strong></label><br />
													<em><?php _e( 'Show movies ratings below the poster.', 'wpmoviescore' ) ?></em><br />
													<label><input id="most_rated_movies_show_more" name="<?php echo $widget_id ?>[show_more]"<?php checked( $settings['show_more'], '1' ) ?> type="checkbox" value="1" /> <strong><?php _e( 'Show "Load more" button', 'wpmoviescore' ) ?></strong></label><br />
													<em><?php _e( 'Show a button to load more movies to the Widget.', 'wpmoviescore' ) ?></em> <em class="hide-if-js"><?php _e( 'JavaScript required', 'wpmoviescore' ) ?></em><br />
													<label><input id="most_rated_movies_show_modal" name="<?php echo $widget_id ?>[show_modal]"<?php checked( $settings['show_modal'], '1' ) ?> type="checkbox" value="1" /> <strong><?php _e( 'Show a previewing modal window when clicking posters.', 'wpmoviescore' ) ?></strong></label><br />
													<em><?php _e( 'Open modal window on click', 'wpmoviescore' ) ?></em> <em class="hide-if-js"><?php _e( 'JavaScript required', 'wpmoviescore' ) ?></em>
												</td>
												<td style="vertical-align:top;width:40%">
													<label><input id="most_rated_movies_show_quickedit" name="<?php echo $widget_id ?>[show_quickedit]"<?php checked( $settings['show_quickedit'], '1' ) ?> type="checkbox" value="1" /> <strong><?php _e( 'Quick-Edit menu', 'wpmoviescore' ) ?></strong></label><br />
													<em><?php _e( 'Show a quick edit menu to perform basic actions on movies.', 'wpmoviescore' ) ?></em> <em class="hide-if-js"><?php _e( 'JavaScript required', 'wpmoviescore' ) ?></em><br />
													<label><input id="most_rated_movies_style_posters" name="<?php echo $widget_id ?>[style_posters]"<?php checked( $settings['style_posters'], '1' ) ?> type="checkbox" value="1" /> <strong><?php _e( 'Stylized posters', 'wpmoviescore' ) ?></strong></label><br />
													<em><?php _e( 'Show more stylish poster without rounded borders and shadows.', 'wpmoviescore' ) ?></em><br />
													<label><input id="most_rated_movies_style_metabox" name="<?php echo $widget_id ?>[style_metabox]"<?php checked( $settings['style_metabox'], '1' ) ?> type="checkbox" value="1" /> <strong><?php _e( 'Stylized Metabox', 'wpmoviescore' ) ?></strong></label><br />
													<em><?php _e( 'Use transparent Metabox instead of regular WordPress Metabox', 'wpmoviescore' ) ?></em>
												</td>
											</tr>
											<tr>
												<td colspan="3" style="text-align:right">
													<hr />
													<input type="submit" name="save" id="<?php echo "save_{$widget_id}" ?>" class="button button-primary hide-if-js" value="<?php _e( 'Save' ) ?>" />
												</td>
											</tr>
										</tbody>
									</table>
								</form>
							</div>