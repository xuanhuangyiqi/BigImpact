<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends CI_Model {

    var $email = '';
    var $passwd = '';
    var $url_token = '';
    var $first_name = '';
    var $last_name = '';


    function __construct()
    {
        parent::__construct();
    }
    
    function get_entry_byemailandpassword($email,$password)
    {
        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('email',$email);
        $this->db->where('passwd',$password);

        $query = $this->db->get();

        return $query->row_array();
    }

    function get_entry_byemail($email)
    {
        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('email',$email);

        $query = $this->db->get();

        return $query->row_array();
    }
     
    function get_entry_byid($id)
    {
        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('id',$id);

        $query = $this->db->get();
        return $query->row_array();
    }
    
    function get_entry_bytoken($token)
    {
        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('url_token',$token);

        $query = $this->db->get();
        return $query->row_array();
    }

    function insert_entry($member)
    { 
        $this->db->insert('member', $member);
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
    function ids2tokens($ids)
    {
        $this->db->select('id, url_token');
        $this->db->from('member');
        $this->db->where_in('id', $ids);
        $query = $this->db->get();
        $query = $query->result_array();
        $res = array();
        foreach ($query as &$x)
            $res[$x['id']] = $x['url_token'];
        return $res;
    }
}

/* End of user_model.php */
/* Location: ./system/application/controllers/user_model.php */