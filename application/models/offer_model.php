<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offer_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_entry_bytoken($token)
	{
	    //echo 'this is get_entry_bytoken';
	    $this->db->select('*');
        $this->db->from('offer');
        $this->db->where('url_token',$token);
        
        $query = $this->db->get();
	
        return $query->row_array();
	}

    function get_data_bytoken($member_id,$time_stamp,$number,$orderby)
    {
        $this->db->select('*');
        $this->db->from('offer');
        if($member_id!=null)
            $this->db->where('member_id',$member_id);

        $this->db->where('created <',$time_stamp); // notice there must be a space between 'created' and '<'
        $this->db->order_by($orderby,'desc');
        $this->db->limit($number);

        $query = $this->db->get();

        if($query->num_rows()>0)
        {
            $result=$query->result_array();
            return $result;
        }
        else
        {
            return null;
        }
    }

	function insert_entry($offer_data)
    { 
        $this->db->insert('offer', $offer_data);
       // return $offer_data;
        return mysql_insert_id();
    }

    function update_entry($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('offer', $data);
        return 1;
    }

    function delete_entry_byuid($id)
    {
        $this->db->delete('offer', array('id' => $id)); 
        return 1;
    }
}
