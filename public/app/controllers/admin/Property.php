<?php
class Property extends Admin_Controller
{

    private $return_url = "/admin/property";
    private $create_url = "/admin/property/create";
    //    private $mapped_table_column_arr=[];    

    public function __construct()
    {
        parent::__construct();
        $this->load->model('property_model');
    }

    public function _remap($method, $params = array())
    {
        if (method_exists($this, $method)) {
            return call_user_func_array(array($this, $method), $params);
        } else {
            $this->view($params);
        }
    }

    public function view()
    {
        // load helpers / libraries
        $this->load->library('table');

        $this->data_to_view["property_data"] = $this->property_model->get_property_list(["include_unpublished" => TRUE]);

        $this->data_to_view['create_link'] = $this->create_url;
        $this->data_to_header['title'] = "Property List";
        $this->data_to_header['crumbs'] =
            [
                "Home" => "/admin",
                "Properties" => "/admin/property",
                "List" => "",
            ];

        $this->data_to_header['page_action_list'] =
            [
                [
                    "name" => "Add property",
                    "uri" => 'property/create/add',
                    "icon" => "plus",
                ],
                [
                    "name" => "Import properties",
                    "uri" => 'property/import',
                    "icon" => "arrow-up",
                ],
                [
                    "name" => "Export properties",
                    "uri" => 'property/export',
                    "icon" => "arrow-down",
                ],
            ];

        $this->data_to_view['url'] = $this->url_disect();

        $this->data_to_header['css_to_load'] = array(
            "assets/plugins/datatables/datatables.min.css",
            "assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css",
        );

        $this->data_to_footer['js_to_load'] = array(
            "assets/scripts/admin/datatable.js",
            "assets/plugins/datatables/datatables.min.js",
            "assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js",
            "assets/plugins/bootstrap-confirmation/bootstrap-confirmation.js",
        );

        $this->data_to_footer['scripts_to_load'] = array(
            "assets/scripts/admin/table-datatables-managed.js",
        );

        // load view
        $this->load->view($this->header_url, $this->data_to_header);
        $this->load->view("/admin/property/view", $this->data_to_view);
        $this->load->view($this->footer_url, $this->data_to_footer);
    }


    public function create($action, $id = 0)
    {

        $this->load->model('location_model');
        $this->load->model('type_model');
        // load helpers / libraries
        //        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="note note-danger" role="alert">', '</div>');

        // set data
        $this->data_to_header['title'] = ucfirst($action) . " Property";
        $this->data_to_view['action'] = $action;
        $this->data_to_view['form_url'] = $this->create_url . "/" . $action;

        $this->data_to_header['css_to_load'] = array(
            "assets/plugins/bootstrap-summernote/summernote.css",
        );

        $this->data_to_footer['js_to_load'] = array(
            "assets/plugins/moment.min.js",
            "assets/plugins/bootstrap-summernote/summernote.min.js",
        );

        $this->data_to_footer['scripts_to_load'] = array(
            "assets/scripts/admin/components-editors.js",
        );

        // get drop downs
        $this->data_to_view['location_dropdown'] = $this->location_model->get_location_dropdown();
        $this->data_to_view['type_dropdown'] = $this->type_model->get_type_dropdown();

        $this->data_to_view['sleeps_dropdown'] = $this->property_model->get_sleeps_dropdown();
        $this->data_to_view['sleeps_dropdown'][0] = "Select";

        if ($action == "edit") {
            $this->data_to_view['property_detail'] = $this->property_model->get_property_detail($id);
            $this->data_to_view['form_url'] = $this->create_url . "/" . $action . "/" . $id;
        } else {
            $this->data_to_view['property_detail']['property_ispublished'] = FALSE;
            $this->data_to_view['property_detail']['property_isfeatured'] = FALSE;
        }

        // set validation rules
        $this->form_validation->set_rules('property_code', 'Property Code', 'required|min_length[2]');
        $this->form_validation->set_rules('property_sleeps', 'Sleeps', 'numeric');
        $this->form_validation->set_rules('property_bathrooms', 'Bathrooms', 'numeric');
        $this->form_validation->set_rules('property_bedrooms', 'Bedrooms', 'numeric');
        $this->form_validation->set_rules('property_rate_low', 'Rate Low', 'numeric');
        $this->form_validation->set_rules('property_rate_med', 'Rate Medium', 'numeric');
        $this->form_validation->set_rules('property_rate_high', 'Rate High', 'numeric');
        $this->form_validation->set_rules('location_id', 'Location', 'required|numeric|greater_than[0]', ["greater_than" => "Please select a location"]);

        // load correct view
        if ($this->form_validation->run() === FALSE) {
            $this->data_to_view['return_url'] = $this->return_url;
            $this->load->view($this->header_url, $this->data_to_header);
            $this->load->view($this->create_url, $this->data_to_view);
            $this->load->view($this->footer_url, $this->data_to_footer);
        } else {
            $db_write = $this->property_model->set_property($action, $id);
            if ($db_write) {
                $alert = "Property has been updated";
                $status = "success";
            } else {
                $alert = "Error committing to the database";
                $status = "danger";
            }

            $this->session->set_flashdata([
                'alert' => $alert,
                'status' => $status,
            ]);



            // save_only takes you back to the edit page.
            if (array_key_exists("save_only", $_POST)) {
                $this->return_url = base_url("admin/property/create/edit/" . $db_write);
            }

            // wts($_POST);
            // wts($this->return_url,1);

            redirect($this->return_url);
        }
    }


