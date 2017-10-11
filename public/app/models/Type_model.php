<?php
class Type_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function record_count() 
    {
        return $this->db->count_all("types");
    }


    public function get_type_list()
    {   
        $this->db->select("*");
        $this->db->from("types");
        $this->db->order_by('type_name');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[$row['type_id']] = $row;
            }
            return $data;
        }
        return false;
    }


    public function get_type_dropdown() 
    {
        $this->db->select("type_id, type_name");
        $this->db->from("types");
        $this->db->order_by('type_name');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $data[] = "Please Select";
            foreach ($query->result_array() as $row) {
                $data[$row['type_id']] = $row['type_name'];
            }
            return $data;
        }
        return false;
    }

    
    public function get_type_detail($id)
    {
        if( ! ($id))
        {
            return false;
        }
        else
        {
            $this->db->select("types.*");
            $this->db->from("types");
            $this->db->where('type_id', $id);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            return false;
        }

    }

    public function set_type($action, $id, $type_data=[])
    {
        // POSTED DATA
        if (empty($type_data))
        {
          $type_data = array(
                      'type_name' => $this->input->post('type_name'),
                  );
        } 

        switch ($action) {
            case "add":
                $this->db->trans_start();
                $this->db->insert('types', $type_data);                
                $this->db->trans_complete();
                return $this->db->trans_status();

            case "edit":
                // add updated date to both data arrays
                $type_data['updated_date']=date("Y-m-d H:i:s");
               
                // start SQL transaction
                $this->db->trans_start();
                $this->db->update('types', $type_data, array('type_id' => $id));

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
            $this->db->delete('types', array('type_id' => $id));
            $this->db->trans_complete();
            return $this->db->trans_status();
        }
    }

}
