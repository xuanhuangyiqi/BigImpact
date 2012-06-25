<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 引用流程接入口 
 */


class Test extends Pixel_Controller
{		
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function index()
	{
		//$userdata['auth'] = '0';
        //$userdata['email'] = "huiter@vip.qq.com";
        //$this->session->set_userdata('userdata',$userdata);

		$this->template['content'] = $this->load->view('test/test_view',$this->template,TRUE);
		$this->template['css'] = $this->load->view('test/test_css',$this->template,TRUE);
		$this->template['js'] = $this->load->view('test/test_js',$this->template,TRUE);
		$this->load->view('template_view',$this->template);
	}

}
/* End of file profile.php */
/* Location: ./application/controllers/profile.php */