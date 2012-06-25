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

class Auth extends REST_Controller
{
    function AdminLogin_post()
    {

        $email = $this->post('email');
        $password = $this->post('password');

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
                $userdata['auth'] = '0';
                $userdata['email'] = $admin['email'];
                $this->session->set_userdata('userdata',$userdata);
                $this->response(array('message' => 'log in success'), 200);
            }
            else
            {
                $this->response(array('message' => 'user or password is not correct'), 400);
            }

        }
    }
    function IsAdminLogin_post()
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
                $this->response(array('error' => 'you are a admin'), 200); 
            }
            else
            {
                $this->response(array('error' => 'you are not a admin'), 403);
            }

        }
    }

    
    function AdminLogout_post()
    {
        $this->session->sess_destroy();
        $this->response(array('message' => 'log out success'), 200);
    }

    function MemberLogin_post()
    {
        $email = $this->post('email');
        $password = $this->post('password');

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
                $this->session->set_userdata('userdata',$userdata);
                $this->response(array('message' => 'log in success'), 200);
            }
            else
            {
                $this->response(array('message' => 'user or password is not correct'), 400);
            }

        }
    }

    function IsMemberLogin_post()
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
                $this->response(array('error' => 'you are a member'), 200); 
            }
            else
            {
                $this->response(array('error' => 'you are not a member'), 403);
            }

        }
    }

    function MemberLogout_post()
    {
        $this->session->sess_destroy();
        $this->response(array('message' => 'log out success'), 200);
    }
}
