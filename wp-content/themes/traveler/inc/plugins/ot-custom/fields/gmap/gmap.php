<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 1/20/15
 * Time: 2:35 PM
 */
if(!class_exists('BTOTGmap'))
{
    class BTOTGmap extends BTOptionField
    {
        static  $instance=null;
        public $curent_key;

        function __construct()
        {
            parent::__construct(__FILE__);

            parent::init(array(
                'id'=>'bt_gmap',
                'name'          =>__('Gmap Location',ST_TEXTDOMAIN)
            ));

            add_action('admin_enqueue_scripts',array($this,'add_scripts'));

            add_action('save_post',array($this,'_save_separated_field'));
        }

        /**
         *
         *
         * @since 1.0
         * */
        function _save_separated_field( $post_id )
        {

            $st_google_map = get_post_meta($post_id,'st_google_map',true);
            if(!empty($st_google_map)){
                $default=array(
                    'lat'=>'',
                    'lng'=>'',
                    'zoom'=>'',
                    'type'=>'',
                    'st_street_number' => '',
                    'st_locality' => '',
                    'st_route' => '',
                    'st_sublocality_level_1' => '',
                    'st_administrative_area_level_2' => '',
                    'st_administrative_area_level_1' => '',
                    'st_country' => ''
                );

                $meta_value=wp_parse_args($st_google_map,$default);
                
                update_post_meta($post_id,'map_lat',$meta_value['lat']);
                update_post_meta($post_id,'map_lng',$meta_value['lng']);
                update_post_meta($post_id,'map_zoom',$meta_value['zoom']);
                update_post_meta($post_id,'st_street_number',sanitize_title($meta_value['st_street_number']));
                update_post_meta($post_id,'st_locality',sanitize_title($meta_value['st_locality']));
                update_post_meta($post_id,'st_route',sanitize_title($meta_value['st_route']));
                update_post_meta($post_id,'st_sublocality_level_1',sanitize_title($meta_value['st_sublocality_level_1']));
                update_post_meta($post_id,'st_administrative_area_level_2',sanitize_title($meta_value['st_administrative_area_level_2']));
                update_post_meta($post_id,'st_administrative_area_level_1',sanitize_title($meta_value['st_administrative_area_level_1']));
                update_post_meta($post_id,'st_country',sanitize_title($meta_value['st_country']));

                if(TravelHelper::isset_table('st_glocation')){
                    global $wpdb; 
                    $num_rows = TravelHelper::checkIssetPost($post_id, 'st_glocation');
                    $data = array(
                        'post_type' => get_post_type($post_id),
                        'street_number' => sanitize_title($meta_value['st_street_number']),
                        'locality' => sanitize_title($meta_value['st_locality']),
                        'route' => sanitize_title($meta_value['st_route']),
                        'sublocality_level_1' => sanitize_title($meta_value['st_sublocality_level_1']),
                        'administrative_area_level_2' => sanitize_title($meta_value['st_administrative_area_level_2']),
                        'administrative_area_level_1' => sanitize_title($meta_value['st_administrative_area_level_1']),
                        'country' => sanitize_title($meta_value['st_country'])
                        );
                    if($num_rows == 1){
                        $where = array(
                            'post_id' => $post_id
                        );
                        TravelHelper::updateDuplicate('st_glocation', $data, $where);
                    }else{
                        $data['post_id'] = $post_id;
                        TravelHelper::insertDuplicate('st_glocation', $data);
                    }
                }
            }
        }
        function add_scripts()
        {
            if (TravelHelper::is_https()){
                wp_register_script('gmap-api','https://maps.google.com/maps/api/js?language=en&amp;libraries=places',null,false,true);
            }else {
                wp_register_script('gmap-api','http://maps.google.com/maps/api/js?language=en&amp;libraries=places',null,false,true);
            }           
            wp_register_script('gmapv3',$this->_url.'js/gmap3.min.js',array('jquery','gmap-api'),false,true);
            wp_register_script('bt-gmapv3-init',$this->_url.'js/init.js',array('gmapv3'),false,true);
            wp_register_style('bt-gmapv3',$this->_url.'css/bt-gmap.css');
        }


        static function instance()
        {
            if(self::$instance==null)
            {
                self::$instance=new self();
            }

            return self::$instance;
        }

    }

    BTOTGmap::instance();

    if(!function_exists('ot_type_bt_gmap'))
    {
        function ot_type_bt_gmap($args = array())
        {
            $default=array(
                'field_name'=>''
            );
            $args=wp_parse_args($args,$default);

            wp_enqueue_script('bt-gmapv3-init');
            wp_enqueue_style('bt-gmapv3');

            BTOTGmap::instance()->curent_key=$args['field_name'];

            echo BTOTGmap::instance()->load_view(false,array('args'=>$args));
        }
    }

    if(!function_exists('ot_type_bt_gmap_html'))
    {
        function ot_type_bt_gmap_html($args = array())
        {
            $default=array(
                'field_name'=>'gmap'
            );
            $args=wp_parse_args($args,$default);

            wp_enqueue_script('bt-gmapv3-init');
            wp_enqueue_style('bt-gmapv3');

            BTOTGmap::instance()->curent_key=$args['field_name'];

            echo BTOTGmap::instance()->load_view(false,array('args'=>$args));
        }
    }
}
