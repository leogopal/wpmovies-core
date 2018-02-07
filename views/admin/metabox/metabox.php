
<?php if ( ! is_null( $post_type ) ) : ?>

		<p><?php printf( __( 'You can convert this %s to Movie to access WPMoviesCore features without duplicating your content.', 'wpmoviescore' ), $post_type ); ?></p>
		<p id="wpmcp-convert-button">
			<a href="<?php echo wpmcp_nonce_url( admin_url( "post.php?post={$post_id}&action=edit&wpmcp_convert_post_type=1" ), 'convert-post-type' ) ?>" class="button button-primary button-large"><?php printf( __( 'Convert %s to Movie', 'wpmoviescore' ), $post_type ); ?></a>
		</p>
<?php else : ?>
		<?php do_action( 'wpmcp_before_metabox_content' ); ?>
		<input type="hidden" id="wpmcp-autocomplete-collection" value="<?php echo wpmcp_o( 'collection-autocomplete' ); ?>" />
		<input type="hidden" id="wpmcp-autocomplete-genre" value="<?php echo wpmcp_o( 'genre-autocomplete' ); ?>" />
		<input type="hidden" id="wpmcp-autocomplete-actor" value="<?php echo wpmcp_o( 'actor-autocomplete' ); ?>" />

		<div id="wpmcp-meta" class="wpmcp-meta">

			<div id="wpmcp-meta-menu-bg"></div>
			<ul id="wpmcp-meta-menu" class="hide-if-no-js">

<?php foreach ( $tabs as $id => $tab ) : ?>

				<li id="wpmcp-meta-<?php echo $id ?>" class="tab<?php echo $tab['active'] ?>"><a href="#" onclick="wpmcp_meta_panel.navigate( '<?php echo $id ?>' ) ; return false;"><span class="<?php echo $tab['icon'] ?>"></span>&nbsp; <span class="text"><?php echo $tab['title'] ?></span></a></li>
<?php endforeach; ?>
				<li class="tab off"><a href="#" onclick="wpmcp_meta_panel.resize() ; return false;"><span class="wpmolicon icon-collapse"></span>&nbsp; <span class="text"><?php _e( 'Collapse', 'wpmoviescore' ) ?></span></a></li>
			</ul>

			<div id="wpmcp-meta-panels">

				<?php do_action( 'wpmcp_before_metabox_panels' ); ?>

<?php foreach ( $panels as $id => $panel ) : ?>

				<div id="wpmcp-meta-<?php echo $id ?>-panel" class="panel<?php echo $panel['active'] ?> hide-if-js"><?php echo $panel['content'] ?></div>
<?php endforeach; ?>

				<?php do_action( 'wpmcp_after_metabox_panels' ); ?>
			</div>
			<div style="clear:both"></div>

		</div>

		<?php do_action( 'wpmcp_after_metabox_content' ); ?>

<?php endif; ?>