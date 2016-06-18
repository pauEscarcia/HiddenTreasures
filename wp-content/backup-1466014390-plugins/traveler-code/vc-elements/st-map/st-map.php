<?php

vc_map( array(
    "name"      => __("ST Google Map", STP_TEXTDOMAIN),
    "base"      => "st_google_map",
    "class"     => "",
    "icon" => "icon-st",
    "category"=>"Shinetheme",
    "params"    => array(
        array(
            "type"      => "dropdown",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Type", STP_TEXTDOMAIN),
            "param_name"=> "type",
            "value"     => array(
                __('Use Address',STP_TEXTDOMAIN)=>1,
                __('User Latitude and Longitude',STP_TEXTDOMAIN)=>2,
            ),
            "description" => __("Address or using Latitude and Longitude", STP_TEXTDOMAIN)
        ),
        array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Address", STP_TEXTDOMAIN),
            "param_name"=> "address",
            "value"     => "",
            "description" => __("Address", STP_TEXTDOMAIN)
        ),
        array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Latitude", STP_TEXTDOMAIN),
            "param_name"=> "latitude",
            "value"     => "",
            "description" => __("Latitude, you can get it from  <a target='_blank' href='http://www.latlong.net/convert-address-to-lat-long.html'>here</a>", STP_TEXTDOMAIN)
        ),
        array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Longitude", STP_TEXTDOMAIN),
            "param_name"=> "longitude",
            "value"     => "",
            "description" => __("Longitude", STP_TEXTDOMAIN)
        ),
        array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Lightness", STP_TEXTDOMAIN),
            "param_name"=> "lightness",
            "value"     => 0,
            "description" => __("(a floating point value between -100 and 100) indicates the percentage change in brightness of the element.", STP_TEXTDOMAIN)
        ),
        array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Saturation", STP_TEXTDOMAIN),
            "param_name"=> "saturation",
            "value"     => "-100",
        ),
        array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Gamma", STP_TEXTDOMAIN),
            "param_name"=> "gama",
            "value"     => 0.5,
        ),
        array(
            "type"      => "textfield",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Zoom", STP_TEXTDOMAIN),
            "param_name"=> "zoom",
            "value"     => 13,
        ),
        array(
            "type"      => "attach_image",
            "holder"    => "div",
            "class"     => "",
            "heading"   => __("Custom Marker Icon", STP_TEXTDOMAIN),
            "param_name"=> "marker",
            "value"     => "",
            "description" => __("Custom Marker Icon", STP_TEXTDOMAIN)
        ),
    )));

class ST_Google_Map extends STBasedShortcode
{
    function __construct()
    {
        parent::__construct();
    }

    function add_scripst()
    {
    //    wp_register_script('gmapv3','//maps.googleapis.com/maps/api/js?sensor=false',null,null,true);
      //  wp_register_script('jquery-gmap',st()->plugin_url().'/vc-elements/st-map/js/gmap3.min.js',array('gmapv3'),null,true);
      //  wp_register_script('st-gmap-init',st()->plugin_url().'/vc-elements/st-map/js/gmap.init.js',array('jquery-gmap'),null,true);
    }

    function content($attr,$content=false)
    {

        wp_enqueue_script('st-gmap-init');
        extract(shortcode_atts(array(
            'address'=>'93 Worth St, New York, NY',
            'type'=>1,
            'marker'=>'',
            'height'=>'480',
            'lightness'=>0,
            'saturation'=>0,
            'gama'=>0.5,
            'zoom'=>13,
            'longitude'=>false,
            'latitude'=>false
        ),$attr));
        /*if(!$marker)
        {
            $marker_url=get_template_directory_uri().'/images/marker.png';
        }else
        {
            $marker_url=wp_get_attachment_image_src($marker,'full');
            if(isset($marker_url[0]))
            {
                $marker_url=$marker_url[0];
            }else
            {
                $marker_url=get_template_directory_uri().'/img/marker.png';
            }
        }*/
        return "<div class='map_wrap'><div data-type='{$type}' data-lat='{$latitude}' data-lng='{$longitude}' data-zoom='{$zoom}' style='height: {$height}px' data-lightness='{$lightness}' data-saturation='{$saturation}' data-gama='{$gama}'  class='st_google_map' data-address='{$address}' data-marker='$marker_url'>
                    </div></div>";
    }
}
$googlemap=new ST_Google_Map();

add_action('wp_enqueue_scripts',array($googlemap,'add_scripst'));