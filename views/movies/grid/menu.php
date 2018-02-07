
				<ul id="wpmcp-movie-grid-menu" class="wpmcp movies grid menu list<?php echo $theme; ?>">

<?php
$current = $letter;
foreach ( $default as $l ) :
	$_url = str_replace( ':letter:', $l, $urls['letter'] );
?>
					<li id="wpmcp-movie-grid-menu-item-<?php echo $l ?>" class="wpmcp movies grid menu list item<?php if ( strtolower( $l ) == strtolower( $current ) ) echo ' active'; ?>"><?php if ( in_array( $l, $letters ) ) { ?><a href="<?php echo $_url; ?>"><?php echo $l; ?></a><?php } else { echo $l; } ?></li>

<?php endforeach; ?>
					<li id="wpmcp-movie-grid-menu-item-all" class="wpmcp movies grid menu list item<?php if ( 'all' == $current ) echo ' active'; ?>"><a href="<?php echo  $urls['all']; ?>"><?php _e( 'All', 'wpmoviescore' ) ?></a></li>
				</ul>

				<form id="wpmcp-grid-form" action="">
					<input type="submit" value="" style="display:none" />
					<ul id="wpmcp-movie-grid-menu-2" class="wpmcp movies grid menu list<?php echo $theme; ?>">
						<li id="wpmcp-movie-grid-menu-item-alpha-asc" class="wpmcp movies grid menu list item<?php if ( 'ASC' == $order ) echo ' active'; ?>"><a href="<?php echo str_replace( array( 'DESC', 'desc' ), 'ASC', $urls['asc'] ) ?>" title="<?php _e( 'List ascendingly alphabetically', 'wpmoviescore' ) ?>"><span class="wpmolicon icon-sort-alpha-asc"></span></a></li>
						<li id="wpmcp-movie-grid-menu-item-alpha-desc" class="wpmcp movies grid menu list item<?php if ( 'DESC' == $order ) echo ' active'; ?>"><a href="<?php echo str_replace( array( 'ASC', 'asc' ), 'DESC', $urls['desc'] ) ?>" title="<?php _e( 'List descendingly alphabetically', 'wpmoviescore' ) ?>"><span class="wpmolicon icon-sort-alpha-desc"></span></a></li>
<?php if ( '1' == $editable ) : ?>
						<li id="wpmcp-movie-grid-menu-item-list" class="wpmcp movies grid menu list item<?php if ( 'list' == $view ) echo ' active'; ?>"><a href="<?php echo $urls['list']; ?>" title="<?php _e( 'Show movies as an extended list', 'wpmoviescore' ) ?>"><span class="wpmolicon icon-align-justify"></span></a></li>
						<li id="wpmcp-movie-grid-menu-item-archives" class="wpmcp movies grid menu list item<?php if ( 'archives' == $view ) echo ' active'; ?>"><a href="<?php echo $urls['archives']; ?>" title="<?php _e( 'Show movies as a list of titles', 'wpmoviescore' ) ?>"><span class="wpmolicon icon-th-list"></span></a></li>
						<li id="wpmcp-movie-grid-menu-item-grid" class="wpmcp movies grid menu list item<?php if ( 'grid' == $view ) echo ' active'; ?>"><a href="<?php echo $urls['grid']; ?>" title="<?php _e( 'Show movies as a poster grid', 'wpmoviescore' ) ?>"><span class="wpmolicon icon-grid"></span></a></li>

<?php endif; ?>

					</ul>
				</form>
