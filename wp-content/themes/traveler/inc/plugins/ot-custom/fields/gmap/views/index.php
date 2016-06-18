<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 1/20/15
 * Time: 3:23 PM
 */
$default = array(
    'field_desc'  => '',
    'field_name'  => '',
    'field_value' => array(),
    'meta'        => '',
    'field_id'    => '',
    'type'        => ''
);


$args = wp_parse_args($args, $default);


extract($args);

if($field_value == 'off'){
    $zoom = get_post_meta( STInput::request('post'),'map_zoom',true);
    if(empty($zoom))$zoom='1';
    $field_value  =array(
        'lat'=>get_post_meta( STInput::request('post'),'map_lat',true),
        'lng'=>get_post_meta( STInput::request('post'),'map_lng',true),
        'type'=>get_post_meta( STInput::request('post'),'map_type',true),
        'zoom'=>$zoom,
        'st_street_number'=>get_post_meta( STInput::request('post'),'st_street_number',true),
        'st_locality'=>get_post_meta( STInput::request('post'),'st_locality',true),
        'st_route'=>get_post_meta( STInput::request('post'),'st_route',true),
        'st_sublocality_level_1'=>get_post_meta( STInput::request('post'),'st_sublocality_level_1',true),
        'st_administrative_area_level_2'=>get_post_meta( STInput::request('post'),'st_administrative_area_level_2',true),
        'st_administrative_area_level_1'=>get_post_meta( STInput::request('post'),'st_administrative_area_level_1',true),
        'st_country'=>get_post_meta( STInput::request('post'),'st_country',true),
    );
}
if(is_page_template('template-user.php')){
    $zoom = get_post_meta( STInput::request('id'),'map_zoom',true);
    if(empty($zoom))$zoom='1';
    $field_value  =array(
        'lat'=>get_post_meta( STInput::request('id'),'map_lat',true),
        'lng'=>get_post_meta( STInput::request('id'),'map_lng',true),
        'type'=>get_post_meta( STInput::request('id'),'map_type',true),
        'zoom'=>$zoom,
        'st_street_number'=>get_post_meta( STInput::request('id'),'st_street_number',true),
        'st_locality'=>get_post_meta( STInput::request('id'),'st_locality',true),
        'st_route'=>get_post_meta( STInput::request('id'),'st_route',true),
        'st_sublocality_level_1'=>get_post_meta( STInput::request('id'),'st_sublocality_level_1',true),
        'st_administrative_area_level_2'=>get_post_meta( STInput::request('id'),'st_administrative_area_level_2',true),
        'st_administrative_area_level_1'=>get_post_meta( STInput::request('id'),'st_administrative_area_level_1',true),
        'st_country'=>get_post_meta( STInput::request('id'),'st_country',true),
    );
}
if(!empty($field_post_type)){
    $post_type = $field_post_type;
}

