<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Firstlogin_test extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();	
		$this->load->library('rest', array('server' => 'http://www.omarhub.com/'));	
	}

    public function index($id) { }


    public function put($id)
    {
        $res = $this->rest->get('api/user/profileexist/', array('id'=>$id), 'json');
        print_r($res);
        //echo $this->rest->debug();
    }
}
         
