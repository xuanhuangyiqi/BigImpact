<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends CI_Model {

    var $uid = '';
    var $name = '';
  

    function __construct()
    {
        parent::__construct();
    }
    
    function get_entry_byid($id)
    {
        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('id',$id);

        $query = $this->db->get();
        return $query->row_array();

        //$sql = "SELECT * FROM user WHERE uid = ?";
        //$query = $this->db->query($sql, array($uid));
        //return $query->row_array();
    }

    function get_entry_bytoken($token)
    {
        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('url_token',$token);

        $query = $this->db->get();
        return $query->row_array();
    }

    function get_entry_bymail($mail)
    {
        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('email',$mail);

        $query = $this->db->get();

        return $query->row_array();

        //$sql = "SELECT * FROM user WHERE uid = ?";
        //$query = $this->db->query($sql, array($uid));
        //return $query->row_array();
    }

    function insert_entry($member_data)
    { 
        $this->db->insert('member', $member_data);
        return mysql_insert_id();
    }

    function update_entry($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('member', $data);
        return 1;
    }

    function delete_entry_byuid($id)
    {
        $this->db->delete('member', array('id' => $id)); 
        return 1;
    }
    
}

/* End of user_model.php */
/* Location: ./system/application/controllers/user_model.php */
