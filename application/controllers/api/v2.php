<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';


class V2 extends REST_Controller
{  
    //公共函数！！！

    //admin权限判断
    private function _auth_admin()
    {
        $userdata=$this->session->userdata('userdata');

        if(empty($userdata))
        {
            $this->response(array('error' => 'not login'), 403);
        }
        if($userdata['auth']=='fellow')
        {
            $this->response(array('error' => 'you are a fellow,not a admin'), 403);
        }
        return 0;

    }
    //fellow权限判读
    private function _auth_fellow()
    {
        $userdata=$this->session->userdata('userdata');

        if(empty($userdata))
        {
            $this->response(array('error' => 'not login'), 403);
        }
        if($userdata['auth']=='admin')
        {
            $this->response(array('error' => 'you are a admin,not a fellow'), 403);
        }
        return $userdata['fellow_id'];
    }


    //#1、测试环境配置相关API

    //1-1:重置数据库
    function reset_post()
    {
        $this->load->model('reset_model', '', TRUE); 
        
        $flag = $this->reset_model->reset();

        if($flag == 0)
        {   
            $this->response(array('error' =>'0'), 200);
        }
        else
        {
            $this->response(array('error' =>'1'), 400);
        }
    }

    //#2、账号登陆与退出相关API
   
    function session_post()
    {
        $json = $this->post('json');
        $in =json_decode($json,TRUE);

        $auth = $in['auth'];
        $email = $in['email'];
        $password = $in['password'];

        //2-1:Admin登录
        if($auth == 0)
        {

            if(empty($email))
            {
                $this->response(array('error' => 'email is empty'), 400);
            }
           
            $this->load->model('admin_model', '', TRUE);  

            $admin = $this->admin_model->get_entry_byemailandpassword($email,$password);

            if(empty($admin))
            {
                $this->response(array('message' => 'user or password is not correct'), 400);
            }
            
            $userdata['auth'] = 'admin';
            $userdata['email'] = $admin['email'];

            $this->session->set_userdata('userdata',$userdata);
            $this->response(array('message' => 'log in success'), 200);

        }
        //2-2Fellow登录
        else
        {
            if(empty($email))
            {
                $this->response(array('error' => 'email is empty'), 400);
            }
           
            $this->load->model('fellow_model', '', TRUE);  

            $fellow = $this->fellow_model->get_entry_byemailandpassword($email,$password);

            if(empty($fellow))
            {
                $this->response(array('message' => 'user or password is not correct'), 400);
            }

            $userdata['auth'] = 'fellow';
            $userdata['email'] = $fellow['email'];
            $userdata['fellow_id'] = $fellow['fellow_url_token'];

            $this->session->set_userdata('userdata',$userdata);
            $this->response(array('message' => 'log in success'), 200);
        }
    }
    
    //2-3:登出
    function session_delete()
    {
        $this->session->sess_destroy();
        $this->response(array('message' => 'log out success'), 200);
    }

    //2-4:获取当前Session
    function session_get()
    {
        $userdata=$this->session->userdata('userdata');

        if(empty($userdata))
        {
            $this->response(array('error' => 'no session'), 400);
        }
        else
        {
         
            $this->response(array($userdata), 200); 
        }
    }

    //#3、Admin管理操作

