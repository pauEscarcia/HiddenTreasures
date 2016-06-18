<?php

vc_map( array(
    "name" => __("ST Flickr", STP_TEXTDOMAIN),
    "base" => "st_flickr",
    "content_element" => true,
    "icon" => "icon-st",
    "params" => array(
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => __("Number", STP_TEXTDOMAIN),
            "param_name" => "st_number",
            "description" =>"",
        ),
        array(
            "type" => "textfield",
            "heading" => __("User", STP_TEXTDOMAIN),
            "param_name" => "st_user",
            "description" => ""
        ),
    )
) );
/*
*
* This is Shortcode
*/
class st_flickr extends  STBasedShortcode
{
    function __construct()
    {
        parent::__construct();
    }

    function content($arg,$content=false)
    {
        $data = shortcode_atts(array(
            'st_number' =>5,
            'st_user'=>'23401669@N00',
        ), $arg, 'st_flickr' );
        extract($data);
        $r = st()->load_template('vc-elements/st-fickr/html',null,$data);
        return $r;
    }
}
new st_flickr();
