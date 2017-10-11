<?php
class Property extends Admin_Controller {
    

    // check if method exists, if not calls "view" method
    public function _remap($method, $params = array())
    {
        if (method_exists($this, $method))
        {
            return call_user_func_array(array($this, $method), $params);
        }
        else
        {
            $this->view();
        }


    }

    public function view() 
    {
     
        $this->view_url="admin/property/view";

        $this->data_to_header['title'] = "Properties";
        $this->data_to_header['crumbs'] =
                   [
                   "Home"=>"/admin",
                   "Properties"=>"",
                   ];
        
        $this->data_to_footer['js_to_load']=array(
            );
       

        $this->load->view($this->header_url, $this->data_to_header);
        $this->load->view($this->view_url, $this->data_to_view);
        $this->load->view($this->footer_url, $this->data_to_footer);
    }


}
