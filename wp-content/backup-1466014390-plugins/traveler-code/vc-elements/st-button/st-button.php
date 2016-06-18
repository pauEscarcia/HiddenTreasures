<?php
vc_map( array(
    "name" => __("ST Button", STP_TEXTDOMAIN),
    "base" => "st_button",
    "content_element" => true,
    "icon" => "icon-st",
    "category"=>"Shinetheme",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Text Button", STP_TEXTDOMAIN),
            "param_name" => "st_title",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-12'
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Link Buttons", STP_TEXTDOMAIN),
            "param_name" => "st_link",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-12',
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Type Button", STP_TEXTDOMAIN),
            "param_name" => "st_type",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-4',
            'value'=>array(
                __('Default',STP_TEXTDOMAIN)=>'btn-default',
                __('Primary',STP_TEXTDOMAIN)=>'btn-primary',
                __('Success',STP_TEXTDOMAIN)=>'btn-success',
                __('Info',STP_TEXTDOMAIN)=>'btn-info',
                __('Warning',STP_TEXTDOMAIN)=>'btn-warning',
                __('Danger',STP_TEXTDOMAIN)=>'btn-danger',
                __('Link',STP_TEXTDOMAIN)=>'btn-link',
            )
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Button Sizes", STP_TEXTDOMAIN),
            "param_name" => "st_size",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-4',
            'value'=>array(
                __('Normal',STP_TEXTDOMAIN)=>'btn-normal',
                __('Large',STP_TEXTDOMAIN)=>'btn-lg',
                __('Small',STP_TEXTDOMAIN)=>'btn-sm',
                __('Extra small',STP_TEXTDOMAIN)=>'btn-xs',
            )
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Ghost Buttons", STP_TEXTDOMAIN),
            "param_name" => "st_ghost",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-4',
            'value'=>array(
                __('No',STP_TEXTDOMAIN)=>'',
                __('Yes',STP_TEXTDOMAIN)=>'btn-ghost',
            )
        ),


    )
) );

Class st_button extends STBasedShortcode{
    function __construct()
    {
        parent::__construct();
    }
    function content($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_title' =>'',
                'st_link' =>'',
                'st_type' =>'',
                'st_size' =>'',
                'st_ghost' =>'',
            ), $attr, 'st_button' );
        extract($data);
        $txt ='<a href="'.$st_link.'" class="btn '.$st_type.' '.$st_size.' '.$st_ghost.'">'.$st_title.'</a>';
        return $txt;
    }
}
new st_button();