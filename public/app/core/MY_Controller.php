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

}

class Frontend_Controller extends MY_Controller {

    public $data_to_header=["section"=>""];
    public $data_to_view=[];
    public $data_to_footer=["admin_login"=>"/login/admin"];

    public $header_url='templates/header';
    public $footer_url='templates/footer';

    public $crumbs_arr=[];
    
}