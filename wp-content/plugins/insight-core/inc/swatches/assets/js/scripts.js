'use strict';

window.isw = {};

(
	function( isw, $ ) {
		isw = isw || {};

		$.extend( isw, {
			ajax_url: isw_vars.ajax,
			product_selector: isw_vars.product_selector,
			price_selector: isw_vars.price_selector,
			localization: isw_vars.localization,
		} );

	}
).apply( this, [ window.isw, jQuery ] );

(
	function( isw, $ ) {
		isw = isw || {};

		$.extend( isw, {

			Swatches: {
				init: function() {

					this.$form     = $( 'form.isw-swatches.variations_form' );
					this.$swatches = $( 'div.isw-swatches' );

					this.initSingle();
					this.initLoop();

					$( '.isw-term' ).each( function() {
						if ( $( this ).css( 'background-color' ) == 'rgb(255, 255, 255)' ) {
							$( this ).addClass( 'isw-white' );
						}
					} )
				},

				getObjects: function( obj, key, val ) {
					var objects = [];
					for ( var i in obj ) {
						if ( ! obj.hasOwnProperty( i ) ) continue;
						if ( typeof obj[ i ] == 'object' ) {
							objects = objects.concat( getObjects( obj[ i ], key, val ) );
						} else if ( i == key && obj[ key ] == val || obj[ key ] == '' ) {
							objects.push( obj );
						}
					}
					return objects;
				},

				initSingle: function() {

					var self = this;

					// load default value
					$( '.isw-term', self.$form ).each( function() {
						var $this      = $( this ),
							term       = $this.attr( 'data-term' ),
							attr       = $this.parent().attr( 'data-attribute' ),
							$selectbox = self.$form.find( 'select#' + attr );

						var val = $selectbox.val();

						if ( val != '' && term == val ) {
							$( this ).addClass( 'isw-selected' );
						}
					} )

					self.$form.on( 'click', '.isw-term:not(.isw-disabled)', function() {

						var $this      = $( this ),
							term       = $this.attr( 'data-term' ),
							attr       = $this.parent().attr( 'data-attribute' ),
							$selectbox = self.$form.find( 'select#' + attr );

						$selectbox.val( term ).trigger( 'change' );

						$this.parent().find( '.isw-selected' ).removeClass( 'isw-selected' );
						$this.addClass( 'isw-selected' );
					} );

					self.$form.on( 'woocommerce_update_variation_values', function() {
						self.$form.find( 'select' ).each( function() {
							var $this   = $( this );
							var $swatch = $this.parent().find( '.isw-swatch' );

							$swatch.find( '.isw-term' ).removeClass( 'isw-enabled' ).addClass( 'isw-disabled' );

							$this.find( 'option.enabled' ).each( function() {
								var val = $( this ).val();
								$swatch.find( '.isw-term[data-term="' + val + '"]' )
									.removeClass( 'isw-disabled' )
									.addClass( 'isw-enabled' );
							} )
						} )
					} );

					self.$form.on( 'reset_data', function() {
						$( this ).parent().find( '.isw-selected' ).removeClass( 'isw-selected' );
					} )

				},

				initLoop: function() {

					var self = this;

					self.$swatches.each( function() {

						var $swatches  = $( this ),
							variations = $.parseJSON( $( this ).attr( 'data-product_variations' ) );

						// add class if empty
						if ( $swatches.find( '.isw-swatch' ).length == 0 ) {
							$swatches.addClass( 'isw-empty' );
						}

						$( this ).on( 'click', '.isw-term:not(.isw-disabled)', function() {

							var $this            = $( this ),
								term             = $this.attr( 'data-term' ),
								attr             = 'attribute_' + $( this ).parent().attr( 'data-attribute' ),
								current_settings = {};

							current_settings[ attr ] = term;

							var $terms = $swatches.find( '.isw-selected' );

							$terms.each( function() {
								var t = $( this ).attr( 'data-term' );
								var a = 'attribute_' + $( this ).parent().attr( 'data-attribute' );

								if ( a != attr ) {
									current_settings[ a ] = t;
								}
							} );

							var matching_variations = self.find_matching_variations( variations, current_settings );

							if ( matching_variations ) {
								self.find_outofstock_variations( matching_variations, $this );
								self.change_image( matching_variations, $this );
								self.change_price_of_variation( matching_variations, $swatches );
							}

						} );

						$( this ).on( 'click', '.reset_variations', function() {

							$swatches.removeAttr( 'data-variation_id' );
							$swatches.find( '.isw-swatch' ).removeClass( 'isw-activated' );
							$swatches.find( '.isw-term' ).removeClass( 'isw-enabled isw-disabled isw-selected' );

							$( 'body' ).trigger( 'reset_add_to_cart_button_text' );
							$swatches.parents( isw.product_selector )
								.find( '.add_to_cart_button' )
								.removeClass( 'isw-ready isw-readmore isw-text-changed added loading' )
								.text( isw.localization.select_options_text );

							var $product      = $swatches.parents( isw.product_selector ),
								$price        = $product.find( isw.price_selector ).not( '.price-cloned' ),
								$price_cloned = $product.find( '.price-cloned' );

							if ( $price_cloned.length ) {
								$price.html( $price_cloned.html() );
							}

							// reset image
							var $img     = $product.find( 'img' ).first(),
								o_src    = $img.data( 'o-src' ),
								o_srcset = $img.data( 'o-srcset' ),
								o_sizes  = $img.data( 'o-sizes' );

							if ( typeof  o_src == 'undefined' ) {
								$img.data( 'o-src', $img.attr( 'src' ) );
							}

							if ( typeof  o_srcset == 'undefined' ) {
								$img.data( 'o-srcset', $img.attr( 'srcset' ) );
							}

							if ( typeof  o_sizes == 'undefined' ) {
								$img.data( 'o-sizes', $img.attr( 'sizes' ) );
							}

							$img.parent().addClass( 'loading' );
							$img.attr( 'src', o_src )
								.attr( 'srcset', o_srcset )
								.attr( 'sizes', o_sizes )
								.one( 'load', function() {
									$img.parent().removeClass( 'loading' );
								} );

							$product.removeClass( 'isw-product-swatched' );

							$( this ).hide();

							return false;
						} )
					} );

					// Ajax add to cart
					$( document ).on( 'click', '.add_to_cart_button.product_type_variable.isw-ready', function() {

						var $this     = $( this ),
							$swatches = $this.closest( isw.product_selector ).find( '.isw-swatches' );

						var variation_id = $swatches.attr( 'data-variation_id' );

						if ( typeof variation_id == 'undefined' || variation_id == '' ) {
							return true;
						}

						var product_id = $this.attr( 'data-product_id' ),
							quantity   = $this.attr( 'data-quantity' ),
							item       = {};

						$swatches.find( '.isw-swatch' ).each( function() {
							var attr       = $( this ).attr( 'data-attribute' );
							var attr_value = $( this ).find( 'span.isw-selected' ).attr( 'aria-label' );

							item[ attr ] = attr_value;
						} );

						$this.removeClass( 'added' );

						var data = {
							action: 'insight_sw_add_to_cart',
							product_id: product_id,
							quantity: quantity,
							variation_id: variation_id,
							variation: item
						};

						$( 'body' ).trigger( 'adding_to_cart', [ $this, data ] );

						$.ajax( {
							type: 'POST',
							url: isw.ajax_url,
							data: data,
							success: function( response ) {

								if ( ! response ) {
									return false;
								}

								if ( response.error && response.product_url ) {
									window.location = response.product_url;
									return false;
								}

								// update cartf ragment
								var fragments = response.fragments;
								var cart_hash = response.cart_hash;

								if ( fragments ) {
									$.each( fragments, function( key, value ) {
										$( key ).replaceWith( value );
									} );
								}

								$this.addClass( 'added' );
								$( 'body' ).trigger( 'added_to_cart', [ fragments, cart_hash ] );

							},
							timeout: 6000
						} );

						return false;
					} );

				},

				find_matching_variations: function( product_variations, settings ) {
					var matching = [];
					for ( var i = 0; i < product_variations.length; i ++ ) {
						var variation = product_variations[ i ];

						if ( this.variations_match( variation.attributes, settings ) ) {
							matching.push( variation );
						}
					}
					return matching;
				},

				variations_match: function( attrs1, attrs2 ) {
					var match = true;
					for ( var attr_name in attrs1 ) {
						if ( attrs1.hasOwnProperty( attr_name ) ) {
							var val1 = attrs1[ attr_name ];
							var val2 = attrs2[ attr_name ];
							if ( val1 !== undefined && val2 !== undefined && val1.length !== 0 && val2.length !== 0 && val1 !== val2 ) {
								match = false;
							}
						}
					}
					return match;
				},

				find_outofstock_variations: function( matching_variations, $el ) {

					var $curr_swatch    = $el.parent(),
						curr_attr       = 'attribute_' + $curr_swatch.attr( 'data-attribute' ),
						$other_swatches = $curr_swatch.closest( '.isw-swatches' )
							.find( '.isw-swatch[data-attribute!=' + curr_attr.replace( 'attribute_', '' ) + ']' );

					for ( var i = 0; i < matching_variations.length; i ++ ) {

						var variation = matching_variations[ i ],
							attrs     = variation[ 'attributes' ];

						$.each( attrs, function( k, v ) {

							if ( k != curr_attr ) {
								var attr    = k.replace( 'attribute_', '' );
								var $swatch = $( '.isw-swatch[data-attribute="' + attr + '"]', $curr_swatch.parent() );


								if ( variation[ 'is_in_stock' ] === true ) {
									if ( v ) {
										$swatch.find( '.isw-term[data-term="' + v + '"]' )
											.addClass( 'isw-enabled' )
											.removeClass( 'isw-disabled' );
									} else {
										$swatch.find( '.isw-term' )
											.addClass( 'isw-enabled' )
											.removeClass( 'isw-disabled' );
									}
								} else {
									if ( v ) {
										$swatch.find( '.isw-term[data-term="' + v + '"]' )
											.removeClass( 'isw-enabled' )
											.addClass( 'isw-disabled' );

										return false;
									}
								}
							}

						} );
					}

					if ( $el.hasClass( 'isw-selected' ) ) {
						$other_swatches.each( function() {
							$( this ).removeClass( 'isw-activated' );
							$( this ).find( '.isw-term' ).removeClass( 'isw-enabled isw-disabled isw-selected' );
						} );
					}
				},

				change_image: function( matching_variations, $el ) {

					var $product         = $el.parents( isw.product_selector ),
						$img             = $product.find( 'img' ).first(),
						$reset_variation = $product.find( '.reset_variations' ).first();

					var src, srcset, sizes,
						o_src    = $img.data( 'o-src' ),
						o_srcset = $img.data( 'o-srcset' ),
						o_sizes  = $img.data( 'o-sizes' );

					if ( typeof  o_src == 'undefined' ) {
						$img.data( 'o-src', $img.attr( 'src' ) );
					}

					if ( typeof  o_srcset == 'undefined' ) {
						$img.data( 'o-srcset', $img.attr( 'srcset' ) );
					}

					if ( typeof  o_sizes == 'undefined' ) {
						$img.data( 'o-sizes', $img.attr( 'sizes' ) );
					}

					if ( $el.hasClass( 'isw-selected' ) ) {

						src    = o_src;
						srcset = o_srcset;
						sizes  = o_sizes;

						$el.parent().removeClass( 'isw-activated' )
						$el.parent().find( '.isw-term' ).removeClass( 'isw-selected' );
						$product.removeClass( 'isw-product-swatched' );
					} else {
						$el.parent().addClass( 'isw-activated' )
						$el.parent().find( '.isw-term' ).removeClass( 'isw-selected' );
						$el.addClass( 'isw-selected' );
						$product.addClass( 'isw-product-swatched' );
						$reset_variation.show();

						for ( var i = 0; i < matching_variations.length; i ++ ) {
							var variation = matching_variations[ i ];

							if ( typeof variation.image_src != 'undefined' ) {
								src = variation.image_src[ 0 ];
							}

							if ( variation.image_srcset != '' ) {
								srcset = variation.image_srcset;
							}

							if ( variation.image_sizes != '' ) {
								sizes = variation.image_sizes;
							}
						}
					}

					if ( typeof src !== 'undefined' && typeof srcset !== 'undefined' && typeof sizes !== 'undefined' ) {

						$img.parent().addClass( 'loading' );

						$img.attr( 'src', src )
							.attr( 'srcset', srcset )
							.attr( 'sizes', sizes )
							.one( 'load', function() {
								$img.parent().removeClass( 'loading' );
							} );
					}

				},

				change_add_to_cart_button_text: function( selected_variation, $el ) {

					var attr_count       = $el.find( '.isw-swatch' ).length,
						$add_to_cart_btn = $el.parents( isw.product_selector ).find( '.add_to_cart_button' ),
						text;

					$add_to_cart_btn.removeClass( 'added' );

					if ( ! $.isEmptyObject( selected_variation ) ) {
						if ( selected_variation[ 'is_in_stock' ] === true ) {
							var i = 0;

							$.each( selected_variation[ 'attributes' ], function() {
								i ++;
							} );

							if ( attr_count == i ) {
								text = isw.localization.add_to_cart_text;
								$add_to_cart_btn.addClass( 'isw-ready' ).removeClass( 'isw-readmore' );

							} else {
								text = isw.localization.select_options_text;
								$add_to_cart_btn.removeClass( 'isw-ready isw-readmore' );
							}

						} else {
							text = isw.localization.read_more_text;
							$add_to_cart_btn.addClass( 'isw-readmore' ).removeClass( 'isw-ready' );
						}
					} else {
						text = isw.localization.select_options_text;
						$add_to_cart_btn.removeClass( 'isw-ready isw-readmore' );
					}

					$add_to_cart_btn.addClass( 'isw-text-changed' ).text( text );

					$( 'body' ).trigger( 'change_add_to_cart_button_text' );
				},

				change_price_of_variation: function( matching_variations, $swatches ) {

					var self               = this,
						$this              = $swatches,
						selected_variation = {};

					if ( $this.find( '.isw-swatch' ).length > 0 && $this.find( '.isw-swatch:not(.isw-activated)' ).length == 0 ) {
						var $els     = $this.find( '.isw-swatch.isw-activated' );
						var curr_var = {};

						$els.each( function() {
							curr_var[ 'attribute_' + $( this ).attr( 'data-attribute' ) ] = $( this )
								.find( 'span.isw-selected' )
								.attr( 'data-term' );
						} )

						var i = $this.find( '.isw-swatch' ).length;

						$.each( matching_variations, function( key, variation ) {

							var o     = 0;
							var found = false;

							$.each( curr_var, function( k, v ) {
								var curr_set = self.getObjects( variation[ 'attributes' ], k, v );

								if ( $.isEmptyObject( curr_set ) === false ) {
									o ++;
								}
							} );

							if ( o === i ) {
								found = true;
							}

							if ( found === true ) {
								selected_variation = variation;
							}
						} );
					}

					// change price
					if ( ! $.isEmptyObject( selected_variation ) ) {

						$this.attr( 'data-variation_id', selected_variation[ 'variation_id' ] );

						var $product = $this.parents( isw.product_selector ),
							$price   = $product.find( isw.price_selector ).not( '.price-cloned' );

						if ( ! $( '.price-cloned' ).length ) {
							var $price_clone = $price.clone().addClass( 'price-cloned' ).css( 'display', 'none' );
							$product.append( $price_clone );
						}

						if ( $price.length && selected_variation.price_html ) {
							$price.replaceWith( selected_variation.price_html );
						}

					} else {
						$this.removeAttr( 'data-variation_id' );
					}

					self.change_add_to_cart_button_text( selected_variation, $this );
				}
			}

		} );

	}
).apply( this, [ window.isw, jQuery ] );

(
	function( isw, $ ) {

		$( document ).ready( function() {
			if ( typeof isw.Swatches !== 'undefined' ) {
				isw.Swatches.init();
			}
		} );

	}
).apply( this, [ window.isw, jQuery ] );