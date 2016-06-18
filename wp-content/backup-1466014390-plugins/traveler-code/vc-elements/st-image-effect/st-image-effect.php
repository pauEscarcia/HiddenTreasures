<?php
vc_map( array(
    "name" => __("ST Image Effect", STP_TEXTDOMAIN),
    "base" => "st_image_effect",
    "content_element" => true,
    "icon" => "icon-st",
    "category"=>"Shinetheme",
    "params" => array(
        array(
            "type" => "attach_image",
            "holder" => "div",
            "heading" => __("image", STP_TEXTDOMAIN),
            "param_name" => "st_image",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-12',
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Type Hover", STP_TEXTDOMAIN),
            "param_name" => "st_type",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-12',
            'value'=>array(
                __('Simple Hover',STP_TEXTDOMAIN)=>'',
                __('Icon',STP_TEXTDOMAIN)=>'icon',
                __('Icon Group',STP_TEXTDOMAIN)=>'icon-group',
                __('Title',STP_TEXTDOMAIN)=>'title',
                __('Inner Full',STP_TEXTDOMAIN)=>'inner-full',
                __('Inner Block',STP_TEXTDOMAIN)=>'inner-block',
            )
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Position Layout", STP_TEXTDOMAIN),
            "param_name" => "st_pos_layout",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-4',
            'value'=>array(
                __("Top Left",STP_TEXTDOMAIN)     =>"-top-left",
                __("Top Right",STP_TEXTDOMAIN)    =>"-top-right",
                __("Bottom Left",STP_TEXTDOMAIN)  =>"-bottom-left",
                __("Bottom Right",STP_TEXTDOMAIN) =>"-bottom-right",
                __("Center",STP_TEXTDOMAIN)       =>"-center",
                __("Center Top",STP_TEXTDOMAIN)   =>"-center-top",
                __("Center Bottom",STP_TEXTDOMAIN)=>"-center-bottom",
                __("Top",STP_TEXTDOMAIN)   =>"-top",
                __("Bottom",STP_TEXTDOMAIN)=>"-bottom",
            )
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Hover Hold", STP_TEXTDOMAIN),
            "param_name" => "st_hover_hold",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-4',
            'value'=>array(
                __("No",STP_TEXTDOMAIN)     =>"",
                __("Yes",STP_TEXTDOMAIN)    =>"hover-hold",
            )
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
            "heading" => __("Class Icon", STP_TEXTDOMAIN),
            "param_name" => "st_class_icon",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-12',
        ),
        array(
            "type" => "textarea",
            "holder" => "div",
            "heading" => __("Icon Group", STP_TEXTDOMAIN),
            "param_name" => "content",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-12',
            'value'=>''
        ),
    )
) );

Class st_image_effect extends STBasedShortcode{
    function __construct()
    {
        parent::__construct();
    }
    function content($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_image' =>'',
                'st_type' =>'',
                'st_pos_layout' =>'',
                'st_hover_hold' =>'',
                'st_title' =>'',
                'st_class_icon'=>'',
                'st_icon_group'=>''
            ), $attr, 'st_image_effect' );
        extract($data);
        $img = wp_get_attachment_image_src($st_image,'full');
        if($st_type == ""){
            $txt ='<a href="#" class="hover-img">
                     <img title="" alt="" src="'.$img[0].'">
                   </a>';
        }

        if($st_type == "icon"){
            $txt ='<a href="#" class="hover-img">
                     <img title="" alt="" src="'.$img[0].'">
                     <i class="fa '.$st_class_icon.' box-icon hover-icon'.$st_pos_layout.' '.$st_hover_hold.' round"></i>
                   </a>';
        }
        if($st_type == "icon-group"){
            $content = str_ireplace('<ul>','',$content);
            $content = str_ireplace('</ul>','',$content);
            $txt ='<div class="hover-img">
                     <img title="" alt="" src="'.$img[0].'">
                     <ul class="hover-icon-group'.$st_pos_layout.' '.$st_hover_hold.'">
                    '.st_remove_wpautop($content).'
                    </ul>
                   </div>';
        }
        if($st_type == "title"){
            $txt ='<a href="#" class="hover-img">
                            <img title="" alt="" src="'.$img[0].'">
                            <h5 class="hover-title'.$st_pos_layout.' '.$st_hover_hold.'">'.$st_title.'</h5>
                         </a>';
        }
        if($st_type == "inner-full"){
            $txt ='<a href="#" class="hover-img">
                            <img title="" alt="" src="'.$img[0].'">
                            <div class="hover-inner">'.$st_title.'</div>
                         </a>';
        }
        if($st_type == "inner-block") {
            $txt = '<a href="#" class="hover-img">
                            <img title="" alt="" src="' . $img[0] . '">
                            <div class="hover-inner hover-hold">' . $st_title . '</div>
                         </a>';
        }
        return $txt;
    }
}
new st_image_effect();