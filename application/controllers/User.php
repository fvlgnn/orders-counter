<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User controller
 * @author @fvlgnn <fvlgnn@gmail.com>
 * @date 28th Aug, 2018
 */

class User extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        $this->load->library('form_validation');
        $this->load->library('email');

        $this->load->library('encrypt');
        
        $this->load->helper('cookie');
        $this->load->helper('security');
        $this->load->helper('string');

        $this->load->model("user_model");
        
    }

	public function index($var = null) {
        if($this->session->loggedIn){
            redirect(base_url() . 'user/profile');
        } else {        
            $config = $this->config->item('configCustom');
            $data['config'] = $config;
            $data['pageTitle'] = "Login";
            $this->load->view('page_login', $data);
        }
    }

    public function login() {
        if($this->input->post('postSubmit')){
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
            if ($this->form_validation->run() === true) {               
                $email =  $this->input->post('email');
                $password =  $this->input->post('password');
                $login = $this->user_model->getLogin($email);
                if( isset($login) &&
                    $password === $this->encrypt->decode($login->password) && 
                    $login->type > 0 )
                {
                    $sessiondata = array(
                        'userId'     => $login->id,
                        'userType'   => $login->type,
                        'loggedIn' => TRUE
                    );
                    $this->session->set_userdata($sessiondata);
                    if($this->input->post('remember')){
                        $expired = 3600 * 24 * 30 * 6;
                        $cookiedata= array(
                            'name'   => 'OrderCount',
                            'value'  => $login->id.":".$login->type,
                            'expire' => $expired,
                            // 'secure' => false
                        );
                        set_cookie($cookiedata);
                    }
                    redirect(base_url());
                } 
                else {
                    $this->session->set_flashdata('error', 'Wrong username or password!');
                    redirect(base_url() . 'user');
                }
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        if(get_cookie('OrderCount',true)){
            delete_cookie('OrderCount');
        }        
        redirect(base_url() . 'user');
    }

    public function profile($id = null)
    {
        $this->load->helper("auth_helper");
        if( ! auth_check() ){
            redirect(base_url() . 'user');
        }
        if( $this->input->method() == 'post' ) {
            if($this->session->userType <= $this->input->post('type') || $this->session->userType >= 5){
                if($this->input->post('postSubmit')){
                    $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|xss_clean');
                    $this->form_validation->set_rules('password', 'Password', 'trim|xss_clean');
                    $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|xss_clean|matches[password]');
                    $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('surname', 'Surname', 'trim|required|xss_clean');
                    if ($this->form_validation->run() === true) {
                        $data = array(
                            'email' => $this->input->post('email', TRUE),
                            'name' => $this->input->post('name', TRUE),
                            'surname' => $this->input->post('surname', TRUE),
                            'type' => $this->input->post('type', TRUE),
                        );
                        if(
                            !empty($this->input->post('password', TRUE)) && 
                            !empty($this->input->post('confirm_password', TRUE)) &&
                            $this->input->post('password', TRUE) == $this->input->post('confirm_password', TRUE)
                            )
                            {
                            $data['password'] = $this->encrypt->encode($this->input->post('password', TRUE));
                        }
                        $this->user_model->updateUser($data);
                        $this->session->set_flashdata('info', 'Profile updated successfully');
                    }
                    else {
                        $this->session->set_flashdata('error', 'Check the entered data something was wrong!');
                    }
                }
                else {
                    $this->session->set_flashdata('error', 'Insufficient privileges!');
                }
            }
            redirect(base_url() . 'user/profile');
        } 
        else {
            //NOTE GET
            $config = $this->config->item('configCustom');
            $data['config'] = $config;
            $data['pageTitle'] = "Profile";
            $values = array(
                'pageTitle' => $data['pageTitle'],
                'userType'      => $this->session->userType,
                'userTypeKeyVal' => $config['userTypeKeyVal'],
            );
            $values['user'] = $this->user_model->getUser($this->session->userId);
            $data['pageContent'] = $this->load->view('user', $values, TRUE);
            $this->load->view('_main', $data);
        }
    }

    public function password_reset($key = null)
    {
        if( $this->input->method() == 'post' && is_null($key) ){
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|xss_clean');
            if($this->input->post('postSubmit')){
                $expiry = time() + (3600 * 24);
                $email = $this->input->post('email', TRUE);
                $password = random_string('alnum', rand(8,12));
                $data = array(
                    'email' => $email,
                    'password' =>  $this->encrypt->encode($password),
                );
                $userid = $this->user_model->updateUser($data);
                if($userid){
                    // var_dump($userid);
                    $config = $this->config->item('configCustom');
                    $body = "Below the new password required.\r\n";
                    $body .= "\r\n";
                    $body .= "Password: ".$password."\r\n";
                    $body .= "\r\n";
                    $body .= "Once logged in, change the password from your personal area.\r\n";
                    $body .= "\r\n".$config['email']['fromName']."\r\n";
                    $this->email->subject($config['siteName'].' Password Reset');
                    $this->email->from($config['email']['fromEmail'], $config['email']['fromName']);
                    $this->email->to($email);
                    $this->email->message($body);
                    if($this->email->send()){
                        $this->session->set_flashdata('info', 'Credentials successfully sent! Check in your inbox.');
                    } else {
                        $this->session->set_flashdata('error', "Error sending email, try again.");
                    }
                } else {
                    $this->session->set_flashdata('error', 'User disabled or incorrect email!');
                }
            }
        } 
        redirect(base_url() . 'user');
    }

}