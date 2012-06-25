<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';


class Wxy extends REST_Controller
{
    
    function member_get()
    {
        
        $userdata=$this->session->userdata('userdata');

        if(empty($userdata))
        {
            $this->response(array('error' => 'not login'), 403);
        }
        else
        {
            if($userdata['auth']==1)
            {
                $json = $this->get('json');
                $arr = json_decode($json, TRUE);
                $token = $arr['token'];

                if (!empty($token))
                {
                    $this->load->model('member_model', '', TRUE);  
                    $member = $this->member_model->get_entry_bytoken($token);
                    if (!empty($member))
                    {
                        unset($member['id']);
                        unset($member['email']);
                        unset($member['passwd']);
                        $this->response($member, 200);
                    }
                    else
                        $this->response('token error', 400);
                }
                else
                $this->response('no token', 400);
                    
                }
                else
                {
                    $this->response(array('error' => 'you are not a member'), 403);
                }

        }
        
    }


    function member_post()
    {
        
        $userdata=$this->session->userdata('userdata');

        if(empty($userdata))
        {
            $this->response(array('error' => 'not login'), 403);
        }
        else
        {
            if($userdata['auth']==0)
            {
                $json = $this->post('json');
                $arr = json_decode($json, TRUE);
                $email = $arr['email'];
                if (!empty($email))
                {
                    $member = $arr;
                    $member['passwd'] = rand(100000,999999);
                    $member['url_token'] = rand() % 1000000;
                    $member['created'] = time();
                    $this->load->model('member_model', '',TRUE);
                    $m = $this->member_model->get_entry_byemail($member['email']);
                    if (!empty($m))
                    {
                        $this->response(array('error'=>'dup email'), 400);
                    }
                    else
                    {
                        $res = $this->member_model->insert_entry($member);

                        {             
                            $this->load->library('email');
                            $this->email->from('amdin@omarhub.com', 'Omar Hub');
                            $this->email->to($email); 
                            $this->email->subject('Welcome to join Omar Hub');
                            $html="Dear ".$member['last_name']." ".$member['first_name']."\n."."Welcome to Omar Hub!"."\n"."Your account\n"."Email:".$member['email']."\n"."Password:".$member['passwd'];
                            $this->email->message($html);  
                            $this->email->send();
                        }

                        $this->response($member['url_token'], 200);
                    }
                }
                else
                    $this->response(array('error' => 'no email'), 400);
                
            }
            else
            {
                $this->response(array('error' => 'you are not a admin'), 403);
            }

        }
        
    }

    function admin_post()
    {
        
        $userdata=$this->session->userdata('userdata');


        if(empty($userdata))
        {
            $this->response(array('error' => 'not login'), 403);
        }
        else
        {
            if($userdata['auth']==0)
            {   
                

                $json = $this->post('json');
                
                //$arrr ='{"email":"huiter@vip.qq.com","first_name":"hui","last_name":"ter"}';
                $arr =json_decode($json,TRUE);
                //$this->response(array('error'=>$arr), 200);
                $email = $arr['email'];


                if (!empty($email))
                {   
                    $this->load->model('admin_model', '', TRUE);
                    
                    $admin = $arr;
                    
                    $admin['passwd'] = rand(100000,999999);
                    $admin['created'] = time();
    
                    $a = $this->admin_model->get_entry_byemail($admin['email']); 
                    if (!empty($a))
                    {
                        $this->response(array('error'=>'dup email'), 400);
                    }
                    
                    else
                    {
                        $res = $this->admin_model->insert_entry($admin);

                        {             
                            $this->load->library('email');
                            $this->email->from('amdin@omarhub.com', 'Omar Hub');
                            $this->email->to($email); 
                            $this->email->subject('Welcome to join Omar Hub');
                            $html="Dear ".$admin['last_name']." ".$admin['first_name']."\n."."Welcome to Omar Hub!"."\n"."You are admin of Omarhub"."\n"."Your account\n"."Email:".$admin['email']."\n"."Password:".$admin['passwd'];
                            $this->email->message($html);  
                            $this->email->send();
                        }

                        $this->response($admin, 200);
                    }
                     
                }
           
                else
                {
                    $this->reponse(array('error'=>'no mail'), 400);
                }

                
            }
            else
            {
                $this->response(array('error' => 'you are not a admin'), 403);
            }

        }
    }
  
}


