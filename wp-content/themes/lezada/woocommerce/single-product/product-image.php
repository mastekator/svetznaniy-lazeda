<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see           https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $post, $product;

$attachment_count  = count( $product->get_gallery_image_ids() );
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
$placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes',
	array(
		'row',
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . $placeholder,
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	) );

// Thumbnail Position
$thumbnails_position = get_post_meta( Lezada_Helper::get_the_ID(), 'lezada_product_thumbnails_position', true );

if ( $thumbnails_position == 'default' || ! $thumbnails_position ) {
	$thumbnails_position = lezada_get_option( 'product_thumbnails_position' );
}

// Product page layout
$product_page_layout = get_post_meta( Lezada_Helper::get_the_ID(), 'lezada_product_page_layout', true );

if ( $product_page_layout == 'default' || ! $product_page_layout ) {
	$product_page_layout = lezada_get_option( 'product_page_layout' );
}

// Show only featured images
$show_only_featured_images = get_post_meta( Lezada_Helper::get_the_ID(), 'lezada_show_featured_images', true );

if ( $show_only_featured_images == 'default' || ! $show_only_featured_images ) {
	$show_only_featured_images = lezada_get_option( 'show_featured_images' );
}

if ( $product_page_layout == 'sticky' || $product_page_layout == 'sticky-fullwidth' ) {
	$thumbnails_position = 'bottom';
}

$wrapper_classes[] = 'thumbnails-' . $thumbnails_position;

if ( lezada_get_option( 'product_zoom_on' ) ) {
	$wrapper_classes[] = 'product-zoom-on';
}

if ( $show_only_featured_images ) {
	$wrapper_classes[] = 'only-featured-image';
}

$attachment_ids    = $product->get_gallery_image_ids();
$carousel_settings = array();
$lightbox_btn_html = '';
$video_btn_html    = '';

?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>">
	<?php
	if ( get_post_meta( $post->ID, '_spin_view_url', true ) ) {
		$post_thumbnail_id = $product->get_image_id();
		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', '', $post_thumbnail_id );
	} else {
		?>
		<div
			class="col-xs-12<?php if ( $thumbnails_position == 'left' && $attachment_ids && ! $show_only_featured_images ) : ?> col-md-9<?php endif; ?>">
			<figure class="woocommerce-product-gallery__wrapper">
				<?php
				// Sale flash
				woocommerce_show_product_sale_flash();


				$attributes = array(
					'title'                   => get_post_field( 'post_title', $post_thumbnail_id ),
					'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
					'data-src'                => $full_size_image[0],
					'data-large_image'        => $full_size_image[0],
					'data-large_image_width'  => $full_size_image[1],
					'data-large_image_height' => $full_size_image[2],
				);

				if ( has_post_thumbnail() ) {

					$size = 'woocommerce_single';

					if ( $show_only_featured_images ) {
						$size = 'full';
					}

					// light box button
					if ( lezada_get_option( 'product_lightbox_button' ) ) {
						$lightbox_btn_html = '<a href="#" class="hint--left hint--bounce lightbox-btn" aria-label="' . esc_html__( 'Click to enlarge',
								'lezada' ) . '">' . esc_html__( 'Click to enlarge',
								'lezada' ) . '<i class="ion-android-expand"></i></a>';
					}

					if ( class_exists( 'Lezada_Video_Product' ) ) {
						$video_url      = Lezada_Video_Product::get_product_video();

						if ( $video_url != '' ):
						$video_btn_html = '<a href="' . esc_attr( $video_url,
								'lezada' ) . '" class="hint--left hint--bounce video-lightbox-btn" aria-label="' . esc_html__( 'Click to see video',
								'lezada' ) . '"><i class="fa fa-play-circle"></i></a>';
						endif;
					}

					if ( $product_page_layout == 'fullwidth' || $product_page_layout == 'sticky-fullwidth' ) {
						$cropping_width  = max( 1, get_option( 'woocommerce_thumbnail_cropping_custom_width', '3' ) );
						$cropping_height = max( 1, get_option( 'woocommerce_thumbnail_cropping_custom_height', '4' ) );
						$image_width     = intval( get_option( 'woocommerce_single_image_width', 540 ) ) * 1.25;
						$size            = array(
							$image_width,
							absint( round( ( $image_width / $cropping_width ) * $cropping_height ) ),
						);
					}
					$html = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID,
							'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
					$html .= get_the_post_thumbnail( $post->ID,
						apply_filters( 'lezada_single_product_large_thumbnail_size', $size ), $attributes );
					$html .= '</a>';
					$html .= '</div>';
				} else {
					$html = '<div class="woocommerce-product-gallery__image--placeholder">';
					$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />',
						esc_url( wc_placeholder_img_src() ),
						esc_html__( 'Awaiting product image', 'lezada' ) );
					$html .= '</div>';
				}

				$images = array();

				$feature_image_template = '';

				ob_start();
				$feature_image_template = apply_filters( 'woocommerce_single_product_image_thumbnail_html',
					$html,
					get_post_thumbnail_id( $post->ID ) );
				ob_get_clean();

				$images[]       = $feature_image_template;
				$attachment_ids = $product->get_gallery_image_ids();

				if ( $attachment_ids && has_post_thumbnail() && ! $show_only_featured_images ) {
					foreach ( $attachment_ids as $attachment_id ) {
						$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
						$attributes      = array(
							'title'                   => get_post_field( 'post_title', $attachment_id ),
							'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
							'data-src'                => $full_size_image[0],
							'data-large_image'        => $full_size_image[0],
							'data-large_image_width'  => $full_size_image[1],
							'data-large_image_height' => $full_size_image[2],
						);

						$html = '<div data-thumb="' . wp_get_attachment_image_src( $attachment_id,
								'shop_thumbnail' )[0] . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
						$html .= wp_get_attachment_image( $attachment_id, 'woocommerce_single', false, $attributes );
						$html .= '</a></div>';

						$images[] = $html;
					}
				}

				$carousel_settings = apply_filters( 'lezada_single_product_carousel_settings',
					array(
						'accessibility' => false,
						'infinite'      => count( $attachment_ids ) >= 3,
						'arrows'        => true,
						'dots'          => true,
						'asNavFor'      => '.thumbnails-slider',
					) );

				echo '<div class="woocommerce-product-gallery__slider"' . ( empty( $carousel_settings ) ? '' : ' data-carousel="' . esc_attr( json_encode( $carousel_settings ) ) . '"' ) . '>' . implode( "\n\t",
						$images ) . '</div>';


				echo Lezada_Woo::wishlist_button() . $lightbox_btn_html . $video_btn_html;

				?>
			</figure>
		</div>
		<?php if ( $product_page_layout != 'sticky' && $product_page_layout != 'sticky-fullwidth' && ! $show_only_featured_images ) { ?>
			<div
				class="col-xs-12<?php if ( $thumbnails_position == 'left' && $attachment_ids ) : ?> col-md-3 flex-md-first<?php endif; ?>">
				<?php do_action( 'woocommerce_product_thumbnails' ); ?>
			</div>
		<?php } ?>
	<?php } ?>
</div>
