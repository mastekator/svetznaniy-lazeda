<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Lezada
 */
$display_type = lezada_get_option( 'archive_display_type' );

if ( is_category() ) {
	$term_id      = get_category( get_query_var( 'cat' ) )->term_id;
	$display_type = get_term_meta( $term_id, 'lezada_archive_display_type', true );

	if ( $display_type == 'default' || ! $display_type ) {
		$display_type = lezada_get_option( 'archive_display_type' );
	}
}

$content_output         = lezada_get_option( 'archive_content_output' );
$excerpt_length         = lezada_get_option( 'excerpt_length' );
$archive_sidebar_config = lezada_get_option( 'archive_sidebar_config' );

/* from lezada-blog shortcode */
if ( isset( $view ) ) {
	$display_type = $view;
}

switch ( $display_type ) {

	case 'grid':
		$img_size = 'lezada-post-grid';
		break;

	case 'full-grid':
		$img_size = 'lezada-post-grid';
		break;

	case 'list':
		$img_size = 'lezada-post-list';
		break;

	case 'standard':
	default:
		$img_size = 'lezada-single-thumb';
		break;

}

$img_size = apply_filters( 'lezada_blog_image_size', $img_size );
$classes  = array('post-item');

if ( $display_type == 'grid' ) {
	$classes[] = 'grid-item';

	if ( $archive_sidebar_config == 'no' ) {
		$classes[] = 'col-xs-12 col-md-6 col-lg-4';
	} else {
		$classes[] = 'col-xs-12 col-md-6';
	}
}

if ( $display_type == 'list' ) {
	$classes[] = 'list-item row';
}

if ( $display_type == 'masonry' ) {
	$classes[] = 'masonry-item';

	if ( $archive_sidebar_config == 'no' ) {
		$classes[] = 'grid-sizer-3';
	} else {
		$classes[] = 'grid-sizer-2';
	}
}

if ( $display_type == 'full-grid' ) {
	$classes[] = 'col-xs-12 col-md-6 post-full-grid';

	if ( $archive_sidebar_config == 'no' ) {
		$classes[] = 'col-xs-12 col-md-6 col-lg-4';
	} else {
		$classes[] = 'col-xs-12 col-md-6';
	}
}

if ( isset( $shortcode_post_class ) ) {
	$classes[] = $shortcode_post_class;
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

	<?php if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) { ?>
		<div class="entry-thumbnail">
			<div class="post-media post-thumb">
				<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail( $img_size ); ?></a>
			</div>
		</div>
	<?php } ?>
	<div class="entry-body">

		<?php if ( lezada_get_option( 'post_meta' ) ) {
			echo Lezada_Templates::post_meta();
		} ?>

		<div class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">',
				esc_url( get_permalink() ) ),
				'</a></h2>' ); ?>
		</div>

		<div class="entry-content">
			<?php if ( $content_output == 'content' ) {
				echo Lezada_Templates::get_the_content_with_formatting();
			} else {
				echo Lezada_Templates::excerpt( $excerpt_length );
			} ?>
		</div>

		<div class="entry-aux">
			<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:',
						'lezada' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'lezada' ) . ' </span>%',
			) );
			?>

			<?php if ( $content_output == 'excerpt' ) { ?>
				<a class="readmore-button"
				   href="<?php the_permalink( get_the_ID() ) ?>"><?php esc_html_e( 'Read more', 'lezada' ); ?></a>
			<?php } ?>
		</div>

	</div>

</article>
