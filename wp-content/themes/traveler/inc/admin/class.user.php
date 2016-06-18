<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Class STUser
 *
 * Created by ShineTheme
 *
 */
if(!class_exists('STUser'))
{

    class STUser extends STAdmin
    {
        private $extra_fields=array();

        function __construct()
        {
            parent::__construct();

        }



        //Do one time
        function init()
        {
            $this->extra_fields =array(


                'st_address'=>array(
                    'type'=>'text',
                    'label'=>__('Address Line 1',ST_TEXTDOMAIN),
                    'desc'=>__('Show under your reviews',ST_TEXTDOMAIN)
                ),
                'st_address2'=>array(
                    'type'=>'text',
                    'label'=>__('Address Line 2',ST_TEXTDOMAIN),
                    'desc'=>__('Address Line 2',ST_TEXTDOMAIN)
                ),
                'st_phone'=>array(
                    'type'=>'text',
                    'label'=>__('Phone',ST_TEXTDOMAIN),
                    'desc'=>__('Phone',ST_TEXTDOMAIN)
                ),
                'st_fax'=>array(
                    'type'=>'text',
                    'label'=>__('Fax Number',ST_TEXTDOMAIN),
                    'desc'=>__('Fax Number',ST_TEXTDOMAIN)
                ),
                'st_airport'=>array(
                    'type'=>'text',
                    'label'=>__('Airport',ST_TEXTDOMAIN),
                    'desc'=>__('Airport',ST_TEXTDOMAIN)
                ),
                'st_city'=>array(
                    'type'=>'text',
                    'label'=>__('City',ST_TEXTDOMAIN),
                    'desc'=>__('City',ST_TEXTDOMAIN)
                ),
                'st_province'=>array(
                    'type'=>'text',
                    'label'=>__('State/Province/Region',ST_TEXTDOMAIN),
                    'desc'=>__('State/Province/Region',ST_TEXTDOMAIN)
                ),
                'st_zip_code'=>array(
                    'type'=>'text',
                    'label'=>__('ZIP code/Postal code',ST_TEXTDOMAIN),
                    'desc'=>__('ZIP code/Postal code',ST_TEXTDOMAIN)
                ),
                'st_country'=>array(
                    'type'=>'text',
                    'label'=>__('Country',ST_TEXTDOMAIN),
                    'desc'=>__('Country',ST_TEXTDOMAIN)
                )

            );

            $this->extra_fields=apply_filters('st_user_extra_fields',$this->extra_fields);


            add_action( 'show_user_profile',array($this,'show_user_profile')  );

            add_action( 'edit_user_profile', array($this,'show_user_profile') );

            add_action( 'show_user_profile',array($this,'show_user_certificates')  );
            add_action( 'edit_user_profile', array($this,'show_user_certificates') );

            add_action( 'personal_options_update', array($this,'personal_options_update') );
            add_action( 'edit_user_profile_update', array($this,'personal_options_update') );


            add_action('admin_menu', array($this,'st_users_partner_menu'));

            add_action('set_user_role',array($this,'_st_check_change_role'),999,3);



        }


        function _st_check_change_role($user_id,$role_new,$role_old){
            $role_old = array_shift($role_old);
            if($role_new == "partner" and $role_old == "subscriber"){
                update_user_meta($user_id,'st_pending_partner','0');
                STUser::_send_approved_customer_register_partner($user_id);
            }
        }


        function st_users_partner_menu() {
            if(current_user_can('manage_options')) {
                add_users_page( 'Users Partner' , 'Partner Register' , 'read' , 'st-users-partner-menu' , array(
                    $this ,
                    'st_callback_user_partner_function'
                ) );
            }
        }

        function st_callback_user_partner_function(){
            $action=STInput::request('st_action',false);
            switch($action){
                case "delete":
                    $this->_delete_items();
                    break;
                case "approve_role":
                    $user_id = STInput::request('user_id');
                    if(!empty($user_id)){
                        $user_data = new WP_User( $user_id );
                        $user__permission = array_shift($user_data->roles);
                        if($user__permission == "subscriber" or $user__permission == "" or $user__permission == "Subscriber"){
                            if(!empty($user_data->roles)){
                                foreach($user_data->roles as $k=>$v){
                                    $user_data->remove_role( $v );
                                }
                            }


                            $user_data = new WP_User( $user_id );
                            $user_data->remove_role( $user__permission );
                            $user_data->add_role( 'partner' );

                            update_user_meta($user_id,'st_pending_partner','0');
                            STAdmin::set_message(__("Approve success !",ST_TEXTDOMAIN),'updated');
                            // send email
                            STUser::_send_approved_customer_register_partner($user_id);
                        }
                        unset( $user_data );
                    }
                    break;
                case "cancel_role":
                    $user_id = STInput::request('user_id');
                    if(!empty($user_id)){
                        update_user_meta($user_id,'st_pending_partner','0');
                        STAdmin::set_message(__("Cancel success !",ST_TEXTDOMAIN),'updated');
                        // send email
                        STUser::_send_cancel_customer_register_partner($user_id);
                    }
                    break;
            }
            echo balanceTags($this->load_view('users/partner_index',false));
        }
        function _delete_items(){

            if ( empty( $_POST ) or  !check_admin_referer( 'shb_action', 'shb_field' ) ) {
                //// process form data, e.g. update fields
                return;
            }
            $ids=isset($_POST['users'])?$_POST['users']:array();
            if(!empty($ids))
            {
                foreach($ids as $id)
                    wp_delete_user($id,true);

            }

            STAdmin::set_message(__("Delete item(s) success",ST_TEXTDOMAIN),'updated');

        }

        function show_user_profile($user)
        {
            echo balanceTags($this->load_view('users/profile',null,array('user'=>$user,'extra_fields'=>$this->extra_fields)));
        }

        function show_user_certificates($user)
        {
            echo balanceTags($this->load_view('users/certificates',null,array('user'=>$user)));

        }


        static function get_list_partner( $permission = "partner" , $offset , $limit )
        {
            global $wpdb;
            $where  = '';
            $join   = '';
            if($permission == "pending_partner"){
                $join .= " INNER JOIN {$wpdb->prefix}usermeta ON ( {$wpdb->prefix}users.ID = {$wpdb->prefix}usermeta.user_id )
                           INNER JOIN {$wpdb->prefix}usermeta AS mt1 ON ( {$wpdb->prefix}users.ID = mt1.user_id )";
                $where .= " AND
                            (
                                (
                                    (
                                        ( {$wpdb->prefix}usermeta.meta_key = 'st_pending_partner' AND CAST({$wpdb->prefix}usermeta.meta_value AS CHAR) = '1' )
                                    )
                                    AND
                                    (
                                        (
                                            ( mt1.meta_key = '{$wpdb->prefix}capabilities' AND CAST(mt1.meta_value AS CHAR) LIKE '%\"Subscriber\"%' )
                                        )
                                    )
                                )
                            )";
            }
            $querystr = "
                SELECT SQL_CALC_FOUND_ROWS {$wpdb->prefix}users.* FROM {$wpdb->prefix}users
                {$join}
                WHERE 1=1
                " . $where . "
                ORDER BY user_registered DESC
                LIMIT {$offset},{$limit}
            ";
            $pageposts = $wpdb->get_results( $querystr , OBJECT );
            return array( 'total' => $wpdb->get_var( "SELECT FOUND_ROWS();" ) , 'rows' => $pageposts );
        }

        static function _send_admin_new_register_partner($user_id){
            global $st_user_id;
            $st_user_id = $user_id;
            $admin_email = st()->get_option('email_admin_address');
            if(!$admin_email) return false;
            $to = $admin_email;
            if($user_id){
                $message = st()->load_template('email/header');
                $email_to = st()->get_option('partner_email_for_admin', '');
                $message .= do_shortcode($email_to);
                $message .= st()->load_template('email/footer');
                $user_data = get_userdata( $user_id );
                $title = $user_data->user_nicename." - ".$user_data->user_email." - ".$user_data->user_registered;
                $subject = sprintf(__('New Register Partner: %s',ST_TEXTDOMAIN), $title);
                $check = self::_send_mail_user($to, $subject, $message);
            }
            unset($st_user_id);
            return $check;
        }
        static function _resend_send_admin_update_certificate_partner($user_id){
            global $st_user_id;
            $st_user_id = $user_id;
            $admin_email = st()->get_option('email_admin_address');
            if(!$admin_email) return false;
            $to = $admin_email;
            if($user_id){
                $message = st()->load_template('email/header');
                $email_to = st()->get_option('partner_resend_email_for_admin', '');
                $message .= do_shortcode($email_to);
                $message .= st()->load_template('email/footer');
                $user_data = get_userdata( $user_id );
                $title = $user_data->user_nicename." - ".$user_data->user_email;
                $subject = sprintf(__('New Update Certificate Partner: %s',ST_TEXTDOMAIN), $title);
                $check = self::_send_mail_user($to, $subject, $message);
            }
            unset($st_user_id);
            return $check;
        }
        static function _send_customer_register_partner($user_id){
            global $st_user_id;
            $st_user_id = $user_id;
            $user_data = get_userdata( $user_id );
            $user_email = $user_data->user_email;
            if(!$user_email) return false;
            $to = $user_email;
            $message = st()->load_template('email/header');
            $email_to = st()->get_option('partner_email_for_customer', '');
            $message .= do_shortcode($email_to);
            $message .= st()->load_template('email/footer');
            $title = get_option('blogname');
            $subject = sprintf(__('Your Register Partner at %s',ST_TEXTDOMAIN), $title);
            $check = self::_send_mail_user($to, $subject, $message);
            unset($st_user_id);
            return $check;
        }
        static function _send_approved_customer_register_partner($user_id){
            global $st_user_id;
            $st_user_id = $user_id;
            $user_data = get_userdata( $user_id );
            $user_email = $user_data->user_email;
            if(!$user_email) return false;
            $to = $user_email;
            $message = st()->load_template('email/header');
            $email_to = st()->get_option('partner_email_approved', '');
            $message .= do_shortcode($email_to);
            $message .= st()->load_template('email/footer');
            $title = get_option('blogname');
            $subject = sprintf(__('Approve Register Partner at %s',ST_TEXTDOMAIN), $title);
            $check = self::_send_mail_user($to, $subject, $message);
            unset($st_user_id);
            return $check;
        }
        static function _send_cancel_customer_register_partner($user_id){
            global $st_user_id;
            $st_user_id = $user_id;
            $user_data = get_userdata( $user_id );
            $user_email = $user_data->user_email;
            if(!$user_email) return false;
            $to = $user_email;
            $message = st()->load_template('email/header');
            $email_to = st()->get_option('partner_email_cancel', '');
            $message .= do_shortcode($email_to);
            $message .= st()->load_template('email/footer');
            $title = get_option('blogname');
            $subject = sprintf(__('Cancel Register Partner at %s',ST_TEXTDOMAIN), $title);
            $check = self::_send_mail_user($to, $subject, $message);
            unset($st_user_id);
            return $check;
        }
        private static function _send_mail_user($to, $subject, $message, $attachment=false){
            if(!$message) return array(
                'status'  => false,
                'data'    => '',
                'message' => __("Email content is empty",ST_TEXTDOMAIN)
            );
            $from = st()->get_option('email_from');
            $from_address = st()->get_option('email_from_address');
            $headers = array();

            if($from and $from_address){
                $headers[]='From:'. $from .' <'.$from_address.'>';
            }
            add_filter( 'wp_mail_content_type', array(__CLASS__,'set_html_content_type') );
            $check=wp_mail( $to, $subject, $message,$headers ,$attachment);
            remove_filter( 'wp_mail_content_type', array(__CLASS__,'set_html_content_type') );
            return array(
                'status'=>$check,
                'data'=>array(
                    'to'=>$to,
                    'subject'=>$subject,
                    'message'=>$message,
                    'headers'=>$headers
                )
            );
        }
        static function set_html_content_type() {
            return 'text/html';
        }
        function personal_options_update($user_id)
        {
            if ( !current_user_can( 'edit_user', $user_id ) )
                return false;

            if(!empty($this->extra_fields))
            {
                foreach($this->extra_fields as $key=> $value)
                {
                    update_user_meta($user_id, $key, sanitize_text_field($_POST[$key]));
                }
            }

        }

        static function count_comment($user_id=false,$post_id=false,$comment_type=false)
        {
            if(!$user_id)
            {
                if(is_user_logged_in())
                {

                    global $current_user;

                    $user_id=$current_user->ID;
                }
            }

            if($user_id)
            {
                global $wpdb;

                $query='SELECT COUNT(comment_ID) FROM ' . $wpdb->comments. ' WHERE user_id = "' . sanitize_title_for_query($user_id) . '"';


                if($post_id)
                {
                    $query.=' AND comment_post_ID="'.sanitize_title_for_query($post_id).'"';
                }

                if($comment_type)
                {
                    $query.=' AND comment_type="'.sanitize_title_for_query($comment_type).'"';
                }

                $count = $wpdb->get_var($query);


                return $count;
            }
        }
        static function count_comment_by_email($email,$post_id=false,$comment_type=false)
        {
            if(!$email)
                return  0 ; 

            if($email)
            {
                global $wpdb;

                $query='SELECT COUNT(comment_ID) FROM ' . $wpdb->comments. ' WHERE comment_author_email = "' . $email . '"';


                if($post_id)
                {
                    $query.=' AND comment_post_ID="'.sanitize_title_for_query($post_id).'"';
                }

                if($comment_type)
                {
                    $query.=' AND comment_type="'.sanitize_title_for_query($comment_type).'"';
                }

                $count = $wpdb->get_var($query);


                return $count;
            }
        }

        static function count_review($user_id=false,$post_id=false)
        {
            return self::count_comment($user_id,$post_id,"st_reviews");
        }
        static function count_review_by_email($email,$post_id=false)
        {
            return self::count_comment_by_email($email,$post_id,"st_reviews");
        }

    }

    $User=new STUser();

    $User->init();
}