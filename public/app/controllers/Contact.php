<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends Frontend_Controller {

	public function index()
	{            
            $this->data_to_header['title']="Contact Us";
            $this->data_to_header['active_menu']="contact";
            
            $this->load->view($this->header_url, $this->data_to_header);
            $this->load->view('contact', $this->data_to_view);
            $this->load->view($this->footer_url, $this->data_to_footer);
	}
}
