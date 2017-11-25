<?php
class Property extends Admin_Controller {    

    private $return_url="/admin/property";
    private $create_url="/admin/property/create";    
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('property_model');
    }
    
    public function _remap($method, $params = array())
    {
        if (method_exists($this, $method))
        {
            return call_user_func_array(array($this, $method), $params);
        }
        else
        {
            $this->view($params);
        }
    }
    
    public function view() {
        // load helpers / libraries
        $this->load->library('table');
        
        $this->data_to_view["property_data"] = $this->property_model->get_property_list();
        
        $this->data_to_view['create_link']=$this->create_url;
        $this->data_to_header['title'] = "Property List";
        $this->data_to_header['crumbs'] =
                   [
                   "Home"=>"/admin",
                   "Properties"=>"/admin/property",
                   "List"=>"",
                   ];
        
        $this->data_to_header['page_action_list']=
                [
                    [
                        "name"=>"Add Property",
                        "icon"=>"pin",
                        "uri"=>"property/create/add",
                    ],
                ];
        
        $this->data_to_view['url']=$this->url_disect();
        
        $this->data_to_header['css_to_load']=array(
            "assets/plugins/datatables/datatables.min.css",
            "assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css",
            );

        $this->data_to_footer['js_to_load']=array(
            "assets/scripts/admin/datatable.js",
            "assets/plugins/datatables/datatables.min.js",
            "assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js",
            "assets/plugins/bootstrap-confirmation/bootstrap-confirmation.js",
            );

        $this->data_to_footer['scripts_to_load']=array(
            "assets/scripts/admin/table-datatables-managed.js",
            );

        // load view
        $this->load->view($this->header_url, $this->data_to_header);
        $this->load->view("/admin/property/view", $this->data_to_view);
        $this->load->view($this->footer_url, $this->data_to_footer);
    }
    
    
    public function create($action, $id=0) {

        $this->load->model('location_model');
        $this->load->model('type_model');
        // load helpers / libraries
//        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="note note-danger" role="alert">', '</div>');

        // set data
        $this->data_to_header['title'] = ucfirst($action)." Property";
        $this->data_to_view['action']=$action;
        $this->data_to_view['form_url']=$this->create_url."/".$action;
        
        $this->data_to_header['css_to_load']=array(
            "assets/plugins/bootstrap-summernote/summernote.css",
            );

        $this->data_to_footer['js_to_load']=array(
            "assets/plugins/moment.min.js",
            "assets/plugins/bootstrap-summernote/summernote.min.js",
            );

        $this->data_to_footer['scripts_to_load']=array(
            "assets/scripts/admin/components-editors.js",
            );

        // get drop downs
        $this->data_to_view['location_dropdown']=$this->location_model->get_location_dropdown();
        $this->data_to_view['type_dropdown']=$this->type_model->get_type_dropdown();

        if ($action=="edit")
        {
            $this->data_to_view['property_detail']=$this->property_model->get_property_detail($id);
            $this->data_to_view['form_url']=$this->create_url."/".$action."/".$id;
        }
                
        // set validation rules
        $this->form_validation->set_rules('property_code', 'Property Code', 'required|min_length[2]');
        $this->form_validation->set_rules('property_sleeps', 'Sleeps', 'numeric');
        $this->form_validation->set_rules('property_bathrooms', 'Bathrooms', 'numeric');
        $this->form_validation->set_rules('property_bedrooms', 'Bedrooms', 'numeric');
        $this->form_validation->set_rules('property_rate_low', 'Rate Low', 'numeric');
        $this->form_validation->set_rules('property_rate_med', 'Rate Medium', 'numeric');
        $this->form_validation->set_rules('property_rate_high', 'Rate High', 'numeric');
        $this->form_validation->set_rules('location_id', 'Location', 'required|numeric|greater_than[0]',["greater_than"=>"Please select a location"]);

        // load correct view
        if ($this->form_validation->run() === FALSE)
        {
            $this->data_to_view['return_url']=$this->return_url;
            $this->load->view($this->header_url, $this->data_to_header);
            $this->load->view($this->create_url, $this->data_to_view);
            $this->load->view($this->footer_url, $this->data_to_footer);
        }
        else
        {
            $db_write=$this->property_model->set_property($action, $id);
            if ($db_write)
            {
                $alert="Property has been updated";
                $status="success";
            }
            else
            {
                $alert="Error committing to the database";
                $status="danger";
            }

            $this->session->set_flashdata([
                'alert'=>$alert,
                'status'=>$status,
                ]);

            redirect($this->return_url);
        }
    }
    
    
    public function delete($property_id=0) {

        if (($property_id==0) AND (!is_int($property_id))) {
            $this->session->set_flashdata('alert', 'Cannot delete record: '.$property_id);
            $this->session->set_flashdata('status', 'danger');
            redirect($this->return_url);
            die();
        }

        // get type detail for nice delete message
        $property_detail=$this->property_model->get_property_detail($property_id);
        // delete record
        $db_del=$this->property_model->remove_property($property_id);
        
        if ($db_del)
        {
            $msg="Property has successfully been deleted: ".$property_detail['property_code'];
            $status="success";
        }
        else
        {
            $msg="Error in deleting the record:'.$property_id";
            $status="danger";
        }

        $this->session->set_flashdata('alert', $msg);
        $this->session->set_flashdata('status', $status);
        redirect($this->return_url);
    }


}
