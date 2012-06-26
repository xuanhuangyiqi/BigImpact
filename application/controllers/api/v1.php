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

    function offer_post()
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
                $json = $this->post('json');
                $arr = json_decode($json,TRUE); //$arr includes member_id and all the information that an offer needs
                $title=$arr['title'];   
                $id=$userdata['url_token'];

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
                        $this->response(array('error' => 'id error'),400);
                    }
                }
                else
                {
                    $this->response(array('error' => $id,'error2' => $title,'json'=>$arr),400);
                }
            }
       
            else
            {
                $this->response(array('error' => 'you are not a member'), 403);
            }

        }
    }
    function follow_offer_post()
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

                $stringJson = $this->post('json');


                $in=json_decode($stringJson, true);
            

               //通过member的url_token获得member的id
                $this->load->model('member_model', '', TRUE);  
                $member_token  =  $userdata['url_token'];    
                $member = $this->member_model->get_entry_bytoken($member_token);
                

               //通过offer的url_token获得offer的id
                $this->load->model('offer_model', '', TRUE);
                $offer_token  =  $in['offer_url_token'];     
                $offer = $this->offer_model->get_entry_bytoken($offer_token);

                
                

                if(!empty($member)&& !empty($offer))
                {
                     $member_id = $member['id'];
                     $offer_id = $offer['id'];



                     $follow_offer_data['member_id'] = $member_id;
                     $follow_offer_data['created'] = time();
                     $follow_offer_data['offer_id'] = $offer_id;

                     $this->load->model('followoffer_model','',TRUE);

                     $res = $this->followoffer_model->insert_entry($follow_offer_data);

                     $this->response(array('error'=>'insert success'), 200);
                    
                }
                else
                {
                     $this->response(array('error' => 'no such member or no such offer'), 400);
                }
            }
       
            else
            {
                $this->response(array('error' => 'you are not a member'), 403);
            }

        }
    }
    function follow_offer_delete()
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
                $stringJson = $this->delete('json');

                $in=json_decode($stringJson, true);
               
               //通过member的url_token获得member的id
                $this->load->model('member_model', '', TRUE);
                $member_token  =  $userdata['url_token'];    
                $member = $this->member_model->get_entry_bytoken($member_token);

                //$this->response($in['member_url_token'], 200);

                //通过offer的url_token获得offer的id
                $this->load->model('offer_model', '', TRUE);
                $offer_token  =  $in['offer_url_token'];     
                $offer = $this->offer_model->get_entry_bytoken($offer_token);

                if(!empty($member)&& !empty($offer))
                {
                     $member_id = $member['id'];
                     $offer_id = $offer['id'];


                     $this->load->model('followoffer_model','',TRUE);

                     $res = $this->followoffer_model->delete_entry($member_id,$offer_id);

                     if ($res == 1)
                     {
                           $this->response(array('error' =>'delete success'), 200);
                     }
                     else
                     {
                          $this->response(array('error' => 'delete error'), 400);
                     }
                }
                else
                {
                     $this->response(array('error' => 'no such member or no such offer'), 400);
                }
            }
       
            else
            {
                $this->response(array('error' => 'you are not a member'), 403);
            }

        }
    }

    function offer_get()//$member_id(member_token)='',$time_stamp='now',$num='10',$orderby='created',$offer_id(offer_token)=''
    {
          $this->load->model('member_model','',TRUE);
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
            {      
                $token_arr = $this->member_model->ids2tokens(array($offer_detail['member_id']));
                //$this->response($token_arr,200);
                $offer_detail['member_id'] = $token_arr[$offer_detail['member_id']];
                $this->response($offer_detail,200);
            }
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
            
            $aarr = array();
            foreach ($offer as $x)
                array_push($aarr, $x['member_id']);
         
            $ids2tokens = $this->member_model->ids2tokens($aarr);
           // $this->response($ids2tokens,200);
            foreach ($offer as &$x)
            {

                $x['member_id'] = $ids2tokens[($x['member_id'])];
                //$this->response($ids2tokens,200);
                unset($x['id']);
            }
            $this->response($offer,200);
            
        }
        else
        {
            offer = array()
            $this->response(offer, 200);
        }   
    }
    
}


