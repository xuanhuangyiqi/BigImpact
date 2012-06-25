<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viewothers_test extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();	
		$this->load->library('rest', array('server' => 'http://www.omarhub.com/'));	
	}

    public function get($url_token)
    {
        $json = json_encode(array('token'=>$url_token));
        $res = $this->rest->get('api/wxy/member/format/json/', array('json'=>$json), '');
        print_r($res);
        echo $this->rest->debug();
    }
}
         
