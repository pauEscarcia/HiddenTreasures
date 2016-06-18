<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 11/24/14
 * Time: 3:34 PM
 */
if(!class_exists('STBasedShortcode')) return;


class st_checkout extends  STBasedShortcode
{

    function __construct()
    {
        parent::__construct();
    }

    function content($attr=array(),$content=false)
    {
        return stp()->load_template('checkout/html');
    }
}

new st_checkout();