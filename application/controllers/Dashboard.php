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
            $shift = (date('H')>4 && date('H')<16)?1:2;
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

    // public function autoupdate($id) {
    //     $items = $this->itemsValues($id);
    //     $this->load->view('autoupdate', array('items' => $items));
    // }

    // private function dashItems() {
    //     $items = $this->dashboard_model->getItems();
    //     $types = $this->dashboard_model->getTypes();
    //     $orders = $this->dashboard_model->getOrders();
    //     $obj = array();
    //     foreach($types as $type){
    //         $itemsType = $this->dashboard_model->getItem($type->id);
    //     }
    //     return $obj;
    // }

    // private function itemsValues($id){
    //     $set = $this->dashboard_model->getSets($id, array('pin','asc'));
    //     $items = array();        
    //     foreach($set as $s){
    //         $s->lasttime = $s->updated; 
    //         $s->show = null;
    //         $s->color="btn-primary";
    //         $s->action = null;
    //         $s->ico = null;
    //         $s->cssclass = null;
    //         $pin = $s->pin;
    //         switch($s->type){
    //             // case 4: // notify
    //             // if ($s->val == 0) {
    //             //     $s->action = 'ardId='.$id.'&pin='.$pin.'&val=1';
    //             //     $s->color = 'btn-default';
    //             //     $s->show = "Off";
    //             // } else {
    //             //     $s->action = 'ardId='.$id.'&pin='.$pin.'&val=0';
    //             //     $s->color = 'btn-primary';
    //             //    $s->show = "On";                            
    //             // }
    //             // $s->ico = 'fa-power-off';
    //             // $s->cssclass = 'action';
    //             // break;
    //             case 3: // impulse
    //             $s->action = 'ardId='.$id.'&pin='.$pin.'&val=1';
    //             $s->color = "btn-info";
    //             $s->show = '<i class="fa fa-plug"></i>';
    //             $s->cssclass = 'action';
    //             $s->ico = 'fa-dot-circle-o';
    //             break;
    //             case 2: // actuator
    //             if ($s->val == 0) {
    //                 $s->action = 'ardId='.$id.'&pin='.$pin.'&val=1';
    //                 $s->color = 'btn-default';
    //                 $s->show = '<i class="fa fa-toggle-off"></i>';					
    //             }
    //             if ($s->val == 1)	{
    //                 $s->action = 'ardId='.$id.'&pin='.$pin.'&val=0';
    //                 $s->color = 'btn-primary';                              
    //                 $s->show = '<i class="fa fa-toggle-on"></i>';
    //             }
    //             $s->cssclass = 'action';
    //             $s->ico = 'fa-power-off';
    //             break;
    //             default: // 0: disabled, 1: sensors 
    //             $s->cssclass = 'hidden';
    //             break;
    //         }
    //         $items[] = $s;
    //     }
    //     $btnCheck = new stdClass;
    //     $btnCheck->name = "Update Values";
    //     $btnCheck->type = 4;
    //     $btnCheck->status = 1;
    //     $btnCheck->action = 'ardId='.$id.'&pin=n0&val=2';
    //     $btnCheck->color = "btn-info";
    //     $btnCheck->show = '<i class="fa fa-heartbeat"></i>';
    //     $btnCheck->cssclass = 'action';
    //     $btnCheck->ico = 'fa-dot-circle-o';
    //     $items[] = $btnCheck;
    //     return $items;
    // }

}