    //3-1创建一个Admin账号
    function admin_post()
    {

        $this->_auth_admin();

        $json = $this->post('json');
        $in =json_decode($json,TRUE);

        $email = $in['email'];
        $first_name = $in['first_name'];
        $last_name = $in['last_name'];
               
        if(empty($email))
        {
            $this->response(array('error'=>'no email'), 400);
        }
   
        $this->load->model('admin_model', '', TRUE);    
        $admin = $this->admin_model->get_entry_byemail($in['email']); 

        if (!empty($admin))
        {
            $this->response(array('error'=>'email is exist'), 400);
        }

        $data['email'] = $email;
        $data['first_name'] = $first_name;
        $data['last_name'] = $last_name;
        $data['password'] = rand(100000,999999);
        $data['created'] = time();
            
        $this->admin_model->insert_entry($data);
        /*
        //发送邮件。
        {
            $this->load->library('email');
            $this->email->from('amdin@omarhub.com', 'Omar Hub');
            $this->email->to($data['email']); 
            $this->email->subject('Welcome to join Omar Hub');
            $html="Dear ".$data['last_name']." ".$data['first_name']."\n."."Welcome to Omar Hub!"."\n"."You are admin of Omarhub"."\n"."Your account\n"."Email:".$data['email']."\n"."Password:".$data['password'];
            $this->email->message($html);  
            $this->email->send();
        }
        */
        $out['email'] = $data['email'];
        $out['first_name'] = $data['first_name'];
        $out['last_name'] = $data['last_name'];
        $out['password'] = $data['password'];

        $this->response($out, 200);

    }
//3-2创建一个Fellow账号
    function fellow_post()
    {

        $this->_auth_admin();

        $json = $this->post('json');
        $in =json_decode($json,TRUE);

        $email = $in['email'];
        $first_name = $in['first_name'];
        $last_name = $in['last_name'];
               
        if(empty($email))
        {
            $this->response(array('error'=>'no email'), 400);
        }
   
        $this->load->model('fellow_model', '', TRUE);    
        $fellow = $this->fellow_model->get_entry_byemail($in['email']); 

        if (!empty($fellow))
        {
            $this->response(array('error'=>'email is exist'), 400);
        }

        $data['email'] = $email;
        $data['first_name'] = $first_name;
        $data['last_name'] = $last_name;
        $data['password'] = rand(100000,999999);
        $data['created'] = time();
        $data['fellow_url_token'] = rand() % 1000000;
            
        $this->fellow_model->insert_entry($data);
        /*
        //发送邮件。
        {
            $this->load->library('email');
            $this->email->from('amdin@omarhub.com', 'Omar Hub');
            $this->email->to($data['email']); 
            $this->email->subject('Welcome to join Omar Hub');
            $html="Dear ".$data['last_name']." ".$data['first_name']."\n."."Welcome to Omar Hub!"."\n"."You are fellow of Omarhub"."\n"."Your account\n"."Email:".$data['email']."\n"."Password:".$data['password'];
            $this->email->message($html);  
            $this->email->send();
        }
        */
        $out['email'] = $data['email'];
        $out['first_name'] = $data['first_name'];
        $out['last_name'] = $data['last_name'];
        $out['password'] = $data['password'];

        $this->response($out, 200);

    }

    //#4、Fellow账号操作

    //4-1:获取当前登陆的Fellow信息
    //4-2:获取一个制定的Fellow信息
    function fellow_get($fellow_id = '')
    {

        $fellow_url_token = $this->_auth_fellow();

        if($fellow_id !='')
        {
            $fellow_url_token = $fellow_id;
        } 

        $this->load->model('fellow_model', '', TRUE);  
            
        $fellow = $this->fellow_model->get_entry_byfellow_url_token($fellow_url_token);

        if (empty($fellow))
        {   
            $this->response(array('error' => 'we don not have this fellow'), 400);
        }
        
        $out['first_name'] = $fellow['first_name'];
        $out['last_name'] = $fellow['last_name'];
        $out['email'] = $fellow['email'];
        $out['created'] = $fellow['created'];
        $out['gender'] = $fellow['gender'];
        $out['language'] = $fellow['language'];
        $out['job'] = $fellow['job'];
        $out['location'] = $fellow['location'];
        $out['target'] = $fellow['target'];
        $out['country'] = $fellow['country'];
        $out['state'] = $fellow['state'];
        $out['city'] = $fellow['city'];
        $out['street'] = $fellow['street'];
        $out['zip'] = $fellow['zip'];
        $out['mobile'] = $fellow['mobile'];
        $out['mobile_country_code'] = $fellow['mobile_country_code'];
        $out['mail'] = $fellow['mail'];
        $out['mail_option'] = $fellow['mail_option'];
        $out['fellow_id'] = $fellow['fellow_url_token'];
        
    
        $this->response($out, 200);
        
    }
    //4-3:修改当前登陆的Fellow信息

