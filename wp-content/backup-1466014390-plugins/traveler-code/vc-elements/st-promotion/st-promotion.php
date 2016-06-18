<?php
vc_map( array(
    "name" => __("ST Promotion", STP_TEXTDOMAIN),
    "base" => "st_promotion",
    "content_element" => true,
    "icon" => "icon-st",
    "category"=>"Shinetheme",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Icon ", STP_TEXTDOMAIN),
            "param_name" => "st_icon",
            "description" =>"",
            'value'=>'fa-clock-o',
            'edit_field_class'=>'vc_col-sm-6',
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Discount", STP_TEXTDOMAIN),
            "param_name" => "st_discount",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-6',
        ),
        array(
            "type" => "attach_image",
            "holder" => "div",
            "heading" => __("Background Image", STP_TEXTDOMAIN),
            "param_name" => "st_bg_img",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-4',
        ),
        array(
            "type" => "colorpicker",
            "holder" => "div",
            "heading" => __("Background Color", STP_TEXTDOMAIN),
            "param_name" => "st_bg",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-4',
            'value'=>'#002ca8'
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Opacity", STP_TEXTDOMAIN),
            "param_name" => "st_opacity",
            "description" =>__("Opacity : 0-100",STP_TEXTDOMAIN),
            'edit_field_class'=>'vc_col-sm-4',
            'value'=>'50',
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Title", STP_TEXTDOMAIN),
            "param_name" => "st_title",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-12',
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Sub", STP_TEXTDOMAIN),
            "param_name" => "st_sub",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-12',
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Link", STP_TEXTDOMAIN),
            "param_name" => "st_link",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-12',
        )
    )
) );

Class st_promotion extends STBasedShortcode{

    function __construct()
    {
        parent::__construct();
    }


    function content($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_icon'=>'',
                'st_discount' =>0,
                'st_bg'=>'',
                'st_bg_img'=>'',
                'st_opacity'=>'',
                'st_title'=>'',
                'st_sub'=>'',
                'st_link'=>'',
            ), $attr, 'st_promotion' );
        extract($data);
        return st()->load_template('vc-elements/st-promotion/html',false,$data);
    }
}

new st_promotion();