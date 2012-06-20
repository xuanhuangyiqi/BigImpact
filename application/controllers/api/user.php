<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class User extends REST_Controller
{
    function profile_get()
    {
        $token = $this->get('token');
        if (!empty($token))
        {
            $this->load->model('member_model', '', TRUE);  //加载USER模型
            $member = $this->member_model->get_entry_bytoken($token);
            if (!empty($member))
            {
                $this->load->model('auth_model', '', TRUE);  //加载USER模型
                $auth = $this->auth_model->get_entry_byid($member['auth_id']);
                $this->response(array(
                        'first_name' =>     $auth['first_name'],
                        'last_name' =>      $auth['last_name'],
                        'avatar_path' =>    $member['avatar_path'],
                        'gender' =>         $member['gender'],
                        'language' =>       $member['language'],
                        'job' =>            $member['job'],
                        'location' =>       $member['location']), 200);
            }
            else
                $this->response('token error', 200);
        }
        else
            $this->response('no token', 200);
    }


    function profileexist_get()
    {
        $id = $this->get('id');
        if (!empty($id))
        {
            $this->load->model('auth_model', '', TRUE);  //加载USER模型
            $auth = $this->auth_model->get_entry_byid($id);//调用USER模型中的方法
            if (!empty($auth))
            {
                if (empty($auth['object_id']))
                {
                    if ($auth['utype'] == 1) //is_member
                    {
                        $member_data['url_token'] = rand()%1000000000;
                        $member_data['auth_id'] = $id+0;
                        $member_data['created'] = time();
                        $this->load->model('member_model', '', TRUE);  //加载USER模型
                        $res = $this->member_model->insert_entry($member_data);
                        if (!empty($res))
                        {
                            $this->auth_model->update_entry($id, array('object_id'=>$res));
                            $this->response(array('res' => $res), 200);
                        }
                        else
                            $this->response(array('res' => $res, 'error'=>'update_error'), 200);
                    }
                    else if ($auth['utype'] == 0)//is_admin
                    {
                        $admin_data['auth_id'] = $id+0;
                        $admin_data['created'] = time();
                        $this->load->model('admin_model', '', TRUE);  //加载USER模型
                        $res = $this->admin_model->insert_entry($admin_data);
                        if (!empty($res))
                        {
                            $this->auth_model->update_entry($id, array('object_id'=>$res));
                            $this->response(array('res' => $res), 200);
                        }
                        else
                            $this->response(array('res' => $res, 'error'=>'update_error'), 200);
                    }
                    else
                        $this->response(array('res' => 0), 200);
                    
                }
                else
                    $this->response(array('res' => 0), 200);
            }
            else
                $this->response(array('error' => 'no such id in auth'), 200);
        }
        else
            $this->response(array('error' => 'no id'), 404);
            
    }


    function auth_get()
    {
        
        $id = $this->get('id');//用GET方法获取UID


        if(empty($id))
        {
            $this->response(array('error' => 'no id'), 400);
        }
        else
        {
            $this->load->model('auth_model', '', TRUE);  //加载USER模型

            $auth = $this->auth_model->get_entry_byid($id);//调用USER模型中的方法




            
            if(!empty($auth))
            {

                $out['id'] = $auth['id'];
                $out['name'] = $auth['first_name'];
                $out['createTime'] = $auth['created'];

                $this->response($out, 200); // 200 being the HTTP response code
            }

            else
            {
                $this->response(array('error' => 'no such id in auth'), 404);
            }
        }
    }

    function auth_put()
    {
        
        $in['email'] = $this->put('email');
        $in['first_name'] = $this->put('firstname');
        $in['last_name'] = $this->put('lastname');
        
       


        // TODO password generate
        $in['passwd'] = "123";
        
        // "1" means member "0" means admin
        $in['utype'] = 1;

        $system_time = time();
        $in['created'] = $system_time;

        if(empty($in))
        {
            $this->response(array('error' => 'no info about the auth'), 404);
        }
        else
        {
            #print_r($in);
            $this->load->model('auth_model', '', TRUE);  //加载USER模型

            $auth = $this->auth_model->get_entry_bymail($in['email']);

            if(!empty($auth))
            {
                //$out['email'] = $auth['email'];
               $this->response(array('error' => 'email already exits'), 200);
            }

            else
            {

                $id = $this->auth_model->insert_entry($in);//调用USER模型中的方法
            
            

                if(!empty($id))
                {
                    $out['id'] = $id;
                    $this->response($out, 201); //200成功 
                } 

                else
                {
                    $this->response(array('error' => 'can not insert'), 404); //400失败
                }
            }

            
        }
    }

    function auth_delete()
    {
        
        $id = $this->get('id');

        if(empty($id))
        {
            $this->response(array('error' => '...no id auth in table auth'), 404);
        }
        else
        {
            $this->load->model('auth_model', '', TRUE);  //加载USER模型

            $this->auth_model->delete_entry_byid($id);//调用USER模型中的方法
            
            $user = $this->auth_model->get_entry_byid($id);//调用USER模型中的方法

            if(empty($user))
            {
                $this->response(array('error' => 'success'), 200); 
            }

            else
            {
                $this->response(array('error' => 'fail'), 400);
            }
        }
    }

}
