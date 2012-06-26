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
                $stringJson = $this->put('stringJson');
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

    function follow_offer_post()
    {
        
        $stringJson = $this->post('json');


        $in=json_decode($stringJson, true);
    

       //通过member的url_token获得member的id
        $this->load->model('member_model', '', TRUE);  
        $member_token  =  $in['member_url_token'];     
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

    function follow_offer_delete()
    {
       
        $stringJson = $this->delete('json');

        $in=json_decode($stringJson, true);
       
       //通过member的url_token获得member的id
        $this->load->model('member_model', '', TRUE);
        $member_token  =  $in['member_url_token'];     
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

    function member_follow_offer_get()
    {
       
        $stringJson = $this->get('json');

        $in=json_decode($stringJson, true);

        
       
       //通过member的url_token获得member的id
        $this->load->model('member_model', '', TRUE);
        $member_token  =  $in['member_url_token'];     
        $member = $this->member_model->get_entry_bytoken($member_token);


        //根据member_id取关注的offer_id
        if(!empty($member))
        {
             $member_id = $member['id'];

             $this->load->model('followoffer_model','',TRUE);

             $array = $this->followoffer_model->get_offerid_bymemberid($member_id);

             if(empty($array))
             {
                $this->response(array('error' => 'member no  '), 400);
             }

             $offer_ids = array();

             foreach ($array as &$value) 
             {
                 unset($value['member_id']);
                 unset($value['created']);
                 array_push($offer_ids,$value['offer_id']); 
             }

             //$this->response($offer_ids, 200);

             $this->load->model('offer_model','',TRUE);

             $offer = $this->offer_model->get_data_byids($offer_ids);



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
                $this->response(array('error' => 'no offer'), 400);
            }  

             
        }
        else
        {
             $this->response(array('error' => 'no such member '), 400);
        }
    }


}
