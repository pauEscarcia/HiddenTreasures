<?php
vc_map( array(
    "name" => __("ST Gird", STP_TEXTDOMAIN),
    "base" => "st_gird",
    "content_element" => true,
    "icon" => "icon-st",
    "category"=>"Shinetheme",
    "params" => array(
        array(
            "type" => "colorpicker",
            "holder" => "div",
            "heading" => __("Color", STP_TEXTDOMAIN),
            "param_name" => "st_color",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-12',
            'value'=>'#999'
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Size", STP_TEXTDOMAIN),
            "param_name" => "st_size",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-12',
            'value'=>array(
                __('col-1',STP_TEXTDOMAIN)=>'col-md-1',
                __('col-2',STP_TEXTDOMAIN)=>'col-md-2',
                __('col-3',STP_TEXTDOMAIN)=>'col-md-3',
                __('col-4',STP_TEXTDOMAIN)=>'col-md-4',
                __('col-5',STP_TEXTDOMAIN)=>'col-md-5',
                __('col-6',STP_TEXTDOMAIN)=>'col-md-6',
                __('col-7',STP_TEXTDOMAIN)=>'col-md-7',
                __('col-8',STP_TEXTDOMAIN)=>'col-md-8',
                __('col-9',STP_TEXTDOMAIN)=>'col-md-9',
                __('col-10',STP_TEXTDOMAIN)=>'col-md-10',
                __('col-11',STP_TEXTDOMAIN)=>'col-md-11',
                __('col-12',STP_TEXTDOMAIN)=>'col-md-12',
            )
        ),


    )
) );

Class st_gird extends STBasedShortcode{
    function __construct()
    {
        parent::__construct();
    }
    function content($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_color' =>'',
                'st_size' =>'',
            ), $attr, 'st_gird' );
        extract($data);
        $class = Assets::build_css('background : '.$st_color. ' ; height : 20px');
        $txt ='<div class="row"><div class="demo-grid">
                    <div class="'.$st_size.'">
                        <div class="'.$class.'"></div>
                    </div>
               </div></div>';
        return $txt;
    }
}
new st_gird();