<?php
class Property_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function record_count() {
        return $this->db->count_all("properties");
    }
    
    public function get_property_list($params=[])
    {   
        if (@$params['isfeatured']) {
            $this->db->limit(6);
        } 
        
        $this->db->select("*");
        $this->db->from("properties");
            $this->db->join('locations', 'properties.location_id=locations.location_id', 'left');
            $this->db->join('types', 'types.type_id=types.type_id', 'left');
            
        if (@$params['isfeatured']) { 
            $this->db->where('property_isfeatured', 1);
        }
        
        $this->db->order_by('property_code');
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

    public function set_property($action, $id, $property_data=[])
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


    public function remove_type($id) 
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