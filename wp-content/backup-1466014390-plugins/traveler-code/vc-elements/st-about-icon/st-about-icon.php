<?php
vc_map( array(
    "name" => __("ST About Icon", STP_TEXTDOMAIN),
    "base" => "st_about_icon",
    "content_element" => true,
    "icon" => "icon-st",
    "category"=>"Shinetheme",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Icon", STP_TEXTDOMAIN),
            "param_name" => "st_icon",
            "description" =>"",
            'edit_field_class'=>'st_iconpicker vc_col-sm-12'
        ),
        array(
            "type" => "colorpicker",
            "holder" => "div",
            "heading" => __("Color Icon", STP_TEXTDOMAIN),
            "param_name" => "st_color_icon",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-3'
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("To Color Icon", STP_TEXTDOMAIN),
            "param_name" => "st_to_color",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-3',
            'value'=>'black'
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Position Icon", STP_TEXTDOMAIN),
            "param_name" => "st_pos_icon",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-3',
            'value'=>array(
                __('Top',STP_TEXTDOMAIN)=>'top',
                __('Left',STP_TEXTDOMAIN)=>'left',
                __('Right',STP_TEXTDOMAIN)=>'right'
            )
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Size Icon", STP_TEXTDOMAIN),
            "param_name" => "st_size_icon",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-3',
            'value'=>array(
                __('Small',STP_TEXTDOMAIN)=>'box-icon-sm',
                __('Medium',STP_TEXTDOMAIN)=>'box-icon-md',
                __('Big',STP_TEXTDOMAIN)=>'box-icon-big'
            )
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Text Align", STP_TEXTDOMAIN),
            "param_name" => "st_text_align",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-3',
            'value'=>array(
                __('Center',STP_TEXTDOMAIN)=>'text-center',
                __('Left',STP_TEXTDOMAIN)=>'text-left',
                __('Right',STP_TEXTDOMAIN)=>'text-right'
            )
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Box icon border", STP_TEXTDOMAIN),
            "param_name" => "st_border",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-3',
            'value'=>array(
                __('No',STP_TEXTDOMAIN)=>'',
                __('Yes',STP_TEXTDOMAIN)=>'box-icon-border',
            )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Animation", STP_TEXTDOMAIN),
            "param_name" => "st_animation",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-6',
            'value'=>'animate-icon-top-to-bottom'
        ),

        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Name", STP_TEXTDOMAIN),
            "param_name" => "st_name",
            "description" =>"",
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Link", STP_TEXTDOMAIN),
            "param_name" => "st_link",
            "description" =>"",
        ),
        array(
            "type" => "textarea",
            "holder" => "div",
            "heading" => __("Description", STP_TEXTDOMAIN),
            "param_name" => "st_description",
            "description" =>"",
        ),
    )
) );

Class st_about_icon extends STBasedShortcode{

    function __construct()
    {
        parent::__construct();
    }


    function content($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_icon' =>'',
                'st_name' => '',
                'st_description'=>'',
                'st_link'=>'',
                'st_pos_icon'=>'',
                'st_color_icon'=>'',
                'st_size_icon'=>'',
                'st_text_align'=>'',
                'st_border'=>'',
                'st_to_color'=>''
            ), $attr, 'st_about_icon' );
        extract($data);

        $icons_center='';
        if($st_text_align =='text-center'){
            $icons_center = 'box-icon-center';
        }

        $class_bg_color = Assets::build_css("background: ".$st_color_icon."");

        if(!empty($st_border)){
            $class_bg_color = Assets::build_css("border-color: ".$st_color_icon.";
                                                 color: ".$st_color_icon.";");
        }

        if(empty($st_link)){
            $title = '<h4 class="thumb-title">'.$st_name.'</h4>';
        }else{
            $title = ' <h5 class="thumb-title">
                        <a href="'.$st_link.'" class="text-darken">'.$st_name.'</a>
                       </h5>';
        }
        $txt =  '
        <div class="thumb '.$st_text_align.'">
                <header class="thumb-header pull-'.$st_pos_icon.' st-thumb-header">
                   <i class="fa '.$st_icon.' '.$st_size_icon.' box-icon-'.$st_pos_icon.' '.$icons_center.' round '.$class_bg_color.' animate-icon-top-to-bottom '.$st_border.'  box-icon-to-'.$st_to_color.' "></i>
                </header>
                <div class="thumb-caption pull-'.$st_pos_icon.' st-thumb-caption">
                     '.$title.'
                    <p class="thumb-desc">'.$st_description.'</p>
                </div>
        </div>
        ';
        return $txt;
    }
}
new st_about_icon();