/**
 * Script for our theme
 * Written By: ThemeMove
 */
'use strict';

var lezada;
var md = new MobileDetect( window.navigator.userAgent ); // Mobile Detect

(
	function() {

		lezada = (

			function() {

				return {

					init: function() {

						this.closeTopBar();

						this.offcanvas();

						this.backToTop();

						this.stickyHeader();

						this.splitNavHeader();

						this.headerOverlap();

						this.verticalHeader();

						this.blog();

						this.switcher();

						this.siteMenu();

						this.mobileMenu();

						this.search();

						this.wishlist();

						this.miniCart();

						this.shop();

						this.quickView();

						this.notification();

						this.compare();

						this.ajaxAddToCart();

						this.ajaxLoadMore();

						this.product();

						this.crossSells();

						this.swatches();

						this.quantityField();

						this.imageCarousel();

						this.instagramCarousel();

						this.countdown();

						this.productCategoriesShortcode();

						this.productsShortCode();

						this.vcTabs();

						this.vcRow();

						this.vcColumn();

						this.bannerGrid5();

						this.bannerGrid6();

						this.bannerGrid6v2();

						this.cookie();

						this.brand();

						this.videoPopup();

						this.instagram();

						this.mailchimpSubscribe();

						this.menuVertical();

						this.bannerCarousel();

					}
				}
			}()
		);
	}
)( jQuery );

jQuery( document ).ready( function() {
	lezada.init();
} );
