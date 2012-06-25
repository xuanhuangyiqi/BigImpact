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

class Ht extends REST_Controller
{

    function thisAdmin_get()
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
                $this->load->model('admin_model', '', TRUE); 
                $email = $userdata['email'];
                $admin = $this->admin_model->get_entry_byemail($email);

                
                if(!empty($admin))
                {
                    $out['firstname'] = $admin['first_name'];
                    $out['lastname'] = $admin['last_name'];
                    $out['email'] = $admin['email'];
        
                    $this->response($out, 200);
                }
                else
                {
                    $this->response(array('error' => 'something be wrong'), 403);
                }
                
            }
            else
            {
                $this->response(array('error' => 'you are not a admin'), 403);
            }

        }

    }


    function thisMember_get()
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
                $this->load->model('member_model', '', TRUE); 
                $email = $userdata['email'];
                $member = $this->member_model->get_entry_byemail($email);

                
                if(!empty($member))
                {
                    $out['firstname'] = $member['first_name'];
                    $out['lastname'] = $member['last_name'];
                    $out['email'] = $member['email'];
        
                    $this->response($out, 200);
                }
                else
                {
                    $this->response(array('error' => 'something be wrong'), 403);
                }
                
            }
            else
            {
                $this->response(array('error' => 'you are not a admin'), 403);
            }

        }

    }
}
