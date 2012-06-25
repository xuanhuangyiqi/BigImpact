<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Hxq extends REST_Controller
{
	
	function offer_get()
	{
		$json = $this->get('json');
		$arr = json_decode($json,TRUE);
		$token = $arr['url_token'];

		if(!empty($token))
		{
			$this->load->model('offer_model','',TRUE);
		
			$offer = $this->offer_model->get_entry_bytoken($token);

			if(!empty($offer))
			{
				unset($offer['id']);
				$this->response($offer,200);
			}
			else
			{
				$this->response('token error', 400);
			}


		}
		else
		{
			$this->response('no token', 400);
		}
	
	}
	
	function offer_post()
	{
		$json = $this->post('json');
		$arr = json_decode($json,TRUE); //$arr includes member_id and all the information that an offer needs
		$title=$arr['title'];	
		$id=$arr['id'];

		if(!empty($id)&&!empty($title))
		{
			$this->load->model('offer_model','',TRUE);
			$this->load->model('member_model','',TRUE);

			$arr["created"]=time();

			$temp=$this->member_model->get_entry_bytoken($id);
			$arr['member_id']=$temp['id'];
			$member_id=$arr['member_id'];


			if(empty($member_id))
			{
				$this->response('no such user','400');
			}
			
			$arr['url_token'] = rand() % 1000000;

			$offer_data['title']=$arr['title'];
			$offer_data['member_id']=$arr['member_id'];
			$offer_data['created']=$arr['created'];
			$offer_data['url_token']=$arr['url_token'];
			$offer = $this->offer_model->insert_entry($offer_data);

			if(!empty($offer))
			{
				$this->response($offer,200);
			}
			else
			{
				$this->response('id error',400);
			}
		}
		else
		{
			$this->response('no id',400);
		}
	}
}


