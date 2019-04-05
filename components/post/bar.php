<?php
/**
 * The file is for displaying the post minibar on singular posts.
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

$prev_post = get_previous_post();

$bar       = get_theme_mod( 'post_bar', tabor_defaults( 'post_bar' ) );
$bar_style = get_theme_mod( 'post_bar_style', tabor_defaults( 'post_bar_style' ) );
$bar_style = ( 'style-1' === $bar_style ) ? null : $bar_style;

$twitter     = get_theme_mod( 'twitter_share', tabor_defaults( 'twitter_share' ) );
$twitter_via = get_theme_mod( 'twitter_via', tabor_defaults( 'twitter_via' ) );
$twitter_via = str_replace( '@', '', $twitter_via );
$facebook    = get_theme_mod( 'facebook_share', tabor_defaults( 'facebook_share' ) );
$linkedin    = get_theme_mod( 'linkedin_share', tabor_defaults( 'linkedin_share' ) );

// Only display if the option is selected in the Customizer.
$bar_visibility      = ( false === $bar ) ? ' hidden' : null;
$twitter_visibility  = ( false === $twitter ) ? ' hidden' : null;
$facebook_visibility = ( false === $facebook ) ? ' hidden' : null;
$linkedin_visibility = ( false === $linkedin ) ? ' hidden' : null;

$title   = rawurlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) );
$picture = ( has_post_thumbnail() ) ? '&picture= ' . get_the_post_thumbnail_url() : null;
$via     = ( $twitter_via ) ? '&via=' . $twitter_via : null;

// Generate the Facebook URL.
$facebook_url = '
	https://www.facebook.com/sharer/sharer.php?
	u=' . get_the_permalink() . '
	&title=' . $title .
	$picture;

$facebook_url = apply_filters( 'tabor_facebook_share_url_generator', $facebook_url );

// Generate the LinkedIn URL.
$linkedin_url = '
	https://www.linkedin.com/shareArticle?mini=true
	&url=' . get_the_permalink() . '
	&title=' . $title . '
	&summary=' . get_the_excerpt() . '
	&source= ' . esc_html( get_bloginfo( 'name' ) ) . '
';

$linkedin_url = apply_filters( 'tabor_linkedin_share_url_generator', $linkedin_url ); ?>

<?php if ( $bar || is_customize_preview() ) { ?>

	<div id="engagement-bar" class="bar drop-in drop-in--from-bottom <?php echo esc_attr( $bar_style ); ?> <?php echo esc_attr( $bar_visibility ); ?>">

		<div class="container max-width flex justify-between">

			<div class="flex items-center justify-start">

				<?php if ( $twitter || is_customize_preview() ) { ?>

					<a class="share-icon share-icon--twitter button--attention header-font medium smooth relative <?php echo esc_attr( $twitter_visibility ); ?>" href="http://twitter.com/share?text=<?php echo esc_attr( $title ); ?>&nbsp;—&url=<?php the_permalink(); ?><?php echo esc_attr( $via ); ?>" target="_blank">
						<?php echo esc_html__( 'Tweet', 'tabor' ); ?>
						<?php echo wp_kses( tabor_get_svg( array( 'icon' => 'twitter' ) ), tabor_svg_allowed_html() ); ?>
					</a>

				<?php } ?>

				<?php if ( $facebook || is_customize_preview() ) { ?>

					<a class="share-icon share-icon--facebook button--attention--fb header-font medium smooth relative <?php echo esc_attr( $facebook_visibility ); ?>" href="<?php echo esc_url( $facebook_url ); ?>" target="_blank">
						<?php echo esc_html__( 'Facebook', 'tabor' ); ?>
						<?php echo wp_kses( tabor_get_svg( array( 'icon' => 'facebook-share' ) ), tabor_svg_allowed_html() ); ?>
					</a>

				<?php } ?>

				<?php if ( $linkedin || is_customize_preview() ) { ?>

					<a class="share-icon share-icon--linkedin button--attention--linkedin header-font medium smooth relative <?php echo esc_attr( $linkedin_visibility ); ?>" href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank">
						<?php echo esc_html__( 'LinkedIn', 'tabor' ); ?>
						<?php echo wp_kses( tabor_get_svg( array( 'icon' => 'linkedin' ) ), tabor_svg_allowed_html() ); ?>
					</a>

				<?php } ?>

			</div>

			<div class="flex items-center justify-end relative">

				<?php if ( ! empty( $prev_post ) ) { ?>
					<?php if ( get_the_post_thumbnail( $prev_post->ID ) ) { ?>
						<div class="thumbnail">
							<?php echo get_the_post_thumbnail( $prev_post->ID, 'tabor-featured-image-xsm' ); ?>
						</div>
					<?php } ?>
				<?php } ?>

				<div class="site-minibar__right-content justify-end">
					<?php if ( ! empty( $prev_post ) ) { ?>
						<span class="up-next h6 header-font medium smooth gray">
							<?php echo esc_html( apply_filters( 'tabor_post_up_next', esc_html__( 'Up Next:', 'tabor' ) ) ); ?>
						</span>
						<?php printf( '<h4 class="title h5 medium-bold">%1$s</h4>', esc_html( $prev_post->post_title ) ); ?>
						<?php printf( '<a href="%1$s" rel="bookmark" title="%2$s"><span class="screen-reader-text">%2$s</span></a>', esc_url( get_permalink( $prev_post->ID ) ), esc_attr( $prev_post->post_title ) ); ?>
					<?php } ?>
				</div>

			</div>

		</div>

	</div>

<?php
}

