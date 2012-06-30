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
        $this->db->empty_table('follow_offer');    
        $this->db->empty_table('offer');     

        $query = $this->db->query('truncate table admin');
        $query = $this->db->query('truncate table fellow');
        $query = $this->db->query('truncate table offer');
        $query = $this->db->query('truncate table follow_fellow');
        $query = $this->db->query('truncate table follow_offer');
        
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
                'mobile_country_code' => '010',
                'mobile' => 'China Unicom',
                'home_country' => 'China',
                'home_zip' => '100191',
                'home_state' => 'haidian',
                'home_city' => 'Beijing',
                'home_street' => 'Xueyuan Road',
                'business_country' => 'China',
                'business_zip' => '100191',
                'business_state' => '西城',
                'business_city' => 'Beijing',
                'business_street' => 'Tianan Road',
                'target' => 'Education',
                'location' => 'Buaa',
                'job' => 'IT',
                'language' => 'Chinese',
                'gender' => '1',
                'fellow_url_token'  =>  '100001',
                'skype_id' => 'i@skype.com',
                'home_mail' => 'home...mail',
                'business_mail' =>'business_mail',
                'organization_name' => '130',
                'organization_acronym' => '',
                'date_organization_formed' => '19900101',
                'organization_website_url' => '130.huiter.me',
                'organization_type' => '',
                'number_of_employees' => '130',
                'organization_estimated_annual_budget' => '',
                'organization_phone_number_country_code' => '',
                'organization_phone_number' => ''
            );
        $this->db->insert('fellow', $data); 

                $data = array(
                'created' => '0000000002',
                'email' => 'huiter@vip.qq.com' ,
                'password' => 'huiter',
                'first_name' => 'hui',
                'last_name' => 'ter',
                'mobile_country_code' => '010',
                'mobile' => '15210832621',
                'home_country' => 'China',
                'home_zip' => '100191',
                'home_state' => 'haidian',
                'home_city' => 'Beijing',
                'home_street' => 'Xueyuan Road',
                'business_country' => 'China',
                'business_zip' => '100191',
                'business_state' => '西城',
                'business_city' => 'Beijing',
                'business_street' => 'Tianan Road',
                'target' => 'Education',
                'location' => 'Buaa',
                'job' => 'IT',
                'language' => 'Chinese',
                'gender' => '1',
                'fellow_url_token'  =>  '100002',
                'skype_id' => 'i@skype.com',
                'home_mail' => 'home...mail',
                'business_mail' =>'business_mail',
                'organization_name' => '130',
                'organization_acronym' => '',
                'date_organization_formed' => '19900101',
                'organization_website_url' => '130.huiter.me',
                'organization_type' => '',
                'number_of_employees' => '130',
                'organization_estimated_annual_budget' => '',
                'organization_phone_number_country_code' => '',
                'organization_phone_number' => ''
            );
        $this->db->insert('fellow', $data);   

                $data = array(
                'created' => '0000000003',
                'email' => 'liuyuxiao123@gmail.com' ,
                'password' => 'liuyuxiao',
                'first_name' => 'chen',
                'last_name' => 'qi',
                'mobile_country_code' => '010',
                'mobile' => '...',
                'home_country' => 'China',
                'home_zip' => '100191',
                'home_state' => 'haidian',
                'home_city' => 'Beijing',
                'home_street' => 'Xueyuan Road',
                'business_country' => 'China',
                'business_zip' => '100191',
                'business_state' => '西城',
                'business_city' => 'Beijing',
                'business_street' => 'Tianan Road',
                'target' => 'Education',
                'location' => 'Buaa',
                'job' => 'IT',
                'language' => 'Chinese',
                'gender' => '1',
                'fellow_url_token'  =>  '100003',
                'skype_id' => 'i@skype.com',
                'home_mail' => 'home...mail',
                'business_mail' =>'business_mail',
                'organization_name' => '130',
                'organization_acronym' => '',
                'date_organization_formed' => '19900101',
                'organization_website_url' => '130.huiter.me',
                'organization_type' => '',
                'number_of_employees' => '130',
                'organization_estimated_annual_budget' => '',
                'organization_phone_number_country_code' => '',
                'organization_phone_number' => ''
            );
        $this->db->insert('fellow', $data); 


        $data = array(
                'created' => '0000000005',
                'email' => 'xuanhuangyiqi@126.com' ,
                'password' => 'wangxiaoyu',
                'first_name' => 'omarhub',
                'last_name' => 'fellow',
                'mobile_country_code' => '010',
                'mobile' => 'China Unicom',
                'home_country' => 'China',
                'home_zip' => '100191',
                'home_state' => 'haidian',
                'home_city' => 'Beijing',
                'home_street' => 'Xueyuan Road',
                'business_country' => 'China',
                'business_zip' => '100191',
                'business_state' => '西城',
                'business_city' => 'Beijing',
                'business_street' => 'Tianan Road',
                'target' => 'Education',
                'location' => 'Buaa',
                'job' => 'IT',
                'language' => 'Chinese',
                'gender' => '1',
                'fellow_url_token'  =>  '100004',
                'skype_id' => 'i@skype.com',
                'home_mail' => 'home...mail',
                'business_mail' =>'business_mail',
                'organization_name' => '130',
                'organization_acronym' => '',
                'date_organization_formed' => '19900101',
                'organization_website_url' => '130.huiter.me',
                'organization_type' => '',
                'number_of_employees' => '130',
                'organization_estimated_annual_budget' => '',
                'organization_phone_number_country_code' => '',
                'organization_phone_number' => ''
            );

        $this->db->insert('fellow', $data); 
        $data = array(
                'created' => '0000000006',
                'email' => 'jxaa144081@163.com' ,
                'password' => 'huxiangquan',
                'first_name' => 'hu',
                'last_name' => 'xiangquan',
                'mobile_country_code' => '010',
                'mobile' => 'China Unicom',
                'home_country' => 'China',
                'home_zip' => '100191',
                'home_state' => 'haidian',
                'home_city' => 'Beijing',
                'home_street' => 'Xueyuan Road',
                'business_country' => 'China',
                'business_zip' => '100191',
                'business_state' => '西城',
                'business_city' => 'Beijing',
                'business_street' => 'Tianan Road',
                'target' => 'Education',
                'location' => 'Buaa',
                'job' => 'IT',
                'language' => 'Chinese',
                'gender' => '1',
                'fellow_url_token'  =>  '100005',
                'skype_id' => 'i@skype.com',
                'home_mail' => 'home...mail',
                'business_mail' =>'business_mail',
                'organization_name' => '130',
                'organization_acronym' => '',
                'date_organization_formed' => '19900101',
                'organization_website_url' => '130.huiter.me',
                'organization_type' => '',
                'number_of_employees' => '130',
                'organization_estimated_annual_budget' => '',
                'organization_phone_number_country_code' => '',
                'organization_phone_number' => ''
            );

        $this->db->insert('fellow', $data); 
        $data = array(
                'created' => '0000000007',
                'email' => '674400921@qq.com' ,
                'password' => 'zhangweishu',
                'first_name' => 'zhang',
                'last_name' => 'weishu',
                'mobile_country_code' => '010',
                'mobile' => 'China Unicom',
                'home_country' => 'China',
                'home_zip' => '100191',
                'home_state' => 'haidian',
                'home_city' => 'Beijing',
                'home_street' => 'Xueyuan Road',
                'business_country' => 'China',
                'business_zip' => '100191',
                'business_state' => '西城',
                'business_city' => 'Beijing',
                'business_street' => 'Tianan Road',
                'target' => 'Education',
                'location' => 'Buaa',
                'job' => 'IT',
                'language' => 'Chinese',
                'gender' => '1',
                'fellow_url_token'  =>  '100006',
                'skype_id' => 'i@skype.com',
                'home_mail' => 'home...mail',
                'business_mail' =>'business_mail',
                'organization_name' => '130',
                'organization_acronym' => '',
                'date_organization_formed' => '19900101',
                'organization_website_url' => '130.huiter.me',
                'organization_type' => '',
                'number_of_employees' => '130',
                'organization_estimated_annual_budget' => '',
                'organization_phone_number_country_code' => '',
                'organization_phone_number' => ''
            );
        $this->db->insert('fellow', $data); 

        $data = array(
                'created' => '0000000008',
                'email' => 'labikyo@gmail.com' ,
                'password' => 'lixinyue',
                'first_name' => 'li',
                'last_name' => 'xinyue',
                'mobile_country_code' => '010',
                'mobile' => 'China Unicom',
                'home_country' => 'China',
                'home_zip' => '100191',
                'home_state' => 'haidian',
                'home_city' => 'Beijing',
                'home_street' => 'Xueyuan Road',
                'business_country' => 'China',
                'business_zip' => '100191',
                'business_state' => '西城',
                'business_city' => 'Beijing',
                'business_street' => 'Tianan Road',
                'target' => 'Education',
                'location' => 'Buaa',
                'job' => 'IT',
                'language' => 'Chinese',
                'gender' => '1',
                'fellow_url_token'  =>  '100007',
                'skype_id' => 'i@skype.com',
                'home_mail' => 'home...mail',
                'business_mail' =>'business_mail',
                'organization_name' => '130',
                'organization_acronym' => '',
                'date_organization_formed' => '19900101',
                'organization_website_url' => '130.huiter.me',
                'organization_type' => '',
                'number_of_employees' => '130',
                'organization_estimated_annual_budget' => '',
                'organization_phone_number_country_code' => '',
                'organization_phone_number' => ''
            );
        $this->db->insert('fellow', $data); 

        $data = array(
                'created' => '0000000009',
                'email' => 'buaawangyue@gmail.com' ,
                'password' => 'wangyue',
                'first_name' => 'wang',
                'last_name' => 'yue',
                'mobile_country_code' => '010',
                'mobile' => 'China Unicom',
                'home_country' => 'China',
                'home_zip' => '100191',
                'home_state' => 'haidian',
                'home_city' => 'Beijing',
                'home_street' => 'Xueyuan Road',
                'business_country' => 'China',
                'business_zip' => '100191',
                'business_state' => '西城',
                'business_city' => 'Beijing',
                'business_street' => 'Tianan Road',
                'target' => 'Education',
                'location' => 'Buaa',
                'job' => 'IT',
                'language' => 'Chinese',
                'gender' => '1',
                'fellow_url_token'  =>  '100008',
                'skype_id' => 'i@skype.com',
                'home_mail' => 'home...mail',
                'business_mail' =>'business_mail',
                'organization_name' => '130',
                'organization_acronym' => '',
                'date_organization_formed' => '19900101',
                'organization_website_url' => '130.huiter.me',
                'organization_type' => '',
                'number_of_employees' => '130',
                'organization_estimated_annual_budget' => '',
                'organization_phone_number_country_code' => '',
                'organization_phone_number' => ''
            );
        $this->db->insert('fellow', $data); 

        $data = array(
                'created' => '0000000019',
                'email' => 'randy228@126.com' ,
                'password' => 'wangchao',
                'first_name' => 'wang',
                'last_name' => 'chao',
                'mobile_country_code' => '010',
                'mobile' => 'China Unicom',
                'home_country' => 'China',
                'home_zip' => '100191',
                'home_state' => 'haidian',
                'home_city' => 'Beijing',
                'home_street' => 'Xueyuan Road',
                'business_country' => 'China',
                'business_zip' => '100191',
                'business_state' => '西城',
                'business_city' => 'Beijing',
                'business_street' => 'Tianan Road',
                'target' => 'Education',
                'location' => 'Buaa',
                'job' => 'IT',
                'language' => 'Chinese',
                'gender' => '1',
                'fellow_url_token'  =>  '100009',
                'skype_id' => 'i@skype.com',
                'home_mail' => 'home...mail',
                'business_mail' =>'business_mail',
                'organization_name' => '130',
                'organization_acronym' => '',
                'date_organization_formed' => '19900101',
                'organization_website_url' => '130.huiter.me',
                'organization_type' => '',
                'number_of_employees' => '130',
                'organization_estimated_annual_budget' => '',
                'organization_phone_number_country_code' => '',
                'organization_phone_number' => ''
            );
        $this->db->insert('fellow', $data); 

        $data = array(
                'created' => '0000000009',
                'email' => 'shiyin92@gmail.com' ,
                'password' => 'wangshiyin',
                'first_name' => 'wang',
                'last_name' => 'shiyin',
                'mobile_country_code' => '010',
                'mobile' => 'China Unicom',
                'home_country' => 'China',
                'home_zip' => '100191',
                'home_state' => 'haidian',
                'home_city' => 'Beijing',
                'home_street' => 'Xueyuan Road',
                'business_country' => 'China',
                'business_zip' => '100191',
                'business_state' => '西城',
                'business_city' => 'Beijing',
                'business_street' => 'Tianan Road',
                'target' => 'Education',
                'location' => 'Buaa',
                'job' => 'IT',
                'language' => 'Chinese',
                'gender' => '1',
                'fellow_url_token'  =>  '100010',
                'skype_id' => 'i@skype.com',
                'home_mail' => 'home...mail',
                'business_mail' =>'business_mail',
                'organization_name' => '130',
                'organization_acronym' => '',
                'date_organization_formed' => '19900101',
                'organization_website_url' => '130.huiter.me',
                'organization_type' => '',
                'number_of_employees' => '130',
                'organization_estimated_annual_budget' => '',
                'organization_phone_number_country_code' => '',
                'organization_phone_number' => ''
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
               'fellow_id'=>'1',
               'title'=>'Solution to the poor health',
               'description'=>'A healthy plan for the people who suffer the disease',
               'fields'=>'Health',
               'locations'=>'China',
               'target'=>'All people'
            );
         $this->db->insert('offer', $data); 
        $data = array(
               'offer_url_token'=>'40800',
               'created'=>'1340673270',
               'fellow_id'=>'3',
               'title'=>'Offer the opportunity for the unemployed',
               'description'=>'Help you survive the financial crisis ',
               'fields'=>'Job',
               'locations'=>'Greece',
               'target'=>'adult'
            );
         $this->db->insert('offer', $data); 
        $data = array(
               'offer_url_token'=>'40801',
               'created'=>'1340674350',
               'fellow_id'=>'1',
               'title'=>'Kill the cancer',
               'description'=>'We offer the money to help the people in despair',
               'fields'=>'Health',
               'locations'=>'South Africa',
               'target'=>'Youth'
            );
         $this->db->insert('offer', $data); 
        $data = array(
               'offer_url_token'=>'40802',
               'created'=>'1340675344',
               'fellow_id'=>'1',
               'title'=>'Free chance ',
               'description'=>'We want to help bad situation,they can get help here',
               'fields'=>'Aid',
               'locations'=>'Afghanistan',
               'target'=>'Young Girls'
            );     
         $this->db->insert('offer', $data); 


         $data = array(
            'fellow_id'=> '1',
            'be_fellow_id'=> '2',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_fellow', $data); 
         $data = array(
            'fellow_id'=> '1',
            'be_fellow_id'=> '3',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_fellow', $data); 
         $data = array(
            'fellow_id'=> '1',
            'be_fellow_id'=> '5',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_fellow', $data); 
         $data = array(
            'fellow_id'=> '1',
            'be_fellow_id'=> '6',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_fellow', $data); 
         $data = array(
            'fellow_id'=> '1',
            'be_fellow_id'=> '7',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_fellow', $data); 
         $data = array(
            'fellow_id'=> '2',
            'be_fellow_id'=> '3',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_fellow', $data); 
         $data = array(
            'fellow_id'=> '2',
            'be_fellow_id'=> '1',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_fellow', $data); 
         $data = array(
            'fellow_id'=> '2',
            'be_fellow_id'=> '5',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_fellow', $data); 
         $data = array(
            'fellow_id'=> '2',
            'be_fellow_id'=> '8',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_fellow', $data); 
         $data = array(
            'fellow_id'=> '3',
            'be_fellow_id'=> '1',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_fellow', $data); 
         $data = array(
            'fellow_id'=> '3',
            'be_fellow_id'=> '2',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_fellow', $data); 
         $data = array(
            'fellow_id'=> '3',
            'be_fellow_id'=> '4',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_fellow', $data); 
         $data = array(
            'fellow_id'=> '4',
            'be_fellow_id'=> '2',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_fellow', $data); 
         $data = array(
            'fellow_id'=> '4',
            'be_fellow_id'=> '3',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_fellow', $data); 



         $data = array(
            'fellow_id'=> '1',
            'offer_id'=> '3',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_offer', $data); 
         $data = array(
            'fellow_id'=> '2',
            'offer_id'=> '3',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_offer', $data); 
         $data = array(
            'fellow_id'=> '2',
            'offer_id'=> '1',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_offer', $data); 
         $data = array(
            'fellow_id'=> '4',
            'offer_id'=> '2',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_offer', $data); 
         $data = array(
            'fellow_id'=> '1',
            'offer_id'=> '1',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_offer', $data); 
         $data = array(
            'fellow_id'=> '2',
            'offer_id'=> '4',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_offer', $data); 
         $data = array(
            'fellow_id'=> '4',
            'offer_id'=> '1',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_offer', $data); 
         $data = array(
            'fellow_id'=> '3',
            'offer_id'=> '4',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_offer', $data); 
         $data = array(
            'fellow_id'=> '5',
            'offer_id'=> '5',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_offer', $data); 
         $data = array(
            'fellow_id'=> '5',
            'offer_id'=> '1',
            'created'=> '1340675344',
            );
         $this->db->insert('follow_offer', $data); 

        return 0;
    }
}

/* End of reset_model.php */
/* Location: ./system/application/model/reset_model.php */
