<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_post_test extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();	
		$this->load->library('rest', array('server' => 'http://localhost/'));	
	}

    public function get($url_token)
    {
        $res = $this->rest->get('api/wxy/member/', array('token'=>$url_token), 'json');
        print_r($res);
        echo $this->rest->debug();
    }

    public function post()
    {
        $res = $this->rest->post('api/wxy/member/', array('email'=>'wxy@124.com'), 'json');
        print_r($res);
        echo $this->rest->debug();
    }
}
