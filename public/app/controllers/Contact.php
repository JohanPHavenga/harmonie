<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends Frontend_Controller {

    // check if method exists, if not calls "view" method
    public function _remap($method, $params = array())
    {
        if (method_exists($this, $method))
        {
            return call_user_func_array(array($this, $method), $params);
        }
        else
        {
            $this->index();
        }
    }

    public function index($from=NUll)
    {                       
        $this->load->library('form_validation');

        $this->data_to_header['title']="Contact Us";
        $this->data_to_header['active_menu']="contact";

        $lp_data['latest_properties']=$this->property_model->get_property_list(["latest"=>4]);            
        $this->data_to_view['latest_prop'] = $this->load->view('templates/latest_prop', $lp_data, TRUE);

        $this->data_to_view["sleeps_dropdown"] = $this->property_model->get_sleeps_dropdown(); 

        $this->data_to_header['css_to_load']=array("assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css",);
        $this->data_to_footer['js_to_load']=array("assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js",);
        $this->data_to_footer['scripts_to_load']=array("assets/scripts/contact.js",);

        $this->data_to_view['from']=$from;
        
        $this->load->view($this->header_url, $this->data_to_header);
        $this->load->view('contact', $this->data_to_view);
        $this->load->view($this->footer_url, $this->data_to_footer);
    }


    public function mailer($from=NULL)
    {
        
        $this->load->library('form_validation');

        $this->data_to_header['title'] = "Mailer"; 
        $this->data_to_view['from']=$from;
        
        $lp_data['latest_properties']=$this->property_model->get_property_list(["latest"=>5]);    
        $this->data_to_view['latest_prop'] = $this->load->view('templates/latest_prop', $lp_data, TRUE);

        // set validation rules
        $this->form_validation->set_rules('inputContactName', 'Name', 'required');
        $this->form_validation->set_rules('inputContactEmail', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('inputContactPhone', 'Phone Number', 'required');
        $this->form_validation->set_rules('inputSleeps', 'Number of guests', 'required');
        $this->form_validation->set_rules('inputDateFrom', 'Date From', 'required');
        $this->form_validation->set_rules('inputDateTo', 'Date To', 'required');
        $this->form_validation->set_rules('inputContactMessage', 'Message', 'required');

        // load correct view. If validation is false:
        if ($this->form_validation->run() === FALSE)
        {
                $this->data_to_view['post']=$_POST;
                $this->data_to_view['email_send']=false;

                $this->data_to_view["sleeps_dropdown"] = $this->property_model->get_sleeps_dropdown(); 
                $this->data_to_header['css_to_load']=array("assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css",);
                $this->data_to_footer['js_to_load']=array("assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js",);
                $this->data_to_footer['scripts_to_load']=array("assets/scripts/contact.js",);
        
                $this->load->view($this->header_url, $this->data_to_header);
                $this->load->view('contact', $this->data_to_view);
                $this->load->view($this->footer_url, $this->data_to_footer);
        }
        else
        {
            $this->load->library('email');
            
//            $config['mailtype'] = 'html';
//            $config['smtp_host'] = 'smtp.gmail.com';
//            $config['smtp_user'] = 'johan.havenga@gmail.com';
//            $config['smtp_pass'] = 'Cereal4Killer2';
//            $config['smtp_port'] = '465';
//            $config['smtp_crypto'] = 'ssl';
            
            $config['mailtype'] = 'html';
            $config['smtp_host'] = 'http://dandelion.aserv.co.za';
            $config['smtp_port'] = '465';
            
            $this->email->initialize($config);

            $this->email->from($this->input->post('inputContactEmail'), $this->input->post('inputContactName'));
            // TO adres
            $this->email->to('info@harmonieprop.co.za');
            // moet uithaal
            $this->email->bcc('johan.havenga@gmail.com');

            if ($this->input->post('inputPropCode')) {
                $this->email->subject('Website Query: '.$this->input->post('inputPropCode').' #'.time());
            } else {
                $this->email->subject('General website query #'.time());
                
            }

            $msg_arr[]="Name: ".$this->input->post('inputContactName');
            $msg_arr[]="Phone Number: ".$this->input->post('inputContactPhone');
            $msg_arr[]="Email: ".$this->input->post('inputContactEmail');
            if ($this->input->post('inputPropCode')) {
                $msg_arr[]="Property equiring about: ".$this->input->post('inputPropCode');
            }
            if ($this->input->post('inputPropCode') > 0) {
                $msg_arr[]="Number of Guests: ".$this->input->post('inputSleeps');
            }
            $msg_arr[]="Date From: ".$this->input->post('inputDateFrom');
            $msg_arr[]="Date To: ".$this->input->post('inputDateTo');
            $msg_arr[]="Message: ".$this->input->post('inputContactMessage');
            $msg=implode("<br>",$msg_arr);

            $this->email->message($msg);

            $this->email->send();
            $this->data_to_view['email_send']=true;
                            
            $this->load->view($this->header_url, $this->data_to_header);
            $this->load->view('contact', $this->data_to_view);
            $this->load->view($this->footer_url, $this->data_to_footer);
        }
    }
}
