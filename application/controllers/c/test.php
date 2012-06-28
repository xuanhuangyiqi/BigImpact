<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 测试环境 
 */


class Test extends Pixel_Controller
{		
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function index()
	{
		$this->template['content'] = $this->load->view('test_view',$this->template,TRUE);
		$this->template['css'] = $this->load->view('test_css',$this->template,TRUE);
		$this->template['js'] = $this->load->view('test_js',$this->template,TRUE);
		$this->load->view('template_view',$this->template);
	}

}
/* End of file test.php */
/* Location: ./application/controllers/c/test.php */