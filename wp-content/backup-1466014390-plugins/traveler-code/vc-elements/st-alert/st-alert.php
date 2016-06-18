<?php
vc_map( array(
    "name" => __("ST Alert", STP_TEXTDOMAIN),
    "base" => "st_alert",
    "content_element" => true,
    "icon" => "icon-st",
    "category"=>"Shinetheme",
    "params" => array(
        array(
            "type" => "textarea",
            "holder" => "div",
            "heading" => __("Content Alert", STP_TEXTDOMAIN),
            "param_name" => "st_content",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-12'
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Type Alert", STP_TEXTDOMAIN),
            "param_name" => "st_type",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-12',
            'value'=>array(
                __('Success',STP_TEXTDOMAIN)=>'alert-success',
                __('Info',STP_TEXTDOMAIN)=>'alert-info',
                __('Warning',STP_TEXTDOMAIN)=>'alert-warning',
                __('Danger',STP_TEXTDOMAIN)=>'alert-danger',
            )
        ),

    )
) );

Class st_alert extends STBasedShortcode{
    function __construct()
    {
        parent::__construct();
    }
    function content($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_content' =>'',
                'st_type' =>'',
            ), $attr, 'st_alert' );
        extract($data);
        $txt ='<div class="alert '.$st_type.'">
                    <button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span>
                    </button>
                    <p class="text-small">'.$st_content.'</p>
                </div>';
        return $txt;
    }
}
new st_alert();