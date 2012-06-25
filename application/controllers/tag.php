<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 引用流程接入口 
 */


class Tag extends Pixel_Controller
{		
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function index()
	{
		$this->template['content'] = $this->load->view('tag/tag_view',$this->template,TRUE);
		$this->template['css'] = $this->load->view('tag/tag_css',$this->template,TRUE);
		$this->template['js'] = $this->load->view('tag/tag_js',$this->template,TRUE);
		$this->load->view('template_view',$this->template);
	}

}
/* End of file profile.php */
/* Location: ./application/controllers/profile.php */