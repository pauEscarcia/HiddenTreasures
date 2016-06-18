<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * function
 *
 * Created by ShineTheme
 *
 */

if(!defined('ST_TEXTDOMAIN'))
define ('ST_TEXTDOMAIN','traveler');

if(!defined('ST_TRAVELER_VERSION'))
{
    $theme=wp_get_theme();
	if($theme->parent())
	{
		$theme=$theme->parent();
	}
    define ('ST_TRAVELER_VERSION',$theme->get( 'Version' ));
}


$status=load_theme_textdomain(ST_TEXTDOMAIN,get_template_directory().'/language');

get_template_part('inc/class.traveler');

st();
get_template_part('demo/demo_functions');


