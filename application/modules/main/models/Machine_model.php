<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Machine_model extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->db3 = $this->load->database("prodplan", true);
    }






/////////////////////////////////////////////////////////////////////////////////
////////setting.html ส่วนของบริหารจัดการข้อมูลหน้า Setting page
////////////////////////////////////////////////////////////////////////////////
    public function saveMachineTemplate()
    {
        if ($this->input->post("machineName")) {
            $arsave_machinetemplate = array(
                "mat_column_name" => $this->input->post("runscreenName"),
                "mat_machine_name" => $this->input->post("machineName"),
                "mat_machine_type" => $this->input->post("runscreenType"),
                "mat_userpost" => getUser()->Fname." ".getUser()->Lname,
                "mat_ecodepost" => getUser()->ecode,
                "mat_datetime" => date("Y-m-d H:i:s")
            );
            $this->db->insert("machine_template" , $arsave_machinetemplate);

            $output = array(
                "machine_name" => $this->input->post("mat_machine_name"),
                "column_name" => $this->input->post("mat_column_name"),
                "status" => "insert success"
            );

            echo json_encode($output);
            
        } else {
            echo "ไม่มีข้อมูล";
        }
    }


    public function getListMachineTemp()
    {
        $machineName = "";
        if($this->input->post("machineName")){
            $machineName = $this->input->post("machineName");
            $sql = $this->db->query("SELECT
            machine_template.mat_machine_name
            FROM
            machine_template
            WHERE mat_machine_name like '%$machineName%' group by mat_machine_name ORDER BY mat_autoid DESC LIMIT 5 
            ");

            if($sql->num_rows() == 0){
                $output = '
                <div class="list-group">
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action list-group-item-info getDataFromTemp"
                        data_mat_machine_name="'.$machineName.'"
                    >'.$machineName.'</a>
                ';
            }else{
                $output = '<div class="list-group">';
                foreach($sql->result() as $rs){
                    $output .='
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action list-group-item-light getDataFromTemp"
                        data_mat_machine_name="'.$rs->mat_machine_name.'"
                    >'.$rs->mat_machine_name.'</a>
                    ';
                }
                $output .='</div>';
            }

            

            echo $output;
        }
    }



    public function checkDuplicateRunscreen()
    {
        $machineName = "";
        $runscreenName = "";
        $runscreenType = "";

        if($this->input->post("machineName")){
            $machineName = $this->input->post("machineName");
            $runscreenName = $this->input->post("runscreenName");
            $runscreenType = $this->input->post("runscreenType");

            $sql = $this->db->query("SELECT
            machine_template.mat_column_name,
            machine_template.mat_machine_name,
            machine_template.mat_machine_type
            FROM
            machine_template
            WHERE mat_column_name = '$runscreenName' AND mat_machine_name = '$machineName' AND mat_machine_type = '$runscreenType' 
            ");
            if($sql->num_rows() > 0){
                $output = array(
                    "msg" => "พบข้อมูลซ้ำในระบบ",
                    "status" => "notok"
                );
            }else{
                $output = array(
                    "msg" => "ไม่พบข้อมูลซ้ำในระบบ",
                    "status" => "ok"
                );
            }
            echo json_encode($output);
        }
    }


 


    public function getRunscreenMaster()
    {
        $sql = $this->db->query("SELECT
        runscreen_master.run_autoid,
        runscreen_master.run_name,
        runscreen_master.run_userpost,
        runscreen_master.run_ecodepost,
        runscreen_master.run_datetime,
        runscreen_master.run_type
        FROM
        runscreen_master
        order by run_autoid desc
        ");

            $output = '
            <h5>Run screen Master</h5>
                <div class="table-responsive">
                    <table id="runscreen_master_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Run screen</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                    ';
        foreach($sql->result() as $rs){
            $output .= '
            <tr>
                <td>' . $rs->run_name . '</td>
                <td>
                <i class="icon-line-chevrons-right iconMachineEdit" 
                    data_run_name = "'.$rs->run_name.'"
                    data_run_type = "'.$rs->run_type.'" 
                ></i></td>
            </tr>
            ';
        }

            $output .= '
                        </tbody>
                    </table>
                </div>
                ';

        echo $output;


    }




    public function getRunscreenMasterNew_arrayNull($action)
    {

        $sql = $this->db->query("SELECT
            runscreen_master.run_autoid,
            runscreen_master.run_name,
            runscreen_master.run_minvalue,
            runscreen_master.run_maxvalue,
            runscreen_master.run_spoint,
            runscreen_master.run_linenum,
            runscreen_master.run_type
            FROM
            runscreen_master
            order by run_autoid desc
            ");

        

        $output = '';

        if($action != "edit_template"){
            $output .= '<ul class="list-group runScMaster">';
                foreach ($sql->result() as $rs) {
                    $output .= '
                    <a href="#" id="runScMaster_attr"
                    data_run_autoid = "' . $rs->run_autoid . '"
                    data_run_name = "' . $rs->run_name . '"
                    data_run_minvalue = "' . $rs->run_minvalue . '"
                    data_run_maxvalue = "' . $rs->run_maxvalue . '"
                    data_run_spoint = "' . $rs->run_spoint . '"
                    data_run_linenum = "' . $rs->run_linenum . '"
                    data_run_type = "'.$rs->run_type.'"
                    ><li class="list-group-item mb-1 runScMasLi">
                    <span>' . $rs->run_name . '</span><br>
                    <span><b>Min : </b>'.conNumToText($rs->run_minvalue).'</span>&nbsp;&nbsp;<span><b>Max : </b>'.conNumToText($rs->run_maxvalue).'</span><br>
                    <span><b>SPoint : </b>'.conNumToText($rs->run_spoint).'</span>&nbsp;&nbsp;<span><b>Type : </b>'.$rs->run_type.'</span>
                    <i class="icon-caret-right1 runScMasI"></i>
                    </li></a>
                ';
                }
            $output .= '</ul>';
            echo $output;
        }else{
            $output .= '<ul class="list-group runScMaster">';
                foreach ($sql->result() as $rs) {
                    $output .= '
                    <a href="javascript:void(0)" id="runScMaster_attr_edit" class="runScMaster_attr_edit"
                    data_run_autoid = "' . $rs->run_autoid . '"
                    data_run_name = "' . $rs->run_name . '"
                    data_run_minvalue = "' . $rs->run_minvalue . '"
                    data_run_maxvalue = "' . $rs->run_maxvalue . '"
                    data_run_spoint = "' . $rs->run_spoint . '"
                    data_run_linenum = "' . $rs->run_linenum . '"
                    data_run_type = "'.$rs->run_type.'"
                    ><li class="list-group-item mb-1 runScMasLi_edit">
                    <span>' . $rs->run_name . '</span><br>
                    <span><b>Min : </b>'.conNumToText($rs->run_minvalue).'</span>&nbsp;&nbsp;<span><b>Max : </b>'.conNumToText($rs->run_maxvalue).'</span><br>
                    <span><b>SPoint : </b>'.conNumToText($rs->run_spoint).'</span>&nbsp;&nbsp;<span><b>Type : </b>'.$rs->run_type.'</span>
                    <i class="icon-caret-right1 runScMasI_edit"></i>
                    </li></a>
                ';
                }
            $output .= '</ul>';
            echo $output;
        }
        

    }



    public function getRunscreenMasterNew_search()
    {
        if($this->input->post("searchMasterRun") != ""){
            $searchMasterRun = $this->input->post("searchMasterRun");
            $condition = " where run_name like '%$searchMasterRun%' OR run_type like '%$searchMasterRun%' ";
        }else{
            $condition = "";
        }

        $sql = $this->db->query("SELECT
            runscreen_master.run_autoid,
            runscreen_master.run_name,
            runscreen_master.run_minvalue,
            runscreen_master.run_maxvalue,
            runscreen_master.run_spoint,
            runscreen_master.run_linenum,
            runscreen_master.run_type
            FROM
            runscreen_master
            $condition
            order by run_autoid desc
            ");

        

        $output = '';
        if($this->input->post("action") != "edit_template"){
            $output .= '<ul class="list-group runScMaster">';
                foreach ($sql->result() as $rs) {
            
                    $output .= '
                    <a href="#" id="runScMaster_attr"
                    data_run_autoid = "' . $rs->run_autoid . '"
                    data_run_name = "' . $rs->run_name . '"
                    data_run_minvalue = "' . $rs->run_minvalue . '"
                    data_run_maxvalue = "' . $rs->run_maxvalue . '"
                    data_run_spoint = "' . $rs->run_spoint . '"
                    data_run_linenum = "' . $rs->run_linenum . '"
                    data_run_type = "'.$rs->run_type.'"
                    ><li class="list-group-item mb-1 runScMasLi">
                    <span>' . $rs->run_name . '</span><br>
                    <span><b>Min : </b>'.conNumToText($rs->run_minvalue).'</span>&nbsp;&nbsp;<span><b>Max : </b>'.conNumToText($rs->run_maxvalue).'</span><br>
                        <span><b>SPoint : </b>'.conNumToText($rs->run_spoint).'</span>&nbsp;&nbsp;<span><b>Type : </b>'.conNumToText($rs->run_type).'</span>
                    <i class="icon-caret-right1 runScMasI"></i>
                    </li></a>
                ';
                }
            $output .= '</ul>';
            echo $output;
        }else{
            $output .= '<ul class="list-group runScMaster_edit">';
                foreach ($sql->result() as $rs) {
            
                    $output .= '
                    <a href="javascript:void(0)" id="runScMaster_attr_edit" class="runScMaster_attr_edit"
                    data_run_autoid = "' . $rs->run_autoid . '"
                    data_run_name = "' . $rs->run_name . '"
                    data_run_minvalue = "' . $rs->run_minvalue . '"
                    data_run_maxvalue = "' . $rs->run_maxvalue . '"
                    data_run_spoint = "' . $rs->run_spoint . '"
                    data_run_linenum = "' . $rs->run_linenum . '"
                    data_run_type = "'.$rs->run_type.'"
                    ><li class="list-group-item mb-1 runScMasLi_edit">
                    <span>' . $rs->run_name . '</span><br>
                    <span><b>Min : </b>'.conNumToText($rs->run_minvalue).'</span>&nbsp;&nbsp;<span><b>Max : </b>'.conNumToText($rs->run_maxvalue).'</span><br>
                        <span><b>SPoint : </b>'.conNumToText($rs->run_spoint).'</span>&nbsp;&nbsp;<span><b>Type : </b>'.conNumToText($rs->run_type).'</span>
                    <i class="icon-caret-right1 runScMasI_edit"></i>
                    </li></a>
                ';
                }
            $output .= '</ul>';
            echo $output;
        }
    }




    public function countTotalRunmaster()
    {
        $dataUse = $this->input->post("dataUse");
        if($dataUse == ""){
            $sql = $this->db->query("SELECT run_linenum FROM runscreen_master");
            $countTotalRunmaster = $sql->num_rows();

            $output = array(
                "msg" => "นับข้อมูลเรียบร้อยแล้ว",
                "status" => "Count Data Success",
                "countdata" => $countTotalRunmaster
            );

            echo json_encode($output);
        }else{
            $sql = $this->db->query("SELECT run_linenum FROM runscreen_master WHERE run_linenum NOT IN ($dataUse)");
            $countTotalRunmaster = $sql->num_rows();

            $output = array(
                "msg" => "นับข้อมูลเรียบร้อยแล้ว",
                "status" => "Count Data Success",
                "countdata" => $countTotalRunmaster
            );

            echo json_encode($output);
        }
        
    }




    public function countTotalRunTemp()
    {
        $templatename = "";
        $countTotalTemp = "";
        if($this->input->post("templatename") != ""){
            $templatename = $this->input->post("templatename");
            $sql = $this->db->query("SELECT mat_linenum FROM machine_template_temp WHERE mat_machine_name = '$templatename' ");
            $countTotalTemp = $sql->num_rows();
            $output = array(
                "msg" => "นับจำนวน Runscreen ในตาราง Temp เรียบร้อยแล้ว",
                "status" => "Count Data Success",
                "countdata" => $countTotalTemp
            );
        }else{
            $output = array(
                "msg" => "นับจำนวน Runscreen ในตาราง Temp เรียบร้อยแล้ว",
                "status" => "Count Data Success",
                "countdata" => 0
            );
        }
        

        echo json_encode($output);
    }






    public function getRunscreenMasterNew2()
    {

        if($this->input->post("linenumUsed") != ""){

            $searchMasterRun = $this->input->post("searchMasterRun");
            $linenum = $this->input->post("linenumUsed");

            $sql = $this->db->query("SELECT
            runscreen_master.run_autoid,
            runscreen_master.run_name,
            runscreen_master.run_minvalue,
            runscreen_master.run_maxvalue,
            runscreen_master.run_spoint,
            runscreen_master.run_linenum,
            runscreen_master.run_type
            FROM
            runscreen_master
            WHERE run_linenum NOT IN ($linenum)
            AND run_name LIKE '%$searchMasterRun%'
            order by run_autoid desc
            ");
            $output = '';

            if($this->input->post("action") != "edit_template"){
                $output .= '<ul class="list-group runScMaster">';
                    foreach ($sql->result() as $rs) {
                
                        $output .= '
                        <a href="#" id="runScMaster_attr"
                        data_run_autoid = "' . $rs->run_autoid . '"
                        data_run_name = "' . $rs->run_name . '"
                        data_run_minvalue = "' . $rs->run_minvalue . '"
                        data_run_maxvalue = "' . $rs->run_maxvalue . '"
                        data_run_spoint = "' . $rs->run_spoint . '"
                        data_run_linenum = "' . $rs->run_linenum . '"
                        data_run_type = "'.$rs->run_type.'"
                        ><li class="list-group-item mb-1 runScMasLi">
                        <span>' . $rs->run_name . '</span><br>
                        <span><b>Min : </b>'.conNumToText($rs->run_minvalue).'</span>&nbsp;&nbsp;<span><b>Max : </b>'.conNumToText($rs->run_maxvalue).'</span><br>
                        <span><b>SPoint : </b>'.conNumToText($rs->run_spoint).'</span>&nbsp;&nbsp;<span><b>Type : </b>'.conNumToText($rs->run_type).'</span>
                        <i class="icon-caret-right1 runScMasI"></i>
                        </li></a>
                    ';
                    }
                $output .= '</ul>';
                echo $output;
            }else{
                $output .= '<ul class="list-group runScMaster_edit">';
                    foreach ($sql->result() as $rs) {
                
                        $output .= '
                        <a href="javascript:void(0)" id="runScMaster_attr_edit" class="runScMaster_attr_edit"
                        data_run_autoid = "' . $rs->run_autoid . '"
                        data_run_name = "' . $rs->run_name . '"
                        data_run_minvalue = "' . $rs->run_minvalue . '"
                        data_run_maxvalue = "' . $rs->run_maxvalue . '"
                        data_run_spoint = "' . $rs->run_spoint . '"
                        data_run_linenum = "' . $rs->run_linenum . '"
                        data_run_type = "'.$rs->run_type.'"
                        ><li class="list-group-item mb-1 runScMasLi_edit">
                        <span>' . $rs->run_name . '</span><br>
                        <span><b>Min : </b>'.conNumToText($rs->run_minvalue).'</span>&nbsp;&nbsp;<span><b>Max : </b>'.conNumToText($rs->run_maxvalue).'</span><br>
                        <span><b>SPoint : </b>'.conNumToText($rs->run_spoint).'</span>&nbsp;&nbsp;<span><b>Type : </b>'.conNumToText($rs->run_type).'</span>
                        <i class="icon-caret-right1 runScMasI_edit"></i>
                        </li></a>
                    ';
                    }
                $output .= '</ul>';
                echo $output;
            }
        }else{
            $this->getRunscreenMasterNew_search();
        }

        

    }





    public function truncate_machine_template_temp()
    {
        if($this->db->truncate('machine_template_temp'))
        {
            //ลบไฟล์ออกจาก server
            $getfile = $this->db->query("SELECT ted_template_image FROM msd_template_detail_temp");

            if($getfile->num_rows() != 0){
                //ลบรูปภาพออกจาก Folder
                if($getfile->row()->ted_template_image != ""){
                    $path = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template_temp/".$getfile->row()->ted_template_image;
                    if(file_exists($path) != 0){
                        unlink($path);
                    }
                    
                }
            }
            
            $this->db->truncate('msd_template_detail_temp');

            $output = array(
                "msg" => "Clear machine_template_temp successfuly",
                "status" => "Truncate successfuly"
            );

            echo json_encode($output);
        }
    }



    public function saveDataToMachineTemplate()
    {

        // insert itemcode to msd_template_detail
        if($this->input->post("itemid") != ""){
            $itemid = $this->input->post("itemid");
            $templatename = $this->input->post("templatename");

            $arUpdateTemplateDetailTemp = array(
                "ted_template_itemuse" => $itemid
            );
            $this->db->where("ted_template_name" , $templatename);
            $this->db->update("msd_template_detail_temp" , $arUpdateTemplateDetailTemp);
        }

        // Insert data to machine template table
        $sql = $this->db->query("SELECT
        machine_template_temp.mat_column_name,
        machine_template_temp.mat_machine_name,
        machine_template_temp.mat_machine_type,
        machine_template_temp.mat_min_value,
        machine_template_temp.mat_max_value,
        machine_template_temp.mat_spoint_value,
        machine_template_temp.mat_linenum,
        machine_template_temp.mat_master_linenum,
        machine_template_temp.mat_userpost,
        machine_template_temp.mat_ecodepost,
        machine_template_temp.mat_datetime
        FROM
        machine_template_temp
        WHERE mat_machine_name = '$templatename' ");

        foreach($sql->result() as $rs){
            $arSaveToMachineTemplate = array(
                "mat_column_name" => $rs->mat_column_name,
                "mat_machine_name" => $rs->mat_machine_name,
                "mat_machine_type" => $rs->mat_machine_type,
                "mat_min_value" => $rs->mat_min_value,
                "mat_max_value" => $rs->mat_max_value,
                "mat_spoint_value" => $rs->mat_spoint_value,
                "mat_linenum" => $rs->mat_linenum,
                "mat_master_linenum" => $rs->mat_master_linenum,
                "mat_userpost" => getUser()->Fname." ".getUser()->Lname,
                "mat_ecodepost" => getUser()->ecode,
                "mat_datetime" => date("Y-m-d H:i:s")
            );
            $this->db->insert("machine_template" , $arSaveToMachineTemplate);
        }


        $this->db->where("mat_machine_name" , $templatename);
        $this->db->delete("machine_template_temp");
        // Insert data to machine template table

        $sql2 = $this->db->query("SELECT
        msd_template_detail_temp.ted_template_name,
        msd_template_detail_temp.ted_template_image,
        msd_template_detail_temp.ted_template_itemuse,
        msd_template_detail_temp.ted_template_user,
        msd_template_detail_temp.ted_template_ecode,
        msd_template_detail_temp.ted_template_deptcode,
        msd_template_detail_temp.ted_template_datetime,
        msd_template_detail_temp.ted_template_user_modi,
        msd_template_detail_temp.ted_template_ecode_modi,
        msd_template_detail_temp.ted_template_deptcode_modi,
        msd_template_detail_temp.ted_template_datetime_modi
        FROM
        msd_template_detail_temp
        WHERE ted_template_name = '$templatename' ");

        foreach($sql2->result() as $rs){
            $arSaveToTemplateDetail = array(
                "ted_template_name" => $rs->ted_template_name,
                "ted_template_image" => $rs->ted_template_image,
                "ted_template_itemuse" => $rs->ted_template_itemuse,
                "ted_template_user" => getUser()->Fname." ".getUser()->Lname,
                "ted_template_ecode" => getUser()->ecode,
                "ted_template_deptcode" => getUser()->DeptCode,
                "ted_template_datetime" => date("Y-m-d H:i:s")
            );
            $this->db->insert("msd_template_detail" , $arSaveToTemplateDetail);
        }

        $getfile = $sql2->row()->ted_template_image;

        if($getfile != ""){
            $pathFrom = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template_temp/".$getfile;
            $pathTo = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template/".$getfile;
            $path = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template_temp/".$getfile;
            if(file_exists($path) != 0){
                copy($pathFrom , $pathTo);
                unlink($path);
            }
            
        }
        $this->db->where("ted_template_name" , $templatename);
        $this->db->delete("msd_template_detail_temp");
        

        $output = array(
            "msg" => "บันทึกข้อมูลสำเร็จ",
            "status" => "Insert Success"
        );

        echo json_encode($output);
    }



    public function checkEditTemplateDuplicate()
    {
        if($this->input->post("checkTname") != ""){
            $checkTname = $this->input->post("checkTname");

            // Check Old data
            $checkOldData = $this->db->query("SELECT
            mat_machine_name
            FROM
            machine_template
            WHERE mat_machine_name = '$checkTname'
            GROUP BY mat_machine_name");

            if($checkOldData->num_rows() != 0){
                $output = array(
                    "msg" => "ไม่สามารถเปลี่ยนเป็นชื่อนี้ได้เนื่องจากชื่อซ้ำในระบบ",
                    "status" => "Found Duplicate Template Name"
                );
                
            }else{
                $output = array(
                    "msg" => "สามารถใช้ชื่อนี้ได้",
                    "status" => "Not Found Duplicate Template Name"
                );
            }
            
        }else{
            $output = array(
                "msg" => "ไม่มีการเปลี่ยนแปลงชื่อ Template",
                "status" => "Non Effect"
            );
        }

        echo json_encode($output);
    }




    public function saveDataToMachineTemplate_edit()
    {

        // Delete data From Template table Frist
        
        if($this->input->post("oldtemplate") != ""){//เช็ค Template เดิม
            $oldtemplate = $this->input->post("oldtemplate");
            $editfile = $this->input->post("editfile");
            $templatename = $this->input->post("templatename");
            $checkTname = $this->input->post("checkTname");
            $checkItemId = $this->input->post("checkItemId");

            if($checkTname != ""){//ตรวจสอบว่ามีการเปลี่ยนแปลงชื่อ Template หรือไม่ ถ้ามีการเปลี่ยนแปลง

                // Updata in Temp table คือให้ทำการอัพเดตใน Temp table ให้เสร็จก่อน
                $selectTemp = $this->db->query("SELECT mat_autoid , mat_machine_name FROM machine_template_temp WHERE mat_machine_name = '$oldtemplate' ORDER BY mat_autoid ASC");

                foreach($selectTemp->result() as $rs){
                    $arUpdateNewTemplateName = array(
                        "mat_machine_name" => $checkTname
                    );
                    $this->db->where("mat_machine_name" , $rs->mat_machine_name);
                    $this->db->update("machine_template_temp",$arUpdateNewTemplateName);
                }

                

                if($checkItemId != ""){
                    // Update Template Name in msd_template_detail
                    $arUpdateTemplateNameDetail = array(
                        "ted_template_name" =>$checkTname,
                        "ted_template_itemuse" => strtoupper($checkItemId)
                    );
                    $this->db->where("ted_template_name" , $oldtemplate);
                    $this->db->update("msd_template_detail_temp" , $arUpdateTemplateNameDetail);
                }else{
                    // Update Template Name in msd_template_detail
                    $arUpdateTemplateNameDetail = array(
                        "ted_template_name" =>$checkTname
                    );
                    $this->db->where("ted_template_name" , $oldtemplate);
                    $this->db->update("msd_template_detail_temp" , $arUpdateTemplateNameDetail);
                }
            }






            if($checkItemId != ""){

                if($checkTname != ""){
                    $arUpdateItemID = array(
                        "ted_template_itemuse" => strtoupper($checkItemId),
                        "ted_template_name" =>$checkTname
                    );
                    $this->db->where("ted_template_name" , $oldtemplate);
                    $this->db->update("msd_template_detail_temp" , $arUpdateItemID);
                }else{
                    $arUpdateItemID = array(
                        "ted_template_itemuse" => strtoupper($checkItemId)
                    );
                    $this->db->where("ted_template_name" , $oldtemplate);
                    $this->db->update("msd_template_detail_temp" , $arUpdateItemID);
                }
            }

            

            $this->db->where("mat_machine_name" , $oldtemplate);
            $this->db->delete("machine_template");

            $this->db->where("ted_template_name" , $oldtemplate);
            $this->db->delete("msd_template_detail");



            // Insert data to machine template table
            $sql = $this->db->query("SELECT
            machine_template_temp.mat_column_name,
            machine_template_temp.mat_machine_name,
            machine_template_temp.mat_machine_type,
            machine_template_temp.mat_min_value,
            machine_template_temp.mat_max_value,
            machine_template_temp.mat_spoint_value,
            machine_template_temp.mat_linenum,
            machine_template_temp.mat_master_linenum,
            machine_template_temp.mat_userpost,
            machine_template_temp.mat_ecodepost,
            machine_template_temp.mat_datetime
            FROM
            machine_template_temp
            WHERE mat_machine_name = '$templatename'
            ORDER BY  mat_linenum ASC");

            foreach($sql->result() as $rs){
                $arSaveToMachineTemplate = array(
                    "mat_column_name" => $rs->mat_column_name,
                    "mat_machine_name" => $rs->mat_machine_name,
                    "mat_machine_type" => $rs->mat_machine_type,
                    "mat_min_value" => conPrice($rs->mat_min_value),
                    "mat_max_value" => conPrice($rs->mat_max_value),
                    "mat_spoint_value" => conPrice($rs->mat_spoint_value),
                    "mat_linenum" => $rs->mat_linenum,
                    "mat_master_linenum" => $rs->mat_master_linenum,
                    "mat_userpost" => getUser()->Fname." ".getUser()->Lname,
                    "mat_ecodepost" => getUser()->ecode,
                    "mat_datetime" => date("Y-m-d H:i:s")
                );
                $this->db->insert("machine_template" , $arSaveToMachineTemplate);
            }
            // $this->db->truncate("machine_template_temp");
            // Insert data to machine template table

            $sql2 = $this->db->query("SELECT
            msd_template_detail_temp.ted_template_name,
            msd_template_detail_temp.ted_template_image,
            msd_template_detail_temp.ted_template_itemuse,
            msd_template_detail_temp.ted_template_user,
            msd_template_detail_temp.ted_template_ecode,
            msd_template_detail_temp.ted_template_deptcode,
            msd_template_detail_temp.ted_template_datetime,
            msd_template_detail_temp.ted_template_user_modi,
            msd_template_detail_temp.ted_template_ecode_modi,
            msd_template_detail_temp.ted_template_deptcode_modi,
            msd_template_detail_temp.ted_template_datetime_modi
            FROM
            msd_template_detail_temp
            WHERE ted_template_name = '$templatename' ");

            foreach($sql2->result() as $rs){
                $arSaveToTemplateDetail = array(
                    "ted_template_name" => $rs->ted_template_name,
                    "ted_template_image" => $rs->ted_template_image,
                    "ted_template_itemuse" => strtoupper($rs->ted_template_itemuse),
                    "ted_template_user" => getUser()->Fname." ".getUser()->Lname,
                    "ted_template_ecode" => getUser()->ecode,
                    "ted_template_deptcode" => getUser()->DeptCode,
                    "ted_template_datetime" => date("Y-m-d H:i:s")
                );
                $this->db->insert("msd_template_detail" , $arSaveToTemplateDetail);
            }
            // $this->db->truncate("msd_template_detail_temp");

            $getfile = $sql2->row()->ted_template_image;

            // $pathFrom = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template_temp/".$getfile;
            // $pathTo = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template/".$getfile;

            if($editfile != ""){

                $pathFrom = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template_temp/".$getfile;
                $pathTo = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template/".$getfile;

                if(file_exists($pathFrom) != 0){
                    copy($pathFrom,$pathTo);
                    unlink($pathFrom);
                }
                
            }else{
                if($getfile != ""){
                    $pathFrom = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template_temp/".$getfile;
                    if(file_exists($pathFrom) != 0){
                        unlink($pathFrom);
                    }
                }

            }

            //Delete Data on Temp Table
            $this->db->where("mat_machine_name",$templatename);
            $this->db->delete("machine_template_temp");

            $this->db->where("ted_template_name",$templatename);
            $this->db->delete("msd_template_detail_temp");
            
            $output = array(
                "msg" => "บันทึกข้อมูลสำเร็จ",
                "status" => "Insert Success",
                "image" => $getfile,
                "checkfile" => file_exists($pathFrom),
                "pathform" => $pathFrom
            );

            echo json_encode($output);
        }


    }




    public function uploadImageCopyToTemp()
    {
        // Upload file Zone
        $file_name = $_FILES["ted_template_image"]["name"];
        $fileno = 1;

        $create_copy_template_name = $this->input->post("create_new_template_name");
        $oldFile = $this->input->post("ted_template_image_copy");

        foreach ($file_name as $key => $value) {
            if ($_FILES["ted_template_image"]["tmp_name"][$key] != "") {

                // ถ้ามีการอัพไฟล์ใหม่ให้ทำการลบไฟล์เก่า

                // Check New หรือว่า Copy
                if($this->input->post("check_new_types") == "copy"){
                // จะทำการลบรูปที่มาจาก Template ต้นฉบับออกเนื่องจาก Template ปลายทางที่ Copy มานั้นจะใช้ไฟล์รุปของ Template ต้นฉบับเลย
                    if($oldFile != ""){
                        $pathCheck = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template_temp/".$oldFile;
                        if(file_exists($pathCheck) != 0){
                            unlink($pathCheck);
                        }
                    }

                }else if($this->input->post("check_new_types") == "new"){
                    // Check Image On Temptable

                    $sqlgetImage = $this->db->query("SELECT ted_template_image FROM msd_template_detail_temp WHERE ted_template_name = '$create_copy_template_name' ");

                    if($sqlgetImage->num_rows() != 0){
                        $templateImage = $sqlgetImage->row()->ted_template_image;
                        if($templateImage == ""){
                            $time = date("H-i-s"); //ดึงเวลามาก่อน
                            $path_parts = pathinfo($value);
                
                            if($path_parts['extension'] == "jpeg"){
                                $filename_type = "jpg";
                            }else{
                                $filename_type = $path_parts['extension'];
                            }
                            
                            $file_name_date = substr_replace($value,  $create_copy_template_name . "-" . $time ."-".$fileno .".". $filename_type, 0);
                            $file_name_s = substr_replace($value,  $create_copy_template_name . "-" . $time ."-".$fileno, 0);
                            // Upload file
                            $file_tmp = $_FILES["ted_template_image"]["tmp_name"][$key];
                
                
                            if($path_parts['extension'] == "jpeg" || $path_parts['extension'] == "jpg"){
                                $newWidth = 1000;
                                resize($newWidth, "upload/images_template_temp/" . $file_name_s , $file_tmp );
                            }else{
                                move_uploaded_file($file_tmp, "upload/images_template_temp/" . $file_name_date);
                            }
                            // move_uploaded_file($file_tmp, "upload/images/" . $file_name_date);
                            // correctImageOrientation($file_tmp);
                
                
                            $arfiles = array(
                                "ted_template_image" => $file_name_date
                            );
                            $this->db->where("ted_template_name" , $create_copy_template_name);
                            $this->db->update("msd_template_detail_temp", $arfiles);
                
                            $fileno++;
                        }else{
                            $pathFrom = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template_temp/".$templateImage;
                            $pathTo = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template/".$templateImage;
                            copy($pathFrom , $pathTo);
                            unlink($pathFrom);
                        }
                    }
                }


                




                
    
            }
        }

        $output = array(
            "msg" => "อัพโหลดไฟล์เสร็จแล้ว",
            "status" => "Upload File Success",
            "itemid" => $this->input->post("create_new_template_itemid"),
            "templatename" => $this->input->post("create_new_template_name"),
        );
        echo json_encode($output);
    }





    public function saveRunScrToTempTable()
    {
        // Upload file Zone
        $file_name = $_FILES["ted_template_image"]["name"];
        $fileno = 1;

        $create_new_template_name = $this->input->post("create_new_template_name");
        $create_new_template_itemid = $this->input->post("create_new_template_itemid");
        $run_name_use = $this->input->post("run_name_use");
        $run_type_use = $this->input->post("run_type_use");
        $run_minvalue_use = $this->input->post("run_minvalue_use");
        $run_maxvalue_use = $this->input->post("run_maxvalue_use");
        $run_spoint_use = $this->input->post("run_spoint_use");
        $run_linenum_use = $this->input->post("run_linenum_use");

        foreach ($file_name as $key => $value) {
            if ($_FILES["ted_template_image"]["tmp_name"][$key] != "") {

                // Check ข้อมูลบน msd_template_detail_temp ว่ามีการบันทึกไปหรือยัง
                $checkDataDuplicate = $this->db->query("SELECT ted_template_name FROM msd_template_detail_temp WHERE ted_template_name = '$create_new_template_name' ");
                if($checkDataDuplicate->num_rows() == 0){
                    $time = date("H-i-s"); //ดึงเวลามาก่อน
                    $path_parts = pathinfo($value);
        
                    if($path_parts['extension'] == "jpeg"){
                        $filename_type = "jpg";
                    }else{
                        $filename_type = $path_parts['extension'];
                    }
                    
                    $file_name_date = substr_replace($value,  $create_new_template_name . "-" . $time ."-".$fileno .".". $filename_type, 0);
                    $file_name_s = substr_replace($value,  $create_new_template_name . "-" . $time ."-".$fileno, 0);
                    // Upload file
                    $file_tmp = $_FILES["ted_template_image"]["tmp_name"][$key];
        
        
                    
        
                    if($path_parts['extension'] == "jpeg" || $path_parts['extension'] == "jpg"){
                        $newWidth = 1000;
                        resize($newWidth, "upload/images_template_temp/" . $file_name_s , $file_tmp );
                    }else{
                        move_uploaded_file($file_tmp, "upload/images_template_temp/" . $file_name_date);
                    }
                    // move_uploaded_file($file_tmp, "upload/images/" . $file_name_date);
                    // correctImageOrientation($file_tmp);
        
        
                    $arfiles = array(
                        "ted_template_name" => $create_new_template_name,
                        "ted_template_image" => $file_name_date,
                        "ted_template_itemuse" => strtoupper($create_new_template_itemid),
                        "ted_template_user" => getUser()->Fname . " " . getUser()->Lname,
                        "ted_template_ecode" => getUser()->ecode,
                        "ted_template_deptcode" => getUser()->DeptCode,
                        "ted_template_datetime" => date("Y-m-d H:i:s")
                    );
                    $this->db->insert("msd_template_detail_temp", $arfiles);
        
                    $fileno++;
                }
    
            }else{
                $checkDataDuplicate = $this->db->query("SELECT ted_template_name FROM msd_template_detail_temp WHERE ted_template_name = '$create_new_template_name' ");
                if($checkDataDuplicate->num_rows() == 0){
                    $arfiles = array(
                        "ted_template_name" => $create_new_template_name,
                        "ted_template_itemuse" => $create_new_template_itemid,
                        "ted_template_user" => getUser()->Fname . " " . getUser()->Lname,
                        "ted_template_ecode" => getUser()->ecode,
                        "ted_template_deptcode" => getUser()->DeptCode,
                        "ted_template_datetime" => date("Y-m-d H:i:s")
                    );
                    $this->db->insert("msd_template_detail_temp", $arfiles);
                }
            }
        }

        $lineNumber = getRunLinenumTemplate($create_new_template_name);


        $arSaveToTempTable = array(
            "mat_machine_name" => $create_new_template_name,
            "mat_column_name" => $run_name_use,
            "mat_machine_type" => $run_type_use,
            "mat_min_value" => $run_minvalue_use,
            "mat_max_value" => $run_maxvalue_use,
            "mat_spoint_value" => $run_spoint_use,
            "mat_linenum" => $lineNumber,
            "mat_master_linenum" => $run_linenum_use,
            "mat_userpost" => getUser()->Fname." ".getUser()->Lname,
            "mat_ecodepost" => getUser()->ecode,
            "mat_datetime" => date("Y-m-d H:i:s"),
        );
        //Check duplicate runscreen
        $checkDupRunscreen = $this->db->query("SELECT mat_column_name FROM machine_template_temp WHERE mat_machine_name = '$create_new_template_name' AND mat_column_name = '$run_name_use' ");
        if($checkDupRunscreen->num_rows() == 0){
            $this->db->insert("machine_template_temp" , $arSaveToTempTable);
        }
        $output = array(
            "msg" => "บันทึกข้อมูลสำเร็จ",
            "status" => "Insert Success",
            "templatename" => $create_new_template_name
        );

        echo json_encode($output);
    }



    public function uploadImageOnly_edit()
    {

        // Check File in Folder
        $getFile = $this->db->query("SELECT ted_template_image FROM msd_template_detail_temp");
        if($getFile->num_rows() != 0){
            if($getFile->row()->ted_template_image != "" || $getFile->row()->ted_template_image != null){
                $pathCheck = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template_temp/".$getFile->row()->ted_template_image;
                if(file_exists($pathCheck) != 0){
                    unlink($pathCheck);
                }
            }
        }




        // Upload file Zone
        $file_name = $_FILES["select_edit_template_image"]["name"];
        $fileno = 1;

        $select_edit_template_name = $this->input->post("select_check_templatename");

        foreach ($file_name as $key => $value) {
            if ($_FILES["select_edit_template_image"]["tmp_name"][$key] != "") {

                    $time = date("H-i-s"); //ดึงเวลามาก่อน
                    $path_parts = pathinfo($value);
        
                    if($path_parts['extension'] == "jpeg"){
                        $filename_type = "jpg";
                    }else{
                        $filename_type = $path_parts['extension'];
                    }
                    
                    $file_name_date = substr_replace($value,  $select_edit_template_name . "-" . $time ."-".$fileno .".". $filename_type, 0);
                    $file_name_s = substr_replace($value,  $select_edit_template_name . "-" . $time ."-".$fileno, 0);
                    // Upload file
                    $file_tmp = $_FILES["select_edit_template_image"]["tmp_name"][$key];
        
        
                    
        
                    if($path_parts['extension'] == "jpeg" || $path_parts['extension'] == "jpg"){
                        $newWidth = 1000;
                        resize($newWidth, "upload/images_template_temp/" . $file_name_s , $file_tmp );
                    }else{
                        move_uploaded_file($file_tmp, "upload/images_template_temp/" . $file_name_date);
                    }
                    // move_uploaded_file($file_tmp, "upload/images/" . $file_name_date);
                    // correctImageOrientation($file_tmp);
        
        
                    $arfiles = array(
                        "ted_template_image" => $file_name_date,
                        "ted_template_user" => getUser()->Fname . " " . getUser()->Lname,
                        "ted_template_ecode" => getUser()->ecode,
                        "ted_template_deptcode" => getUser()->DeptCode,
                        "ted_template_datetime" => date("Y-m-d H:i:s")
                    );
                    $this->db->where("ted_template_name" , $select_edit_template_name);
                    $this->db->update("msd_template_detail_temp", $arfiles);
        
                    $fileno++;
                
    
            }
        }

        $output = array(
            "msg" => "อัพเดตรูปภาพสำเร็จ",
            "status" => "Update Image Success",
            "templatename" => $select_edit_template_name
        );

        echo json_encode($output);
    }



    




    public function saveRunScrToTempTable_edit()
    {
        // Upload file Zone
        $file_name = $_FILES["select_edit_template_image"]["name"];
        $fileno = 1;

        $select_edit_template_name = $this->input->post("select_check_templatename");
        $select_edit_template_itemid = $this->input->post("select_edit_template_itemid");
        $run_name_use_edit = $this->input->post("run_name_use_edit");
        $run_type_use_edit = $this->input->post("run_type_use_edit");
        $run_minvalue_use_edit = $this->input->post("run_minvalue_use_edit");
        $run_maxvalue_use_edit = $this->input->post("run_maxvalue_use_edit");
        $run_spoint_use_edit = $this->input->post("run_spoint_use_edit");
        $run_linenum_use_edit = $this->input->post("run_linenum_use_edit");

        foreach ($file_name as $key => $value) {
            if ($_FILES["select_edit_template_image"]["tmp_name"][$key] != "") {

                // Check ข้อมูลบน msd_template_detail_temp ว่ามีการบันทึกไปหรือยัง
                $checkDataDuplicate = $this->db->query("SELECT ted_template_name FROM msd_template_detail_temp WHERE ted_template_name = '$select_edit_template_name' ");
                if($checkDataDuplicate->num_rows() == 0){
                    $time = date("H-i-s"); //ดึงเวลามาก่อน
                    $path_parts = pathinfo($value);
        
                    if($path_parts['extension'] == "jpeg"){
                        $filename_type = "jpg";
                    }else{
                        $filename_type = $path_parts['extension'];
                    }
                    
                    $file_name_date = substr_replace($value,  $select_edit_template_name . "-" . $time ."-".$fileno .".". $filename_type, 0);
                    $file_name_s = substr_replace($value,  $select_edit_template_name . "-" . $time ."-".$fileno, 0);
                    // Upload file
                    $file_tmp = $_FILES["select_edit_template_image"]["tmp_name"][$key];
        
        
                    
        
                    if($path_parts['extension'] == "jpeg" || $path_parts['extension'] == "jpg"){
                        $newWidth = 1000;
                        resize($newWidth, "upload/images_template_temp/" . $file_name_s , $file_tmp );
                    }else{
                        move_uploaded_file($file_tmp, "upload/images_template_temp/" . $file_name_date);
                    }
                    // move_uploaded_file($file_tmp, "upload/images/" . $file_name_date);
                    // correctImageOrientation($file_tmp);
        
        
                    $arfiles = array(
                        "ted_template_name" => $select_edit_template_name,
                        "ted_template_image" => $file_name_date,
                        "ted_template_itemuse" => strtoupper($select_edit_template_itemid),
                        "ted_template_user" => getUser()->Fname . " " . getUser()->Lname,
                        "ted_template_ecode" => getUser()->ecode,
                        "ted_template_deptcode" => getUser()->DeptCode,
                        "ted_template_datetime" => date("Y-m-d H:i:s")
                    );
                    $this->db->insert("msd_template_detail_temp", $arfiles);
        
                    $fileno++;
                }
    
            }else{
                $checkDataDuplicate = $this->db->query("SELECT ted_template_name FROM msd_template_detail_temp WHERE ted_template_name = '$select_edit_template_name' ");
                if($checkDataDuplicate->num_rows() == 0){
                    $arfiles = array(
                        "ted_template_name" => $select_edit_template_name,
                        "ted_template_itemuse" => $select_edit_template_itemid,
                        "ted_template_user" => getUser()->Fname . " " . getUser()->Lname,
                        "ted_template_ecode" => getUser()->ecode,
                        "ted_template_deptcode" => getUser()->DeptCode,
                        "ted_template_datetime" => date("Y-m-d H:i:s")
                    );
                    $this->db->insert("msd_template_detail_temp", $arfiles);
                }
            }
        }

        $lineNumber = getRunLinenumTemplate($select_edit_template_name);


        $arSaveToTempTable = array(
            "mat_machine_name" => $select_edit_template_name,
            "mat_column_name" => $run_name_use_edit,
            "mat_machine_type" => $run_type_use_edit,
            "mat_min_value" => $run_minvalue_use_edit,
            "mat_max_value" => $run_maxvalue_use_edit,
            "mat_spoint_value" => $run_spoint_use_edit,
            "mat_linenum" => $lineNumber,
            "mat_master_linenum" => $run_linenum_use_edit,
            "mat_userpost" => getUser()->Fname." ".getUser()->Lname,
            "mat_ecodepost" => getUser()->ecode,
            "mat_datetime" => date("Y-m-d H:i:s"),
        );

        $this->db->insert("machine_template_temp" , $arSaveToTempTable);
        $output = array(
            "msg" => "บันทึกข้อมูลสำเร็จ",
            "status" => "Insert Success",
            "templatename" => $select_edit_template_name
        );

        echo json_encode($output);
    }




    public function loadRunScrFromTempTable()
    {
        if($this->input->post("templatename") != ""){
            $templatename = $this->input->post("templatename");
            $searchSelectRun = $this->input->post("searchSelectRun");

            $sql = $this->db->query("SELECT
            machine_template_temp.mat_autoid,
            machine_template_temp.mat_column_name,
            machine_template_temp.mat_machine_name,
            machine_template_temp.mat_machine_type,
            machine_template_temp.mat_min_value,
            machine_template_temp.mat_max_value,
            machine_template_temp.mat_spoint_value,
            machine_template_temp.mat_linenum,
            machine_template_temp.mat_master_linenum
            FROM
            machine_template_temp
            WHERE mat_machine_name = '$templatename'
            AND mat_column_name LIKE '%$searchSelectRun%'
            ORDER BY mat_linenum ASC
            ");
            $output = '';

            if($this->input->post("action") != "edit_template"){
                $output .= '<ul class="list-group runScMasterTemp">';
                foreach ($sql->result() as $rs) {
                    $calMatlineNumUp = $rs->mat_linenum - 1;
                    $calMatlineNumDown = $rs->mat_linenum + 1;
                    // $checkOrderRun = $this->db->query("SELECT mat_linenum FROM machine_template_temp WHERE mat_linenum ='$calMatlineNumUp' ");

                    // $checkOrderRun2 = $this->db->query("SELECT mat_linenum FROM machine_template_temp WHERE mat_linenum ='$calMatlineNumDown' ");

                    $checkUpItem = $this->db->query("SELECT mat_linenum FROM machine_template_temp ORDER BY mat_linenum ASC LIMIT 1");
                    $checkDownItem = $this->db->query("SELECT mat_linenum FROM machine_template_temp ORDER BY mat_linenum DESC LIMIT 1");

                    $displayI = "";
                    $displayI2 = "";

                    if($rs->mat_linenum == $checkUpItem->row()->mat_linenum){
                        $displayI = 'style="display:none;" ';
                    }

                    if($rs->mat_linenum == $checkDownItem->row()->mat_linenum){
                        $displayI2 = 'style="display:none;" ';
                    }


                    $output .= '<a>
                    <li class="list-group-item mb-1 runScMasTempLi">
                    <span>' . $rs->mat_column_name . '</span><br>
                    <span><b>Min : </b>'.conNumToText($rs->mat_min_value).'</span>&nbsp;&nbsp;<span><b>Max : </b>'.conNumToText($rs->mat_max_value).'</span><br>
                    <span><b>SPoint : </b>'.conNumToText($rs->mat_spoint_value).'</span>&nbsp;&nbsp;<span><b>Type : </b>'.conNumToText($rs->mat_machine_type).'</span>
                        <i class="icon-caret-left1 runScMasTempI"
                            data_mat_autoid = "'.$rs->mat_autoid.'"
                            data_mat_master_linenum = "'.$rs->mat_master_linenum.'"
                            data_mat_machine_name = "'.$rs->mat_machine_name.'"
                        ></i>

                        <button type="button" style="width:100%;" class="button button-border button-border-thin button-small button-amber runScMasTempIedit"
                            data_mat_autoid = "'.$rs->mat_autoid.'"
                            data_mat_master_linenum = "'.$rs->mat_master_linenum.'"
                            data_mat_machine_name = "'.$rs->mat_machine_name.'"
                            data_mat_min_value = "'.valueFormat($rs->mat_min_value).'"
                            data_mat_max_value = "'.valueFormat($rs->mat_max_value).'"
                            data_mat_spoint_value = "'.valueFormat($rs->mat_spoint_value).'"
                            data_mat_column_name = "'.$rs->mat_column_name.'"
                            data_mat_machine_type = "'.$rs->mat_machine_type.'"
                        ><i class="icon-edit2 iEdit"></i> แก้ไข</button>

                        <i class="icon-caret-up1 runScUpI" '.$displayI.'
                            data_mat_autoid = "'.$rs->mat_autoid.'"
                            data_mat_master_linenum = "'.$rs->mat_master_linenum.'"
                            data_mat_linenum = "'.$rs->mat_linenum.'"
                            data_mat_machine_name = "'.$rs->mat_machine_name.'"
                        ></i>

                        <i class="icon-caret-down1 runScDownI" '.$displayI2.'
                            data_mat_autoid = "'.$rs->mat_autoid.'"
                            data_mat_master_linenum = "'.$rs->mat_master_linenum.'"
                            data_mat_linenum = "'.$rs->mat_linenum.'"
                            data_mat_machine_name = "'.$rs->mat_machine_name.'"
                        ></i>

                    </li></a>
                    ';
                }
                $output .= '</ul>';
                echo $output;
            }else{
                $output .= '<ul class="list-group runScMasterTemp_edit">';
                foreach ($sql->result() as $rs) {

                    $checkUpItem = $this->db->query("SELECT mat_linenum FROM machine_template_temp ORDER BY mat_linenum ASC LIMIT 1");
                    $checkDownItem = $this->db->query("SELECT mat_linenum FROM machine_template_temp ORDER BY mat_linenum DESC LIMIT 1");

                    $displayI = "";
                    $displayI2 = "";

                    if($rs->mat_linenum == $checkUpItem->row()->mat_linenum){
                        $displayI = 'style="display:none;" ';
                    }

                    if($rs->mat_linenum == $checkDownItem->row()->mat_linenum){
                        $displayI2 = 'style="display:none;" ';
                    }


                    $output .= '<a>
                    <li id="runScMasTempLi_edit_'.$rs->mat_autoid.'" class="list-group-item mb-1 runScMasTempLi_edit">
                    <span>' . $rs->mat_column_name . '</span><br>
                    <span><b>Min : </b>'.conNumToText($rs->mat_min_value).'</span>&nbsp;&nbsp;<span><b>Max : </b>'.conNumToText($rs->mat_max_value).'</span><br>
                    <span><b>SPoint : </b>'.conNumToText($rs->mat_spoint_value).'</span>&nbsp;&nbsp;<span><b>Type : </b>'.conNumToText($rs->mat_machine_type).'</span>
                        <i class="icon-caret-left1 runScMasTempI_edit"
                            data_mat_autoid = "'.$rs->mat_autoid.'"
                            data_mat_master_linenum = "'.$rs->mat_master_linenum.'"
                            data_mat_machine_name = "'.$rs->mat_machine_name.'"
                        ></i>

                        <button type="button" style="width:100%;" class="button button-border button-border-thin button-small button-amber runScMasTempIedit_edit"
                            data_mat_autoid = "'.$rs->mat_autoid.'"
                            data_mat_master_linenum = "'.$rs->mat_master_linenum.'"
                            data_mat_machine_name = "'.$rs->mat_machine_name.'"
                            data_mat_min_value = "'.valueFormat($rs->mat_min_value).'"
                            data_mat_max_value = "'.valueFormat($rs->mat_max_value).'"
                            data_mat_spoint_value = "'.valueFormat($rs->mat_spoint_value).'"
                            data_mat_column_name = "'.$rs->mat_column_name.'"
                            data_mat_machine_type = "'.$rs->mat_machine_type.'"
                        ><i class="icon-edit2 iEdit"></i> แก้ไข</button>

                        <i class="icon-caret-up1 runScUpI_edit" '.$displayI.'
                            data_mat_autoid = "'.$rs->mat_autoid.'"
                            data_mat_master_linenum = "'.$rs->mat_master_linenum.'"
                            data_mat_linenum = "'.$rs->mat_linenum.'"
                            data_mat_machine_name = "'.$rs->mat_machine_name.'"
                        ></i>

                        <i class="icon-caret-down1 runScDownI_edit" '.$displayI2.'
                            data_mat_autoid = "'.$rs->mat_autoid.'"
                            data_mat_master_linenum = "'.$rs->mat_master_linenum.'"
                            data_mat_linenum = "'.$rs->mat_linenum.'"
                            data_mat_machine_name = "'.$rs->mat_machine_name.'"
                        ></i>

                    </li></a>
                    ';
                }
                $output .= '</ul>';
                echo $output;
            }
            
        }
    }






    public function save_frm_edit_runscreen_newtemplate()
    {
        $arr_edit_runscreen_newtemplate = array(
            "mat_min_value" => conPrice($this->input->post("editRSC_min")),
            "mat_max_value" => conPrice($this->input->post("editRSC_max")),
            "mat_spoint_value" => conPrice($this->input->post("editRSC_spoint"))
        );
        $this->db->where("mat_autoid" , $this->input->post("editRSC_autoid"));
        $this->db->update("machine_template_temp" , $arr_edit_runscreen_newtemplate);

        $output = array(
            "msg" => "อัพเดต ข้อมูลเรียบร้อยแล้ว",
            "status" => "Update Success",
            "templatename" => $this->input->post("editRSC_templatename")
        );

        echo json_encode($output);
    }




    public function delRunScrFromTempTable()
    {
        if($this->input->post("data_mat_autoid") != ""){
            $data_mat_autoid = $this->input->post("data_mat_autoid");
            $this->db->where("mat_autoid" , $data_mat_autoid);
            $this->db->delete("machine_template_temp");


            // หลังจากลบ Runscreen ออกแล้วให้ทำการอัพเดต Linenumber ใหม่
            
            // $countRow = $this->db->query("SELECT mat_column_name , mat_autoid FROM machine_template_temp");
            // $i = 1;
            // foreach($countRow->result() as $rs){
            //     $arUpdate = array(
            //         "mat_linenum" => $i
            //     );
            //     $this->db->where("mat_autoid" , $rs->mat_autoid);
            //     $this->db->update("machine_template_temp" , $arUpdate);
            //     $i++;
            // }
            

            $output = array(
                "msg" => "Delete already",
                "status" => "Delete Success"
            );
        }
        echo json_encode($output);
    }




    public function updateLinenumDown()
    {
        if($this->input->post("data_mat_linenum") != ""){

            $data_mat_linenum = $this->input->post("data_mat_linenum");
            $data_mat_autoid = $this->input->post("data_mat_autoid");

            $query = $this->db->query("SELECT mat_autoid , mat_linenum , mat_machine_name , mat_column_name FROM machine_template_temp ORDER BY mat_linenum ASC");

            $queryMatLine = $this->db->query("SELECT mat_linenum FROM machine_template_temp ORDER BY mat_linenum ASC");
            
            foreach($queryMatLine->result() as $rs){
                $output[] = $rs->mat_linenum;
            }

            
            $result = array_search($data_mat_linenum , $output); //return position array
            // echo json_encode($result);
            $j = $result+1;
            $moveArray = moveElementInArray($output, $result, $j);
            // echo json_encode($moveArray);
            $i = 0;
            foreach($query->result() as $rs){
                $arUpdate = array(
                    "mat_linenum" => $moveArray[$i]
                );
                $this->db->where("mat_autoid" , $rs->mat_autoid);
                $this->db->update("machine_template_temp" , $arUpdate);
                $i++;
            }

            $outputJson = array(
                "msg" => "เลื่อนตำแหน่งเรียบร้อย",
                "status" => "Change Position Success",
                "templatename" => $query->row()->mat_machine_name,
                "now" => $result,
                "to" => $j,
                "array" => $moveArray
            );

            echo json_encode($outputJson);
                  
        }
    }



    public function updateLinenumUp()
    {

        if($this->input->post("data_mat_linenum") != ""){

            $data_mat_linenum = $this->input->post("data_mat_linenum");
            $data_mat_autoid = $this->input->post("data_mat_autoid");

            $query = $this->db->query("SELECT mat_autoid , mat_linenum , mat_machine_name , mat_column_name FROM machine_template_temp ORDER BY mat_linenum ASC");

            $queryMatLine = $this->db->query("SELECT mat_linenum FROM machine_template_temp ORDER BY mat_linenum ASC");
            
            foreach($queryMatLine->result() as $rs){
                $output[] = $rs->mat_linenum;
            }

            
            $result = array_search($data_mat_linenum , $output); //return position array
            // echo json_encode($result);
            $j = $result-1;
            $moveArray = moveElementInArray($output, $result, $j);
            // echo json_encode($moveArray);
            
            $i = 0;
            foreach($query->result() as $rs){
                $arUpdate = array(
                    "mat_linenum" => $moveArray[$i]
                );
                $this->db->where("mat_autoid" , $rs->mat_autoid);
                $this->db->update("machine_template_temp" , $arUpdate);
                $i++;
            }

            $outputJson = array(
                "msg" => "เลื่อนตำแหน่งเรียบร้อย",
                "status" => "Change Position Success",
                "templatename" => $query->row()->mat_machine_name,
                "now" => $result,
                "to" => $j,
                "array" => $moveArray,
                "autoid" =>$data_mat_autoid
            );

            echo json_encode($outputJson);
                  
        }
    }








    public function getMachineTemp()
    {
        $machineName = "";
        if($this->input->post("machineName")){
            $machineName = $this->input->post("machineName");

            $sql = $this->db->query("SELECT
            machine_template.mat_column_name,
            machine_template.mat_machine_name,
            machine_template.mat_autoid
            FROM
            machine_template
            WHERE mat_machine_name = '$machineName' ORDER BY mat_autoid DESC 
            ");
                    $output = '
                    <h5>Machine Template '.$machineName.'</h5>
                        <div class="table-responsive">
                            <table id="machineTemplate" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Run screen</th>
                                    </tr>
                                </thead>
                                <tbody>
                            ';
                foreach($sql->result() as $rs){
                    $output .= '
                    <tr>
                        <td><i class="icon-line-chevrons-left iconMachineDel" data_mat_autoid = "'.$rs->mat_autoid.'" data_mat_machine_name="'.$rs->mat_machine_name.'"></i></td>
                        <td>' . $rs->mat_column_name . '</td>
                    </tr>
                    ';
                }
                    $output .= '
                                </tbody>
                            </table>
                        </div>
                        ';
                    echo $output;
            
        }
    }



    public function deleteRunscreenFromTemp()
    {
        $matautoid = "";
        if($this->input->post("runscreenAutoid")){
            $matautoid = $this->input->post("runscreenAutoid");
            $this->db->where("mat_autoid" , $matautoid);
            $this->db->delete("machine_template");

            $output = array(
                "status" => "DeleteSuccess"
            );

        }else{
            $output = array(
                "status" => "DeleteNotSuccess"
            );
        }
        echo json_encode($output);
    }




    public function runscreenManagement()
    {
        $sql = $this->db->query("SELECT
        runscreen_master.run_autoid,
        runscreen_master.run_name,
        runscreen_master.run_minvalue,
        runscreen_master.run_maxvalue,
        runscreen_master.run_spoint,
        runscreen_master.run_userpost,
        runscreen_master.run_ecodepost,
        runscreen_master.run_datetime,
        runscreen_master.run_type
        FROM
        runscreen_master
        ORDER BY run_autoid DESC
        ");

            $output = '
            <h4><u>รายการ Runscreen ทั้งหมด</u></h4>
                <div class="table-responsive">
                    <table id="runscreenManage">
                        <thead>
                            <tr>
                                <th>Run Screen</th>
                                <th>Min</th>
                                <th>Max</th>
                                <th>S Point</th>
                                <th>Run Type</th>
                                <th class="runManageBtn">#</th>
                            </tr>
                        </thead>
                        <tbody>
                    ';
        foreach($sql->result() as $rs)
        {

            $output .= '
                    <tr>
                        <td>' . $rs->run_name . '</td>
                        <td>' . $rs->run_minvalue . '</td>
                        <td>' . $rs->run_maxvalue . '</td>
                        <td>' . $rs->run_spoint . '</td>
                        <td>' . $rs->run_type . '</td>
                        <td>
                        <i class="icon-edit2 iconRunEdit"
                            data_run_name = "'.$rs->run_name.'" 
                            data_run_autoid="'.$rs->run_autoid.'"
                            data_run_type="'.$rs->run_type.'"
                            data_run_min="'.$rs->run_minvalue.'"
                            data_run_max="'.$rs->run_maxvalue.'"
                            data_run_spoint="'.$rs->run_spoint.'"
                        ></i>
                        <i class="icon-trash-alt iconRunDel" data_run_autoid="'.$rs->run_autoid.'" ></i>
                        </td>
                    </tr>
                    ';
        }

            $output .= '
                        </tbody>
                    </table>
                </div>
                ';
            echo $output;
    }






    public function saveRunscreen()
    {
        if($this->input->post("run_name") != ""){
            $getRunLinenum = getRunLinenum();
            $arSaveRunscreen = array(
                "run_name" => $this->input->post("run_name"),
                "run_minvalue" => conPrice($this->input->post("run_minvalue")),
                "run_maxvalue" => conPrice($this->input->post("run_maxvalue")),
                "run_spoint" => conPrice($this->input->post("run_spoint")),
                "run_linenum" => $getRunLinenum,
                "run_userpost" => getUser()->Fname." ".getUser()->Lname,
                "run_ecodepost" => getUser()->ecode,
                "run_datetime" => date("Y-m-d H:i:s"),
                "run_type" => $this->input->post("run_type")
            );

            $this->db->insert("runscreen_master" , $arSaveRunscreen);

            $output = array(
                "msg" => "บันทึกข้อมูลสำเร็จ",
                "status" => "insert success"
            );
        }else{
            $output = array(
                "msg" => "ไม่พบข้อมูล บันทึกข้อมูลไม่สำเร็จ",
                "status" => "insert not success"
            );
        }
        echo json_encode($output);
    }




    public function checkDupRunManage()
    {
        $runnameCheck = $this->input->post("run_name");
        $runTypeCheck = $this->input->post("run_type");
        if($this->input->post("run_name") != ""){
            $sql = $this->db->query("SELECT
            runscreen_master.run_name
            FROM
            runscreen_master
            WHERE run_name = '$runnameCheck' and run_type = '$runTypeCheck'
            ");
            if($sql->num_rows() > 0){
                $output = array(
                    "msg" => "พบข้อมูลซ้ำในระบบ",
                    "status" => "Found Duplicate Data"
                );
            }else{
                $output = array(
                    "msg" => "ไม่พบข้อมูลซ้ำในระบบ",
                    "status" => "Not Found Duplicate Data"
                );
            }
            echo json_encode($output);
        }
    }



    public function checkDupEditRunManage()
    {
        $runnameCheck = $this->input->post("edit_run_name");
        $runTypeCheck = $this->input->post("edit_run_type");
        if($this->input->post("edit_run_name") != ""){
            $sql = $this->db->query("SELECT
            runscreen_master.run_name
            FROM
            runscreen_master
            WHERE run_name = '$runnameCheck' and run_type = '$runTypeCheck'
            ");

            $output = array(
                "msg" => "Pass",
                "status" => "Pass"
            );
            echo json_encode($output);
        }
    }





    public function editRunscreen()
    {
        if($this->input->post("edit_run_name") != ""){
            $arSaveRunscreen = array(
                "run_name" => $this->input->post("edit_run_name"),
                "run_minvalue" => conPrice($this->input->post("edit_run_minvalue")),
                "run_maxvalue" => conPrice($this->input->post("edit_run_maxvalue")),
                "run_spoint" => conPrice($this->input->post("edit_run_spoint")),
                "run_userpost" => getUser()->Fname." ".getUser()->Lname,
                "run_ecodepost" => getUser()->ecode,
                "run_datetime" => date("Y-m-d H:i:s"),
                "run_type" => $this->input->post("edit_run_type")
            );
            $this->db->where("run_autoid" , $this->input->post("edit_run_autoid"));
            $this->db->update("runscreen_master" , $arSaveRunscreen);

            $output = array(
                "msg" => "บันทึกการแก้ไขข้อมูลสำเร็จ",
                "status" => "Update success"
            );
        }else{
            $output = array(
                "msg" => "ไม่พบข้อมูล บันทึกการแก้ไขข้อมูลไม่สำเร็จ",
                "status" => "Update not success"
            );
        }
        echo json_encode($output);
    }



    public function delRunscreen()
    {
        $runautoid = "";
        if($this->input->post("runAutoid")){
            $runautoid = $this->input->post("runAutoid");
            $this->db->where("run_autoid" , $runautoid);
            $this->db->delete("runscreen_master");

            $output = array(
                "msg" => "ลบข้อมูลสำเร็จ",
                "status" => "Delete success"
            );
        }else{
            $output = array(
                "msg" => "ลบข้อมูลไม่สำเร็จ",
                "status" => "Delete not success"
            );
        }
        echo json_encode($output);
    }


    public function copyTemplate()
    {

            $sql = $this->db->query("SELECT
            mat_machine_name,
            count(mat_column_name)as items
            FROM
                machine_template 
            group by mat_machine_name ORDER BY mat_autoid DESC");

            $output = '
            <table id="copyTemplateTable" class="table table-bordered" cellspacing="0" style="width:100%">
                <thead class="text-center">
                    <tr>
                        <th>ชื่อ Template</th>
                        <th>จำนวน RunScreen</th>
                        <th>#</th>
                        <th>#</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
            ';
        
            foreach ($sql->result() as $rs) {
                if(getdataTemDetail($rs->mat_machine_name)->num_rows() == 0){
                    $temImage = "";
                    $temProdCode = "";
                }else{
                    $temImage = getdataTemDetail($rs->mat_machine_name)->row()->ted_template_image;
                    $temProdCode = getdataTemDetail($rs->mat_machine_name)->row()->ted_template_itemuse;
                }
    
    
                $output .= '
                <tr>
                    <td class="text-nowrap">' . $rs->mat_machine_name . '</td>
                    <td>' . $rs->items . '</td>
                    <td class="text-center"><i class="icon-copy copyIcon" data-toggle="modal" data-target=""
                        data_mat_machine_name = "'.$rs->mat_machine_name.'"
                    ></i></td>
                    <td class="text-center"><i class="icon-edit iconTemEdit" data-toggle="modal" data-target=""
                        data_mat_machine_name = "'.$rs->mat_machine_name.'"
                        data_matchine_image = "'.$temImage.'"
                        data_matchine_prodcode = "'.$temProdCode.'"
                    ></i></td>
                    <td class="text-center"><i class="icon-trash iconTemDel" data-toggle="modal" data-target=""
                        data_mat_machine_name = "'.$rs->mat_machine_name.'"
                    ></i></td>
                </tr>
            ';
            }
        
                $output .= '
                </tbody>
            </table>
            ';
        
                echo $output;

    }






    public function saveCopyTemplate()
    {
        if($this->input->post("newTemplatename") != ""){
            $oldTemplatename = $this->input->post("oldTemplatename");
            $newTemplatename = $this->input->post("newTemplatename");
            //Query old template
            $sqlOldTem = $this->db->query("SELECT
            machine_template.mat_column_name,
            machine_template.mat_machine_name,
            machine_template.mat_machine_type,
            machine_template.mat_min_value,
            machine_template.mat_max_value
            FROM
            machine_template
            WHERE
            machine_template.mat_machine_name = '$oldTemplatename' ");

            foreach($sqlOldTem->result_array() as $rs){
                $arnewTemplateName = array(
                    "mat_column_name" => $rs['mat_column_name'],
                    "mat_machine_name" => $newTemplatename,
                    "mat_min_value" => $rs['mat_min_value'],
                    "mat_max_value" => $rs['mat_max_value'],
                    "mat_machine_type" => $rs['mat_machine_type']
                );
                $this->db->insert("machine_template" , $arnewTemplateName);
            }

            $output = array(
                "msg" => "Copy ข้อมูลสำเร็จ",
                "status" => "Copy Data Success"
            );

            echo json_encode($output);
        }
    }



    public function delTemplate()
    {
        $matchinename = "";
        if($this->input->post("matchinename")){
            $matchinename = $this->input->post("matchinename");

            //ลบข้อมูลที่ Table machine_template
            $this->db->where("mat_machine_name" , $matchinename);
            $this->db->delete("machine_template");
            //ลบข้อมูลที่ Table machine_template


            //ลบรูปภาพออกจาก Folder
            $path = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template/".getImageMachineBox($matchinename);
            unlink($path);
            $this->db->where("ted_template_name" , $matchinename);
            $this->db->delete("msd_template_detail");
            //ลบรูปภาพออกจาก Folder

            $output = array(
                "msg" => "ลบ Template เรียบร้อยแล้ว",
                "status" => "Delete Template Successfuly"
            );

            echo json_encode($output);
        }
    }



    public function loadTemplateBox()
    {
        getMachineBox();
    }

    public function loadDataTemplate()
    {
        if($this->input->post("templatename") != ""){
            $templatename = $this->input->post("templatename");

            $query = $this->db->query("SELECT
            msd_template_detail.ted_autoid,
            msd_template_detail.ted_template_name,
            msd_template_detail.ted_template_image,
            msd_template_detail.ted_template_itemuse
            FROM
            msd_template_detail
            WHERE ted_template_name = '$templatename'
            ");

            $row = $query->row();
            if($query->num_rows() != 0){
                $output = array(
                    "msg" => "ดึงข้อมูลสำเร็จ",
                    "status" => "Select Data Success",
                    "ted_template_name" => $row->ted_template_name,
                    "ted_template_image" => $row->ted_template_image,
                    "ted_template_itemuse" => $row->ted_template_itemuse
                );

                echo json_encode($output);
            }else{
                $output = array(
                    "msg" => "ดึงข้อมูลไม่สำเร็จ",
                    "status" => "Select Data Not Success",
                    "ted_template_name" => "",
                    "ted_template_image" => "",
                    "ted_template_itemuse" => ""
                );
                echo json_encode($output);
            }
        }
    }






/////////////////////////////////////////////
////////////Template detail page
public function temDetail()
{
    $machinename = "";

    if($this->input->post("machinename")){

        $machinename = $this->input->post("machinename");

        $sql = $this->db->query("SELECT
        machine_template.mat_autoid,
        machine_template.mat_column_name,
        machine_template.mat_machine_name,
        machine_template.mat_min_value,
        machine_template.mat_max_value,
        machine_template.mat_spoint_value,
        machine_template.mat_userpost,
        machine_template.mat_ecodepost,
        machine_template.mat_datetime
        FROM
        machine_template
        WHERE mat_machine_name = '$machinename' ORDER BY mat_autoid ASC
        ");
    
            $output = '
            <h5>Run Screen List</h5>
                <div class="table-responsive">
                    <table id="tempDetail" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Run screen</th>
                                <th>Min value</th>
                                <th>Max value</th>
                                <th>S Point Value</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                    ';
        foreach($sql->result() as $rs)
        {
           if($rs->mat_min_value <= 0){
            $minValue = "";
           }else{
            $minValue = $rs->mat_min_value;
           }

           if($rs->mat_max_value <= 0){
            $maxValue = "";
           }else{
            $maxValue = $rs->mat_max_value;
           }

           if($rs->mat_spoint_value <= 0){
            $spointValue = "";
           }else{
            $spointValue = $rs->mat_spoint_value;
           }

            $output .= '
                    <tr>
                        <td>' . $rs->mat_column_name . '</td>
                        <td>'.$minValue.'</td>
                        <td>'.$maxValue.'</td>
                        <td>'.$spointValue.'</td>
                        <td>
                        <i class="icon-edit2 iconEditMinMax" data-target="#min_max_md" data-toggle="modal" 
                        data_run_name = "'.$rs->mat_column_name.'" 
                        data_run_autoid="'.$rs->mat_autoid.'" 
                        data_run_machinename="'.$rs->mat_machine_name.'"
                        data_minvalue ="'.$rs->mat_min_value.'"
                        data_maxvalue ="'.$rs->mat_max_value.'"
                        data_spointvalue = "'.$rs->mat_spoint_value.'"
                        >
                        
                        </i>
                        </td>
                    </tr>
                    ';
        }
    
            $output .= '
                        </tbody>
                    </table>
                </div>
                ';
            echo $output;
    }

}





//////////////////////////////////////////
///////////Save Min max
public function saveMinMax()
{

    if($this->input->post("minMaxAutoid") != ""){
        $arMinMax = array(
            "mat_min_value" => $this->input->post("minvalue"),
            "mat_max_value" => $this->input->post("maxvalue"),
            "mat_spoint_value" => $this->input->post("spointvalue"),
        );
        $this->db->where("mat_autoid" , $this->input->post("minMaxAutoid"));
        $this->db->update("machine_template" , $arMinMax);

        $output = array(
            "msg" => "บันทึกข้อมูล Min and Max value สำเร็จแล้ว",
            "status" => "Update success",
            "machineName" => $this->input->post("minMaxMachinename")
        );
    }else{
        $output = array(
            "msg" => "บันทึกไม่สำเร็จ เนื่องจากกรอกข้อมูลไม่ครบถ้วน",
            "status" => "Update not success"
        );
    }

    echo json_encode($output);
}


public function loadLinenumFromTemp()
{
    $sql = $this->db->query("SELECT mat_autoid , mat_column_name , mat_linenum FROM machine_template_temp ORDER BY mat_linenum ASC");
    if($sql->num_rows() != 0){
        foreach($sql->result() as $rs)
        {
            $output[] = array(
                "line no." => $rs->mat_linenum,
                "id" => $rs->mat_autoid,
                "name" => $rs->mat_column_name
            );
        }
        echo json_encode($output);
    }else{
        return false;
    }
    
}


public function loadOldTemplate()
{
    if($this->input->post("templatename") != ""){
        $templatename = $this->input->post("templatename");

        $sql = $this->db->query("SELECT
        machine_template.mat_autoid,
        machine_template.mat_machine_name,
        msd_template_detail.ted_template_itemuse,
        msd_template_detail.ted_template_image
        FROM
        machine_template
        LEFT JOIN msd_template_detail ON msd_template_detail.ted_template_name = machine_template.mat_machine_name
        WHERE mat_machine_name LIKE '%$templatename%' OR ted_template_itemuse Like '%$templatename%'
        GROUP BY
        machine_template.mat_machine_name
        ORDER BY
        machine_template.mat_autoid DESC");

        $output = '';
        $output .= '<ul class="list-group oldTemplateUl">';
            foreach ($sql->result() as $rs) {
                if($rs->ted_template_itemuse == ""){
                    $item = "ยังไม่ได้กำหนด";
                }else{
                    $item = $rs->ted_template_itemuse;
                }
                $output .= '
                <a href="javascript:void(0)" class="oldTemplateLi" 
                    data_templatename = "'.$rs->mat_machine_name.'"
                    data_template_image = "'.$rs->ted_template_image.'"
                    data_template_itemuse = "'.$rs->ted_template_itemuse.'"
                ><li class="list-group-item mb-1">'.$rs->mat_machine_name." / ".$item.'</li></a>
            ';
            }
        $output .= '</ul>';
        echo $output;
    }


}


public function loadRunscreen()
{
    if($this->input->post("templatename") != ""){
        $templatename = $this->input->post("templatename");

        $sql = $this->db->query("SELECT
        machine_template.mat_autoid,
        machine_template.mat_column_name,
        machine_template.mat_machine_name,
        machine_template.mat_machine_type,
        machine_template.mat_min_value,
        machine_template.mat_max_value,
        machine_template.mat_spoint_value,
        machine_template.mat_linenum,
        machine_template.mat_master_linenum
        FROM
        machine_template
        WHERE mat_machine_name = '$templatename'
        ORDER BY mat_linenum ASC
        ");

        $output = '<ul class="list-group runScMasterTemp">';
        foreach ($sql->result() as $rs) {
            $calMatlineNumUp = $rs->mat_linenum - 1;
            $calMatlineNumDown = $rs->mat_linenum + 1;
            // $checkOrderRun = $this->db->query("SELECT mat_linenum FROM machine_template_temp WHERE mat_linenum ='$calMatlineNumUp' ");

            // $checkOrderRun2 = $this->db->query("SELECT mat_linenum FROM machine_template_temp WHERE mat_linenum ='$calMatlineNumDown' ");

            $checkUpItem = $this->db->query("SELECT mat_linenum FROM machine_template ORDER BY mat_linenum ASC LIMIT 1");
            $checkDownItem = $this->db->query("SELECT mat_linenum FROM machine_template ORDER BY mat_linenum DESC LIMIT 1");

            $displayI = "";
            $displayI2 = "";

            if($rs->mat_linenum == $checkUpItem->row()->mat_linenum){
                $displayI = 'style="display:none;" ';
            }

            if($rs->mat_linenum == $checkDownItem->row()->mat_linenum){
                $displayI2 = 'style="display:none;" ';
            }

            $output .= '<a>
            <li class="list-group-item mb-1 runScMasTempLi">
            <span>' . $rs->mat_column_name . '</span><br>
            <span><b>Min : </b>'.conNumToText($rs->mat_min_value).'</span>&nbsp;&nbsp;<span><b>Max : </b>'.conNumToText($rs->mat_max_value).'</span><br>
            <span><b>SPoint : </b>'.conNumToText($rs->mat_spoint_value).'</span>&nbsp;&nbsp;<span><b>Type : </b>'.$rs->mat_machine_type.'</span>
                <i class="icon-caret-left1 runScMasTempI"
                    data_mat_autoid = "'.$rs->mat_autoid.'"
                    data_mat_master_linenum = "'.$rs->mat_master_linenum.'"
                    data_mat_machine_name = "'.$rs->mat_machine_name.'"
                ></i>

                <i class="icon-edit2 runScMasTempIedit"
                    data_mat_autoid = "'.$rs->mat_autoid.'"
                    data_mat_master_linenum = "'.$rs->mat_master_linenum.'"
                    data_mat_machine_name = "'.$rs->mat_machine_name.'"
                    data_mat_min_value = "'.valueFormat($rs->mat_min_value).'"
                    data_mat_max_value = "'.valueFormat($rs->mat_max_value).'"
                    data_mat_spoint_value = "'.valueFormat($rs->mat_spoint_value).'"
                    data_mat_column_name = "'.$rs->mat_column_name.'"
                    data_mat_machine_type = "'.$rs->mat_machine_type.'"
                ></i>

                <i class="icon-caret-up1 runScUpI" '.$displayI.'
                    data_mat_autoid = "'.$rs->mat_autoid.'"
                    data_mat_master_linenum = "'.$rs->mat_master_linenum.'"
                    data_mat_linenum = "'.$rs->mat_linenum.'"
                    data_mat_machine_name = "'.$rs->mat_machine_name.'"
                ></i>

                <i class="icon-caret-down1 runScDownI" '.$displayI2.'
                    data_mat_autoid = "'.$rs->mat_autoid.'"
                    data_mat_master_linenum = "'.$rs->mat_master_linenum.'"
                    data_mat_linenum = "'.$rs->mat_linenum.'"
                    data_mat_machine_name = "'.$rs->mat_machine_name.'"
                ></i>

            </li></a>
            ';
        }
        $output .= '</ul>';
        echo $output;
    }
}




public function copyOriTemplateToTemp()
{

    // Check data From temp table
    if($this->db->truncate('machine_template_temp'))
        {
            //ลบไฟล์ออกจาก server
            $getfile = $this->db->query("SELECT ted_template_image FROM msd_template_detail_temp");
            if($getfile->num_rows() != 0){
                if($getfile->row()->ted_template_image != ""){
                    //ลบรูปภาพออกจาก Folder
                    $path = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template_temp/".$getfile->row()->ted_template_image;
                    unlink($path);
                } 
            }
            $this->db->truncate('msd_template_detail_temp');
        }


    $templatename = $this->input->post("templatename");
    $template_newname = $this->input->post("template_newname");
    $itemused = $this->input->post("itemused");
    $template_image = $this->input->post("template_image");
    $data_template_image = $this->input->post("data_template_image");
    $data_template_itemuse = $this->input->post("data_template_itemuse");


    if($data_template_image != ""){
        $pathFrom = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template/".$data_template_image;
        $pathTo = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template_temp/".$data_template_image;
        copy($pathFrom , $pathTo);
    }

    $selectData = $this->db->query("SELECT
    machine_template.mat_column_name,
    machine_template.mat_machine_name,
    machine_template.mat_machine_type,
    machine_template.mat_min_value,
    machine_template.mat_max_value,
    machine_template.mat_spoint_value,
    machine_template.mat_linenum,
    machine_template.mat_master_linenum
    FROM
        machine_template 
    WHERE
        mat_machine_name = '$templatename' 
    ORDER BY
        mat_linenum ASC");

    // Save data to temp table
    foreach($selectData->result() as $rs){
        $arsaveToTemp = array(
            "mat_column_name" => $rs->mat_column_name,
            "mat_machine_name" => $template_newname,
            "mat_machine_type" => $rs->mat_machine_type,
            "mat_min_value" => $rs->mat_min_value,
            "mat_max_value" => $rs->mat_max_value,
            "mat_spoint_value" => $rs->mat_spoint_value,
            "mat_linenum" => $rs->mat_linenum,
            "mat_master_linenum" => $rs->mat_master_linenum,
            "mat_userpost" => getUser()->Fname." ".getUser()->Lname,
            "mat_ecodepost" => getUser()->ecode,
            "mat_datetime" => date("Y-m-d H:i:s")
        );
        $masterlinenum[] = $rs->mat_master_linenum;
        $this->db->insert("machine_template_temp" , $arsaveToTemp);
    }



    $arsaveToDetailTemp = array(
        "ted_template_name" => $template_newname,
        "ted_template_itemuse" => $data_template_itemuse,
        "ted_template_image" => $data_template_image,
        "ted_template_user" => getUser()->Fname." ".getUser()->Lname,
        "ted_template_ecode" => getUser()->ecode,
        "ted_template_deptcode" => getUser()->DeptCode,
        "ted_template_datetime" => date("Y-m-d H:i:s")
    );
    $this->db->insert("msd_template_detail_temp" , $arsaveToDetailTemp);

    $output = array(
        "msg" => "บันทึกข้อมูลลง Machine Template Temp เรียบร้อยแล้ว",
        "status" => "Insert Success",
        "masterlinenum" => $masterlinenum
    );
    echo json_encode($output);

}




public function copyOriTemplateToTemp_edit()
{

    
    $templatename = $this->input->post("templatename");
    $itemuse = $this->input->post("itemuse");
    $template_image = $this->input->post("template_image");

    $selectData = $this->db->query("SELECT
    machine_template.mat_column_name,
    machine_template.mat_machine_name,
    machine_template.mat_machine_type,
    machine_template.mat_min_value,
    machine_template.mat_max_value,
    machine_template.mat_spoint_value,
    machine_template.mat_linenum,
    machine_template.mat_master_linenum
    FROM
        machine_template 
    WHERE
        mat_machine_name = '$templatename' 
    ORDER BY
        mat_autoid ASC");

    // Save data to temp table
    foreach($selectData->result() as $rs){
        $arsaveToTemp = array(
            "mat_column_name" => $rs->mat_column_name,
            "mat_machine_name" => $templatename,
            "mat_machine_type" => $rs->mat_machine_type,
            "mat_min_value" => $rs->mat_min_value,
            "mat_max_value" => $rs->mat_max_value,
            "mat_spoint_value" => $rs->mat_spoint_value,
            "mat_linenum" => $rs->mat_linenum,
            "mat_master_linenum" => $rs->mat_master_linenum,
            "mat_userpost" => getUser()->Fname." ".getUser()->Lname,
            "mat_ecodepost" => getUser()->ecode,
            "mat_datetime" => date("Y-m-d H:i:s")
        );
        $masterlinenum[] = $rs->mat_master_linenum;
        $this->db->insert("machine_template_temp" , $arsaveToTemp);
    }



    $arsaveToDetailTemp = array(
        "ted_template_name" => $templatename,
        "ted_template_itemuse" => $itemuse,
        "ted_template_image" => $template_image,
        "ted_template_user" => getUser()->Fname." ".getUser()->Lname,
        "ted_template_ecode" => getUser()->ecode,
        "ted_template_deptcode" => getUser()->DeptCode,
        "ted_template_datetime" => date("Y-m-d H:i:s")
    );
    $this->db->insert("msd_template_detail_temp" , $arsaveToDetailTemp);

    if($template_image != ""){
        $pathFrom = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template/".$template_image;
        $pathTo = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template_temp/".$template_image;
        copy($pathFrom , $pathTo);
    }
    

    $output = array(
        "msg" => "บันทึกข้อมูลลง Machine Template Temp เรียบร้อยแล้ว",
        "status" => "Insert Success",
        "masterlinenum" => $masterlinenum
    );
    echo json_encode($output);

}



public function checkTemplateNameDuplicate()
{
    if($this->input->post("template_newname") != ""){
        $templatename = $this->input->post("template_newname");
        $sql = $this->db->query("SELECT mat_machine_name FROM machine_template WHERE mat_machine_name = '$templatename' GROUP BY mat_machine_name ");

        $resultCheck = $sql->num_rows();
        if($resultCheck != 0){
            $output = array(
                "msg" => "ชื่อนี้ซ้ำในระบบ",
                "status" => "Found Duplicate Template Name"
            );
            echo json_encode($output);
        }else{
            $output = array(
                "msg" => "ชื่อนี้สามารถใช้ได้",
                "status" => "Not Found Duplicate Template Name"
            );
            echo json_encode($output);
        }
    }
}




public function loadRunscreenFromTemplate()
{
    if($this->input->post("templatename") != ""){

        $templatename = $this->input->post("templatename");
        $select_edit_searchRunscreenMaster = $this->input->post("select_edit_searchRunscreenMaster");

        $sql = $this->db->query("SELECT
        machine_template.mat_autoid,
        machine_template.mat_column_name,
        machine_template.mat_machine_name,
        machine_template.mat_machine_type,
        machine_template.mat_min_value,
        machine_template.mat_max_value,
        machine_template.mat_spoint_value,
        machine_template.mat_linenum,
        machine_template.mat_master_linenum
        FROM
        machine_template
        WHERE mat_machine_name = '$templatename' 
        AND mat_column_name LIKE '%$select_edit_searchRunscreenMaster%'
        ORDER BY mat_linenum ASC");

        $output = '';
        $output .= '<ul class="list-group runScSelectTemplate">';
            foreach ($sql->result() as $rs) {
        
                $output .= '
                <a href="javascript:void(0)" id="">
                <li class="list-group-item mb-1 runScSelectLi">
                    <div>
                        <span>' . $rs->mat_column_name . '</span>
                    </div>
                    <div>
                        <span><b>Min : </b>'.conNumToText($rs->mat_min_value).'</span>&nbsp;&nbsp;<span><b>Max : </b>'.conNumToText($rs->mat_max_value).'</span>
                        <span><b>SPoint : </b>'.conNumToText($rs->mat_spoint_value).'</span>&nbsp;&nbsp;<span><b>Type : </b>'.$rs->mat_machine_type.'</span>
                    </div>
                </li></a>
            ';
            }
        $output .= '</ul>';
        echo $output;
    }
}


public function deleteTemplate()
{
    if($this->input->post("templatename") != ""){
        $templatename = $this->input->post("templatename");
        $filename = $this->input->post("filename");

        // Unlink File
        if($filename != ""){
            $path = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template/".$filename;
            unlink($path);
        }
        
        // Delete template table machine_template
        $this->db->where("mat_machine_name" , $templatename);
        $this->db->delete("machine_template");


        // Delete msd_template_detail
        $this->db->where("ted_template_name" , $templatename);
        $this->db->delete("msd_template_detail");


        $output = array(
            "msg" => "ลบ Template สำเร็จ",
            "status" => "Delete Template Success"
        );

        echo json_encode($output);
    }
}



public function loadItemidFormTable()
{
    if($this->input->post("itemid") != ""){
        $itemid = $this->input->post("itemid");
        $sql = $this->db3->query("SELECT
            itemid 
        FROM
            prodtable WHERE itemid LIKE '%$itemid%' 
        GROUP BY
            itemid 
        ORDER BY
            itemid ASC");

        $output = '';
        $output .= '<ul class="list-group itemidUl">';
            foreach ($sql->result() as $rs) {
        
                $output .= '
                <a href="javascript:void(0)" id="itemidA"
                    data_itemid = "'.$rs->itemid.'"
                ><li class="list-group-item mb-1 itemidLi">
                <span>' . $rs->itemid . '</span><br>
                </li></a>
            ';
            }
        $output .= '</ul>';
        echo $output;
    }
}


public function loadItemidFormTable_edit()
{
    if($this->input->post("itemid") != ""){
        $itemid = $this->input->post("itemid");
        $sql = $this->db3->query("SELECT
            itemid 
        FROM
            prodtable WHERE itemid LIKE '%$itemid%' 
        GROUP BY
            itemid 
        ORDER BY
            itemid ASC");

        $output = '';
        $output .= '<ul class="list-group itemidUl_edit">';
            foreach ($sql->result() as $rs) {
        
                $output .= '
                <a href="javascript:void(0)" id="itemidA_edit"
                    data_itemid = "'.$rs->itemid.'"
                ><li class="list-group-item mb-1 itemidLi_edit">
                <span>' . $rs->itemid . '</span><br>
                </li></a>
            ';
            }
        $output .= '</ul>';
        echo $output;
    }
}



public function save_edittemplate_editrun()
{
    if($this->input->post("editRSC_autoid_edit") != ""){
        $arupdateRunscreen = array(
            "mat_min_value" => conPrice($this->input->post("editRSC_min_edit")),
            "mat_max_value" => conPrice($this->input->post("editRSC_max_edit")),
            "mat_spoint_value" => conPrice($this->input->post("editRSC_spoint_edit")),
        );

        $this->db->where("mat_autoid" , $this->input->post("editRSC_autoid_edit"));
        $this->db->update("machine_template_temp" , $arupdateRunscreen);

        $output = array(
            "msg" => "อัพเดต Runscreen สำเร็จ",
            "status" => "Update Success",
            "templatename" => $this->input->post("editRSC_templatename_edit")
        );
    }else{
        $output = array(
            "msg" => "อัพเดต Runscreen ไม่สำเร็จ",
            "status" => "Update Not Success",
            "templatename" => ""
        );
    }

    echo json_encode($output);
}



public function countTotalRunMasterShow()
{
    if($this->input->post("templatename") != ""){
        $templatename = $this->input->post("templatename");
        $sql = $this->db->query("SELECT mat_column_name FROM machine_template WHERE mat_machine_name = '$templatename' ");
        $output = '';

        $output .=$sql->num_rows();

        echo $output;
    }
}


public function getRunscreenMasterNew()
{
    echo "test";
}


public function overall_template()
{
    if($this->input->post("templatename") != ""){
        $templatename = $this->input->post("templatename");

        $sql = $this->db->query("SELECT mat_column_name , mat_machine_type FROM machine_template WHERE mat_machine_name = '$templatename' ORDER BY mat_linenum ASC ");

        $output = '';

        $output .='
        <h4 class="text-center">Total : '.$sql->num_rows().' รายการ</h4>
        <div id="submaindatadiv" class="table-responsive">
            <table>
                <thead>
                    <th style="width:90%;">Run Screen</th>
                    <th>Type</th>
                </thead>
        ';

        $output .='
                <tbody>   
        ';

        foreach($sql->result() as $rs){
            $output .='
                <tr>
                    <td>'.$rs->mat_column_name.'</td>
                    <td>'.$rs->mat_machine_type.'</td>
                </tr>
            ';
        }

        $output .='
                </tbody>
        ';

        $output .='
            </table>
        </div>
        ';

        echo $output;
    }
}



public function del_dataFromTemptableBy_templatename()
{
    $templatename = "";
    if($this->input->post("templatename") != ""){
        $templatename = $this->input->post("templatename");
        $ecode = $this->input->post("ecode");
        
        // Check Template ว่ามีข้อมูลใน Temptable ไหม
        $sql = $this->db->query("SELECT mat_machine_name FROM machine_template_temp WHERE mat_machine_name = '$templatename' AND mat_ecodepost = '$ecode' ");
        if($sql->num_rows() != 0){
            $this->db->where("mat_machine_name" , $templatename);
            $this->db->delete("machine_template_temp");
        }


        //Check Template Detail ว่ามีข้อมูลอยู่ไหม
        $sql2 = $this->db->query("SELECT ted_template_name , ted_template_image FROM msd_template_detail_temp WHERE ted_template_name = '$templatename' AND ted_template_ecode = '$ecode' ");

        $templateimage = "";
        if($sql2->num_rows() != 0){
            // Check File ว่ามีการอัพโหลดภาพมาแล้วหรือยัง
            $templateimage = $sql2->row()->ted_template_image;
            if($templateimage != ""){
                $path = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template_temp/".$templateimage;
                if(file_exists($path) != 0){
                    unlink($path);
                }  
            }

            $this->db->where("ted_template_name" , $templatename);
            $this->db->delete("msd_template_detail_temp");
        }

        $output = array(
            "msg" => "ล้างข้อมูลใน Temp Table Template ".$templatename."เรียบร้อยแล้ว",
            "status" => "Clear Data Already"
        );
        echo json_encode($output);
    }
}



public function checkDataOnTemptable()
{
    $templatename = "";
    if($this->input->post("templatename") != ""){
        $templatename = $this->input->post("templatename");
        $sql = $this->db->query("SELECT
        msd_template_detail_temp.ted_template_name,
        msd_template_detail_temp.ted_template_image,
        msd_template_detail_temp.ted_template_itemuse,
        machine_template_temp.mat_column_name
        FROM
        msd_template_detail_temp
        INNER JOIN machine_template_temp ON machine_template_temp.mat_machine_name = msd_template_detail_temp.ted_template_name
        WHERE ted_template_name = '$templatename' ");

        if($sql->num_rows() != 0){

            $this->db->where("mat_machine_name" , $templatename);
            $this->db->delete("machine_template_temp");

            $templateimage = $sql->row()->ted_template_image;
            if($templateimage != ""){
                $path = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template_temp/".$templateimage;
                unlink($path);
            }

            $this->db->where("ted_template_name" , $templatename);
            $this->db->delete("msd_template_detail_temp");


            $output = array(
                "msg" => "พบข้อมูล Template ".$templatename."เดิมบน Temp table",
                "status" => "Found Data",
                "templatename" => $templatename,
                "process" => "Done"
            );
        }else{
            $output = array(
                "msg" => "ไม่พบข้อมูล Template ".$templatename."เดิมบน Temp table",
                "status" => "Not Found Data",
                "templatename" => $templatename,
                "process" => "Done"
            );
        }

        echo json_encode($output);
    }
}


public function del_dataFromTemptable_whenReloadPageByEcode()
{
    $ecode = "";
    if($this->input->post("ecode") != ""){
        $ecode = $this->input->post("ecode");
        // Check Template ว่ามีข้อมูลใน Temptable ไหม
        $sql = $this->db->query("SELECT mat_machine_name FROM machine_template_temp WHERE mat_ecodepost = '$ecode' ");
        if($sql->num_rows() != 0){
            $this->db->where("mat_ecodepost" , $ecode);
            $this->db->delete("machine_template_temp");
        }


        //Check Template Detail ว่ามีข้อมูลอยู่ไหม
        $sql2 = $this->db->query("SELECT ted_template_name , ted_template_image FROM msd_template_detail_temp WHERE ted_template_ecode = '$ecode' ");

        $templateimage = "";
        if($sql2->num_rows() != 0){
            // Check File ว่ามีการอัพโหลดภาพมาแล้วหรือยัง
            $templateimage = $sql2->row()->ted_template_image;
            if($templateimage != ""){
                $path = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template_temp/".$templateimage;
                if(file_exists($path) != 0){
                    unlink($path);
                }   
            }

            $this->db->where("ted_template_ecode" , $ecode);
            $this->db->delete("msd_template_detail_temp");
        }

        $output = array(
            "msg" => "ลบข้อมูลที่ค้างออกหมดแล้ว",
            "status" => "Clear data by ecode already"
        );

        echo json_encode($output);
    }
}




public function checkDataTempBefore()
{
    $templatename = "";
    $ecode = "";

    if($this->input->post("templatename") != ""){
        $templatename = $this->input->post("templatename");
        $ecode = $this->input->post("ecode");
        $sql = $this->db->query("SELECT
                msd_template_detail_temp.ted_template_name,
                msd_template_detail_temp.ted_template_image,
                msd_template_detail_temp.ted_template_itemuse,
                machine_template_temp.mat_column_name,
                machine_template_temp.mat_machine_type,
                machine_template_temp.mat_linenum,
                machine_template_temp.mat_ecodepost,
                machine_template_temp.mat_userpost
                FROM
                msd_template_detail_temp
                INNER JOIN machine_template_temp ON machine_template_temp.mat_machine_name = msd_template_detail_temp.ted_template_name
                WHERE ted_template_name = '$templatename' ");
        
        // Check ว่า Template นี้มีคนอื่นกำลังแก้ไขอยู่หรือไม่
        $msgOutput = "";
        $statusOutput = "";
        if($sql->num_rows() != 0){
            // เช็คว่าใช่ user ตัวเองไหมที่แก้ไขค้างอยู่
            if($sql->row()->mat_ecodepost != $ecode){
                $msgOutput = "Template นี้กำลังถูกแก้ไขโดยคุณ ".$sql->row()->mat_userpost;
                $statusOutput = "Found other user edit template";
            }else{
                $msgOutput = "พบ Template ค้างในรายการแก้ไข ระบบกำลังลบ...";
                $statusOutput = "Clear data";
            }
        }else{
            $msgOutput = "ไม่พบความผิดปกติ เข้าสู่ขั้นตอนต่อไปได้";
            $statusOutput = "Ok";
        }

        $output = array(
            "msg" => $msgOutput,
            "status" => $statusOutput
        );

        echo json_encode($output);
    }
}




/////////////////////////////////////////////////////////////////////////////////
////////setting.html ส่วนของบริหารจัดการข้อมูลหน้า Setting page
////////////////////////////////////////////////////////////////////////////////












    /* End of file ModelName.php */
}

/* End of file ModelName.php */
