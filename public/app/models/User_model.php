<?php
class User_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }


    private function hash_pass($password)
    {
        if ($password) {
            return sha1($password."37");
        } else {
            return NULL;
        }
    }

    public function record_count() 
    {
        return $this->db->count_all("users");
    }


    public function get_user_list()
    {   
        $this->db->select("*");
        $this->db->from("users");
        $this->db->order_by('user_name', 'user_surname');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[$row['user_id']] = $row;
            }
            return $data;
        }
        return false;
    }


    public function get_user_dropdown() 
    {
        $this->db->select("user_id, user_name, user_surname");
        $this->db->from("users");
        $this->db->order_by('user_name', 'user_surname');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $data[] = "Please Select";
            foreach ($query->result_array() as $row) {
                $data[$row['user_id']] = $row['user_name']." ".$row['user_surname'];
            }
            return $data;
        }
        return false;
    }


    public function set_user($action, $id, $user_data=[])
    {
        // POSTED DATA
        if (empty($user_data))
        {
          $user_data = array(
                      'user_name' => $this->input->post('user_name'),
                      'user_surname' => $this->input->post('user_surname'),
                      'user_email' => $this->input->post('user_email'),
                      'user_password' => $this->hash_pass($this->input->post('user_password')),
                  );
       } else {
           if (isset($user_data['user_password'])) { $user_data['user_password']=$this->hash_pass($user_data['user_password']); }
       }

        switch ($action) {
            case "add":
                $this->db->trans_start();
                $this->db->insert('users', $user_data);                
                $this->db->trans_complete();
                return $this->db->trans_status();

            case "edit":
                // add updated date to both data arrays
                $user_data['updated_date']=date("Y-m-d H:i:s");
                //check of password wat gepost is alreeds gehash is
                if (@$this->check_password($this->input->post('user_password'),$id))
                {
                    unset($user_data['user_password']);
                }

                // start SQL transaction
                $this->db->trans_start();
                $this->db->update('users', $user_data, array('user_id' => $id));

                $this->db->trans_complete();
                return $this->db->trans_status();

            default:
                show_404();
                break;
        }

    }


    public function remove_user($id) 
    {
        if( ! ($id))
        {
            return false;
        }
        else
        {
            $this->db->trans_start();
            $this->db->delete('users', array('user_id' => $id));
            $this->db->trans_complete();
            return $this->db->trans_status();
        }
    }


    public function check_login()
    {
        $user_data = array(
                    'user_username' => $this->input->post('user_username'),
                    'user_password' => $this->hash_pass($this->input->post('user_password')),
                );

        $this->db->select("user_id, user_name, user_surname");
        $this->db->from("users");
        $this->db->where($user_data);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;

    }

    private function check_password($password, $id)
    {
        $this->db->where('user_password', $password);
        $this->db->where('user_id', $id);
        $this->db->from('users');
        return $this->db->count_all_results();
    }

    public function export()
    {
        $this->db->select("user_id, user_name, user_surname, user_email");
        $this->db->from("users");
        return $query = $this->db->get();
    }

}
