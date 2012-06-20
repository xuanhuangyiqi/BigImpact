<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viewothers_test extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();	
		$this->load->library('rest', array('server' => 'http://localhost/'));	
	}

    public function get($url_token)
    {
        $res = $this->rest->get('api/user/profile/', array('token'=>$url_token), 'json');
        print_r($res);
        echo $this->rest->debug();
    }
}
         
