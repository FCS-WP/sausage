<?php
/**
 * The template to show mobile menu (used only header_style == 'default')
 *
 * @package EASYEAT
 * @since EASYEAT 1.0
 */

$easyeat_show_widgets = easyeat_get_theme_option( 'widgets_menu_mobile_fullscreen' );
$easyeat_show_socials = easyeat_get_theme_option( 'menu_mobile_socials' );

?>
<div class="menu_mobile_overlay scheme_dark"></div>
<div class="menu_mobile menu_mobile_<?php echo esc_attr( easyeat_get_theme_option( 'menu_mobile_fullscreen' ) > 0 ? 'fullscreen' : 'narrow' ); ?> scheme_dark">
	<div class="menu_mobile_inner<?php echo esc_attr( $easyeat_show_widgets == 1  ? ' with_widgets' : '' ); ?>">
        <div class="menu_mobile_header_wrap">
            <?php
            // Logo
            set_query_var( 'easyeat_logo_args', array( 'type' => 'mobile' ) );
            get_template_part( apply_filters( 'easyeat_filter_get_template_part', 'templates/header-logo' ) );
            set_query_var( 'easyeat_logo_args', array() ); ?>

            <a class="menu_mobile_close menu_button_close" tabindex="0"><span class="menu_button_close_text"><?php esc_html_e('Close', 'easyeat')?></span><span class="menu_button_close_icon"></span></a>
        </div>
        <div class="menu_mobile_content_wrap content_wrap">
            <div class="menu_mobile_content_wrap_inner<?php echo esc_attr($easyeat_show_socials ? '' : ' without_socials'); ?>"><?php
            // Mobile menu
            $easyeat_menu_mobile = easyeat_get_nav_menu( 'menu_mobile' );
            if ( empty( $easyeat_menu_mobile ) ) {
                $easyeat_menu_mobile = apply_filters( 'easyeat_filter_get_mobile_menu', '' );
                if ( empty( $easyeat_menu_mobile ) ) {
                    $easyeat_menu_mobile = easyeat_get_nav_menu( 'menu_main' );
                    if ( empty( $easyeat_menu_mobile ) ) {
                        $easyeat_menu_mobile = easyeat_get_nav_menu();
                    }
                }
            }
            if ( ! empty( $easyeat_menu_mobile ) ) {
                // Change attribute 'id' - add prefix 'mobile-' to prevent duplicate id on the page
                $easyeat_menu_mobile = preg_replace( '/([\s]*id=")/', '${1}mobile-', $easyeat_menu_mobile );
                // Change main menu classes
                $easyeat_menu_mobile = str_replace(
                array( 'menu_main',   'sc_layouts_menu_nav', 'sc_layouts_menu ' ), // , 'sc_layouts_hide_on_mobile', 'hide_on_mobile'
                array( 'menu_mobile', '', ' ' ), // , '', ''
                    $easyeat_menu_mobile
                );
                // Wrap menu to the <nav> if not present
                if ( strpos( $easyeat_menu_mobile, '<nav ' ) !== 0 ) {	// condition !== false is not allowed, because menu can contain inner <nav> elements (in the submenu layouts)
                    $easyeat_menu_mobile = sprintf( '<nav class="menu_mobile_nav_area" itemscope="itemscope" itemtype="%1$s//schema.org/SiteNavigationElement">%2$s</nav>', esc_attr( easyeat_get_protocol( true ) ), $easyeat_menu_mobile );
                }
                // Show menu
                easyeat_show_layout( apply_filters( 'easyeat_filter_menu_mobile_layout', $easyeat_menu_mobile ) );
            }
            // Social icons
            if($easyeat_show_socials) {
                easyeat_show_layout( easyeat_get_socials_links(), '<div class="socials_mobile">', '</div>' );
            }            
            ?>
            </div>
		</div><?php

        if ( $easyeat_show_widgets == 1 )  {
            ?><div class="menu_mobile_widgets_area"><?php
            // Create Widgets Area
            easyeat_create_widgets_area( 'widgets_additional_menu_mobile_fullscreen' );
            ?></div><?php
        } ?>

    </div>
</div>
