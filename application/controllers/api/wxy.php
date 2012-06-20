<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';


class Wxy extends REST_Controller
{
    function member_get()
    {
        $json = $this->get('json');
        $arr = json_decode($json, TRUE);
        $token = $arr['token'];

        if (!empty($token))
        {
            $this->load->model('member_model', '', TRUE);  //加载USER模型
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

    function member_post()
    {
        $json = $this->post('json');
        $arr = json_decode($json, TRUE);
        $email = $arr['email'];
        if (!empty($email))
        {
            $member = $arr;
            $member['passwd'] = '000000';
            $member['url_token'] = rand() % 1000000;
            $member['created'] = time();
            $this->load->model('member_model', '',TRUE);
            $m = $this->member_model->get_entry_bymail($member['email']);
            if (!empty($m))
                $this->response(array('error'=>'dup email'), 400);
            $res = $this->member_model->insert_entry($member);
            $this->response($member['url_token'], 200);
        }
        else
            $this->response(array('error' => 'no email'), 400);
    }
    function admin_post()
    {
        $json = $this->post('json');
        $arr = json_decode($json, TRUE);
        $email = $arr['email'];
        if (!empty($email))
        {
            $admin = $arr;
            $admin['passwd'] = '000000';
            $admin['created'] = time();
            $this->load->model('admin_model', '', TRUE);
            $a = $this->admin_model->get_entry_bymail($admin['email']); 
            if (!empty($a))
                $this->response(array('error'=>'dup email'), 400);
            $res = $this->admin_model->insert_entry($admin);
            $this->response($admin, 200);
        }
        else $this->reponse(array('error'=>'no mail', 400));
    }
}


