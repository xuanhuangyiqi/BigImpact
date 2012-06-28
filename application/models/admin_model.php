<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get_entry_byemailandpassword($email,$password)
    {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('email',$email);
        $this->db->where('password',$password);

        $query = $this->db->get();

        return $query->row_array();
    }
    
    function get_entry_byemail($email)
    {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('email',$email);

        $query = $this->db->get();

        return $query->row_array();
    }

    function insert_entry($admin)
    { 
        $this->db->insert('admin', $admin);
        return mysql_insert_id();
    }
}

/* End of admin_model.php */
/* Location: ./system/application/model/admin_model.php */