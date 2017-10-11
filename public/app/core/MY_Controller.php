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
        
        // setup auto crumbs from URI
        $segs = $this->uri->segment_array();
        $crumb_uri= substr(base_url(),0,-1);
        $total_segments=$this->uri->total_segments();
        for ($x = 1; $x <= $total_segments; $x++) {

            if (($x==$total_segments) || ($x==3))
            {
                $crumb_uri="";
            } else {
                $crumb_uri.="/".$segs[$x];
            }

            if ($segs[$x]=="admin") { $segs[$x]="home"; }
                        if ($segs[$x]=="dashboard") { continue; }
            if ($segs[$x]=="delete") { $this->data_to_header['crumbs']=[]; break; }

            $segs[$x]=str_replace("_"," ",$segs[$x]);
            $this->data_to_header['crumbs'][ucwords($segs[$x])]=$crumb_uri;

            if ($x==3) { break; }
        }
        
        $this->data_to_header['menu_array']=$this->set_admin_menu_array();

    }
    
    function url_disect()
    {
        $url_info=[];
        $url_info["base_url"]=base_url();
        $url_info["url_string"]=uri_string();
        $url_info["url_string_arr"]=explode("/",uri_string());

        return $url_info;
    }

    function csv_handler($file_path)
    {
        $csv = array_map('str_getcsv', file($file_path));
        array_walk($csv, function(&$a) use ($csv) {
          $a = array_combine($csv[0], $a);
        });
        array_shift($csv);
        return $csv;
    }

    function csv_flat_table_import($file_data)
    {
        foreach ($file_data as $entity) {
            //reset($entity);

            $id = array_shift($entity);

            foreach ($entity as $key => $value) {
                if (!empty($value)) {
                    $user_data[$key]=$value;
                }
            }

            // get ID - set action
            if ($id>0) {
                $action="edit";
            } else {
                $action="add";
                $id=0;
                if (isset($sum_data[$action])) { $id=max(array_keys($sum_data[$action]))+1; }
            }

            $sum_data[$action][$id]=$user_data;
            unset($user_data);
        }

        return $sum_data;
    }
    
    function set_admin_menu_array() {
        return [
            // Dashboard
            [
                "text"=>"Dashboard",
                "url"=>'admin',
                "icon"=>"bar-chart",
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
            // Properties
            [
                "text"=>"Properties",
                "url"=>'admin/property',
                "icon"=>"home",
                "seg0"=>['property'],                
            ],
            // Users
            [
                "text"=>"Users",
                "url"=>'admin/user',
                "icon"=>"user",
                "seg0"=>['user'],                
            ],
            // Locations
            [
                "text"=>"Locations",
                "url"=>'admin/location',
                "icon"=>"map",
                "seg0"=>['location'],                
            ],
            // Locations
            [
                "text"=>"Property Types",
                "url"=>'admin/type',
                "icon"=>"pin",
                "seg0"=>['type'],                
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