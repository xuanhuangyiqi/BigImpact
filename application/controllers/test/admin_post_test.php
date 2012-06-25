<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_post_test extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();	
		$this->load->library('rest', array('server' => 'http://www.omarhub.com/'));	
	}

    public function post()
    {
        $str = '{"email":"htedsv@gmai.com"}';
        $res = $this->rest->post('api/wxy/admin/', array('json' => $str), 'json');
        echo $this->rest->debug();
    }
}
