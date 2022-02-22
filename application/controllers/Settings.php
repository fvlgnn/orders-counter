<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Settings controller
 * @author @fvlgnn <fvlgnn@gmail.com>
 * @date 28th Aug, 2018
 */

class Settings extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->library('session');

        $this->load->library('grocery_CRUD');
        
        $this->load->helper("auth_helper");
        if( ! auth_check() ){
            redirect(base_url() . 'user');
        }
    }

	public function index() {
        if($this->session->userType >= 5) { 
            $config = $this->config->item('configCustom');
            $data['config'] = $config;
            $data['pageTitle'] = "Settings";
            $values = array(
                'pageTitle' => $data['pageTitle'],
            );
            $data['pageContent'] = $this->load->view('settings', $values, TRUE);
            $this->load->view('_main', $data);
        }
        else {
            $this->session->set_flashdata('error', 'Insufficient privileges or wrong id!');
            redirect(base_url() . 'dashboard');
        }
    }

    public function orders() {
        $config = $this->config->item('configCustom');
        $data['config'] = $config;
        $data['pageTitle'] = "Set Orders";

        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('orders');
        $crud->field_type('updated','readonly');
        $crud->set_relation('item','items','name');
        $crud->field_type('destination','dropdown', array(0 => 'Table Service', 1 => 'Take Away'));
        $crud->field_type('shift','dropdown', array(1 => 'First', 2 => 'Second'));
        $crud->order_by('date','desc');

        $output = $crud->render();
        $data['datatable'] = $output;

        $values['pageSubtitle'] = "Orders";
        $values['datatable'] = $data['datatable'];
        $data['pageContent'] = $this->load->view('settings', $values, TRUE);
        $this->load->view('_main', $data);
    }

    public function items() {
        $config = $this->config->item('configCustom');
        $data['config'] = $config;
        $data['pageTitle'] = "Set Items";

        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('items');
        $crud->required_fields('name','type');
        $crud->field_type('updated','readonly');
        $crud->set_relation('type','types','name');        
        $crud->order_by('type, name');
        // $crud->unset_delete();

        $output = $crud->render();
        $data['datatable'] = $output;

        $values['pageSubtitle'] = "Items";
        $values['datatable'] = $data['datatable'];
        $data['pageContent'] = $this->load->view('settings', $values, TRUE);
        $this->load->view('_main', $data);
    }

    public function types() {
        $config = $this->config->item('configCustom');
        $data['config'] = $config;
        $data['pageTitle'] = "Set Types";

        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('types');
        $crud->required_fields('name'); 
        $crud->field_type('updated','readonly');     
        $crud->order_by('name', 'asc');
        // $crud->unset_delete();

        $output = $crud->render();
        $data['datatable'] = $output;

        $values['pageSubtitle'] = "Types";
        $values['datatable'] = $data['datatable'];
        $data['pageContent'] = $this->load->view('settings', $values, TRUE);
        $this->load->view('_main', $data);
    }

    public function users() {
        if($this->session->userType >= 5) {         
            $config = $this->config->item('configCustom');
            $data['config'] = $config;
            $data['pageTitle'] = "Set Users";

            $this->load->library('grocery_CRUD');
            $crud = new grocery_CRUD();

            $crud->set_table('users');
            $crud->field_type('updated','readonly');
            $crud->unset_columns('pass_reset','pass_expiry');  
            $crud->unset_fields('pass_reset','pass_expiry');
            $crud->required_fields('email','password','type'); 
            $crud->order_by('email', 'asc');
            $crud->field_type('type','dropdown', $config['userTypeKeyVal']);
            $crud->field_type('password', 'password');

            $crud->callback_before_insert(array($this,'encrypt_password_callback'));
            $crud->callback_before_update(array($this,'encrypt_password_callback'));

            $output = $crud->render();
            $data['datatable'] = $output;

            $values['pageSubtitle'] = "Users";
            $values['datatable'] = $data['datatable'];
            $data['pageContent'] = $this->load->view('settings', $values, TRUE);
            $this->load->view('_main', $data);
        }
        else {
            $this->session->set_flashdata('error', 'Insufficient privileges or wrong id!');
            redirect(base_url() . 'dashboard');
        }
    }

    public function day_details($date = null) {
        $config = $this->config->item('configCustom');
        $data['config'] = $config;
        $data['pageTitle'] = "Day Orders";

        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('orders');
        $crud->where('date',$date);
        $crud->field_type('updated','readonly');
        $crud->set_relation('item','items','name');
        $crud->field_type('destination','dropdown', array(0 => 'Table Service', 1 => 'Take Away'));
        $crud->field_type('shift','dropdown', array(1 => 'First', 2 => 'Second'));
        $crud->order_by('total DESC', 'destination ASC', 'shift ASC');

        $output = $crud->render();
        $data['datatable'] = $output;

        $values['pageSubtitle'] = "Day Orders";
        $values['datatable'] = $data['datatable'];
        $data['pageContent'] = $this->load->view('settings', $values, TRUE);
        $this->load->view('_main', $data);
    }

    public function encrypt_password_callback($post_array) {
        $query = "SELECT * FROM users WHERE email='".$post_array['email']."'";
        $row = $this->db->query($query)->row_array();
        if($post_array['password'] != $row['password']){
            $post_array['password'] = password_hash($post_array['password'], PASSWORD_BCRYPT);
        }
        return $post_array;
    }

}