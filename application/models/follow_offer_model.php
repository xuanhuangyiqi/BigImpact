<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Follow_offer_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    

    function get_offerid_byfellow_id($fellow_id)
    {
        $this->db->select('*');
        $this->db->from('follow_offer');
        $this->db->where('fellow_id',$fellow_id);
        $query = $this->db->get();
        
        return $query->result_array();
    }

    function get_fellowid_by_offer_id($offer_id)
    {
        $this->db->select('*');
        $this->db->from('follow_offer');
        $this->db->where_in('offer_id', $offer_id);
        $query = $this->db->get();
        
        return $query->result_array();
    }

    function insert_entry($follow_offer_data)
    { 
        $insert_query = $this->db->insert_string('follow_offer',$follow_offer_data);
        $insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
        $this->db->query($insert_query);
        return 1;
    }

    function delete_entry($fellow_id,$offer_id)
    {
        $this->db->where('fellow_id',$fellow_id);
        $this->db->where('offer_id',$offer_id);
        $this->db->delete('follow_offer'); 
        return 1;
    }

}

/* End of follow_offer_model.php */
/* Location: ./system/application/controllers/follow_offer_model.php */
