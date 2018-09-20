<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Statistics controller
 * @author @fvlgnn <fvlgnn@gmail.com>
 * @date 29th Aug, 2018
 */

class Statistics extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->model("statistics_model");
              
        $this->load->helper("auth_helper");
        if( ! auth_check() ){
            redirect(base_url() . 'user');
        }
    }

	public function index($id = null) {
        $config = $this->config->item('configCustom');
        $data['config'] = $config;
        $values = array();
        $day = (is_null($id)) ? date('Y-m-d') : $id;
        $values['day'] = $day;
        if(is_null($id)){        
            $data['pageTitle'] = "Statistics";
            $values['pageTitle'] = $data['pageTitle'];
            $values['charTitle'] = "Today";
            $values['orderDays'] = $this->orderDays();
        }
        else {
            $data['pageTitle'] = "Details";
            $values['pageTitle'] = "Day ".$day;   
        }
        $values['dayOrders'] = $this->dayOrders($day);
        $data['pageContent'] = $this->load->view('statistics', $values, TRUE);
        $this->load->view('_main', $data);  
    }

    private function dayOrders($day) {
        $obj = array();
        $dayOrders = $this->statistics_model->getDayOrders($day);
        if($dayOrders){
            $ordersTotal = 0;
            $ordersIn = 0;
            $ordersOut = 0;
            $shift1 = 0;
            $shift2 = 0;
            foreach($dayOrders as $order) {
                $ordersTotal =  $ordersTotal + $order->total;
                $ordersIn = ($order->destination == 0) ? $ordersIn + $order->total : $ordersIn;
                $ordersOut = ($order->destination == 1) ? $ordersOut + $order->total : $ordersOut;
                $shift1 = ($order->shift == 1) ? $shift1 + $order->total : $shift1;
                $shift2 = ($order->shift == 2) ? $shift2 + $order->total : $shift2;
            }
            $objGroup = new stdClass;
            $objGroup->date = $order->date;
            $objGroup->ordersTotal = $ordersTotal;
            $objGroup->ordersIn = $ordersIn;
            $objGroup->ordersOut = $ordersOut;
            $objGroup->shift1 = $shift1;
            $objGroup->shift2 = $shift2;
            $obj[] = $objGroup;
            $obj[] = $dayOrders;
        }
        // else {
        //     $this->session->set_flashdata('error', 'No data for this day!');
        //     // redirect(base_url() . 'statistics');
        // }
        return $obj;
    }

    private function orderDays(){
        $obj = array();
        $lastOrders = $this->statistics_model->getLastOrders();
        $ordersTotal = 0;
        $ordersIn = 0;
        $ordersOut = 0;
        $shift1 = 0;
        $shift2 = 0;
        $i=0;
        foreach($lastOrders as $order) {
            $date = $order->date;
            $i = (count($lastOrders)-1 == $i)? 0 : $i + 1;
            $ordersTotal =  $ordersTotal + $order->total;
            $ordersIn = ($order->destination == 0) ? $ordersIn + $order->total : $ordersIn;
            $ordersOut = ($order->destination == 1) ? $ordersOut + $order->total : $ordersOut;
            $shift1 = ($order->shift == 1) ? $shift1 + $order->total : $shift1;
            $shift2 = ($order->shift == 2) ? $shift2 + $order->total : $shift2;
            if($lastOrders{$i}->date != $order->date) {
                $objGroup = new stdClass;
                $objGroup->date = $order->date;
                $objGroup->ordersTotal = $ordersTotal;
                $objGroup->ordersIn = $ordersIn;
                $objGroup->ordersOut = $ordersOut;
                $objGroup->shift1 = $shift1;
                $objGroup->shift2 = $shift2;
                $obj[] = $objGroup;
                $ordersTotal = 0;
                $ordersIn = 0;
                $ordersOut = 0;
                $shift1 = 0;
                $shift2 = 0;
            }
        }
        return $obj;
    }



    public function day($id = null) {
        if(is_null($id)) $id = date('Y-m-d');
        $config = $this->config->item('configCustom');
        $data['config'] = $config;
        $data['pageTitle'] = "Day Stat";
        $values = array(
            'pageTitle' => $data['pageTitle']
        );
        var_dump($id);
        


    }


}