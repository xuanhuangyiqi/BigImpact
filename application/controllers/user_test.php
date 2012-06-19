<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 引用流程接入口 
 */


class User_test extends CI_Controller
{		
	public function __construct()
	{
		parent::__construct();	
		$this->load->library('rest', array('server' => 'http://localhost/'));	
	}
	
	public function index()
	{
		$uid = 3;
		$responce = $this->rest->get('api/example/user/format/json',  array('uid' => $uid), 'json');
		//print_r($responce);
	    echo $this->rest->debug();
	}

	public function get($uid)
	{
		$responce = $this->rest->get('api/example/user/format/json',  array('uid' => $uid), 'json');
		print_r($responce);
		echo $this->rest->debug();
	}

	public function insert($name,$city)
	{
		#$name = 'nana';
		#$city = 'Beijing';

		$responce = $this->rest->put('api/example/user/',  array('name' => $name ,'city' => $city), 'json');
		//print_r($responce);
		echo $this->rest->debug();
	}
	
	public function delete($uid)
	{
		$responce = $this->rest->delete("api/example/user/uid/$uid",'json');
		echo $uid." dsads";
		//print_r($responce);
		echo $this->rest->debug();
	}
}
/* End of file profile.php */
/* Location: ./application/controllers/profile.php */
