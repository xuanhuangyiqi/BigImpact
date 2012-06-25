<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 引用流程接入口 
 */


class Home extends Pixel_Controller
{		
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function index()
	{
		$this->template['content'] = $this->load->view('P&A/P&A_view',$this->template,TRUE);
		$this->template['css'] = $this->load->view('P&A/P&A_css',$this->template,TRUE);
		$this->template['js'] = $this->load->view('P&A/P&A_js',$this->template,TRUE);
		$this->load->view('template_view',$this->template);
	}

}
/* End of file profile.php */
/* Location: ./application/controllers/profile.php */