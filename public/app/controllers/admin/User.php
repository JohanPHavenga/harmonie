<?php
class User extends Admin_Controller {

    private $return_url="/admin/user";
    private $create_url="/admin/user/create";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
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
        
        $this->data_to_view["user_data"] = $this->user_model->get_user_list();
        $this->data_to_view['heading']=["ID","User Name","User Surname","User Email","Actions"];
        
        $this->data_to_view['create_link']=$this->create_url;
        $this->data_to_header['title'] = "Users";
        $this->data_to_header['crumbs'] =
                   [
                   "Home"=>"/admin",
                   "Users"=>"/admin/user",
                   "List"=>"",
                   ];
        
        $this->data_to_header['page_action_list']=
                [
                    [
                        "name"=>"Add User",
                        "icon"=>"users",
                        "uri"=>"user/create/add",
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
        $this->load->view("/admin/user/view", $this->data_to_view);
        $this->load->view($this->footer_url, $this->data_to_footer);
    }
    

    public function create($action, $id=0) {

        // load helpers / libraries
//        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="note note-danger" role="alert">', '</div>');

        // set data
        $this->data_to_header['title'] = ucfirst($action)." User";
        $this->data_to_view['action']=$action;
        $this->data_to_view['form_url']=$this->create_url."/".$action;


        if ($action=="edit")
        {
        $this->data_to_view['user_detail']=$this->user_model->get_user_detail($id);
        $this->data_to_view['user_detail']['passconf']=$this->data_to_view['user_detail']['user_password'];
        $this->data_to_view['form_url']=$this->create_url."/".$action."/".$id;
        }
        // set validation rules
        $this->form_validation->set_rules('user_name', 'Name', 'required|min_length[2]');
        $this->form_validation->set_rules('user_surname', 'Surame', 'required|min_length[2]');
        $this->form_validation->set_rules('user_email', 'Email', 'valid_email');
        $this->form_validation->set_rules('user_username', 'Username', 'required|min_length[5]|is_unique[users.user_username]');
        $this->form_validation->set_rules('user_password', 'Password', 'required');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[user_password]');

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
            $db_write=$this->user_model->set_user($action, $id);
            if ($db_write)
            {
                $alert="User has been updated";
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
    
    
    public function delete($user_id=0) {

        if (($user_id==0) AND (!is_int($user_id))) {
            $this->session->set_flashdata('alert', 'Cannot delete record: '.$user_id);
            $this->session->set_flashdata('status', 'danger');
            redirect($this->return_url);
            die();
        }

        // get user detail for nice delete message
        $user_detail=$this->user_model->get_user_detail($user_id);
        // delete record
        $db_del=$this->user_model->remove_user($user_id);
        
        if ($db_del)
        {
            $msg="User has successfully been deleted: ".$user_detail['user_name']." ".$user_detail['user_surname'];
            $status="success";
        }
        else
        {
            $msg="Error in deleting the record:'.$user_id";
            $status="danger";
        }

        $this->session->set_flashdata('alert', $msg);
        $this->session->set_flashdata('status', $status);
        redirect($this->return_url);
    }


    public function export(){
        $this->load->dbutil();
        $this->load->helper('download');
        /* get the object   */
        $export = $this->user_model->export();
        /*  pass it to db utility function  */
        $new_report = $this->dbutil->csv_from_result($export);
        /*  Force download the file */
        force_download('users.csv', $new_report);
        /*  Done    */
    }

    
}
