<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fellow_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get_entry_byemailandpassword($email,$password)
    {
        $this->db->select('*');
        $this->db->from('fellow');
        $this->db->where('email',$email);
        $this->db->where('password',$password);

        $query = $this->db->get();
        return $query->row_array();
    }

    function get_entry_byemail($email)
    {
        $this->db->select('*');
        $this->db->from('fellow');
        $this->db->where('email',$email);

        $query = $this->db->get();

        return $query->row_array();
    }

    function get_entry_byfellow_url_token($fellow_url_token)
    {
        $this->db->select('*');
        $this->db->from('fellow');
        $this->db->where('fellow_url_token',$fellow_url_token);

        $query = $this->db->get();
        return $query->row_array();
    }

    function update_entry($fellow_url_token, $data)
    {
        $this->db->where('fellow_url_token', $fellow_url_token);
        $this->db->update('fellow',$data);
        return 1;
    }

    function insert_entry($fellow)
    { 
        $this->db->insert('fellow', $fellow);
        return mysql_insert_id();
    }

    function get_entrys_byfellow_ids($fellow_ids)
    {
        $this->db->select('fellow.fellow_url_token,fellow.first_name,fellow.last_name');
        $this->db->from('fellow');
        $this->db->where_in('id',$fellow_ids); 

        $query = $this->db->get();

        return $query->result_array();
    }
}

/* End of fellow_model.php */
/* Location: ./system/application/model/fellow_model.php */
