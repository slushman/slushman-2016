<?php
/**
 * Template part for displaying post excerpts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Slushman_2016
 */

?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php

	do_action( 'tha_entry_top' );

	?><header class="entry-header justcontent"><?php

		the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

		if ( 'post' == get_post_type() ) :

			?><div class="entry-meta"><?php

				slushman_2016_posted_on();

			?></div><!-- .entry-meta --><?php

		endif;

	?></header><!-- .entry-header --><?php

	do_action( 'tha_entry_content_before' );

	?><div class="entry-content"><?php

			the_excerpt();

	?></div><!-- .entry-content --><?php

	do_action( 'tha_entry_content_after' );

	?><footer class="entry-footer"><?php

		slushman_2016_entry_footer();

	?></footer><!-- .entry-footer --><?php

	do_action( 'tha_entry_bottom' );

?></article><!-- #post-## -->