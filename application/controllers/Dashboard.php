<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dashboard controller
 * @author @fvlgnn <fvlgnn@gmail.com>
 * @date 28th Aug, 2018
 */

class Dashboard extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        $this->load->model("dashboard_model");
        
        $this->load->helper("auth_helper");
        if( ! auth_check() ){
            redirect(base_url() . 'user');
        }
    }

    public function index() {
        $config = $this->config->item('configCustom');
        $data['config'] = $config;
        $data['pageTitle'] = "Dashboard";
        $values = array(
            'pageTitle' => $data['pageTitle'],
            'items'     => $this->dashboard_model->getItemsType()
        );
        // $items = $this->itemsValues($id);
        // $values['autoupdate'] = $this->load->view('autoupdate', array('items' => $items), TRUE);
        $data['pageContent'] = $this->load->view('dashboard', $values, TRUE);
        $this->load->view('_main', $data);
    }

    public function submit() {
        if($this->session->userType > 0){
            $shift = (date('H')>5 && date('H')<17)?1:2;
            $date = date('Y-m-d');
			$data = array(
                'item' => $this->input->post('item', TRUE),
                'destination' => $this->input->post('destination', TRUE)
            );
            $order = $this->dashboard_model->getOrder($data['item'], $data['destination'], $shift, $date);
            if($order) {
                $order->total++; 
                $data = $order;
            } else {
                $data['shift'] = $shift;
                $data['date'] = $date;
            }
			$this->dashboard_model->submitOrder($data);
			// sleep(0.5);
			$this->output
				->set_content_type('application/json')
				// ->set_output(json_encode(array("result" => "received")));
				->set_output(json_encode($data));
				// ->set_output(json_encode($data));
		}
		else {
			$this->output->set_status_header(401);
		}
    }

}