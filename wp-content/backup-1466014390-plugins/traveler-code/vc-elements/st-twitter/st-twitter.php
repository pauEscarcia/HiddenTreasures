<?php

vc_map( array(
    "name" => __("ST Twitter", STP_TEXTDOMAIN),
    "base" => "st_twitter",
    "content_element" => true,
    "icon" => "icon-st",
    "params" => array(
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => __("Number", STP_TEXTDOMAIN),
            "param_name" => "st_twitter_number",
            "description" =>"",
        ),
        array(
            "type" => "textfield",
            "heading" => __("User Twitter", STP_TEXTDOMAIN),
            "param_name" => "st_twitter_user",
            "description" => ""
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Color text", STP_TEXTDOMAIN),
            "param_name" => "st_color",
            "description" =>"",
        ),
    )
) );
/*
*
* This is Shortcode
*/
class st_twitter extends  STBasedShortcode
{
    function __construct()
    {
        parent::__construct();
    }

    function content($arg,$content=false)
    {
        $data = shortcode_atts(array(
            'st_twitter_number' =>5,
            'st_twitter_user'=>'evanto',
            'st_color'=>'#fff',
        ), $arg, 'st_twitter' );
        extract($data);
        require_once 'TwitterAPIExchange.php';
        if($st_twitter_user)
        {
            //get twitter
            $settings = array(
                'oauth_access_token' => "460485056-XHfLUud3fQToKfseTnoaiSLrWrdKnsiEyiCaJHLX",
                'oauth_access_token_secret' => "GmYQbQcDXdiWBJFH39GgyG7i7fxVcfaQQT0YgCgh015f7",
                'consumer_key' => "18ihEuNsfOJokCLb8SAgA",
                'consumer_secret' => "7vTYnLYYiP4BhXvkMWtD3bGnysgiGqYlsPFfwXhGk"
            );
            $num=$st_twitter_number;
            $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
            $getfield = '?screen_name='.$st_twitter_user.'&count='.$num;
            $requestMethod = 'GET';
            $twitter = new TwitterAPIExchange($settings);
            $recent_twitter = $twitter->setGetfield($getfield)
                ->buildOauth($url, $requestMethod)
                ->performRequest();

            $twitters = json_decode($recent_twitter,true);
            $output = array();
            $txt="";
            $class = "";
            if(!empty($st_color)){
                $class =  Assets::build_css("color: ".$st_color);
                Assets::add_css("
                    .$class .owl-controls .owl-buttons div{
                        background:{$st_color};
                    }
                ");
            }
            if (!isset($twitters['errors']) && count($twitters)>0) {
                foreach( $twitters as $twitter ) {
                    $txt.='<div class="item">
                                <div class="icon pull-left">
                                    <i class="fa fa-twitter"></i>
                                </div>
                                <div class="txt">
                                    <span class="tweet_time">
                                        <a class="'.$class.'" title="view tweet on twitter" href="http://twitter.com/'.$st_twitter_user."/status/".$twitter['id'].'">'.human_time_diff(strtotime($twitter['created_at']) ) .' ago :</a>
                                     </span>
                                     <span class="tweet_text">
                                       '.$twitter['text'].'
                                     </span>
                                </div>
                            </div>';
                }
            }
        }
        $r = st()->load_template('vc-elements/st-twitter/html',null,array('html'=>$txt,'st_color'=>$st_color,'class'=>$class));
        return $r;
    }
}
new st_twitter();
