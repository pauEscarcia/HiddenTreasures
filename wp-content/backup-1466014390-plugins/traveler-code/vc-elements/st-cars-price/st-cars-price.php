<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 12/15/14
 * Time: 8:52 AM
 */
vc_map( array(
    "name" => __("ST Cars Price ", STP_TEXTDOMAIN),
    "base" => "st_cars_price",
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
                __('Style 1 column',STP_TEXTDOMAIN)=>'1',
                __('Style 2 column',STP_TEXTDOMAIN)=>'2'
            ),
        )
    )
) );

Class st_cars_price extends STBasedShortcode{

    function __construct()
    {
        parent::__construct();
    }


    function content($attr,$content=false)
    {
        if(is_singular('st_cars'))
        {
            return st()->load_template('cars/elements/price',null,array('attr'=>$attr));
        }
    }
}

new st_cars_price();