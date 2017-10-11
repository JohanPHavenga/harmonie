<?php
class Location_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function record_count() 
    {
        return $this->db->count_all("locations");
    }


    public function get_location_list()
    {   
        $this->db->select("*");
        $this->db->from("locations");
        $this->db->order_by('location_name');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[$row['location_id']] = $row;
            }
            return $data;
        }
        return false;
    }


    public function get_location_dropdown() 
    {
        $this->db->select("location_id, location_name");
        $this->db->from("locations");
        $this->db->order_by('location_name');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $data[] = "Please Select";
            foreach ($query->result_array() as $row) {
                $data[$row['location_id']] = $row['location_name'];
            }
            return $data;
        }
        return false;
    }

    
    public function get_location_detail($id)
    {
        if( ! ($id))
        {
            return false;
        }
        else
        {
            $this->db->select("locations.*");
            $this->db->from("locations");
            $this->db->where('location_id', $id);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            return false;
        }

    }

    public function set_location($action, $id, $location_data=[])
    {
        // POSTED DATA
        if (empty($location_data))
        {
          $location_data = array(
                      'location_name' => $this->input->post('location_name'),
                  );
        } 

        switch ($action) {
            case "add":
                $this->db->trans_start();
                $this->db->insert('locations', $location_data);                
                $this->db->trans_complete();
                return $this->db->trans_status();

            case "edit":
                // add updated date to both data arrays
                $location_data['updated_date']=date("Y-m-d H:i:s");
               
                // start SQL transaction
                $this->db->trans_start();
                $this->db->update('locations', $location_data, array('location_id' => $id));

                $this->db->trans_complete();
                return $this->db->trans_status();

            default:
                show_404();
                break;
        }

    }


    public function remove_location($id) 
    {
        if( ! ($id))
        {
            return false;
        }
        else
        {
            $this->db->trans_start();
            $this->db->delete('locations', array('location_id' => $id));
            $this->db->trans_complete();
            return $this->db->trans_status();
        }
    }

}
