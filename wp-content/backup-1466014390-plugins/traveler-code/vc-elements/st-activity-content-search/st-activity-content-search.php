<?php
vc_map( array(
    "name" => __("ST Activity Content Search ", STP_TEXTDOMAIN),
    "base" => "st_activiry_content_search",
    "content_element" => true,
    "icon" => "icon-st",
    "category"=>'Shinetheme',
    "params" => array(
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Style", STP_TEXTDOMAIN),
            "param_name" => "st_style",
            "description" =>"",
            "value" => array(
                __('Style 1 ',STP_TEXTDOMAIN)=>'1',
                __('Style 2 ',STP_TEXTDOMAIN)=>'2',
            ),
        )
    )
) );
Class st_activiry_content_search extends STBasedShortcode{

    function __construct()
    {
        parent::__construct();
    }


    function content($attr,$content=false)
    {
        if(is_search())
        {
            return st()->load_template('activity/content','activity',array('attr'=>$attr));
        }
    }
}

new st_activiry_content_search();