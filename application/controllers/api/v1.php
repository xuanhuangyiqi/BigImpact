<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';


class V1 extends REST_Controller
{  
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
    
    function session_post()
    {
        $json = $this->post('json');
        $arr =json_decode($json,TRUE);

        $auth = $arr['auth'];
        $email = $arr['email'];
        $password = $arr['password'];

        /*
        $auth = $this->post('auth');
        $email = $this->post('email');
        $password = $this->post('password');
        */
        

        if($auth == 0)
        {

            if(empty($email))
            {
                $this->response(array('error' => 'email is empty'), 400);
            }
            else
            {
                $this->load->model('admin_model', '', TRUE);  

                $admin = $this->admin_model->get_entry_byemailandpassword($email,$password);

                if(!empty($admin))
                {
                    $userdata['auth'] = 0;
                    $userdata['email'] = $admin['email'];
                    $userdata['url_token'] = '';

                    $this->session->set_userdata('userdata',$userdata);

                    $this->response(array('message' => 'log in success'), 200);
                }
                else
                {
                    $this->response(array('message' => 'user or password is not correct'), 400);
                }

            }
        }
        else
        {
            if(empty($email))
            {
                $this->response(array('error' => 'email is empty'), 400);
            }
            else
            {
                $this->load->model('member_model', '', TRUE);  

                $member = $this->member_model->get_entry_byemailandpassword($email,$password);

                if(!empty($member))
                {
                    $userdata['auth'] = '1';
                    $userdata['email'] = $member['email'];
                    $userdata['url_token'] = $member['url_token'];
                    $this->session->set_userdata('userdata',$userdata);

                    $this->response(array('message' => 'log in success'), 200);
                }
                else
                {
                    $this->response(array('message' => 'user or password is not correct'), 400);
                }

            }
        }
    }

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

    function session_delete()
    {
        $this->session->sess_destroy();
        $this->response(array('message' => 'log out success'), 200);
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
                
                $arr =json_decode($json,TRUE);
                $email = $arr['email'];

                if (!empty($email))
                {   
                    $this->load->model('admin_model', '', TRUE);
                    
                    $admin['email'] = $arr['email'];
                    $admin['first_name'] = $arr['first_name'];
                    $admin['last_name'] = $arr['last_name'];
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

                        $out['email'] = $admin['email'];
                        $out['first_name'] = $admin['first_name'];
                        $out['last_name'] = $admin['last_name'];

                        $this->response($out, 200);
                    }
                     
                }
           
                else
                {
                    $this->response(array('error'=>'no mail'), 400);
                }

                
            }
            else
            {
                $this->response(array('error' => 'you are not a admin'), 403);
            }

        }
    }

    function fellow_post()
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

    function fellow_put()
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
                $stringJson = $this->put('json');
                $in=json_decode($stringJson, true);
       
                $this->load->model('member_model', '', TRUE);

                $token  =  $in['url_token']; 
                if($token == $userdata['url_token'])
                {    
                    $member = $this->member_model->get_entry_bytoken($token);

                    if(!empty($member))
                    {
                         $id = $member['id'];
                         $updatestatus = $this->member_model->update_entry($id, $in);
                         if ($updatestatus == 1)
                         {
                               $this->response(array('error' =>''), 200);
                         }
                         else
                         {
                              $this->response(array('error' => 'update error'), 400);
                         }
                    }
                    else
                    {
                         $this->response(array('error' => 'no such member'), 400);
                    }
                }
                else
                {
                    $this->response(array('error' => 'you are not a this member'), 403);
                }
            }
       
            else
            {
                $this->response(array('error' => 'you are not a member'), 403);
            }

        }
    }

    function fellow_get($url_token = '')
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
                if($url_token =='')
                {
                    $token = $userdata['url_token'];
                } 
                else
                {
                    $token = $url_token;
                }

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
      
}


