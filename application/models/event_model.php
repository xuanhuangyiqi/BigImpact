<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function get_entry_bytoken($token){
		$this->db->select('*');
		$this->db->from('event');
		$this->db->where('url_token',$token);

		$query = $this->db->get();

		return $query->row_array();
	}

    function get_data_byids($event_ids){
        $this->db->select('*');
        $this->db->from('event');
        $this->db->where_in('id',$event_ids);
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

    function get_data_bytoken($member_id,$time_stamp,$number,$orderby){
    	$this->db->select('*');
        $this->db->from('event');
        if($member_id != null){
            $this->db->where('member_id',$member_id);
        }
        $this->db->where('created <=',$time_stamp);
        $this->db->order_by($orderby,'desc');
        $this->db->limit($number);

        $query = $this->db->get();

        if($query->num_rows()>0){
            $result = $query->result_array();
            return $result;
        }
        else{
            return null;
        }

    }

    function insert_entry($event_data){
        $this->db->insert('event',$event_data);
        return mysql_insert_id();
    }

    function update_entry($id,$data){
        return 1;
    }

    function delete_entry_byuid($id){
        return 1;
    }



}
