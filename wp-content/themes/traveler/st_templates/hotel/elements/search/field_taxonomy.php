<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Activity field taxonomy
 *
 * Created by ShineTheme
 *
 */
$default=array(
    'title'=>'',
    'taxonomy'=>'',
    'is_required'=>'on',
    'type_show_taxonomy_hotel'=>'checkbox',
);
if(isset($data)){
    extract(wp_parse_args($data,$default));
    if(!empty($data['custom_terms_'.$taxonomy])){
        $terms_custom = $data['custom_terms_'.$taxonomy];
        $terms_custom = array_values($terms_custom);
    }
}else{
    extract($default);
}

if(!isset($field_size)) $field_size='lg';


if(!empty($terms_custom ) and $terms_custom[0] != "all"){
    $terms = $terms_custom;
}else{
    $terms = get_terms($taxonomy);
}


if($is_required == 'on'){
    $is_required = 'required';
}

if(!empty($terms)):
    if($type_show_taxonomy_hotel == "select"){
?>
    <div class="form-group form-group-<?php echo esc_attr($field_size)?>" taxonomy="<?php echo esc_html($taxonomy) ?>">
        <label for="field-hotel-tax-<?php echo esc_html($taxonomy) ?>"><?php echo esc_html( $title)?></label>
        <select id="field-hotel-tax-<?php echo esc_html($taxonomy) ?>" class="form-control" name="taxonomy[<?php echo esc_html($taxonomy) ?>]" <?php echo esc_attr($is_required) ?>>
            <option value=""><?php _e('-- Select --',ST_TEXTDOMAIN) ?></option>
            <?php if(is_array($terms)){ ?>
                <?php foreach($terms as $k=>$v){
                    $key_id = $value_name = "";
                    if(!empty($v->term_id)){
                        $key_id = $v->term_id;
                        $value_name = $v->name;
                    } else {
                        $tmp = explode("|",$v);
                        $key_id = $tmp[0];
                        $value_name = $tmp[1];
                    }
                    ?>
                    <?php $is_taxonomy = STInput::request('taxonomy'); ?>
                    <option <?php if(!empty($is_taxonomy[$taxonomy]) and $is_taxonomy[$taxonomy] == $key_id) echo 'selected'; ?>  value="<?php echo esc_attr($key_id) ?>">
                        <?php echo esc_html($value_name) ?>
                    </option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
    <?php }else{ ?>
        <div class="form-custom-taxonomy form-group form-group-<?php echo esc_attr($field_size)?>" taxonomy="<?php echo esc_html($taxonomy) ?>">
            <label for="field-hotel-tax-<?php echo esc_html($taxonomy) ?>"><?php echo esc_html( $title)?></label>
            <div class="row">
            <?php if(is_array($terms)){ ?>
                <?php foreach($terms as $k=>$v){
                    $key_id = $value_name = "";
                    if(!empty($v->term_id)){
                        $key_id = $v->term_id;
                        $value_name = $v->name;
                    } else {
                        $tmp = explode("|",$v);
                        $key_id = $tmp[0];
                        $value_name = $tmp[1];
                    }

                    $is_taxonomy = STInput::request('taxonomy');
                    $is_check = '';
                    if(!empty($is_taxonomy[$taxonomy])){
                        $data = explode(',',$is_taxonomy[$taxonomy]);
                        if(in_array($key_id,$data)){
                            $is_check = 'checked';
                        }
                    }
                    ?>
                    <?php

                    $size = 4;
                    if(!empty($st_direction) and $st_direction!='horizontal'){
                        $size='12';
                    }
                    ?>
                    <div class="checkbox col-xs-<?php echo esc_attr($size) ?>">
                        <label>
                            <input class="i-check item_tanoxomy" <?php echo esc_html($is_check) ?>  type="checkbox" value="<?php echo esc_attr($key_id) ?>" /><?php echo esc_html($value_name) ?></label>
                    </div>
                    <?php if (($k+1)%3 ==0) echo "</div><div class='row'>"; ?>
                <?php } ?>
            <?php } ?>
            </div>
            <input type="hidden" class="data_taxonomy" name="taxonomy[<?php echo esc_html($taxonomy) ?>]" value="">
        </div>
    <?php } ?>
<?php endif ?>
