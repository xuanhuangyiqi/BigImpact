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
        $stringJson = $this->put('stringJson');
        $in=json_decode($stringJson, true);
        

        //$this->response($in['url_token'], 200);

        $this->load->model('member_model', '', TRUE);

        $token  =  $in['url_token'];      
        $profile = $this->member_model->get_entry_bytoken($token);

        if(!empty($profile))
        {
        	$id = $profile['id'];
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

    

}
