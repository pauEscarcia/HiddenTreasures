<?php
vc_map( array(
    "name" => __("ST Single Search", STP_TEXTDOMAIN),
    "base" => "st_single_search",
    "content_element" => true,
    "icon" => "icon-st",
    "category"=>"Shinetheme",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Title form search", STP_TEXTDOMAIN),
            "param_name" => "st_title_search",
            "description" =>"",
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Select form search", STP_TEXTDOMAIN),
            "param_name" => "st_list_form",
            "description" =>"",
            'value'=>array(
                __('Hotel',STP_TEXTDOMAIN)=>'hotel',
                __('Rental',STP_TEXTDOMAIN)=>'rental',
                __('Cars',STP_TEXTDOMAIN)=>'cars',
                __('Activities',STP_TEXTDOMAIN)=>'activities',
                __('Tours',STP_TEXTDOMAIN)=>'tours'
            ),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Form's direction", STP_TEXTDOMAIN),
            "param_name" => "st_direction",
            "description" =>"",
            'value'=>array(
                __('Vertical form',STP_TEXTDOMAIN)=>'vertical',
                __('Horizontal form',STP_TEXTDOMAIN)=>'horizontal'
            ),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Style", STP_TEXTDOMAIN),
            "param_name" => "st_style_search",
            "description" =>"",
            'value'=>array(
                __('Large',STP_TEXTDOMAIN)=>'style_1',
                __('Normal',STP_TEXTDOMAIN)=>'style_2',
            )
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
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Field Size", STP_TEXTDOMAIN),
            "param_name" => "field_size",
            "description" =>"",
            'value'=>array(
                __('Large',STP_TEXTDOMAIN)=>'lg',
                __('Normal',STP_TEXTDOMAIN)=>'',
            )
        ),
    )
) );

Class st_single_search extends STBasedShortcode{

    function __construct()
    {
        parent::__construct();
    }


    function content($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_list_form'=>'',
                'st_style_search' =>'style_1',
                'st_direction'=>'horizontal',
                'st_box_shadow'=>'no',
                'st_search_tabs'=>'yes',
                'st_title_search'=>'',
                'field_size'    =>'',
                'active'            =>1
            ), $attr, 'st_single_search' );
        extract($data);



        $txt = st()->load_template('vc-elements/st-single-search/search','form',array('data'=>$data));

        return $txt;
    }
}

new st_single_search();