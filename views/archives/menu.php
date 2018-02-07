
				<ul id="wpmcp-movie-grid-menu" class="wpmcp movies grid menu list">

<?php
$current = $letter;
foreach ( $default as $l ) :
	$_url = str_replace( ':letter:', $l, $urls['letter'] );
?>
					<li id="wpmcp-movie-grid-menu-item-<?php echo $l ?>" class="wpmcp movies grid menu list item<?php if ( strtolower( $l ) == strtolower( $current ) ) echo ' active'; ?>"><?php if ( in_array( $l, $letters ) ) { ?><a href="<?php echo $_url; ?>"><?php echo $l; ?></a><?php } else { echo $l; } ?></li>

<?php endforeach; ?>
					<li id="wpmcp-movie-grid-menu-item-all" class="wpmcp movies grid menu list item<?php if ( 'all' == $current ) echo ' active'; ?>"><a href="<?php echo $urls['all'] ?>"><?php _e( 'All', 'wpmoviescore' ) ?></a></li>
				</ul>

				<form id="wpmcp-grid-form" action="">
					<input type="submit" value="" style="display:none" />
					<ul id="wpmcp-movie-grid-menu-2" class="wpmcp movies grid menu list">
						<li id="wpmcp-movie-grid-menu-item-alpha-asc" class="wpmcp movies grid menu list item<?php if ( 'ASC' == $order && 'title' == $orderby ) echo ' active'; ?>"><a href="<?php echo $urls['title_asc'] ?>" title="<?php _e( 'List alphabetically, ascendingly', 'wpmoviescore' ) ?>"><span class="wpmolicon icon-sort-alpha-asc"></span></a></li>
						<li id="wpmcp-movie-grid-menu-item-alpha-desc" class="wpmcp movies grid menu list item<?php if ( 'DESC' == $order && 'title' == $orderby ) echo ' active'; ?>"><a href="<?php echo $urls['title_desc'] ?>" title="<?php _e( 'List alphabetically, descendingly', 'wpmoviescore' ) ?>"><span class="wpmolicon icon-sort-alpha-desc"></span></a></li>
						<li id="wpmcp-movie-grid-menu-item-numeric-asc" class="wpmcp movies grid menu list item<?php if ( 'ASC' == $order && 'count' == $orderby ) echo ' active'; ?>"><a href="<?php echo $urls['count_asc'] ?>" title="<?php _e( 'List by movies count, ascendingly', 'wpmoviescore' ) ?>"><span class="wpmolicon icon-sort-numeric-asc"></span></a></li>
						<li id="wpmcp-movie-grid-menu-item-numeric-desc" class="wpmcp movies grid menu list item<?php if ( 'DESC' == $order && 'count' == $orderby ) echo ' active'; ?>"><a href="<?php echo $urls['count_desc'] ?>" title="<?php _e( 'List by movies count, descendingly', 'wpmoviescore' ) ?>"><span class="wpmolicon icon-sort-numeric-desc"></span></a></li>
 <?php if ( '1' == $editable ) : ?>
						<li id="wpmcp-movie-grid-menu-item-count" class="wpmcp movies grid menu list item hide-if-no-js"><?php _e( 'Items per page:', 'wpmoviescore' ) ?> <input name="number" type="text" size="3" maxlength="3" placeholder="50" value="<?php echo $number; ?>" /></li>

<?php endif; ?>
					</ul>
				</form>
