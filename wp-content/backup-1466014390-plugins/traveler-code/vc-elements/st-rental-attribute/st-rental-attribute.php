<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 12/15/14
 * Time: 8:52 AM
 */


vc_map( array(
    "name" => __("ST Rental Attribute", STP_TEXTDOMAIN),
    "base" => "st_rental_attribute",
    "content_element" => true,
    "icon" => "icon-st",
    "category"=>'Shinetheme',
    "params" => array(
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Select Taxonomy", STP_TEXTDOMAIN),
            "param_name" => "taxonomy",
            "description" =>"",
            "value" => st_list_taxonomy('st_rental'),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Item Size", STP_TEXTDOMAIN),
            "param_name" => "item_col",
            "description" =>"",
            "value" => array(
                2=>2,
                3=>3,
                4=>4,
                5=>5,
                6=>6,
                7=>7,
                8=>8,
                9=>9,
                10=>10,
                11=>11,
                12=>12,
            ),
        )
    )
) );

Class st_rental_attribute extends STBasedShortcode{

    function __construct()
    {
        parent::__construct();
    }


    function content($attr,$content=false)
    {
        if(is_singular('st_rental'))
        {
            return st()->load_template('rental/elements/attribute',null,array('attr'=>$attr));
        }
    }
}

new st_rental_attribute();