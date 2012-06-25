<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 引用流程接入口 
 */


class Login_test extends CI_Controller
{		
	public function __construct()
	{
		parent::__construct();	
		$this->load->library('rest', array('server' => 'http://www.omarhub.com/'));	
	}
	
	

	public function get()
	{
		$email =  "liuyuxiao123@gmail.com";
		$passwd = "123";
		$responce = $this->rest->get('api/login/auth',  array('email' => $email,'passwd'=>$passwd), 'json');
		//print_r($responce);
		echo $this->rest->debug();
	}
}
/* End of file profile.php */
/* Location: ./application/controllers/profile.php */