    public function delete($property_id = 0)
    {

        if (($property_id == 0) and (!is_int($property_id))) {
            $this->session->set_flashdata('alert', 'Cannot delete record: ' . $property_id);
            $this->session->set_flashdata('status', 'danger');
            redirect($this->return_url);
            die();
        }

        // get type detail for nice delete message
        $property_detail = $this->property_model->get_property_detail($property_id);
        // delete record
        $db_del = $this->property_model->remove_property($property_id);

        if ($db_del) {
            $msg = "Property has successfully been deleted: " . $property_detail['property_code'];
            $status = "success";
        } else {
            $msg = "Error in deleting the record:'.$property_id";
            $status = "danger";
        }

        $this->session->set_flashdata('alert', $msg);
        $this->session->set_flashdata('status', $status);
        redirect($this->return_url);
    }


    public function import($submit = NULL)
    {

        $this->load->helper('form');
        $this->load->library('upload');
        $this->load->library('table');

        $this->data_to_header['title'] = "Import Properties";
        $this->data_to_view['form_url'] = "/admin/property/import/confirm";

        $config['upload_path']          = $this->upload_path;
        $config['allowed_types']        = 'csv';
        $config['max_size']             = 8192;
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('propfile')) {
            if (!empty($submit)) {
                $this->data_to_view['error'] = $this->upload->display_errors();
            }

            $this->load->view($this->header_url, $this->data_to_header);
            $this->load->view("/admin/property/import", $this->data_to_view);
            $this->load->view($this->footer_url, $this->data_to_footer);
        } else {
            if ($submit == "confirm") {
                // get file data and meta data
                // $this->data_to_view['file_meta_data'] = $this->upload->data();

                $file_data = $this->csv_handler($this->upload->data('full_path'));
                $_SESSION['import_property_data'] = $this->csv_flat_table_import($file_data);

                // send to view
                $this->data_to_view['import_property_data'] = $_SESSION['import_property_data'];

                $this->data_to_header['crumbs'] =
                    [
                        "Home" => "/admin",
                        "Event" => "/admin/property",
                        "Import" => "/admin/property/import",
                        "Confirm" => "",
                    ];


                $this->load->view($this->header_url, $this->data_to_header);
                $this->load->view("/admin/property/import", $this->data_to_view);
                $this->load->view($this->footer_url, $this->data_to_footer);
            } else {
                die("Upload failure");
            }
        }
    }


    function run_import()
    {
        // debug not to write to DB
        $debug = 1;

        $property_data = [];

        // EVENTS
        foreach ($_SESSION['import_property_data'] as $property_action => $property_list) {

            foreach ($property_list as $property_id => $property) {
                $property_id = $this->property_model->set_property($property_action, $property_id, $property, $debug);
            }
        }

        // go to view
        $this->session->set_flashdata([
            'alert' => "Upload Successfull",
            'status' => "success",
        ]);

        $this->data_to_header['crumbs'] =
            [
                "Home" => "/admin",
                "Event" => "/admin/property",
                "Import" => "/admin/property/import",
                "Success" => "",
            ];

        $this->load->view($this->header_url, $this->data_to_header);
        $this->load->view("/admin/property/import_success", $this->data_to_view);
        $this->load->view($this->footer_url, $this->data_to_footer);

        // wts($_SESSION['import_event_data']);
        // die("i run");
    }


    public function export()
    {

        $this->load->dbutil();
        $this->load->helper('download');

        $filename = "harmonieprop_export_" . date("Ymd") . ".csv";


        $field_arr = $this->property_model->map_table_columns("properties");
        unset($field_arr['created_date']);
        unset($field_arr['updated_date']);

        /* get the object   */
        $export = $this->property_model->get_property_list_data(
            [
                "field_arr" => $field_arr,
            ]
        );
        /*  pass it to db utility function  */
        $new_report = $this->dbutil->csv_from_result($export);
        mb_convert_encoding($new_report, 'UTF-16LE', 'UTF-8');
        /*  Force download the file */
        force_download($filename, "\xEF\xBB\xBF" . $new_report);
        /*  Done    */
    }
}
