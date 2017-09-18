<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Frontend_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            $this->data_to_header['active_menu']="home";
            
            $this->load->view($this->header_url, $this->data_to_header);
            $this->load->view('home', $this->data_to_view);
            $this->load->view($this->footer_url, $this->data_to_footer);
	}
        
        public function faq() 
        {
            $this->data_to_header['title']="Frequently asked questions";
            $this->data_to_header['active_menu']="faq";
            
            $this->load->view($this->header_url, $this->data_to_header);
            $this->load->view('faq', $this->data_to_view);
            $this->load->view($this->footer_url, $this->data_to_footer);
        }
        
        public function about() 
        {
            $this->data_to_header['title']="About Us";
            $this->data_to_header['active_menu']="about";
            
            $this->load->view($this->header_url, $this->data_to_header);
            $this->load->view('about', $this->data_to_view);
            $this->load->view($this->footer_url, $this->data_to_footer);
        }
        
        public function my_404() 
        {
            $this->data_to_header['title']="Page not found";
            
            $this->load->view($this->header_url, $this->data_to_header);
            $this->load->view('404', $this->data_to_view);
            $this->load->view($this->footer_url, $this->data_to_footer);
        }
}
