<?php
vc_map( array(
    "name" => __("ST Slide Location", STP_TEXTDOMAIN),
    "base" => "st_slide_location",
    "content_element" => true,
    "icon" => "icon-st",
    "category"=>"Shinetheme",
    "params" => array(
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Type", STP_TEXTDOMAIN),
            "param_name" => "st_type",
            "description" =>"",
            'value'=>array(
                __('Hotel',STP_TEXTDOMAIN)=>'st_hotel',
                __('Car',STP_TEXTDOMAIN)=>'st_cars',
                __('Tour',STP_TEXTDOMAIN)=>'st_tours',
                __('Rental',STP_TEXTDOMAIN)=>'st_rental',
                __('Activities',STP_TEXTDOMAIN)=>'st_activity',
//                __('Cruise',STP_TEXTDOMAIN)=>'cruise',
            ),
        ),
        array(
            "type" => "st_post_type_location",
            "holder" => "div",
            "heading" => __("Select Location ", STP_TEXTDOMAIN),
            "param_name" => "st_list_location",
            "description" =>"",
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Style show ", STP_TEXTDOMAIN),
            "param_name" => "st_style",
            "description" =>"",
            'value'=>array(
                __('Text info center')=>'style_1',
                __('Show box find')=>'style_2',
            ),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Weather show ", STP_TEXTDOMAIN),
            "param_name" => "st_weather",
            "description" =>"",
            'value'=>array(
                __('Yes')=>'yes',
                __('No')=>'no',
            ),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Height", STP_TEXTDOMAIN),
            "param_name" => "st_height",
            "description" =>"",
            'value'=>array(
                __('Full height')=>'full',
                __('Half height')=>'half',
            ),
        ),
    )
) );

Class st_slide_location extends STBasedShortcode{

    function __construct()
    {
        parent::__construct();
    }

    function content($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_type'=>'',
                'st_list_location' =>0,
                'st_weather'=>'no',
                'st_style'=>'style_1',
                'st_height'=>'full'
            ), $attr, 'st_slide_location' );
        extract($data);
        $ids = explode(',',$st_list_location);

        $query=array(
            'post_type' => 'location',
            'post__in'  => $ids
        );
        query_posts($query);
        $txt='';
        while(have_posts()){
            the_post();
            if($st_style == 'style_1'){
                $txt .= st()->load_template('vc-elements/st-slide-location/loop-style','1',$data);
            }
            if($st_style == 'style_2'){
                $txt .= st()->load_template('vc-elements/st-slide-location/loop-style','2',$data);
            }

        }
        wp_reset_query();
        if($st_height == 'full'){
            $class = 'top-area show-onload';
        }else{
            $class = 'special-area';
        }


        if($st_style == 'style_1') {
            $r = '<div class="'.$class.'">
                    <div class="owl-carousel owl-slider owl-carousel-area" id="owl-carousel-slider">
                    ' . $txt . '
                    </div>
                  </div>';
        }
        if($st_style == 'style_2') {
            $r = '<div class="'.$class.'">
                <div class="bg-holder full">
                    <div class="bg-front bg-front-mob-rel">
                        <div class="container">
                        '.st()->load_template('vc-elements/st-search/search','form',array('st_style_search' =>'style_2', 'st_box_shadow'=>'no' ,'class'=>'search-tabs-abs mt50','title'=>STLanguage::st_get_language('find_your_perfect_trip')) ).'
                        </div>
                    </div>
                    <div class="owl-carousel owl-slider owl-carousel-area visible-lg" id="owl-carousel-slider">
                      '.$txt.'
                    </div>
                </div>
            </div>';
        }
        if(empty($txt)){
            $r="";
        }
        return $r;
    }
}

new st_slide_location();