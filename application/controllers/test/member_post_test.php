<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_post_test extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();	
		$this->load->library('rest', array('server' => 'http://www.omarhub.com/'));	
	}

    public function get($url_token)
    {
        $res = $this->rest->get('api/wxy/member/', array('token'=>$url_token), 'json');
        print_r($res);
        echo $this->rest->debug();
    }

    public function post()
    {
        $str = '{"email":"htedsv@gmai.com", "first_name":"wxy"}';
        $res = $this->rest->post('api/wxy/member/', array('json' => $str), 'json');
        echo $this->rest->debug();
    }
}