    function fellow_put()
    {
        
        $fellow_url_token = $this->_auth_fellow(); 
        $json = $this->put('json');
        $in=json_decode($json, true);

        $this->load->model('fellow_model', '', TRUE);

        $data['first_name'] = $in['first_name'];
        $data['last_name'] = $in['last_name'];
        $data['gender'] = $in['gender'];
        $data['language'] = $in['language'];
        $data['job'] = $in['job'];
        $data['location'] = $in['location'];
        $data['target'] = $in['target'];
        $data['country'] = $in['country'];
        $data['state'] = $in['state'];
        $data['city'] = $in['city'];
        $data['street'] = $in['street'];
        $data['zip'] = $in['zip'];
        $data['mobile'] = $in['mobile'];
        $data['mobile_country_code'] = $in['mobile_country_code'];
        $data['mail'] = $in['mail'];
        $data['mail_option'] = $in['mail_option'];

        $updatestatus = $this->fellow_model->update_entry($fellow_url_token, $data);
        if ($updatestatus == 1)
        {
               $this->response(array('error' =>''), 200);
        }
        else
        {
              $this->response(array('error' => 'update error'), 400);
        }
        
    }

    //#5、offer相关操作

    //5-1:创建一个Offer
    function offer_post()
    {

        $fellow_url_token = $this->_auth_fellow(); 

        $json = $this->post('json');
        $in = json_decode($json,TRUE); 

        $title = $in['title'];
        $description = $in['description'];
        $fields = $in['fields'];
        $locations = $in['locations'];
        $target = $in['target'];  
    
        $this->load->model('offer_model','',TRUE);
        $this->load->model('fellow_model','',TRUE);

        $fellow=$this->fellow_model->get_entry_byfellow_url_token($fellow_url_token);
             
        $data['fellow_id'] = $fellow['id'];
        $data['title'] = $title;
        $data['description'] = $description;
        $data['created'] = time();
        $data['offer_url_token'] = rand() % 1000000;
        $data['fields']=$fields;
        $data['locations']=$locations;
        $data['target']=$target;

        $this->offer_model->insert_entry($data);

        $this->response(array('error' =>'', ),200);

    }

    //5-2获取一个指定Offer_id的Offer信息
    function offer_get($offer_id='')
    {
        $offer_url_token = $offer_id;

        if(empty($offer_url_token))
        {
            $this->response(array('error' => 'no offer id '), 400);
        }
        $this->load->model('offer_model','',TRUE);
        $offer = $this->offer_model->get_entry_byoffer_url_token($offer_url_token);
        
        if(empty($offer))
        {
           $this->response(array('error' => 'no this offer'), 400); 
        }
        
        $out['offer_id'] = $offer['offer_url_token']; 
        $out['title'] = $offer['title'];
        $out['description'] = $offer['description'];
        $out['created'] = $offer['created'];
        $out['fields'] = $offer['fields'];
        $out['locations'] = $offer['locations'];
        $out['target'] = $offer['target'];
        $out['author_id'] = $offer['fellow_url_token'];
        $out['author_first_name'] = $offer['first_name'];
        $out['author_last_name'] = $offer['last_name'];
        
        $this->response($out,200);

    }

    //5-3获取所有Offer列表
    function offers_get()
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

        $this->load->model('offer_model','',TRUE);
        $offers = $this->offer_model->get_entrys_bynothing($number,$time_stamp,$orderby);
        /*
        foreach ($offers as &$x) 
        {
            $x['fellow_id'] = $x['fellow_url_token'];
            $x['offer_id'] = $x['offer_url_token'];
            unset($x['id']);
            unset($x['fellow_url_token']);
            unset($x['offer_url_token']);
        }
        */
        foreach ($offers as $key => $value) 
        {
            $out[$key]['offer_id'] = $value['offer_url_token']; 
            $out[$key]['title'] = $value['title'];
            $out[$key]['created'] = $value['created'];
            $out[$key]['description'] = $value['description'];
            $out[$key]['fields'] = $value['fields'];
            $out[$key]['locations'] = $value['locations']; 
            $out[$key]['target'] = $value['target'];
            $out[$key]['author_id'] = $value['fellow_url_token'];
            $out[$key]['author_first_name'] = $value['first_name']; 
            $out[$key]['author_last_name'] = $value['last_name']; 
        }

