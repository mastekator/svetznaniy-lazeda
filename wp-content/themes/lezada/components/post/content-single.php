<?php
/**
 * Template part for displaying single posts.
 *
 * @package Lezada
 */
$post_show_tags      = lezada_get_option( 'post_show_tags' );
$post_show_share     = lezada_get_option( 'post_show_share' );
$post_share_links    = lezada_get_option( 'post_share_links' );
$post_sidebar_config = lezada_get_option( 'post_sidebar_config' );

$no_share_links = true;

if ( is_array( $post_share_links ) ) {

	foreach ( $post_share_links as $link ) {
		if ( $link ) {
			$no_share_links = false;
		}
	}
}

$header_classes = array( 'entry-header' );

if ( lezada_get_option( 'single_nav_on' ) ) {
	$header_classes[] = 'single-nav-on';
}

?>

<article <?php post_class(); ?>>

	<?php if ( $post_sidebar_config == 'no' ) { ?>
		<div class="entry-heading">

			<?php if ( lezada_get_option( 'post_meta_categories' ) ) { ?>
				<div class="entry-meta">
					<?php if ( get_the_category_list( ', ' ) ) { ?>
						<span class="meta-categories"><?php echo get_the_category_list( ' / ' ); ?></span>
					<?php } ?>
				</div>
			<?php } ?>

			<?php if ( get_post_meta( get_the_ID(), 'lezada_post_title_on_top', true ) == 'on' ) { ?>
				<div class="<?php echo implode( ' ', $header_classes ) ?>">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<?php echo Lezada_Templates::single_navigation(); ?>
				</div>
			<?php } ?>

			<?php if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) { ?>
				<div class="entry-thumbnail">
					<div class="post-media post-thumb">
						<?php the_post_thumbnail( 'lezada-single-thumb' ); ?>
					</div>
				</div>
			<?php } ?>

			<?php if ( lezada_get_option( 'post_meta' ) ) {
				echo Lezada_Templates::post_meta( array(
					'author' => 1,
					'cats'   => 1,
				) );
			} ?>
		</div>
	<?php } else {
		if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) { ?>
			<div class="entry-thumbnail">
				<div class="post-media post-thumb">
					<?php the_post_thumbnail( 'lezada-single-thumb' ); ?>
				</div>
			</div>
		<?php } ?>

		<div class="entry-heading">

			<?php if ( lezada_get_option( 'post_meta_categories' ) ) { ?>
				<div class="entry-meta">
					<?php if ( get_the_category_list( ', ' ) ) { ?>
						<span class="meta-categories"><?php echo get_the_category_list( ' / ' ); ?></span>
					<?php } ?>
				</div>
			<?php } ?>

			<?php if ( get_post_meta( get_the_ID(), 'lezada_post_title_on_top', true ) == 'on' ) { ?>
				<div class="<?php echo implode( ' ', $header_classes ) ?>">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<?php echo Lezada_Templates::single_navigation(); ?>
				</div>
			<?php } ?>

			<?php if ( lezada_get_option( 'post_meta' ) ) {
				echo Lezada_Templates::post_meta( array(
					'author' => lezada_get_option( 'post_meta_author' ),
					'cats'   => lezada_get_option( 'post_meta_categories' ),

				) );
			} ?>
		</div>

	<?php } ?>

	<div class="entry-content">
		<?php
		the_content();
		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:',
					'lezada' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'lezada' ) . ' </span>%',
		) );
		?>
	</div>

	<div class="row entry-footer flex-items-xs-middle">
		<?php if ( $post_show_tags ) { ?>
			<div
				class="post-tags col-xs-12 col-sm-6">
				<?php the_tags( '<ul class="tagcloud"><li class="tag-cloud__item">',
					'</li><li class="tag-cloud__item">',
					'</li></ul>' ); ?>
			</div>
		<?php } ?>

		<?php if ( $post_show_share && ! $no_share_links && is_array( $post_share_links ) ) { ?>
			<div
				class="post-share col-xs-12 col-sm-6 text-sm-right">
				<ul class="list-inline share-list">
					<li class="list-inline-item">
						<h3
							class="share-list__title"><?php echo esc_html__( 'Share this post:', 'lezada' ); ?>
							<?php if ( $post_show_share ) { ?>
								<div class="post-share-buttons">
									<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"
									   onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=455,width=600'); return false;">
										<i class="fa fa-facebook"></i>
									</a>
									<a href="https://twitter.com/home?status=Check%20out%20this%20article:%20<?php echo rawurlencode( the_title( '',
										'',
										false ) ); ?>%20-%20<?php the_permalink(); ?>"
									   onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=455,width=600'); return false;">
										<i class="fa fa-twitter"></i>
									</a>
									<?php $pin_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>
									<a data-pin-do="skipLink"
									   href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo esc_url( $pin_image ); ?>&amp;description=<?php echo rawurlencode( the_title( '',
										   '',
										   false ) ); ?>"
									   onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=455,width=600'); return false;">
										<i class="fa fa-pinterest"></i>
									</a>
									<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>"
									   onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=455,width=600'); return false;">
										<i class="fa fa-google-plus"></i>
									</a>
									<a href="mailto:<?php echo get_option( 'admin_email' ); ?>"><i
											class="fa fa-envelope-o"></i></a>
								</div>
							<?php } ?>
						</h3>
					</li>
				</ul>
			</div>
		<?php } ?>
	</div>

	<hr class="post-single-hr">

</article>
