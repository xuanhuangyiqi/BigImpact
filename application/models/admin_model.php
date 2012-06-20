<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

    var $uid = '';
    var $name = '';
  

    function __construct()
    {
        parent::__construct();
    }
    
    function get_entry_byid($id)
    {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('id',$id);

        $query = $this->db->get();
        return $query->row_array();

        //$sql = "SELECT * FROM user WHERE uid = ?";
        //$query = $this->db->query($sql, array($uid));
        //return $query->row_array();
    }


    function insert_entry($member_data)
    { 
        $this->db->insert('admin', $member_data);
        return mysql_insert_id();
    }

}

/* End of user_model.php */
/* Location: ./system/application/controllers/user_model.php */
