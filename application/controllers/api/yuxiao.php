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

class Yuxiao extends REST_Controller
{
    function member_put()
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
                $this->response(array('error' => 'you are not a member'), 403);
            }

        }
    }
}
