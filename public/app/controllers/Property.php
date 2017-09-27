<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Property extends Frontend_Controller {

    // check if method exists, if not calls "view" method
    public function _remap($method, $params = array())
    {
        // move dashes from method name
        $check_method= str_replace("-", "_", $method);
        if (method_exists($this, $check_method))
        {
            return call_user_func_array(array($this, $check_method), $params);
        }
        else
        {
            $this->grid($method, $params = array());
        }
    }
    
    public function grid($property_type)
    {            
        $this->data_to_header['title']="Properties Listing | ".ucfirst($property_type);
        $this->data_to_header['active_menu']="property";
        
        $this->data_to_view['filter']['property_type']=$property_type;

        $this->load->view($this->header_url, $this->data_to_header);
        $this->load->view('property', $this->data_to_view);
        $this->load->view($this->footer_url, $this->data_to_footer);
    }
    
    public function list_my_property()
    {            
        $this->data_to_header['title']="List my property";
        $this->data_to_header['active_menu']="property";
        

        $this->load->view($this->header_url, $this->data_to_header);
        $this->load->view('list_my_property', $this->data_to_view);
        $this->load->view($this->footer_url, $this->data_to_footer);
    }
    
    public function search()
    {            
        $this->data_to_header['title']="Search";
        $this->data_to_header['active_menu']="property";
        

        $this->load->view($this->header_url, $this->data_to_header);
        $this->load->view('search', $this->data_to_view);
        $this->load->view($this->footer_url, $this->data_to_footer);
    }
    
    public function detail($prop_code)
    {            
        $this->data_to_header['title']="Detail";
        $this->data_to_header['active_menu']="property";        
        
        $lp_params['count']=4;
        $this->data_to_view['latest_prop'] = $this->load->view('templates/latest_prop', $lp_params, TRUE);
        $cf_params=[];
        $this->data_to_view['contact_form'] = $this->load->view('templates/contact_form', $cf_params, TRUE);
        
        $this->data_to_view['prop_code']=$prop_code;

        $this->load->view($this->header_url, $this->data_to_header);
        $this->load->view('detail', $this->data_to_view);
        $this->load->view($this->footer_url, $this->data_to_footer);
    }
}
