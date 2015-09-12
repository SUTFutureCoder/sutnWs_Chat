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

	public function user_sign_up($user, $section){
		$this->load->database();
		$result = $this->db->insert('user', $user);
		
		if($result){
			$a = $this->db->where(array('user_number'=>$user['user_number']))->get('user')->result_array();
			$user_id = $a[0]['user_id'];
                        
                        //插入角色——用户表
                        $this->db->insert('re_user_role', array(
                            'user_id' => $user['user_number'],
                            'role_id' => -1,
                        ));
                        
			foreach($section as $v):
				if($v != 0){
					$re_user_section = array(
						"user_id" => $user_id,
						"section_id" => $v,
						"valid" => 0
					);
					$this->db->insert('re_user_section', $re_user_section);
				}
			endforeach;
			if ($user_id)
				return $user_id;
			else
				return false;
		}	
	}

	/**    
	 *  @Purpose:    
	 * 面试官打分
	 *     
	 *  @Method Name:
	 *  getRule
	 *  @Parameter: 
	 * 
	 *  @Return: 
	 *  
	*/
	public function InterviewerScore($data) {
		$this->load->database();
		//$this->db->query("update re_user_section set score='$data[user_score]' where user_id='$data[user_id]' and section_id = '$data[section_id]' ");
		$this->db->where('user_id',$data['user_id']);
		$this->db->where('section_id',$data['section_id']);
                $this->db->from('re_user_section');
                $countRows = $this->db->count_all_results();
                if (1 != $countRows){
                    if (0 == $countRows){
                        return 0;
                    } else {
                        //删除多余志愿
                        $this->db->where('user_id', $data['user_id']);
                        $this->db->where('section_id', $data['section_id']);
                        $this->db->delete('re_user_section'); 
                        
                        $this->db->insert('re_user_section', array(
                            'user_id' => $data['user_id'],
                            'section_id' => $data['section_id'],
                        ));
                    }
                } else {
                    $this->db->where('user_id',$data['user_id']);
                    $this->db->where('section_id',$data['section_id']);
                    $this->db->update('re_user_section',array('score'=>$data['user_score']));
                    return $this->db->affected_rows();
                }
	}
        
	/**    
	 *  @Purpose:    
	 *  导出新生名单列表
	 *     
	 *  @Method Name:
	 *  getRule
	 *  @Parameter: 
	 * 
	 *  @Return: 
	 *  
	*/
	public function dumpFreshList() {
            $this->load->database();
            $this->db->select('user.user_id, user.user_number, user.user_name, user.user_telephone, '
                    . 'user.user_qq, user.user_major, user.user_sex, user.user_talent, re_user_section.section_id');
            $this->db->where('re_user_role.role_id = -1');
            $this->db->from('re_user_role');
            $this->db->where('re_user_section.valid = 1');
            $this->db->join('user', 'user.user_id = re_user_role.user_id');
            $this->db->join('re_user_authorizee', 'user.user_id = re_user_authorizee.user_id');
            return $this->db->get()->result_array();
	}

}