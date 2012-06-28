<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reset_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function reset()
    {
    
        $this->db->empty_table('admin'); 
        $this->db->empty_table('fellow');
        $this->db->empty_table('follow_fellow');    
        $this->db->empty_table('offer');     

        $query = $this->db->query('truncate table admin');
        $query = $this->db->query('truncate table fellow');
        $query = $this->db->query('truncate table offer');
        $query = $this->db->query('truncate table follow_fellow');
        
        $data = array(
               'email' => '123456@omar.com' ,
               'password' => '123456',
               'created' => '0000000001',
               'first_name' => 'omarhub',
               'last_name' => 'admin'
            );

        $this->db->insert('admin', $data);


        $data = array(
                'created' => '0000000001',
                'email' => '123456@omar.com' ,
                'password' => '123456',
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
                'fellow_url_token'  =>  '100001'
            );

        $this->db->insert('fellow', $data); 

                $data = array(
                'created' => '0000000002',
                'email' => 'huiter@vip.qq.com' ,
                'password' => 'huiter',
                'first_name' => 'hui',
                'last_name' => 'ter',
                'mail_option' => '1',
                'mail' => 'No 18 Buaa',
                'mobile_country_code' => '010',
                'mobile' => '15210832621',
                'country' => 'China',
                'zip' => '100191',
                'state' => 'Liaoning',
                'city' => 'Anshan',
                'street' => 'Baihuixiangshan',
                'target' => 'Education',
                'location' => 'Buaa',
                'job' => 'IT',
                'language' => 'Chinese',
                'gender' => '1',
                'fellow_url_token'  =>  '100002'
            );

        $this->db->insert('fellow', $data);   

                $data = array(
                'created' => '0000000003',
                'email' => '100524333@qq.com' ,
                'password' => 'huiter',
                'first_name' => 'chen',
                'last_name' => 'qi',
                'mail_option' => '1',
                'mail' => 'No 18 Buaa',
                'mobile_country_code' => '010',
                'mobile' => '...',
                'country' => 'China',
                'zip' => '100191',
                'state' => 'Beijing',
                'city' => 'Beijing',
                'street' => 'Xueyuan',
                'target' => 'Education',
                'location' => 'Buat',
                'job' => 'KUAIJI',
                'language' => 'Chinese',
                'gender' => '1',
                'fellow_url_token'  =>  '100003'
            );

        $this->db->insert('fellow', $data); 

        $data = array(
               'offer_url_token'=>'40798',
               'created'=>'1340673285',
               'fellow_id'=>'3',
               'title'=>'The fund for the poor children',
               'description'=>'We want to help the poor children in Asia. When they encounter the bad situation,they can get help here',
               'fields'=>'Education',
               'locations'=>'Vietnam',
               'target'=>'Youth'
            );
        $this->db->insert('offer', $data); 
        $data = array(
               'offer_url_token'=>'40799',
               'created'=>'1340673290',
               'fellow_id'=>'2',
               'title'=>'Solution to the poor health',
               'description'=>'A healthy plan for the people who suffer the disease',
               'fields'=>'Health',
               'locations'=>'China',
               'target'=>'All people'
            );
         $this->db->insert('offer', $data); 
        $data = array(
               'offer_url_token'=>'40728',
               'created'=>'1340673370',
               'fellow_id'=>'2',
               'title'=>'Offer the opportunity for the unemployed',
               'description'=>'Help you survive the financial crisis ',
               'fields'=>'Job',
               'locations'=>'Greece',
               'target'=>'adult'
            );
         $this->db->insert('offer', $data); 
        $data = array(
               'offer_url_token'=>'40876',
               'created'=>'1340674356',
               'fellow_id'=>'1',
               'title'=>'Kill the cancer',
               'description'=>'We offer the money to help the people in despair',
               'fields'=>'Health',
               'locations'=>'South Africa',
               'target'=>'Youth'
            );
         $this->db->insert('offer', $data); 
        $data = array(
               'offer_url_token'=>'40879',
               'created'=>'1340675344',
               'fellow_id'=>'3',
               'title'=>'Free chance to learn the first aid',
               'description'=>'We want to help the poor children in Asia. When they encounter the bad situation,they can get help here',
               'fields'=>'Aid',
               'locations'=>'Afghanistan',
               'target'=>'Young Girls'
            );     
         $this->db->insert('offer', $data); 
        return 0;
    }
}

/* End of reset_model.php */
/* Location: ./system/application/model/reset_model.php */