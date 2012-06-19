<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 引用流程接入口 
 */


class Auth_test extends CI_Controller
{		
	public function __construct()
	{
		parent::__construct();	
		$this->load->library('rest', array('server' => 'http://localhost/'));	
	}
	
	public function index()
	{
		$id = 3;
		$responce = $this->rest->get('api/example/auth/format/json',  array('id' => $id), 'json');
		//print_r($responce);
		echo "hello";
	    //echo $this->rest->debug();
                 # echo "HELLO INDEX";
	}

	public function get($id)
	{
		$responce = $this->rest->get('api/example/auth/format/json',  array('id' => $id), 'json');
		//print_r($responce);
		echo $this->rest->debug();
	}

	public function insert()
	{
		$email = "liuyuxiao123@126.com";
        $firstname = "Bill";
        $lastname = "William";

		$responce = $this->rest->put('api/example/auth/',  array('email' => $email ,'firstname' => $firstname,'lastname'=>$lastname), 'json');
		print_r($responce);
		echo $this->rest->debug();
	}
	
	public function delete($id)
	{
		$responce = $this->rest->delete("api/example/auth/id/$id",'json');
		//print_r($responce);
		echo $this->rest->debug();
	}
}
/* End of file profile.php */
/* Location: ./application/controllers/profile.php */
