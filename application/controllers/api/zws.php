<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

//**Event contains event_id,title,created,description,fields,locations,target,author_id,author_first_name,author_last_name,start_date,end_data,etype

class Zws extends REST_Controller{
        
    //???-1:创建一个Event
    function event_post(){
        $fellow_url_token = $this->_auth_fellow(); 

        $json = $this->post('json');
        $in = json_decode($json,TRUE);

        $title = $in['title'];
        $id = $in['id'];    
        $description = $in['description'];
        $fields = $in['fields'];
        $locations = $in['locations'];
        $target = $in['target'];
        $start_date = $in['start_date'];
        $end_date = $in['end_date'];
        $etype = $in['etype'];


        $create = time();
            
        $this->load->model('event_model','',TRUE );    
        $this->load->model('member_model','',TRUE );  


        $fellow=$this->fellow_model->get_entry_byfellow_url_token($fellow_url_token);


        // $in['created'] = $create;
        // $in['member_id'] = $fellow['id'];
        // $member_id = $in['member_id'];

        $data['event_url_token'] = rand() % 1000000;
        $data['created'] = time();
        $data['fellow_id'] = $fellow['id'];
        $data['title'] = $title;
        $data['description'] = $description;    
        $data['start_date'] = $start_date
        $data['end_date'] = $end_date
        $data['etype'] = $etype
        $data['fields'] = $fields;
        $data['locations'] = $locations;
        $data['target'] = $target;   
              

        $this->event_model->insert_entry($data);

        $this->response(array('error' =>'', ),200);
    } 

    //???-2:获取一个指定Event_id的Event信息
    function event_get($event_id='')
    {   
        $event_url_token = $event_id;

        if(empty($event_url_token))
        {
            $this->response(array('error' => 'no event id '), 400);
        }
        $this->load->model('event_model','',TRUE);
        $event = $this->event_model->get_entry_byevent_url_token($event_url_token);
        
        if(empty($event))
        {
           $this->response(array('error' => 'no this event'), 400); 
        }
        
        $out['event_id'] = $event['event_url_token']; 
        $out['title'] = $event['title'];
        $out['description'] = $event['description'];
        $out['created'] = $event['created'];
        $out['fields'] = $event['fields'];
        $out['locations'] = $event['locations'];
        $out['target'] = $event['target'];
        $out['author_id'] = $event['fellow_url_token'];
        $out['author_first_name'] = $event['first_name'];
        $out['author_last_name'] = $event['last_name'];
        $out['start_date'] = $event['start_date'];
        $out['end_date'] = $event['end_date'];
        $out['etype'] = $event['etype'];
        
        $this->response($out,200);

    }

