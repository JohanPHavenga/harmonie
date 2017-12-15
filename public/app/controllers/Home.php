<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Frontend_Controller {
    
        public function __construct()
        {       
            parent::__construct();
            $this->load->model('property_model');
        }

	/**
	 * Index Page for this controller.
	 *s
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
            
            $this->data_to_view["featured_properties"] = $this->property_model->get_property_list(["is_featured"=>TRUE]);
            $this->data_to_view["all_properties"] = $this->property_model->get_property_list(["all_prop"=>TRUE]);  
            
            $lp_data['latest_properties']=$this->property_model->get_property_list(["latest"=>4]);            
            $this->data_to_view['latest_prop'] = $this->load->view('templates/latest_prop', $lp_data, TRUE);
            
            $this->data_to_footer['scripts_to_load']=array("assets/scripts/home.js",);
            
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
