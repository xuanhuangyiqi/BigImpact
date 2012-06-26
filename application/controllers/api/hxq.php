<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Hxq extends REST_Controller
{
	
	function offer_get()//$member_id(member_token)='',$time_stamp='now',$num='10',$orderby='created',$offer_id(offer_token)=''
	{
		$json = $this->get('json');
		$arr = json_decode($json,TRUE);

		//$this->response($arr,200);
		$offer_token = $arr['offer_id'];

		$this->load->model('offer_model','',TRUE);

		if(!empty($offer_token))
		{
			//$offer_token=$this->session->userdata('id');
			$offer_detail=$this->offer_model->get_entry_bytoken($offer_token);
			if(!empty($offer_detail))
				$this->response($offer_detail,200);
			else
				$this->response('no such offer',400);
		}
			
			
		$number=$arr['num'];
		$time_stamp=$arr['time_stamp'];
		$orderby=$arr['orderby'];
		$member_token=$arr['member_id'];

		if(empty($number))
			$number=15;

		if(empty($time_stamp))
		{
			$time_stamp=time();
		}
		
		if(empty($orderby))
			$orderby='created';

		
		if(!empty($member_token))
		{
			$this->load->model('member_model','',TRUE);
			$temp=$this->member_model->get_entry_bytoken($member_token);
			if(!empty($temp))
				$member_id=$temp['id'];
			else
				$this->response('wrong user id',400);
		}
		else
		{
			$member_id=$member_token;
		}
		
		$offer = $this->offer_model->get_data_bytoken($member_id,$time_stamp,$number,$orderby);

		if(!empty($offer))
		{
			//unset($offer['id']);
			$this->response($offer,200);
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
			$offer_data['description']=$arr['description'];
			$offer_data['fields']=$arr['fields'];
			$offer_data['locations']=$arr['locations'];
			$offer_data['target']=$arr['target'];

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


