<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * 
 * 
 * 
 *
 * @copyright  版权所有(C) 2014-2015 沈阳工业大学ACM实验室 沈阳工业大学网络管理中心 *Chen
 * @license    http://www.gnu.org/licenses/gpl-3.0.txt   GPL3.0 License
 * @version    
 * @link       https://github.com/SUTFutureCoder/
*/
class User_model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function get_user($user_number){
		$this->load->database();
		return $this->db->where(array('user_number'=>$user_number))->get('user')->result_array();
		 
	}

	public function user_sigin_up($user, $section){
		$this->load->database();
		$this->db->trans_start();
		$user_id = $this->db->insert_id('user', $user);
		foreach($section as $v):
			if($v != 0){
				$re_user_section = array(
					"user_id" => $user_id,
					"section_id" => $v,
					"valid" => -1
				);
				$this->db->insert('user', $re_user_section);
			}
		endforeach;
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
			return false;
		else
			return $user_id;	
	}

}