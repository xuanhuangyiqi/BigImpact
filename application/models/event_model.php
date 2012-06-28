<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	// function get_entry_bytoken($token){
	// 	$this->db->select('*');
	// 	$this->db->from('event');
	// 	$this->db->where('url_token',$token);

	// 	$query = $this->db->get();

	// 	return $query->row_array();
	// }
    function get_entrys_byevent_ids($event_ids)
    {
        $this->db->select('event.*,fellow.fellow_url_token,fellow.first_name,fellow.last_name');
        $this->db->from('event');
        $this->db->join('fellow','event.fellow_id = fellow.id');
        $this->db->where_in('event.id',$event_ids); 

        $query = $this->db->get();

        return $query->result_array();
    }


    function get_entry_byevent_url_token($event_ids){
        $this->db->select('event.*,fellow.fellow_url_token,fellow.first_name,fellow.last_name');
        $this->db->from('event');
        $this->db->join('fellow','event.fellow_id = fellow.id');
        $this->db->where('event_url_token',$event_url_token);

        $query = $this->db->get();

        return $query->row_array();
    }


    function get_entrys_bynothing($number,$time_stamp,$orderby)
    {
        $this->db->select('event.*,fellow.fellow_url_token,fellow.first_name,fellow.last_name');
        $this->db->from('event');
        $this->db->join('fellow','event.fellow_id = fellow.id');
        $this->db->where('event.created <=',$time_stamp); 
        $this->db->order_by($orderby,'desc');
        $this->db->limit($number);

        $query = $this->db->get();

        return $query->result_array();
    }

    function get_entrys_byfellow_url_token($fellow_url_token,$number,$time_stamp,$orderby)
    {
        $this->db->select('event.*,fellow.fellow_url_token,fellow.first_name,fellow.last_name');
        $this->db->from('event');
        $this->db->join('fellow','event.fellow_id = fellow.id');
        $this->db->where('event.created <=',$time_stamp); 
        $this->db->where('fellow.fellow_url_token',$fellow_url_token); 
        $this->db->order_by($orderby,'desc');
        $this->db->limit($number);

        $query = $this->db->get();

        return $query->result_array();
    }

    // function get_data_bytoken($member_id,$time_stamp,$number,$orderby){
    // 	$this->db->select('*');
    //     $this->db->from('event');
    //     if($member_id != null){
    //         $this->db->where('member_id',$member_id);
    //     }
    //     $this->db->where('created <=',$time_stamp);
    //     $this->db->order_by($orderby,'desc');
    //     $this->db->limit($number);

    //     $query = $this->db->get();

    //     if($query->num_rows()>0){
    //         $result = $query->result_array();
    //         return $result;
    //     }
    //     else{
    //         return null;
    //     }

    // }

    function insert_entry($event_data){
        $this->db->insert('event',$event_data);
        return mysql_insert_id();
    }

    function delete_entry_byevent_url_token($event_url_token)
    {
        $this->db->delete('event', array('event_url_token' => $event_url_token)); 
        return 1;
    }



}
