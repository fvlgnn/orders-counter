<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Auth helper
 * @author @fvlgnn <fvlgnn@gmail.com>
 * @date 28th Aug, 2018
 */

if ( ! function_exists('auth_check') )
{
    function auth_check()
    {
        $CI =& get_instance();
        $CI->load->library('session');
        if(isset($CI->session->loggedIn)){
            $CI->load->model('user_model');
            $user = $CI->user_model->getUser($CI->session->userId);
            if($user->type > 0){
                return true;
            } 
            else{
                redirect(base_url() . 'user/logout');
            }            
        } 
        else {
            $CI->load->helper('cookie');
            $cookie = get_cookie('OrderCount',true);
            if(!empty($cookie)) {
                $coo = explode(":", $cookie);
                $sessiondata = array(
                    'userId'     => $coo[0],
                    'userType'   => $coo[1],
                    'loggedIn' => TRUE
                );
                $expired = 3600 * 24 * 30 * 6;
                $cookiedata= array(
                    'name'   => 'OrderCount',
                    'value'  => $cookie,
                    'expire' => $expired,
                    // 'secure' => false
                );
                $CI->session->set_userdata($sessiondata);
                set_cookie($cookiedata);
                return true;
            } 
            else {
                return false;
            }
        }
        unset($CI);
    }

}