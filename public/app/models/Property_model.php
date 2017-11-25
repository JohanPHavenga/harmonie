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

    public function set_property($action, $id, $property_data=[])
    {
        // POSTED DATA
        if (empty($property_data))
        {
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
                      'property_ispublished' => $this->input->post('property_ispublished'),
                      'property_isfeatured' => $this->input->post('property_isfeatured'),
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
        
                
        
}