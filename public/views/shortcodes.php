<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

// pinterest Free shortcode.
if ( ! function_exists( 'kp_pinterest_free_shortcode' ) ) :
	function kp_pinterest_free_shortcode( $atts ) {
		extract(
			shortcode_atts(
				array(
					'id' => null
				), $atts, 'pinterest-free'
			)
		);

		$post_id = $atts['id'];

		$html = '';

		$pinterest_args = array(
			'post_type'      => 'kpp_pinterest',
			'p'         	 => $post_id, // ID of a page, post, or custom type
			'post_status'    => 'publish'		
		);

		$pinterest_query = new WP_Query( $pinterest_args );

		if ( $pinterest_query->have_posts() ) {

			while ( $pinterest_query->have_posts() ) :
				$pinterest_query->the_post();


				
				$defaultValues  = [
					'masonry_col' => '4',
					'bpinterest_row_gap' => 5,
					'bpinterest_col_gap' => 5,
					'slider_column' => '4',
					'slider_col_tablet' => '2',
					'slider_col_mobile' => '1',
					'slider_item_gap' => 5,
					'loop' => true,
					'mouseWheel' => true,
					'autoPlay' => true,
					'effect' => 'none',
					'delay' => 2500,
					'bpinterest_justified_margin' => 5,
					'isCssAnimation' =>  true,
					'lastrow' =>  'nojustify',
					'ratio' => 'square',
					'border' => array(
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'style'  => 'dashed',
					'color'  => '#1e73be',
					'unit'   => 'px',
					),
					'borderRadius' => 5,
					'layout' => 'default',
					'isOverly' => false,
					'isTransform' => false,
					'column' => '4',
					'bpinterest_row_gap' => 5,
					'bpinterest_col_gap' => 5,
					'col_tablet' => '2',
					'col_mobile' => '1',
					'overlyColor' => '#00000038'
					
				];

				
				// get codestar options
				$pinterest_data  = wp_parse_args(get_post_meta( get_the_ID(), 'kp_pinterest_options', true ), $defaultValues);


				
				// pinterest container
				$pinterest_container 		= "pins_".esc_attr(get_the_ID());


				// template
				$template = '<div class="single-item swiper-slide">
					<a class="pins__thumbnail" href="%bigUrl%">
						<div class="imaArea">
							<img class="pins__thumb-img" src="%thumbUrl%" alt="%boardName%">
						</div>
					</a>
				</div>';

				// settings array
				$kp_pinterest_args = array(
					'template'				=> $template,
					'userName' 				=> $pinterest_data['kp-pinterest-username'],
					'boardName' 			=> $pinterest_data['kp-pinterest-boardName'],
					'masonry_column'		=> $pinterest_data['masonry_col'],
					'row_gap'				=> $pinterest_data['bpinterest_row_gap'],
					'column_gap'			=> $pinterest_data['bpinterest_col_gap'],
					'slider_column'			=> $pinterest_data['slider_column'],
					'slider_col_tablet'		=> $pinterest_data['slider_col_tablet'],
					'slider_col_mobile'		=> $pinterest_data['slider_col_mobile'],
					'slider_item_gap'		=> $pinterest_data['slider_item_gap'],
					'loop'					=> $pinterest_data['loop'],
					'mouseWheel'			=> $pinterest_data['mouseWheel'],
					'autoPlay'				=> $pinterest_data['autoPlay'],
					'effect'                => $pinterest_data['effect'],
					'delay'                 => $pinterest_data['delay'],
					'justified_margin'      => $pinterest_data['bpinterest_justified_margin'],
					'isCssAnimation'        => $pinterest_data['isCssAnimation'],
					'lastrow'        		=> $pinterest_data['lastrow'],
				);

				// json encode options
				$kp_pinterest_options = json_encode($kp_pinterest_args);	

				$setting_options 		= get_option( '_kp_pinterest_options' );

				$kp_allow_popup 		= $setting_options['kp-pinterest-allow-popup'] == true ? 'allow-popup' : '';

				$ratio = $pinterest_data['ratio'];
				$border = $pinterest_data['border'];
				$top = $pinterest_data['border']['top'];
				$bottom = $pinterest_data['border']['bottom'];
				$left = $pinterest_data['border']['left'];
				$right = $pinterest_data['border']['right'];
				$style = $pinterest_data['border']['style'];
				$color = $pinterest_data['border']['color'];
				$radius = $pinterest_data['borderRadius'];
				$layout = $pinterest_data['layout'];
				$isOverly = $pinterest_data['isOverly'];
				$isTransform = $pinterest_data['isTransform'];
				$overlyColor = ($isOverly == 1 ? $pinterest_data['overlyColor'] : '');
				$transform = $isTransform == 1 ? 1.05 : 1;


				if ($layout == "masonry"){
					wp_enqueue_script( 'miniMasonry', KP_PFREE_URL . 'public/assets/js/miniMasonry.js', array( 'jquery' ), KP_PFREE_VERSION, true );
				}

				if($layout == "slider"){
					wp_enqueue_style( 'swiper', KP_PFREE_URL . 'public/assets/css/swiper.min.css', array(), '11.1.9', 'all' );
					wp_enqueue_script( 'swiper', KP_PFREE_URL . 'public/assets/js/swiper.min.js', array( ), '11.1.9', true );
				}

				if($layout == "justified") {
					wp_enqueue_style( 'justifiedGallery', KP_PFREE_URL . 'public/assets/css/justifiedGallery.min.css', array(), KP_PFREE_VERSION, 'all' );
					wp_enqueue_script( 'justifiedGallery', KP_PFREE_URL . 'public/assets/js/justifiedGallery.min.js', array(), KP_PFREE_VERSION, true );
				}
				$checkLout =  $layout == "slider" ? "" : "bp_pinterest_pins";

				// html output
				$html = '<div id="'.esc_attr($pinterest_container).'" class="layout ' .esc_attr($checkLout). '  '.esc_attr($kp_allow_popup).' '.esc_attr($layout == "slider" ? "swiper" : $layout).'" data-pinterest-options="'.esc_attr($kp_pinterest_options).'">
				'. ($layout == "slider" ? '<div id="'.esc_attr($pinterest_container).'" class="swiper-wrapper" data-pinterest-options="'.esc_attr($kp_pinterest_options).'"></div>' : '') .'
				'. ($layout == 'slider' ? "<div class='swiper-button-prev'></div><div class='swiper-button-next'></div>": '').'
				</div><style>
					.default {
						grid-template-columns: repeat('. esc_attr($pinterest_data['column']) .', 1fr);
						gap: '.esc_attr($pinterest_data['bpinterest_row_gap']).'px '.esc_attr($pinterest_data['bpinterest_col_gap']) .'px
					}

					@media all and (max-width: 767px) {
						.bp_pinterest_pins {
							grid-template-columns: repeat('. esc_attr($pinterest_data['col_tablet']) .', 1fr);
						}
					}

					@media all and (max-width: 575px) {
						.bp_pinterest_pins {
							grid-template-columns: repeat('. esc_attr($pinterest_data['col_mobile']) .', 1fr);
						}
					}

					.default .pins__thumbnail, .swiper .pins__thumbnail{
						padding-top: '. esc_attr(
							$ratio == 'square' ? '100' : 
							($ratio == 'landscape' ? '56.25' : 
							($ratio == 'horizontal' ? '75' : 
							($ratio == 'vertical' ? '133.33333333333331' : '177.77777777777777')))
						) . '%;
					}

					.layout .pins__thumbnail::after {
						background: '. esc_attr($overlyColor). ';
					}

					.layout .pins__thumbnail:hover img {
						transform: scale('.esc_attr($transform).');
					}
					
					.layout .pins__thumbnail{
						border-top: '. esc_attr($top).'px;
						border-bottom: '. esc_attr($bottom).'px;
						border-left: '. esc_attr($left).'px;
						border-right: '. esc_attr($right).'px;
						border-style: '. esc_attr($style). ';
						border-color: '. esc_attr($color). ';
						border-radius: '. esc_attr($radius). 'px;
					}

				</style>';

			endwhile;
		}	

		// reset postdata
		wp_reset_postdata();

		return $html;
	}
endif;

//call shortcode
add_shortcode( 'pinterest', 'kp_pinterest_free_shortcode' );