    //???-3:获取所有event列表
    function events_get()
    {

        $number=$this->get('num');
        $time_stamp=$this->get('time_stamp');
        $orderby=$this->get('orderby');

        if(empty($number))
        {
            $number=15;
        }
        if(empty($time_stamp))
        {
            $time_stamp=time();
        }
        if(empty($orderby))
        {  
            $orderby='created';
        }

        $this->load->model('event_model','',TRUE);
        $events = $this->event_model->get_entrys_bynothing($number,$time_stamp,$orderby);
        /*
        foreach ($events as &$x) 
        {
            $x['fellow_id'] = $x['fellow_url_token'];
            $x['event_id'] = $x['event_url_token'];
            unset($x['id']);
            unset($x['fellow_url_token']);
            unset($x['event_url_token']);
        }
        */
        foreach ($events as $key => $value) 
        {
            $out[$key]['event_id'] = $value['event_url_token']; 
            $out[$key]['title'] = $value['title'];
            $out[$key]['created'] = $value['created'];
            $out[$key]['description'] = $value['description'];
            $out[$key]['fields'] = $value['fields'];
            $out[$key]['locations'] = $value['locations']; 
            $out[$key]['target'] = $value['target'];
            $out[$key]['author_id'] = $value['fellow_url_token'];
            $out[$key]['author_first_name'] = $value['first_name']; 
            $out[$key]['author_last_name'] = $value['last_name']; 
            $out[$key]['start_date'] = $value['start_date'];
            $out[$key]['end_date'] = $value['end_date'];
            $out[$key]['etype'] = $value['etype'];        
        }

        $this->response($out,200);
    }
    //???-4获取一个指定Fellow所创建的Event列表
    function myevents_get($fellow_id='')
    {
        $fellow_url_token = $fellow_id;

        if(empty($fellow_url_token))
        {
            $this->response(array('error' => 'no fellow id '), 400);
        }

        $number=$this->get('num');
        $time_stamp=$this->get('time_stamp');
        $orderby=$this->get('orderby');

        if(empty($number))
        {
            $number=15;
        }
        if(empty($time_stamp))
        {
            $time_stamp=time();
        }
        if(empty($orderby))
        {  
            $orderby='created';
        }

        $this->load->model('event_model','',TRUE);
        $events = $this->event_model->get_entrys_byfellow_url_token($fellow_url_token,$number,$time_stamp,$orderby);
        /*
        foreach ($events as &$x) 
        {
            $x['fellow_id'] = $x['fellow_url_token'];
            $x['event_id'] = $x['event_url_token'];
            unset($x['id']);
            unset($x['fellow_url_token']);
            unset($x['event_url_token']);
        }
        */
        foreach ($events as $key => $value) 
        {
            $out[$key]['event_id'] = $value['event_url_token']; 
            $out[$key]['title'] = $value['title'];
            $out[$key]['created'] = $value['created'];
            $out[$key]['description'] = $value['description'];
            $out[$key]['fields'] = $value['fields'];
            $out[$key]['locations'] = $value['locations']; 
            $out[$key]['target'] = $value['target'];
            $out[$key]['author_id'] = $value['fellow_url_token'];
            $out[$key]['author_first_name'] = $value['first_name']; 
            $out[$key]['author_last_name'] = $value['last_name'];
            $out[$key]['start_date'] = $value['start_date'];
            $out[$key]['end_date'] = $value['end_date'];
            $out[$key]['etype'] = $value['etype']; 

        }

        $this->response($out,200);
    }

    //???-5:删除一个指定event_id的event
    function event_delete($event_id)
    {

        $fellow_url_token = $this->_auth_fellow(); 
        $event_url_token = $event_id;

        if(empty($event_url_token))
        {
            $this->response(array('error' => 'no event id '), 400);
        }
      
        $this->load->model('fellow_model','',TRUE);
        $fellow = $this->fellow_model->get_entry_byfellow_url_token($fellow_url_token);
        $fellow_id_1 = $fellow['id'];

        $this->load->model('event_model','',TRUE);
        $event=$this->event_model->get_entry_byevent_url_token($event_url_token);
        $fellow_id_2 = $event['fellow_id'];

        if($fellow_id_1!=$fellow_id_2)
        {
            $this->response(array('error' => 'you are not the author of the event'), 400);
        }
   
        $this->event_model->delete_entry_byevent_url_token($event_url_token);
        $this->response(array('error' => ''), 200);
    
    }

    // function event_get(){

    //     $json = $this->get('json');
    //     $arr = json_decode($json,TRUE);

    //     $event_token = $arr['event_id'];
    //     //event_id still not available
        
    //     $this->load->model('event_model','',TRUE );    
    //     //event_model still not available
	

    //     if(!empty($event_token)){
    //             $event_detail = $this->event_model->get_entry_bytoken($event_token);
    //             //this function still not available

    //             if(!empty($event_detail)){
    //                     $this->response($event_detail,200);}

    //             else{
    //                     $this->response('no such event',400);}

    //     }

    //     $number = $arr['num'];
    //     $time_stamp = $arr['time_stamp'];
    //     $orderby = $arr['orderby'];
    //     $member_token = $arr['member_id'];

    //     if(empty($number)){
    //             $number = 15;
    //     }
    //     if(empty($time_stamp)){
    //             $time_stamp=time();
    //     }
    //     if(empty($orderby)){
    //             $orderby='created';
    //     }
    //     if(!empty($member_token)){
    //             $this->load->model('member_model','',TRUE);
		
    //             $temp = $this->member_model->get_entry_bytoken($member_token);

    //             if(!empty($temp)){
    //                     $member_id = $temp['id'];
    //             }        
    //             else{
    //                     $this->response('no such  user',400);
    //             }
    //     }
    //     else{
    //             $member_id = $member_token;
    //     }

    //     $event = $this->event_model->get_data_bytoken($member_id,$time_stamp,$number,$orderby);
    //     if(!empty($event)){
    //             $this->response($event,200);
    //     }
    //     else{
    //             $this->response('no token',400);
    //     }     
    // }




}


