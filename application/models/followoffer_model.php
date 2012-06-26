<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Followoffer_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    

    function get_offerid_bymemberid($member_id)
    {
        //echo 'this is get_entry_bytoken';
        $this->db->select('*');
        $this->db->from('follow_offer');
        $this->db->where('member_id',$member_id);
        
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

    function insert_entry($follow_offer_data)
    { 

        //$this->db->insert('follow_offer', $follow_offer_data);
        //return mysql_insert_id();
        $insert_query = $this->db->insert_string('follow_offer',$follow_offer_data);
        $insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
        $this->db->query($insert_query);
        return 1;
    }

    function delete_entry($member_id,$offer_id)
    {
        $this->db->where('member_id',$member_id);
        $this->db->where('offer_id',$offer_id);
        $this->db->delete('follow_offer'); 
        return 1;
    }

}

/* End of user_model.php */
/* Location: ./system/application/controllers/user_model.php */
