<?php
vc_map( array(
    "name" => __("ST Team", STP_TEXTDOMAIN),
    "base" => "st_team",
    "content_element" => true,
    "icon" => "icon-st",
    "category"=>"Shinetheme",
    "params" => array(
        array(
            "type" => "attach_image",
            "holder" => "div",
            "heading" => __("Avatar", STP_TEXTDOMAIN),
            "param_name" => "st_avatar",
            "description" =>"",
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
            "heading" => __("Position", STP_TEXTDOMAIN),
            "param_name" => "st_position",
            "description" =>"",
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Social Effect ", STP_TEXTDOMAIN),
            "param_name" => "st_effect",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-6',
            'value'=>array(
                __("Hover",STP_TEXTDOMAIN)   =>"",
                __("Hold",STP_TEXTDOMAIN)    =>"hover-hold",
            )
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Position Social", STP_TEXTDOMAIN),
            "param_name" => "st_position_social",
            "description" =>"",
            'edit_field_class'=>'vc_col-sm-6',
            'value'=>array(
                __("Top Left",STP_TEXTDOMAIN)     =>"-top-left",
                __("Top Right",STP_TEXTDOMAIN)    =>"-top-right",
                __("Bottom Left",STP_TEXTDOMAIN)  =>"-bottom-left",
                __("Bottom Right",STP_TEXTDOMAIN) =>"-bottom-right",
                __("Center",STP_TEXTDOMAIN)       =>"",
                __("Center Top",STP_TEXTDOMAIN)   =>"-center-top",
                __("Center Bottom",STP_TEXTDOMAIN)=>"-center-bottom",
            )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Facebook", STP_TEXTDOMAIN),
            "param_name" => "st_facebook",
            "description" =>"",
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Twitter", STP_TEXTDOMAIN),
            "param_name" => "st_twitter",
            "description" =>"",
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Google Plus", STP_TEXTDOMAIN),
            "param_name" => "st_google",
            "description" =>"",
        ),
        array(
            "type" => "textarea",
            "holder" => "div",
            "heading" => __("Other Social Link", STP_TEXTDOMAIN),
            "param_name" => "st_other_social",
            "description" =>"Ex : ".htmlentities("<li><a href='#' class='fa fa-facebook box-icon-normal round'></a></li>").'<br>Social icons <a target="_blank"  href="http://fortawesome.github.io/Font-Awesome/icons/" >click here</a>',
        ),

    )
) );

Class st_team extends STBasedShortcode{

    function __construct()
    {
        parent::__construct();
    }


    function content($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_avatar' =>0,
                'st_name' => 0,
                'st_position'=>'',
                'st_position_social'=>'',
                'st_effect'=>'',
                'st_facebook'=>'',
                'st_twitter'=>'',
                'st_google'=>'',
                'st_other_social'=>'',
            ), $attr, 'st_team' );
        extract($data);
        $img = wp_get_attachment_image_src($st_avatar,'full');

        $list_social ='';
        if(!empty($st_facebook)){
            $list_social .='<li><a href="'.$st_facebook.'" class="fa fa-facebook box-icon-normal round"></a></li>';
        }
        if(!empty($st_twitter)){
            $list_social .='<li><a href="'.$st_twitter.'" class="fa fa-twitter box-icon-normal round"></a></li>';
        }
        if(!empty($st_google)){
            $list_social .='<li><a href="'.$st_google.'" class="fa fa-google-plus box-icon-normal round"></a></li>';
        }
        if(!empty($st_other_social)){
            $list_social .=$st_other_social;
        }

        $txt =  '<div class="thumb text-center st_team">
                        <header class="thumb-header hover-img">
                            <img class="round" src="'.bfi_thumb($img[0],array('width'=>300,'height'=>300)).'" alt="'.$st_name.'" title="'.$st_name.'" />
                            <ul class="hover-icon-group'.$st_position_social.' '.$st_effect.' ">
                                    '.$list_social.'
                            </ul>
                        </header>
                        <div class="thumb-caption">
                            <h5 class="thumb-title">'.$st_name.'</h5>
                            <p class="thumb-meta text-small">'.$st_position.'</p>
                        </div>
                  </div>';
        return $txt;
    }
}

new st_team();