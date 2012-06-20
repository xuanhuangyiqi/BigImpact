<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 引用流程接入口 
 */


class Yuxiao_test extends CI_Controller
{		
	public function __construct()
	{
		parent::__construct();	
		$this->load->library('rest', array('server' => 'http://localhost/'));	
	}
	
	

	public function commit()
	{
		//echo "hello";
		$stringJson = '{
     	"first_name": "John",
     	"last_name": "Smith",
     	"mail_option": 1,
     	"mail": "No 18 Buaa",
     	"mobile_country_code":"010",
     	"mobile":"China Unicom",
     	"country":"China",
     	"zip":"100191",
     	"state":"haidian",
     	"city":"Beijing",
     	"street":"Xueyuan Road",
     	"target":"Education",
     	"location":"Buaa",
     	"job":"IT",
     	"language":"Chinese",
     	"gender":1,
     	"url_token":3123243,
        "avatar_path":"http://img.baidu.com/img/iknow/avarta/48/r6s1g6.gif"
    	}';
    	$response=$this->rest->put('api/yuxiao/member',array('stringJson' =>'{
     	"first_name": "John",
     	"last_name": "Smith",
     	"mail_option": 1,
     	"mail": "No 18 Buaa",
     	"mobile_country_code":"010",
     	"mobile":"China Unicom",
     	"country":"China",
     	"zip":"100191",
     	"state":"haidian",
     	"city":"Beijing",
     	"street":"Xueyuan Road",
     	"target":"Education",
     	"location":"Buaa",
     	"job":"IT",
     	"language":"Chinese",
     	"gender":1,
     	"url_token":3123243,
        "avatar_path":"http://img.baidu.com/img/iknow/avarta/48/r6s1g6.gif"
    	}' ),'json');
    	$stringencode = json_decode($response, true);
    	print_r($stringJson);
    	echo $this->rest->debug();
	}
}
/* End of file profile.php */
/* Location: ./application/controllers/profile.php */
