<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Property extends Frontend_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('property_model');
    }
    
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
        $this->load->model('location_model');
        $this->load->model('type_model');
    
        $this->data_to_header['title']="Properties Listing | ".ucfirst($property_type);
        $this->data_to_header['active_menu']="property";        
        
        // pre-filter
        switch ($property_type) {
            case "houses":
                $filter['type_id']=1;
                break;
            case "apartments":
                $filter['type_id']=2;
                break;
            default:
                $filter['type_id']=0;             
                break;
        }
        
        if ($this->input->post()) {
            $filter=$this->input->post(NULL, TRUE);
        } else {
            $filter['sort']="property_sleeps";
            $filter['order']="DESC";
        }
        $this->data_to_view["filter"]=$filter;
        $this->data_to_view["prop_list"] = $this->property_model->get_property_filter($filter); 
       
        // get Dropdowns
        $this->data_to_view["location_dropdown"] = $this->location_model->get_location_dropdown();
        $this->data_to_view["type_dropdown"] = $this->type_model->get_type_dropdown();
        $this->data_to_view["beds_dropdown"] = $this->property_model->get_beds_dropdown(); 
        $this->data_to_view["sleeps_dropdown"] = $this->property_model->get_sleeps_dropdown(); 
        
        $this->data_to_view["sort_dropdown"]["property_rate_low"]="Rate";                
        $this->data_to_view["sort_dropdown"]["property_bedrooms"]="Beds";
        $this->data_to_view["sort_dropdown"]["property_sleeps"]="Sleeps";
        
        $this->data_to_view["order_dropdown"]["ASC"]="ASC";                
        $this->data_to_view["order_dropdown"]["DESC"]="DESC";
            

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
        
        $this->data_to_view["prop_list"] = $this->property_model->get_property_list(["search"=>$this->input->post('ss')]);         

        $this->load->view($this->header_url, $this->data_to_header);
        $this->load->view('search', $this->data_to_view);
        $this->load->view($this->footer_url, $this->data_to_footer);
    }
    
    public function detail($prop_code)
    {            
        $this->load->helper('file');        
        
        $this->data_to_header['title']="Detail";
        $this->data_to_header['active_menu']="property";        
        
        $lp_data['latest_properties']=$this->property_model->get_property_list(["latest"=>2]);            
        $this->data_to_view['latest_prop'] = $this->load->view('templates/latest_prop', $lp_data, TRUE);
        $cf_params=[];
        $this->data_to_view['contact_form'] = $this->load->view('templates/contact_form', $cf_params, TRUE);
        
        // send property code to the view
        $this->data_to_view['prop_code']=$prop_code;
        // get all the detail from the property using the code
        $this->data_to_view["property_data"] = $this->property_model->get_property_detail_from_code($prop_code);
        // get photos
        $photos_arr = get_filenames("photos/".$prop_code);
        // remove main image
        if ($photos_arr) {
            $key = array_search($this->data_to_view["property_data"]['property_img'], $photos_arr);
            unset($photos_arr[$key]);
        }
        $this->data_to_view["photos"]=$photos_arr;
        
        
        
        // scripts to load
        $this->data_to_footer['scripts_to_load']=array(
            "https://maps.googleapis.com/maps/api/js?key=AIzaSyBeY1SbJOL5kjjqRr9Kwf4RZ3Zyf44S1Dg",
            "assets/plugins/gmaps/gmaps.js",
            );
        
        
        // get lat and long
        $gps_arr= explode(",", $this->data_to_view['property_data']['property_gps']);
        if (count($gps_arr)>1) {
            $lat=$gps_arr[0];
            $long=$gps_arr[1];
        
        // script to add gmaps to the page
        $this->data_to_footer['scripts_to_display'][]="            
            var PageContact = function() {
            
                var _init = function() {
                    var mapbg = new GMaps({
                            div: '#property-map',
                            lat: $lat,
                            lng: $long,
                            zoom: 15,
                            scrollwheel: false
                            });

                    mapbg.addMarker({
                            lat: $lat,
                            lng: $long,
                            title: '". html_escape($this->data_to_view['property_data']['property_address'])."',
                            infoWindow: {
                                    content: '<h3>".$this->data_to_view['property_data']['property_code']."</h3>".($this->data_to_view['property_data']['property_address'])."'
                            }
                           
                    });
                }

                return {
                    init: function() {
                        _init();
                    }

                };
            }();

            $(document).ready(function() {
                PageContact.init();
            });";        
        }
        
        $this->load->view($this->header_url, $this->data_to_header);
        $this->load->view('detail', $this->data_to_view);
        $this->load->view($this->footer_url, $this->data_to_footer);
    }
}
