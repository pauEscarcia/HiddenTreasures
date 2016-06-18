<?php
vc_map( array(
    "name" => __("ST Lightbox", STP_TEXTDOMAIN),
    "base" => "st_lightbox",
    "content_element" => true,
    "icon" => "icon-st",
    "category"=>"Shinetheme",
    "params" => array(
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Type Lightbox", STP_TEXTDOMAIN),
            "param_name" => "st_type",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-4',
            'value'=>array(
                __('Image',STP_TEXTDOMAIN)=>'image',
                __('Iframe',STP_TEXTDOMAIN)=>'iframe',
                __('HTML',STP_TEXTDOMAIN)=>'html',
            )
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Animation effects", STP_TEXTDOMAIN),
            "param_name" => "st_effect",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-4',
            'value'=>array(
                __('Default',STP_TEXTDOMAIN)=>'',
                __('Zoom out',STP_TEXTDOMAIN)=>'mfp-zoom-out',
                __('Zoom in',STP_TEXTDOMAIN)=>'mfp-zoom-in',
                __('Fade',STP_TEXTDOMAIN)=>'mfp-fade',
                __('Move horizontal',STP_TEXTDOMAIN)=>'mfp-move-horizontal',
                __('Move from top',STP_TEXTDOMAIN)=>'mfp-move-from-top',
                __('Newspaper',STP_TEXTDOMAIN)=>'mfp-newspaper',
                __('3D unfold',STP_TEXTDOMAIN)=>'mfp-3d-unfold',
            )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Icon hover", STP_TEXTDOMAIN),
            "param_name" => "st_icon",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-4',
            'value'=>"fa-plus"
        ),
        array(
            "type" => "attach_image",
            "holder" => "div",
            "heading" => __("image", STP_TEXTDOMAIN),
            "param_name" => "st_image",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-2',
        ),
        array(
            "type" => "textarea",
            "holder" => "div",
            "heading" => __("Link Iframe", STP_TEXTDOMAIN),
            "param_name" => "st_link",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-10',
            'value'=>''
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Title", STP_TEXTDOMAIN),
            "param_name" => "st_title",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-12',
            'value'=>''
        ),
        array(
            "type" => "textarea",
            "holder" => "div",
            "heading" => __("Content html", STP_TEXTDOMAIN),
            "param_name" => "content",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-12',
            'value'=>''
        ),
    )
) );

Class st_lightbox extends STBasedShortcode{
    function __construct()
    {
        parent::__construct();
    }
    function content($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_type' =>'',
                'st_effect' =>'',
                'st_image' =>'',
                'st_link' =>'',
                'st_title' =>'',
                'st_icon' =>'fa-plus',
            ), $attr, 'st_lightbox' );
        extract($data);
        $img = wp_get_attachment_image_src($st_image,'full');
        if($st_type == "image"){
            $txt ='<a href="'.$img[0].'" class="hover-img popup-image" data-effect="'.$st_effect.'" >
                       <img title="" alt="" src="'.$img[0].'">
                       <i class="fa '.$st_icon.' round box-icon-small hover-icon i round"></i>
                   </a>';
        }
        if($st_type == "iframe"){
            $txt ='<a class="popup-iframe" data-effect="'.$st_effect.'" href="'.$st_link.'" inline_comment="lightbox">'.$st_title.'</a>';
        }
        if($st_type == "html"){
            $id = rand();
            $txt ='<a class="popup-text" data-effect="'.$st_effect.'" href="#small-dialog-'.$id.'">'.$st_title.'</a>
                    <div id="small-dialog-'.$id.'" class="mfp-with-anim mfp-dialog mfp-hide">
                    '.st_remove_wpautop($content).'
                    </div>';
        }
        return $txt;
    }
}
new st_lightbox();