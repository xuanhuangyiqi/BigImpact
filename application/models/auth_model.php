<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {

    var $uid = '';
    var $name = '';
  

    function __construct()
    {
        parent::__construct();
    }
    
    function get_entry_byid($id)
    {
        $this->db->select('*');
        $this->db->from('auth');
        $this->db->where('id',$id);

        $query = $this->db->get();

        return $query->row_array();

        //$sql = "SELECT * FROM user WHERE uid = ?";
        //$query = $this->db->query($sql, array($uid));
        //return $query->row_array();
    }

    function get_entry_bymail($mail)
    {
        $this->db->select('*');
        $this->db->from('auth');
        $this->db->where('email',$mail);

        $query = $this->db->get();

        return $query->row_array();

        //$sql = "SELECT * FROM user WHERE uid = ?";
        //$query = $this->db->query($sql, array($uid));
        //return $query->row_array();
    }
     
     
    function insert_entry($auth_data)
    { 
        $this->db->insert('auth', $auth_data);
        return mysql_insert_id();
    }

    function delete_entry_byuid($id)
    {
        $this->db->delete('auth', array('id' => $id)); 
        return 1;
    }
    
}

/* End of user_model.php */
/* Location: ./system/application/controllers/user_model.php */