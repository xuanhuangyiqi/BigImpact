<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offer_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

    function get_entrys_byoffer_ids($offer_ids)
    {
        $this->db->select('offer.*,fellow.fellow_url_token,fellow.first_name,fellow.last_name');
        $this->db->from('offer');
        $this->db->join('fellow','offer.fellow_id = fellow.id');
        $this->db->where_in('offer.id',$offer_ids); 

        $query = $this->db->get();

        return $query->result_array();
    }

	function get_entry_byoffer_url_token($offer_url_token)
	{
	    $this->db->select('offer.*,fellow.fellow_url_token,fellow.first_name,fellow.last_name');
        $this->db->from('offer');
        $this->db->join('fellow','offer.fellow_id = fellow.id');
        $this->db->where('offer_url_token',$offer_url_token);
        
        $query = $this->db->get();
	
        return $query->row_array();
	}

    function get_entrys_bynothing($number,$time_stamp,$orderby)
    {
        $this->db->select('offer.*,fellow.fellow_url_token,fellow.first_name,fellow.last_name');
        $this->db->from('offer');
        $this->db->join('fellow','offer.fellow_id = fellow.id');
        $this->db->where('offer.created <=',$time_stamp); 
        $this->db->order_by($orderby,'desc');
        $this->db->limit($number);

        $query = $this->db->get();

        return $query->result_array();
    }

    function get_entrys_byfellow_url_token($fellow_url_token,$number,$time_stamp,$orderby)
    {
        $this->db->select('offer.*,fellow.fellow_url_token,fellow.first_name,fellow.last_name');
        $this->db->from('offer');
        $this->db->join('fellow','offer.fellow_id = fellow.id');
        $this->db->where('offer.created <=',$time_stamp); 
        $this->db->where('fellow.fellow_url_token',$fellow_url_token); 
        $this->db->order_by($orderby,'desc');
        $this->db->limit($number);

        $query = $this->db->get();

        return $query->result_array();
    }

    function insert_entry($data)
    { 
        $this->db->insert('offer', $data);
        return mysql_insert_id();
    }


    function delete_entry_byoffer_url_token($offer_url_token)
    {
        $this->db->delete('offer', array('offer_url_token' => $offer_url_token)); 
        return 1;
    }
}

/* End of offer_model.php */
/* Location: ./system/application/model/offer_model.php */
