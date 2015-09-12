<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * 导出名单
 * 
 * 
 *
 * @copyright  版权所有(C) 2014-2015 沈阳工业大学ACM实验室 沈阳工业大学网络管理中心 *Chen
 * @license    http://www.gnu.org/licenses/gpl-3.0.txt   GPL3.0 License
 * @version    
 * @link       https://github.com/SUTFutureCoder/
*/
class Dump_list extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 显示导出名单界面
     * 
     * @access public
     * @param 
     * @return 
     */
    public function index(){
        $this->load->helper('url');
        $this->load->view('dump_list_login');
    }
    
    /**    
    *  检查密码
    *  
    * @access public
   */
   public function checkPwd() {
        $this->load->helper('url');
        $this->load->library('session');
        $dumpPwd = $this->input->post('dumpPwd', TRUE);
        if(!isset($dumpPwd) || $dumpPwd != 'nws' . date('Y-d-m')) {
                self::index();
        } else {
               $this->session->set_userdata('dumpAccess', 1);
        }
   }
    
    /**    
    *  导出列表
    *  
    * @access public
   */
   public function dumpFreshAll() {
        $this->load->library('session');
        $this->load->model('user_model');
        if($this->session->userdata('dumpAccess')){
            $freshList = $this->user_model->dumpFreshList();
            var_dump($freshList);
            exit();
            $objPHPExcel = new PHPExcel();
            $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);     

            $clean['file_name'] = (date('Y') - 2002) . '届网管中心招新名单.xls';


            $objPHPExcel->getProperties()->setCreator('SUTACM *Chen Lin')
                ->setTitle($student_info['school_name'] . '-' . $student_info['class_name'] . '-' . $clean['ByStudentNO'] . '-' . $term_year . '-' . ($term_year + 1) . '年度德智体综合积分明细');

            if ($curl){
                $objPHPExcel->getActiveSheet()->setCellValue('A1', '姓名');
            } else {
                $objPHPExcel->getActiveSheet()->setCellValue('A1', '[无智育基础分版]姓名');
            }

            $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->setCellValue('B1', $student_info['student_name']);
            $objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $objPHPExcel->getActiveSheet()->setCellValue('C1', '学院');
            $objPHPExcel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->setCellValue('D1', $student_info['school_name']);
            $objPHPExcel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $objPHPExcel->getActiveSheet()->setCellValue('E1', '班级');
            $objPHPExcel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->setCellValue('F1', $student_info['class_name']);
            $objPHPExcel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $objPHPExcel->getActiveSheet()->setCellValue('G1', '生成时间');
            $objPHPExcel->getActiveSheet()->getStyle('G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->setCellValue('H1', date('Y-m-d H:i:s'));
            $objPHPExcel->getActiveSheet()->getStyle('H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $objPHPExcel->getActiveSheet()->setCellValue('A2', '序号');
            $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->setCellValue('B2', '项目');
            $objPHPExcel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->setCellValue('C2', '分数');
            $objPHPExcel->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('C2')->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->setCellValue('D2', '标签');
            $objPHPExcel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->setCellValue('E2', '说明');
            $objPHPExcel->getActiveSheet()->getStyle('E2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('E2')->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->setCellValue('F2', '时间');
            $objPHPExcel->getActiveSheet()->getStyle('F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('F2')->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->setCellValue('G2', '证明人');
            $objPHPExcel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('G2')->getFont()->setBold(true);


            $objPHPExcel->getActiveSheet()->setCellValue('H2', '审核章');
            $objPHPExcel->getActiveSheet()->getStyle('H2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('H2')->getFont()->setBold(true);

            $i = 3;
            foreach ($data['data'] as $data_item){
                //第一列
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, ($i - 2));

                //第二列
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $data_item['score_type_content']);

                //第三列
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $data_item['score_log_judge']);

                //第四列
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $data_item['score_log_event_tag']);

                //第五列
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $data_item['score_log_event_intro']);

                //第六列
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $data_item['score_log_event_time']);

                //第七列
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $data_item['teacher_name']);

                //设置高度
                $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(30);

                //居中
                $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('B' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('C' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('F' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('H' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

                ++$i;
            }

            ++$i;

            $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, '总分');
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $data['score']['sum']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, '德育');
            if ($data['score']['d_sum'] >= 12){
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $data['score']['d_sum']);
            } else {
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $data['score']['d_sum'] . '【无评优资格】');
            }

            $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, '文体');
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $data['score']['w_sum']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, '智育');
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $data['score']['z_sum']);

            //居中
            $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('B' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('C' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('C' . $i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('F' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('H' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);



            header("Content-Type: application/force-download");  
            header("Content-Type: application/octet-stream");  
            header("Content-Type: application/download");  
            header('Content-Disposition:inline;filename="' . $clean['file_name'] . '"');  
            header("Content-Transfer-Encoding: binary");  
            header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");  
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");  
            header("Pragma: no-cache");  
            $objWriter->save('php://output');
        }
   }

}