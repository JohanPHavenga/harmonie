<?php
class Property_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function record_count() {
        return $this->db->count_all("properties");
    }
    
    public function get_sleeps_dropdown() 
    {        
        $data[] = "Any";
        $data[2] = "2";
        $data[4] = "4";
        $data[6] = "6";
        $data[8] = "8";
        $data[10] = "10";
        $data[12] = "12+";
        return $data;        
    }
    
    public function get_beds_dropdown() 
    {        
        $data[] = "Any";
        $data[1] = "1";
        $data[2] = "2";
        $data[3] = "3";
        $data[4] = "4";
        $data[5] = "5+";
        return $data;        
    }
    
    public function get_property_list($params=[])
    {           
        // ALL properties
        if (isset($params['all_prop'])) {
            $this->db->order_by('properties.updated_date');
        }
        // ALL properties incl unpublished
        if (!isset($params['include_unpublished'])) {
            $this->db->where('property_ispublished', 1);
        }        
        // FEATURED properties
        if (isset($params['is_featured'])) {
            $this->db->limit(6);
            $this->db->where('property_isfeatured', 1);
            $this->db->order_by('property_code');
        } 
        // LATEST properties
        if (isset($params['latest'])) {
            $this->db->limit($params['latest']);   
            $this->db->order_by('properties.created_date');
        }        
        
        // search
        if (isset($params['search'])) {
            $this->db->where('property_code', $params['search']);
            $this->db->or_like('property_summary', $params['search']);
            $this->db->or_like('property_overview', $params['search']);
            $this->db->order_by('property_code');
        } 
        
        // actual select
        $this->db->select("*");
        $this->db->from("properties");
            $this->db->join('locations', 'properties.location_id=locations.location_id', 'left');
            $this->db->join('types', 'types.type_id=types.type_id', 'left');                   
        
        $query = $this->db->get();
        

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[$row['property_id']] = $row;
            }
            return $data;
        }
        return false;
    }
    
    // Property grid filter
    public function get_property_filter($post) {
        
        // Location filter
        if (isset($post['location_id'])) {
            if ($post['location_id']>0) {
                $this->db->where('properties.location_id', $post['location_id']);
            }
        }        
        // Type filter
        if (isset($post['type_id'])) {
            if ($post['type_id']>0) {
                $this->db->where('properties.type_id', $post['type_id']);
            }
        }
        // Bedrooms filter
        if (isset($post['property_bedrooms'])) {
            if (($post['property_bedrooms']>0)&&($post['property_bedrooms']<=4)) {
                $this->db->where('property_bedrooms', $post['property_bedrooms']);
            }
            if ($post['property_bedrooms']==5) {                
                $this->db->where('property_bedrooms >=', $post['property_bedrooms']);
            }
        }
        // Sleeps filter
        if (isset($post['property_sleeps'])) {
            if (($post['property_sleeps']>0)&&($post['property_sleeps']<=10)) {
                $this->db->where('property_sleeps', $post['property_sleeps']);
            }
            if ($post['property_sleeps']==12) {                
                $this->db->where('property_sleeps >=', $post['property_sleeps']);
            }
        }
        
        // Sort by filter
        $this->db->order_by($post['sort'], $post['order']);
        
        // Rate Filter
        if (isset($post['inputPriceFrom'])) {
            $this->db->where('property_rate_low >=', $post['inputPriceFrom']);
            $this->db->where('property_rate_low <=', $post['inputPriceTo']);
        }
            
                
        // actual select
        $this->db->select("*");
        $this->db->from("properties");
            $this->db->join('locations', 'properties.location_id=locations.location_id', 'left');
            $this->db->join('types', 'types.type_id=types.type_id', 'left');                   
        
        $query = $this->db->get();
        

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[$row['property_id']] = $row;
            }
            return $data;
        }
        return false;
    }
    
    
    public function get_property_detail($id)
    {
        if( ! ($id))
        {
            return false;
        }
        else
        {
            $this->db->select("properties.*");
            $this->db->from("properties");
            $this->db->where('property_id', $id);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            return false;
        }
    }
    
    public function get_property_detail_from_code($prop_code)
    {
        if( ! ($prop_code))
        {
            return false;
        }
        else
        {
            $this->db->select("*");
            $this->db->from("properties");
                $this->db->join('locations', 'properties.location_id=locations.location_id', 'left');
                $this->db->join('types', 'types.type_id=types.type_id', 'left');
            $this->db->where('property_code', $prop_code);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            return false;
        }
    }

    public function set_property($action, $id, $property_data=[], $debug=0)
    {
        // POSTED DATA
        if (empty($property_data))
        {
            $is_published=FALSE;
            $is_featured=FALSE;
            
            if ($this->input->post('property_ispublished')) { $is_published=TRUE; }
            if ($this->input->post('property_isfeatured')) { $is_featured=TRUE; }
            $property_data = array(
                      'property_code' => $this->input->post('property_code'),
                      'property_address' => $this->input->post('property_address'),
                      'property_sleeps' => $this->input->post('property_sleeps'),
                      'property_bathrooms' => $this->input->post('property_bathrooms'),
                      'property_bedrooms' => $this->input->post('property_bedrooms'),
                      'property_summary' => $this->input->post('property_summary'),
                      'property_overview' => $this->input->post('property_overview'),
                      'property_rate_low' => $this->input->post('property_rate_low'),
                      'property_rate_med' => $this->input->post('property_rate_med'),
                      'property_rate_high' => $this->input->post('property_rate_high'),
                      'property_gps' => $this->input->post('property_gps'),
                      'property_ispublished' => $is_published,
                      'property_isfeatured' => $is_featured,
                      'property_img' => $this->input->post('property_img'),
                      'location_id' => $this->input->post('location_id'),              
                      'type_id' => $this->input->post('type_id'),
                  );
        } 

        switch ($action) {
            case "add":
                $this->db->trans_start();
                $this->db->insert('properties', $property_data);                
                $this->db->trans_complete();
                return $this->db->trans_status();

            case "edit":
                // add updated date to both data arrays
                $property_data['updated_date']=date("Y-m-d H:i:s");
               
                // start SQL transaction
                $this->db->trans_start();
                $this->db->update('properties', $property_data, array('property_id' => $id));

                $this->db->trans_complete();
                return $this->db->trans_status();

            default:
                show_404();
                break;
        }

    }


    public function remove_property($id) 
    {
        if( ! ($id))
        {
            return false;
        }
        else
        {
            $this->db->trans_start();
            $this->db->delete('properties', array('property_id' => $id));
            $this->db->trans_complete();
            return $this->db->trans_status();
        }
    }
    
    
    public function get_property_list_data($params) {
            
            // field_arr is compulsary
            $field_arr=$params['field_arr'];

            $this->db->select($field_arr);
            $this->db->from("properties");
//            $this->db->join('editions', 'editions.event_id = events.event_id');
//            $this->db->join('races', 'races.edition_id = editions.edition_id');
//            $this->db->join('towns', 'towns.town_id = events.town_id');
            
            
//            $this->db->where("events.event_status", 1);
//            $this->db->where("editions.edition_status", 1);
//            $this->db->where("races.race_status", 1);

//            $this->db->order_by("edition_date", $sort);
//            $this->db->order_by("race_distance", "DESC");

            return $this->db->get();
        }
                
        
}