        $this->response($out,200);
    }

    //5-4获取一个指定Fellow所创建的Offer列表
    function myoffers_get($fellow_id='')
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

        $this->load->model('offer_model','',TRUE);
        $offers = $this->offer_model->get_entrys_byfellow_url_token($fellow_url_token,$number,$time_stamp,$orderby);
        /*
        foreach ($offers as &$x) 
        {
            $x['fellow_id'] = $x['fellow_url_token'];
            $x['offer_id'] = $x['offer_url_token'];
            unset($x['id']);
            unset($x['fellow_url_token']);
            unset($x['offer_url_token']);
        }
        */
        foreach ($offers as $key => $value) 
        {
            $out[$key]['offer_id'] = $value['offer_url_token']; 
            $out[$key]['title'] = $value['title'];
            $out[$key]['created'] = $value['created'];
            $out[$key]['description'] = $value['description'];
            $out[$key]['fields'] = $value['fields'];
            $out[$key]['locations'] = $value['locations']; 
            $out[$key]['target'] = $value['target'];
            $out[$key]['author_id'] = $value['fellow_url_token'];
            $out[$key]['author_first_name'] = $value['first_name']; 
            $out[$key]['author_last_name'] = $value['last_name']; 

        }

        $this->response($out,200);
    }

    //5-5删除一个指定Offer_id的Offer
    function offer_delete($offer_id)
    {

        $fellow_url_token = $this->_auth_fellow(); 
        $offer_url_token = $offer_id;

        if(empty($offer_url_token))
        {
            $this->response(array('error' => 'no offer id '), 400);
        }
      
        $this->load->model('fellow_model','',TRUE);
        $fellow = $this->fellow_model->get_entry_byfellow_url_token($fellow_url_token);
        $fellow_id_1 = $fellow['id'];

        $this->load->model('offer_model','',TRUE);
        $offer=$this->offer_model->get_entry_byoffer_url_token($offer_url_token);
        $fellow_id_2 = $offer['fellow_id'];

        if($fellow_id_1!=$fellow_id_2)
        {
            $this->response(array('error' => 'you are not the author of the offer'), 400);
        }
   
        $this->offer_model->delete_entry_byoffer_url_token($offer_url_token);
        $this->response(array('error' => ''), 200);
    
    }

    //#6、Fellow与Offer之间的关系

    //6-1:关注一个offer
    
    function followoffer_post($offer_id='')
    {   
        
        $fellow_url_token = $this->_auth_fellow(); 
        $offer_url_token = $offer_id;
            
        $this->load->model('fellow_model', '', TRUE);   
        $fellow = $this->fellow_model->get_entry_byfellow_url_token($fellow_url_token);
    
        $this->load->model('offer_model', '', TRUE);   
        $offer = $this->offer_model->get_entry_byoffer_url_token($offer_url_token);
        
        if(empty($offer))
        {
            $this->response(array('error' => 'no such member or no such offer'), 400);
        }
        
        $fellow_id = $fellow['id'];
        $offer_id = $offer['id'];

        $data['fellow_id'] = $fellow_id;
        $data['offer_id'] = $offer_id;
        $data['created'] = time();

        $this->load->model('follow_offer_model','',TRUE);

        $this->follow_offer_model->insert_entry($data);

        $this->response(array('error'=>'insert success'), 200);

    }
    
    //6-2:取消关注一个offer
    function followoffer_delete($offer_id='')
    {
        $fellow_url_token = $this->_auth_fellow(); 
        $offer_url_token = $offer_id;
 
        $this->load->model('fellow_model', '', TRUE);   
        $fellow = $this->fellow_model->get_entry_byfellow_url_token($fellow_url_token);
    
        $this->load->model('offer_model', '', TRUE);   
        $offer = $this->offer_model->get_entry_byoffer_url_token($offer_url_token);
        
        if(empty($offer))
        {
            $this->response(array('error' => 'no such member or no such offer'), 400);
        }
        
        $fellow_id = $fellow['id'];
        $offer_id = $offer['id'];


        $this->load->model('follow_offer_model','',TRUE);

        $res = $this->follow_offer_model->delete_entry($fellow_id,$offer_id);

        if ($res == 1)
        {
            $this->response(array('error' =>'delete success'), 200);
        }
        else
        {
            $this->response(array('error' => 'delete error'), 400);
        }

    }
}


