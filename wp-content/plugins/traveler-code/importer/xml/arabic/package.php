<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 20/11/2015
 * Time: 9:41 SA
 */
if(!class_exists('ST_Arabic_Package'))
{
    class ST_Arabic_Package
    {
        static $_instance;

        function __construct()
        {
            add_filter('st_demo_packages',array($this,'_add_package'));
			add_filter('st_demo_packages_config_arabic',array($this,'_get_config'));
        }
		function _get_config()
		{
			return array(
				'st_over_menus'=>array(
					"Main Menu" => "primary",
				),
				'homepage_default'=>'Home Layout Default | Traveler',
				'homepost_default'=>''
			);
		}
        function _add_package($package)
        {
            $package['arabic']=array(
                'object'=>$this,
                'title'=>__("Arabic",'traveler'),
                'preview_image'=>plugin_dir_url(__FILE__).'/preview.png'
            );
            return $package;
        }
        static function instance(){
            if(!self::$_instance){
                self::$_instance=new self();
            }

            return self::$_instance;
        }

    }

    ST_Arabic_Package::instance();
}