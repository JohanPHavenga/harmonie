<?php
class Type extends Admin_Controller {

    private $return_url="/admin/type";
    private $create_url="/admin/type/create";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('type_model');
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
        
        $this->data_to_view["type_data"] = $this->type_model->get_type_list();
        $this->data_to_view['heading']=["ID","Property Type","Actions"];
        
        $this->data_to_view['create_link']=$this->create_url;
        $this->data_to_header['title'] = "Prperty Types";
        $this->data_to_header['crumbs'] =
                   [
                   "Home"=>"/admin",
                   "Types"=>"/admin/type",
                   "List"=>"",
                   ];
        
        $this->data_to_header['page_action_list']=
                [
                    [
                        "name"=>"Add Property Type",
                        "icon"=>"pin",
                        "uri"=>"type/create/add",
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
        $this->load->view("/admin/type/view", $this->data_to_view);
        $this->load->view($this->footer_url, $this->data_to_footer);
    }
    

    public function create($action, $id=0) {

        // load helpers / libraries
//        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="note note-danger" role="alert">', '</div>');

        // set data
        $this->data_to_header['title'] = ucfirst($action)." Property Type";
        $this->data_to_view['action']=$action;
        $this->data_to_view['form_url']=$this->create_url."/".$action;


        if ($action=="edit")
        {
        $this->data_to_view['type_detail']=$this->type_model->get_type_detail($id);
        $this->data_to_view['form_url']=$this->create_url."/".$action."/".$id;
        }
        // set validation rules
        $this->form_validation->set_rules('type_name', 'Property Type', 'required|min_length[2]');

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
            $db_write=$this->type_model->set_type($action, $id);
            if ($db_write)
            {
                $alert="Property Type has been updated";
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
    
    
    public function delete($type_id=0) {

        if (($type_id==0) AND (!is_int($type_id))) {
            $this->session->set_flashdata('alert', 'Cannot delete record: '.$type_id);
            $this->session->set_flashdata('status', 'danger');
            redirect($this->return_url);
            die();
        }

        // get type detail for nice delete message
        $type_detail=$this->type_model->get_type_detail($type_id);
        // delete record
        $db_del=$this->type_model->remove_type($type_id);
        
        if ($db_del)
        {
            $msg="Property Type has successfully been deleted: ".$type_detail['type_name'];
            $status="success";
        }
        else
        {
            $msg="Error in deleting the record:'.$type_id";
            $status="danger";
        }

        $this->session->set_flashdata('alert', $msg);
        $this->session->set_flashdata('status', $status);
        redirect($this->return_url);
    }
    
}
