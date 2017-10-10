<?php
// core/MY_Controller.php
/**
 * Base Controller
 *
 */
class MY_Controller extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        // Load any front-end only dependencies
    }

}

/**
 * Back end Controller
 *
 */
class Admin_Controller extends MY_Controller {
    
    public $data_to_header=[];
    public $data_to_view=[];
    public $data_to_footer=[];

    public $view_url="/admin/list";
    public $header_url="/templates/admin/header";
    public $footer_url="/templates/admin/footer";
    public $logout_url="/login/logout";
    public $upload_path="./uploads/admin/";
    
    function __construct()
    {
        parent::__construct();
        // Check login, load back end dependencies
        if (!$this->session->has_userdata('admin_logged_in'))
        {
            $this->session->set_flashdata([
                    'alert'=>"You are not logged in. Please log in to continue.",
                    'status'=>"danger",
                    ]);
            redirect('/login/admin', 'refresh');
        }
        
        $this->data_to_header['menu_array']=$this->set_admin_menu_array();

    }
    
    function set_admin_menu_array() {
        return [
            // Dashboard
            [
                "text"=>"Dashboard",
                "url"=>'admin',
                "icon"=>"home",
                "seg0"=>['dashboard'],
                "submenu"=>[
                    [
                    "text"=>"Dashboard",
                    "url"=>'admin/dashboard',
                    "icon"=>"bar-chart",
                    ],
                    [
                    "text"=>"Search",
                    "url"=>'admin/dashboard/search',
                    "icon"=>"magnifier",
                    ],
                ],
            ],
            // Events
            [
                "text"=>"Events",
                "url"=>'admin/event',
                "icon"=>"rocket",
                "seg0"=>['event'],
                "submenu"=>[
                    [
                    "text"=>"List All Events",
                    "url"=>'admin/event/view',
                    ],
                    [
                    "text"=>"Add Event",
                    "url"=>'admin/event/create/add',
                    ],
                    [
                    "text"=>"Import Events",
                    "url"=>'admin/event/import',
                    ],
                    [
                    "text"=>"Export Events",
                    "url"=>'admin/event/export',
                    ],
                ],
            ],
        ];
    }

}

class Frontend_Controller extends MY_Controller {

    public $data_to_header=["active_menu"=>""];
    public $data_to_view=[];
    public $data_to_footer=["admin_login"=>"/login/admin"];

    public $header_url='templates/header';
    public $footer_url='templates/footer';

    public $crumbs_arr=[];

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('property_model');
        
        $lp_params['count']=3;
        $cf_params=[];
        $this->data_to_footer['latest_prop'] = $this->load->view('templates/latest_prop', $lp_params, TRUE);
        $this->data_to_footer['contact_form'] = $this->load->view('templates/contact_form', $cf_params, TRUE);
        
        
    }
    
   
    
}