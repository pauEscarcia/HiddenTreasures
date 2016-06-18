<?php
vc_map( array(
    "name" => __("ST Search", STP_TEXTDOMAIN),
    "base" => "st_search",
    "content_element" => true,
    "icon" => "icon-st",
    "category"=>"Shinetheme",
    "params" => array(
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Style", STP_TEXTDOMAIN),
            "param_name" => "st_style_search",
            "description" =>"",
            'value'=>array(
                __('Large',STP_TEXTDOMAIN)=>'style_1',
                __('Small',STP_TEXTDOMAIN)=>'style_2'
            ),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Show box shadow", STP_TEXTDOMAIN),
            "param_name" => "st_box_shadow",
            "description" =>"",
            'value'=>array(
                __('No',STP_TEXTDOMAIN)=>'no',
                __('Yes',STP_TEXTDOMAIN)=>'yes'
            ),
        )
    )
) );

Class st_search extends STBasedShortcode{

    function __construct()
    {
        parent::__construct();
    }


    function content($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_style_search' =>'style_1',
                'st_box_shadow'=>'no',
            ), $attr, 'st_search' );
        extract($data);


        $txt = st()->load_template('vc-elements/st-search/search','form',array('data'=>$data));
        return $txt;
    }
}

new st_search();