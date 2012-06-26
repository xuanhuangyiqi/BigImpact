<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reset_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function reset()
    {
    
        $this->db->empty_table('admin'); 
        $this->db->empty_table('auth');
        $this->db->empty_table('event');
        $this->db->empty_table('follow_event');  
        $this->db->empty_table('follow_member');  
        $this->db->empty_table('follow_need');  
        $this->db->empty_table('follow_offer');    
        $this->db->empty_table('job'); 
        $this->db->empty_table('language');
        $this->db->empty_table('location'); 
        $this->db->empty_table('member');
        $this->db->empty_table('need');
        $this->db->empty_table('offer');     
        $this->db->empty_table('register_queue');  
       
        
        $data = array(
               'email' => '123456@omar.com' ,
               'passwd' => '123456',
               'created' => '0000000001',
               'first_name' => 'omarhub',
               'last_name' => 'admin'
            );
        $this->db->insert('admin', $data);
        
        $data = array(
                'created' => '0000000001',
                'email' => '123456@omar.com' ,
                'passwd' => '123456',
                'first_name' => 'omarhub',
                'last_name' => 'fellow',
                'mail_option' => '1',
                'mail' => 'No 18 Buaa',
                'mobile_country_code' => '010',
                'mobile' => 'China Unicom',
                'country' => 'China',
                'zip' => '100191',
                'state' => 'haidian',
                'city' => 'Beijing',
                'street' => 'Xueyuan Road',
                'target' => 'Education',
                'location' => 'Buaa',
                'job' => 'IT',
                'language' => 'Chinese',
                'gender' => '1',
                'url_token'  =>  '000001',
                'avatar_path' => 'http://img.baidu.com/img/iknow/avarta/48/r6s1g6.gif'
            );
        $this->db->insert('member', $data);
        
        return 0;
        

    }
}

/* End of user_model.php */
/* Location: ./system/application/controllers/user_model.php */