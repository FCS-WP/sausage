<?php
/**
 * Widget: Properties Compare (Shortcodes)
 *
 * @package ThemeREX Addons
 * @since v1.6.24
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	exit;
}


// trx_widget_properties_compare
//-------------------------------------------------------------
/*
[trx_widget_properties_compare id="unique_id" title="Widget title"]
*/
if ( !function_exists( 'trx_addons_sc_widget_properties_compare' ) ) {
	function trx_addons_sc_widget_properties_compare($atts, $content = ''){	
		$atts = trx_addons_sc_prepare_atts( 'trx_widget_properties_compare', $atts, trx_addons_sc_common_atts( 'trx_widget_properties_compare', 'id', array(
			// Individual params
			"title" => "",
		) ) );
		extract($atts);
		$type = 'trx_addons_widget_properties_compare';
		$output = '';
		global $wp_widget_factory;
		if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
			$output = '<div' . ($id ? ' id="'.esc_attr($id).'"' : '')
							. ' class="widget_area sc_widget_properties_compare' 
								. (trx_addons_exists_vc() ? ' vc_widget_properties_compare wpb_content_element' : '') 
								. (!empty($class) ? ' ' . esc_attr($class) : '') 
								. '"'
							. ($css ? ' style="'.esc_attr($css).'"' : '')
						. '>';
			ob_start();
			the_widget( $type, $atts, trx_addons_prepare_widgets_args($id ? $id.'_widget' : 'widget_properties_compare', 'widget_properties_compare') );
			$output .= ob_get_contents();
			ob_end_clean();
			$output .= '</div>';
		}
		return apply_filters('trx_addons_sc_output', $output, 'trx_widget_properties_compare', $atts, $content);
	}
}


// Add shortcode [trx_widget_properties_compare]
if (!function_exists('trx_addons_sc_widget_properties_compare_add_shortcode')) {
	function trx_addons_sc_widget_properties_compare_add_shortcode() {
		add_shortcode("trx_widget_properties_compare", "trx_addons_sc_widget_properties_compare");
	}
	add_action('init', 'trx_addons_sc_widget_properties_compare_add_shortcode', 20);
}
