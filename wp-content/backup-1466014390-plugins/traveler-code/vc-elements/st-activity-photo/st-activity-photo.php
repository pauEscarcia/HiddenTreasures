<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 12/15/14
 * Time: 8:52 AM
 */
vc_map( array(
    "name" => __("ST Activity Detail Photo", STP_TEXTDOMAIN),
    "base" => "st_activity_detail_photo",
    "content_element" => true,
    "icon" => "icon-st",
    "category"=>'Shinetheme',
    "params" => array(
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Style", STP_TEXTDOMAIN),
            "param_name" => "style",
            "description" =>"",
            "value" => array(
                __('Slide',STP_TEXTDOMAIN)=>'slide',
                __('Grid',STP_TEXTDOMAIN)=>'grid',
            ),
        )
    )
) );

Class st_activity_detail_photo extends STBasedShortcode{

    function __construct()
    {
        parent::__construct();
    }


    function content($attr,$content=false)
    {
        if(is_singular('st_activity'))
        {
            return st()->load_template('activity/elements/photo',null,array('attr'=>$attr));
        }
    }
}

new st_activity_detail_photo();