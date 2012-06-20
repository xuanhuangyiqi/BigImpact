<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';


class Wxy extends REST_Controller
{
    function member_get()
    {
        $token = $this->get('token');
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
        $email = $this->post('email');
        if (!empty($email))
        {
            $member['email'] = $this->post('email');
            $member['first_name'] = $this->post('first_name');
            $member['last_name'] = $this->post('last_name');
            $member['passwd'] = '000000';
            $member['url_token'] = rand()%1000000;
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
}


