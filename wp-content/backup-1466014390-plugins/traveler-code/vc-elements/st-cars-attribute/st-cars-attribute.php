<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 12/15/14
 * Time: 8:52 AM
 */


vc_map( array(
    "name" => __("ST Cars Attribute", STP_TEXTDOMAIN),
    "base" => "st_cars_attribute",
    "content_element" => true,
    "icon" => "icon-st",
    "category"=>"Shinetheme",
    "params" => array(
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Select Taxonomy", STP_TEXTDOMAIN),
            "param_name" => "taxonomy",
            "description" =>"",
            "value" => st_list_taxonomy('st_cars'),
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Title", STP_TEXTDOMAIN),
            "param_name" => "title",
            "description" =>"",
        )
    )
) );

Class st_cars_attribute extends STBasedShortcode{

    function __construct()
    {
        parent::__construct();
    }


    function content($attr,$content=false)
    {
        if(is_singular('st_cars'))
        {
            return st()->load_template('cars/elements/attribute',null,array('attr'=>$attr));
        }
    }
}

new st_cars_attribute();