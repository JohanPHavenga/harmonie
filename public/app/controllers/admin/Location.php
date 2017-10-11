<?php
class Location extends Admin_Controller {

    private $return_url="/admin/location";
    private $create_url="/admin/location/create";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('location_model');
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
        
        $this->data_to_view["location_data"] = $this->location_model->get_location_list();
        $this->data_to_view['heading']=["ID","Location Name","Actions"];
        
        $this->data_to_view['create_link']=$this->create_url;
        $this->data_to_header['title'] = "Locations";
        $this->data_to_header['crumbs'] =
                   [
                   "Home"=>"/admin",
                   "Locations"=>"/admin/location",
                   "List"=>"",
                   ];
        
        $this->data_to_header['page_action_list']=
                [
                    [
                        "name"=>"Add Location",
                        "icon"=>"map",
                        "uri"=>"location/create/add",
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
        $this->load->view("/admin/location/view", $this->data_to_view);
        $this->load->view($this->footer_url, $this->data_to_footer);
    }
    

    public function create($action, $id=0) {

        // load helpers / libraries
//        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="note note-danger" role="alert">', '</div>');

        // set data
        $this->data_to_header['title'] = ucfirst($action)." Location";
        $this->data_to_view['action']=$action;
        $this->data_to_view['form_url']=$this->create_url."/".$action;


        if ($action=="edit")
        {
        $this->data_to_view['location_detail']=$this->location_model->get_location_detail($id);
        $this->data_to_view['form_url']=$this->create_url."/".$action."/".$id;
        }
        // set validation rules
        $this->form_validation->set_rules('location_name', 'Location Name', 'required|min_length[2]');

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
            $db_write=$this->location_model->set_location($action, $id);
            if ($db_write)
            {
                $alert="Location has been updated";
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
    
    
    public function delete($location_id=0) {

        if (($location_id==0) AND (!is_int($location_id))) {
            $this->session->set_flashdata('alert', 'Cannot delete record: '.$location_id);
            $this->session->set_flashdata('status', 'danger');
            redirect($this->return_url);
            die();
        }

        // get location detail for nice delete message
        $location_detail=$this->location_model->get_location_detail($location_id);
        // delete record
        $db_del=$this->location_model->remove_location($location_id);
        
        if ($db_del)
        {
            $msg="Location has successfully been deleted: ".$location_detail['location_name'];
            $status="success";
        }
        else
        {
            $msg="Error in deleting the record:'.$location_id";
            $status="danger";
        }

        $this->session->set_flashdata('alert', $msg);
        $this->session->set_flashdata('status', $status);
        redirect($this->return_url);
    }
    
}