/* verify a description */
$has_desc = $field_desc ? TRUE : FALSE;
echo '<div class="format-setting type-post_select_ajax ' . ($has_desc ? 'has-desc' : 'no-desc') . '">';
/* description */
echo $has_desc ? '<div class="description">' . htmlspecialchars_decode($field_desc) . '</div>' : '';
/* format setting inner wrapper */
echo '<div class="format-setting-inner">';
/* allow fields to be filtered */
echo '<div class="option-tree-ui-' . $type . '-input-wrap">';
?>
    <div class="bt_ot_gmap_wrap">
        <input type="text" placeholder="<?php _e('Search by name...', 'bravo-toolkit') ?>" class="bt_ot_searchbox"/>

        <div class="bt_ot_gmap">

        </div>
        <?php $validator= STUser_f::$validator; ?>
        <div class="bt_ot_map_field">
            <div class="" style="padding-left: 10px">
                <?php
                $value ='';
                if(!empty($field_value['lat'])){
                    $value = $field_value['lat'];
                }else{
                    $tmp = STInput::request('gmap');
                    $value = $tmp['lat'];
                } ?>
                <input type="hidden" placeholder="<?php _e('Latitude', ST_TEXTDOMAIN) ?>" id="bt_ot_gmap_input_lat" class="number bt_ot_gmap_input_lat form-control"
                       value="<?php echo esc_html($value) ?>"
                       name="<?php echo esc_attr($field_name) ?>[lat]"/>

                <?php
                $value ='';
                if(!empty($field_value['lng'])){
                    $value = $field_value['lng'];
                }else{
                    $tmp = STInput::request('gmap');
                    $value = $tmp['lng'];
                } ?>
                <input value="<?php echo esc_html($value) ?>" type="hidden"
                       placeholder="<?php _e('Longitude', ST_TEXTDOMAIN) ?>" id="bt_ot_gmap_input_lng" class="number bt_ot_gmap_input_lng form-control"
                       name="<?php echo esc_attr($field_name) ?>[lng]"/>
                <?php
                $value ='';
                $tmp = STInput::request('gmap');
                if(!empty($tmp)){
                    $value = $tmp['zoom'];
                }elseif(!empty($field_value['zoom'])){
                    $value = $field_value['zoom'];
                } ?>
                <input value="<?php echo esc_html($value) ?>" type="hidden"
                       placeholder="<?php _e('Zoom Level', ST_TEXTDOMAIN) ?>" id="bt_ot_gmap_input_zoom" class="number bt_ot_gmap_input_zoom form-control"
                       name="<?php echo esc_attr($field_name) ?>[zoom]"/>


            <?php
            $value ='';
            if(!empty($field_value['type'])){
                $value = $field_value['type'];
            }else{
                $tmp = STInput::request('gmap');
                $value = $tmp['type'];
            } ?>
                <input value="<?php echo esc_html($value) ?>" type="hidden"
                       placeholder="<?php _e('Map style', ST_TEXTDOMAIN) ?>" id="bt_ot_gmap_input_type"  class="bt_ot_gmap_input_type form-control"
                       name="<?php echo esc_attr($field_name) ?>[type]"/>
                

                <?php
                $value ='';
                if(!empty($field_value['st_street_number'])){
                    $value = $field_value['st_street_number'];
                }else{
                    $tmp = STInput::request('gmap');
                    $value = $tmp['st_street_number'];
                } ?>
                <label for=""><span class="title"><?php _e('Street Number:', ST_TEXTDOMAIN) ?></span></label>
                <input readonly="readonly" class="widefat option-tree-ui-input form-control" type="text" name="<?php echo esc_attr($field_name) ?>[st_street_number]" value="<?php echo esc_html($value) ?>" id="bt_ot_gmap_st_street_number">
                <?php
                $value ='';
                if(!empty($field_value['st_locality'])){
                    $value = $field_value['st_locality'];
                }else{
                    $tmp = STInput::request('gmap');
                    $value = $tmp['st_locality'];
                } ?>
                <label for=""><span class="title"><?php _e('Locality:', ST_TEXTDOMAIN) ?></span></label>
                <input readonly="readonly" class="widefat option-tree-ui-input form-control" type="text" name="<?php echo esc_attr($field_name) ?>[st_locality]" value="<?php echo esc_html($value) ?>" id="bt_ot_gmap_st_locality">
                <?php
                $value ='';
                if(!empty($field_value['st_route'])){
                    $value = $field_value['st_route'];
                }else{
                    $tmp = STInput::request('gmap');
                    $value = $tmp['st_route'];
                } ?>
                <label for=""><span class="title"><?php _e('Route:', ST_TEXTDOMAIN) ?></span></label>
                <input readonly="readonly" class="widefat option-tree-ui-input form-control" type="text" name="<?php echo esc_attr($field_name) ?>[st_route]" value="<?php echo esc_html($value) ?>" id="bt_ot_gmap_st_route">
                <?php
                $value ='';
                if(!empty($field_value['st_sublocality_level_1'])){
                    $value = $field_value['st_sublocality_level_1'];
                }else{
                    $tmp = STInput::request('gmap');
                    $value = $tmp['st_sublocality_level_1'];
                } ?>
                <label for=""><span class="title"><?php _e('Sublocality:', ST_TEXTDOMAIN) ?></span></label>
                <input readonly="readonly" class="widefat option-tree-ui-input form-control" type="text" name="<?php echo esc_attr($field_name) ?>[st_sublocality_level_1]" value="<?php echo esc_html($value) ?>" id="bt_ot_gmap_st_sublocality_level_1">
                <?php
                $value ='';
                if(!empty($field_value['st_administrative_area_level_2'])){
                    $value = $field_value['st_administrative_area_level_2'];
                }else{
                    $tmp = STInput::request('gmap');
                    $value = $tmp['st_administrative_area_level_2'];
                } ?>
                <label for=""><span class="title"><?php _e('Administrative area 2:', ST_TEXTDOMAIN) ?></span></label>
                <input readonly="readonly" class="widefat option-tree-ui-input form-control" type="text" name="<?php echo esc_attr($field_name) ?>[st_administrative_area_level_2]" value="<?php echo esc_html($value) ?>" id="bt_ot_gmap_st_administrative_area_level_2">

                <?php
                $value ='';
                if(!empty($field_value['st_administrative_area_level_1'])){
                    $value = $field_value['st_administrative_area_level_1'];
                }else{
                    $tmp = STInput::request('gmap');
                    $value = $tmp['st_administrative_area_level_1'];
                } ?>
                <label for=""><span class="title"><?php _e('Administrative area 1:', ST_TEXTDOMAIN) ?></span></label>
                <input readonly="readonly" class="widefat option-tree-ui-input form-control" type="text" name="<?php echo esc_attr($field_name) ?>[st_administrative_area_level_1]" value="<?php echo esc_html($value) ?>" id="bt_ot_gmap_st_administrative_area_level_1">
                <?php
                $value ='';
                if(!empty($field_value['st_country'])){
                    $value = $field_value['st_country'];
                }else{
                    $tmp = STInput::request('gmap');
                    $value = $tmp['st_country'];
                } ?>
                <label for=""><span class="title"><?php _e('Country:', ST_TEXTDOMAIN) ?></span></label>
                <input readonly="readonly" class="widefat option-tree-ui-input form-control" type="text" name="<?php echo esc_attr($field_name) ?>[st_country]" value="<?php echo esc_html($value) ?>" id="bt_ot_gmap_st_country">
        </div></div>
    </div>
<?php
echo '</div>';
echo '</div>';
echo '</div>';