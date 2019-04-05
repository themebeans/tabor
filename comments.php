<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
} ?>

<div id="comments" class="comments">

	<?php $sidebar_class = ( is_active_sidebar( 'sidebar-3' ) ) ? ' has-sidebar' : null; ?>

	<div class="comments__inner container <?php echo esc_attr( $sidebar_class ); ?>">

		<?php
		if ( have_comments() ) :
			?>

			<ol class="comment-list list-reset">
				<?php
				wp_list_comments(
					array(
						'avatar_size' => 100,
						'style'       => 'ol',
						'short_ping'  => true,
					)
				);
				?>
			</ol>

			<?php
			the_comments_pagination(
				array(
					'prev_text' => wp_kses( tabor_get_svg( array( 'icon' => 'left' ) ), tabor_svg_allowed_html() ) . '<span class="screen-reader-text">' . __( 'Previous', 'tabor' ) . '</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'tabor' ) . '</span>' . wp_kses( tabor_get_svg( array( 'icon' => 'right' ) ), tabor_svg_allowed_html() ),
				)
			);

		endif; // Check for have_comments().

		comment_form();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'tabor' ); ?></p>
		<?php
		endif;
		?>

	</div>

</div>
