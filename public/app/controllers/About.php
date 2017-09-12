<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends Frontend_Controller {

	public function index()
	{            
            $this->data_to_header['title']="About Us";
            $this->data_to_header['active_menu']="about";
            
            $this->load->view($this->header_url, $this->data_to_header);
            $this->load->view('about', $this->data_to_view);
            $this->load->view($this->footer_url, $this->data_to_footer);
	}
}
