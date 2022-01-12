<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exportdata_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        require("PHPExcel/Classes/PHPExcel.php");
        
    }



    public function exportdata_fromtemplate($mainformno)
    {

      $objPHPExcel = new PHPExcel();

      $objPHPExcel->setActiveSheetIndex(0);
      //กำหนดส่วนหัวเป็น Column แบบ Fix ไม่มีการเปลี่ยนแปลงใดๆ
      $objPHPExcel->getActiveSheet()->setCellValue('a1', 'Run Screen');
      $objPHPExcel->getActiveSheet()->setCellValue('b1', 'S/Point');
      //กำหนดส่วนหัวเป็น Column แบบ Fix ไม่มีการเปลี่ยนแปลงใดๆ


      //สรา้งส่วนหัวตามการ Loop ของข้อมูลโดยใช้สูตรการรนับตัวอักษรเข้ามาช่วย เพื่อให้ให้ PhpExcel นั้นสร้างข้อมูลใน Column ถัดๆไปของ Excel นั่นเองตัวอย่างเช่น ข้อมูลตั้งต้นอยู่ที่ Column C1 ข้อมูลชุดถัดไปนั้นจะต้องสร้างที่ Column D1 และ E1 ....ถัดไปเรื่อยๆจนจบชุดข้อมูล
      $ii = 1;
      $cha = "b";
      if(getWorktime2($mainformno)->num_rows() != 0){
        foreach(getWorktime2($mainformno)->result() as $rs){//Main Loop
    
            $detailFormno[]=$rs->far_detail_formno;
            
            $next_cha = ++$cha; 
            //The following if condition prevent you to go beyond 'z' or 'Z' and will reset to 'a' or 'A'.
            // if (strlen($next_cha) > 1) 
            // {
            // $next_cha = $next_cha[0];
            // }
            $objPHPExcel->getActiveSheet()->setCellValue($next_cha.$ii, convertTimeToShift($rs->far_worktime)."\n".$rs->far_worktime);
            $objPHPExcel->getActiveSheet()->getStyle($next_cha.$ii)->getAlignment()->setWrapText(true);                 
        
     

        $i = 2;
        foreach(get_runscreen_name($mainformno)->result() as $rsx){//Loop runscreen name , S/Point

          $objPHPExcel->getActiveSheet()->setCellValue('a' . $i , $rsx->far_runscreen_name);
          $objPHPExcel->getActiveSheet()->getColumnDimension('a')->setAutoSize(true);
          $objPHPExcel->getActiveSheet()->setCellValue('b' . $i , valueFormat($rsx->far_runscreen_value));

          foreach($detailFormno as $rss){//Loop Runscreen Value
            $runValue = get_time_value($rss , $rsx->far_runscreen_linenum , $mainformno);
            $objPHPExcel->getActiveSheet()->setCellValue($next_cha.$i , valueFormat($runValue));
            }

          $i++;
        }


        

      }//Main Loop

    }



      
      


      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="Export Machine Setup เลขที่ '.$mainformno.'.xlsx"');
      header('Cache-Control: max-age=0');
      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
      echo $objWriter->save('php://output');
    }
    

    

}
/* End of file ModelName.php */

?>
