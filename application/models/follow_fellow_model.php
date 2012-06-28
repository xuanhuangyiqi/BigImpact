<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Follow_fellow_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    

    function get_be_fellowid_byfellow_id($fellow_id)
    {
        $this->db->select('*');
        $this->db->from('follow_fellow');
        $this->db->where('fellow_id',$fellow_id);
        $query = $this->db->get();
        
        return $query->result_array();

    }

    function insert_entry($follow_be_fellow_data)
    { 
        $insert_query = $this->db->insert_string('follow_fellow',$follow_be_fellow_data);
        $insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
        $this->db->query($insert_query);
        return 1;
    }

    function delete_entry($fellow_id,$be_fellow_id)
    {
        $this->db->where('fellow_id',$fellow_id);
        $this->db->where('be_fellow_id',$be_fellow_id);
        $this->db->delete('follow_fellow'); 
        return 1;
    }

}

/* End of follow_be_fellow_model.php */
/* Location: ./system/application/controllers/follow_be_fellow_model.php */
