<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Zws extends REST_Controller{
    
    function event_get(){

        $json = $this->get('json');
        $arr = json_decode($json,TRUE);

        $event_token = $arr['event_id'];
        //event_id still not available
        
        $this->load->model('event_model','',TRUE );    
        //event_model still not available
	

        if(!empty($event_token)){
                $event_detail = $this->event_model->get_entry_bytoken($event_token);
                //this function still not available

                if(!empty($event_detail)){
                        $this->response($event_detail,200);}

                else{
                        $this->response('no such event',400);}

        }

        $number = $arr['num'];
        $time_stamp = $arr['time_stamp'];
        $orderby = $arr['orderby'];
        $member_token = $arr['member_id'];

        if(empty($number)){
                $number = 15;
        }
        if(empty($time_stamp)){
                $time_stamp=time();
        }
        if(empty($orderby)){
                $orderby='created';
        }
        if(!empty($member_token)){
                $this->load->model('member_model','',TRUE);
		
                $temp = $this->member_model->get_entry_bytoken($member_token);

                if(!empty($temp)){
                        $member_id = $temp['id'];
                }        
                else{
                        $this->response('no such  user',400);
                }
        }
        else{
                $member_id = $member_token;
        }

        $event = $this->event_model->get_data_bytoken($member_id,$time_stamp,$number,$orderby);
        if(!empty($event)){
                $this->response($event,200);
        }
        else{
                $this->response('no token',400);
        }     
    }


    function event_post(){
        $json = $this->post('json');
        $arr = json_decode($json,TRUE);       
        $title = $arr['title'];
        $id = $arr['id'];       
        $create = time();
        if(!empty($id)&&!empty($title)){       
                $this->load->model('event_model','',TRUE );    
                $this->load->model('member_model','',TRUE );  
                //event_model still not available
                //member_model still not available

                 $temp=$this->member_model->get_entry_bytoken($id);
                //this id stand for the token of the member
                //this function still not available

                $arr['created'] = $create;
                $arr['member_id'] = $temp['id'];
                $member_id = $arr['member_id'];

                if(empty($member_id)){
                        $this->response('no such user','400');}

                $arr['url_token'] = rand()%1000000;

                $event_data['url_token'] = $arr['url_token'];
                $event_data['created'] = $arr['created'];
                $event_data['member_id'] = $arr['member_id'];
                $event_data['title'] = $arr['title'];
                $event_data['description'] = $arr['description'];    
                $event_data['start_date'] = $arr['start_date'];
                $event_data['end_date'] = $arr['end_date'];
                $event_data['etype'] = $arr['etype'];
                $event_data['fields'] = $arr['fields'];
                $event_data['locations'] = $arr['locations'];
                $event_data['target'] = $arr['target'];         
              

                $event = $this->event_model->insert_entry($event_data);
                //this function still not available

                if(!empty($event)){
                        $this->response($event,200);}
                else{
                        $this->response('ID ERROR',400);}

        }
                else{
                                $this->response('NO ID',400);}

                                
    }

}


