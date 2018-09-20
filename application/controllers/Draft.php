<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Draft controller
 * @author @fvlgnn <fvlgnn@gmail.com>
 * @date 28th May, 2018
 */

class Draft extends CI_Controller {

    public function __construct(){
        parent::__construct();
              
        // if(!empty($_SESSION['admin_id'])){
        //     redirect('dashboard');
        // }
    }

	public function index($var = null) {
        $config = $this->config->item('configCustom');
        $data['config'] = $config;
        $data['pageTitle'] = "Draft";
        $values = array(
            'pageTitle' => $data['pageTitle']
        );
        $data['pageContent'] = $this->load->view('draft', $values, TRUE);
        $this->load->view('_main', $data);
    }


}