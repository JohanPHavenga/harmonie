<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends Frontend_Controller {

	public function index()
	{            
            $this->data_to_header['title']="Contact Us";
            $this->data_to_header['active_menu']="contact";
            
            $lp_params['count']=4;
            $this->data_to_view['latest_prop'] = $this->load->view('templates/latest_prop', $lp_params, TRUE);
            
            $cf_params=[];
            $this->data_to_view['contact_form'] = $this->load->view('templates/contact_form', $cf_params, TRUE);
            
            $this->load->view($this->header_url, $this->data_to_header);
            $this->load->view('contact', $this->data_to_view);
            $this->load->view($this->footer_url, $this->data_to_footer);
	}
}
