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
class Fresh_model extends CI_Model{
    public function __construct() {
        parent::__construct();
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
                        'score'=>$data['user_score'],
                    ));
                    return $this->db->affected_rows();
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
        $this->db->where('re_user_section.valid = 1');
        $this->db->where('user.user_id = re_user_role.user_id');
        $this->db->where('user.user_id = re_user_section.user_id');
        $this->db->from('re_user_role, re_user_section, user');
        return $this->db->get()->result_array();
    }
    
    /**
     * 获取部门录取总数
     * 
     * @access public
     * @param int $sectionId The id of section
     * @return int Sum of section accepted
     */
    public function getAcceptedSum($sectionId = 0){
        $this->load->database();
        $this->db->select('re_user_section.user_id');
        $this->db->where('re_user_role.role_id = -1');
        $this->db->where('re_user_section.valid = 1');
        $this->db->where('re_user_section.user_id = re_user_role.user_id');
        if ($sectionId != 0){
            $this->db->where('re_user_section.section_id', $sectionId);
        }
        $this->db->from('re_user_role, re_user_section');
        return $this->db->count_all_results();
    }
    
}