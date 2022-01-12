<?php
class getfn
{
    private $ci;
    function __construct()
    {
        $this->ci = &get_instance();
        date_default_timezone_set("Asia/Bangkok");
    }

    function gci()
    {
        return $this->ci;
    }
}



function gfn()
{
    $obj = new getfn();
    return $obj->gci();
}


/////////////////////////////////
//////////get Template///////////
////////////////////////////////
function getHead()
{
    gfn()->load->view("templates/header");
}
function getFooter()
{
    gfn()->load->view("templates/footer");
}
function getContent($page, $data)
{
    gfn()->parser->parse($page, $data);
}
function getTopmenu($page)
{
    gfn()->load->view($page);
}
function getModal($modal)
{
    gfn()->load->view($modal);
}
function getDb()
{
    $sql = gfn()->db->query("SELECT * FROM db WHERE db_autoid = 1 ");
    return $sql->row();
}

/////////////////////////////////
//////////get Template///////////
////////////////////////////////








////////////////////////////////
//////// Get zone ////////
///////////////////////////////

// Get Main form no
function getFormNo()
{
    $obj = new getfn();
    // check formno ซ้ำในระบบ
    $checkRowdata = $obj->gci()->db->query("SELECT
    fam_formno FROM farrel_main ORDER BY fam_autoid DESC LIMIT 1 
    ");
    $result = $checkRowdata->num_rows();

    $cutYear = substr(date("Y"), 2, 2);
    $getMonth = substr(date("m"), 0, 2);
    $formno = "";
    if ($result == 0) {
        $formno = "MS" . $cutYear . "000001";
    } else {

        $getFormno = $checkRowdata->row()->fam_formno;
        $cutGetYear = substr($getFormno, 2, 2); //KB2003001
        $cutNo = substr($getFormno, 4, 6); //อันนี้ตัดเอามาแค่ตัวเลขจาก CRF2003001 ตัดเหลือ 001
        $cutNo++;

        if ($cutNo < 10) {
            $cutNo = "00000" . $cutNo;
        } else if ($cutNo < 100) {
            $cutNo = "0000" . $cutNo;
        }else if($cutNo < 1000){
            $cutNo = "000" . $cutNo;
        }else if($cutNo < 10000){
            $cutNo = "00" . $cutNo;
        }else if($cutNo < 100000){
            $cutNo = "0" . $cutNo;
        }

        if ($cutGetYear != $cutYear) {
            $formno = "MS" . $cutYear ."000001";
        } else {
            $formno = "MS" . $cutGetYear . $cutNo;
        }
    }

    return $formno;
}
// Get Main form no





// Get Main form no
function getSubFormNo()
{
    $obj = new getfn();
    // check formno ซ้ำในระบบ
    $checkRowdata = $obj->gci()->db->query("SELECT
    fasub_formno FROM farrel_submain ORDER BY fasub_autoid DESC LIMIT 1 
    ");
    $result = $checkRowdata->num_rows();

    $cutYear = substr(date("Y"), 2, 2);
    $getMonth = substr(date("m"), 0, 2);
    $formno = "";
    if ($result == 0) {
        $formno = "FS" . $cutYear . "000001";
    } else {

        $getFormno = $checkRowdata->row()->fasub_formno;
        $cutGetYear = substr($getFormno, 2, 2); //KB2003001
        $cutNo = substr($getFormno, 4, 6); //อันนี้ตัดเอามาแค่ตัวเลขจาก CRF2003001 ตัดเหลือ 001
        $cutNo++;

        if ($cutNo < 10) {
            $cutNo = "00000" . $cutNo;
        } else if ($cutNo < 100) {
            $cutNo = "0000" . $cutNo;
        }else if($cutNo < 1000){
            $cutNo = "000" . $cutNo;
        }else if($cutNo < 10000){
            $cutNo = "00" . $cutNo;
        }else if($cutNo < 100000){
            $cutNo = "0" . $cutNo;
        }

        if ($cutGetYear != $cutYear) {
            $formno = "FS" . $cutYear ."000001";
        } else {
            $formno = "FS" . $cutGetYear . $cutNo;
        }
    }

    return $formno;
}
// Get Main form no



// Get Main form no
function getDetailFormNo()
{
    $obj = new getfn();
    // check formno ซ้ำในระบบ
    $checkRowdata = $obj->gci()->db->query("SELECT
    far_detail_formno FROM farrel_detail WHERE far_detail_formno != '' ORDER BY far_autoid DESC LIMIT 1 
    ");
    $result = $checkRowdata->num_rows();

    $cutYear = substr(date("Y"), 2, 2);
    $getMonth = substr(date("m"), 0, 2);
    $formno = "";
    if ($result == 0) {
        $formno = "FR" . $cutYear . "000001";
    } else {

        $getFormno = $checkRowdata->row()->far_detail_formno;
        $cutGetYear = substr($getFormno, 2, 2); //KB2003001
        $cutNo = substr($getFormno, 4, 6); //อันนี้ตัดเอามาแค่ตัวเลขจาก CRF2003001 ตัดเหลือ 001
        $cutNo++;

        if ($cutNo < 10) {
            $cutNo = "00000" . $cutNo;
        } else if ($cutNo < 100) {
            $cutNo = "0000" . $cutNo;
        }else if($cutNo < 1000){
            $cutNo = "000" . $cutNo;
        }else if($cutNo < 10000){
            $cutNo = "00" . $cutNo;
        }else if($cutNo < 100000){
            $cutNo = "0" . $cutNo;
        }

        if ($cutGetYear != $cutYear) {
            $formno = "FR" . $cutYear ."000001";
        } else {
            $formno = "FR" . $cutGetYear . $cutNo;
        }
    }

    return $formno;
}
// Get Main form no


// Get linenum ber for Group Runscreen Time
function getGroup_linenumber($mainformno)
{
    $sqlCheckLinenum = gfn()->db->query("SELECT far_runscreen_group_linenum FROM farrel_detail WHERE far_main_formno = '$mainformno' AND far_action = 'run' GROUP BY far_detail_formno ORDER BY far_runscreen_group_linenum DESC LIMIT 1 ");

    if($sqlCheckLinenum->num_rows() == 0)
    {
        $linenumGroup = 1;
    }else{
        $linenumGroup = $sqlCheckLinenum->row()->far_runscreen_group_linenum;
        $linenumGroup++;
    }

    return $linenumGroup;
}


////////////////////////////////
//////// Get zone ////////
///////////////////////////////















////////////////////////////////////////
///////////Query farrel_main tabel
////////////////////////////////////////
function sqlMainData()
{
    $sql = gfn()->db->query("SELECT
    fam_autoid,
    fam_formno,
    fam_machinename,
    fam_productcode,
    fam_batchnumber,
    fam_shit,
    fam_username,
    fam_userecode,
    fam_userdeptcode,
    fam_datetime
    FROM
    farrel_main
    ");

    return $sql;
}

function getMaindataRow($mainformno)
{
    $sql = gfn()->db->query("SELECT
    fam_autoid,
    fam_formno,
    fam_machinename,
    fam_productcode,
    fam_batchnumber,
    fam_shit,
    fam_username,
    fam_userecode,
    fam_userdeptcode,
    fam_datetime,
    fam_prodid,
    fam_outputhr,
    fam_deviation,
    fam_dataareaid,
    fam_mis,
    fam_output
    FROM
    farrel_main
    WHERE fam_formno = '$mainformno'
    ");

    return $sql->row();
}


function getDataareaid()
{
    gfn()->db3 = gfn()->load->database("prodplan" , true);
    $sql = gfn()->db3->query("SELECT
    dataareaid
    from prodtable
    group by dataareaid
    order by dataareaid asc");

    $output = "";
    $fullComName = "";
    foreach($sql->result() as $rs){
        switch($rs->dataareaid){
            case "ca":
                $fullComName = "Composite Asia Co.,Ltd";
                break;
            case "poly":
                $fullComName = "Poly Meritasia Co.,Ltd.";
                break;
            case "sln";
                $fullComName = "Salee Colour Public Company Limited.";
        }
        $output .='<option value="'.$rs->dataareaid.'">'.$fullComName.'</option>';
    }
    echo $output;
}

////////////////////////////////////////
/////////Query farrel_main tabel
////////////////////////////////////////







////////////////////////////////////////
//////Query farrel_submain table
///////////////////////////////////////
function sqlSubMainData($mainFormno)
{
    $sql = gfn()->db->query("SELECT
    fasub_autoid,
    fasub_formno,
    fasub_main_formno,
    fasub_worktime,
    fasub_remark,
    fasub_op_username,
    fasub_op_ecode,
    fasub_op_deptcode,
    fasub_op_datetime,
    fasub_app_username,
    fasub_app_ecode,
    fasub_app_deptcode,
    fasub_app_datetime
    FROM
    farrel_submain
    WHERE fasub_main_formno = '$mainFormno'
    ");
    return $sql->row();
}


////////////////////////////////////////
//////Query farrel_submain table
///////////////////////////////////////





////////////////////////////////////////
////// machine template
///////////////////////////////////////

function getMachineBox()
{
    $templatename = gfn()->input->post("templatename");


    $sql = gfn()->db->query("SELECT
    machine_template.mat_machine_name,
    machine_template.mat_userpost,
    machine_template.mat_ecodepost,
    machine_template.mat_datetime
    FROM
    machine_template
    WHERE mat_machine_name LIKE '%$templatename%'
    group by mat_machine_name ORDER BY mat_autoid DESC");


    $output = '
    ';
    foreach ($sql->result() as $rs) {
        $output .= '
        <div class="col-md-3 col-sm-4 col-6 mb-3">
            <a href="javascript:void(0)" id="tempdetailBox" name="tempdetailBox" class="tempdetailBox"
                data_machinename = "'.$rs->mat_machine_name.'"
            >
                <div class="card bg-dark text-white deptBox">
                '.getImageMachineBox($rs->mat_machine_name).'
                    <div id="templateBoxDiv" class="card-img-overlay">
                        <span class="textdept">' . $rs->mat_machine_name . '</span>
                    </div>
                </div>
            </a>
        </div>
        ';
    }

    echo $output;
}



function getImageMachineBox($machineName)
{
    $sql = gfn()->db->query("SELECT
        ted_template_image
        FROM msd_template_detail
        WHERE ted_template_name = '$machineName'
    ");
    if($sql->num_rows() == 0){
        // return "noimage.jpg";
        return false;
    }else{
        // return $sql->row()->ted_template_image;
        if($sql->row()->ted_template_image != ""){
            return '<img src="' . base_url('upload/images_template/').$sql->row()->ted_template_image.'" class="card-img deptbgimage" alt="...">';
        }else{
            return false;
        }
        
    }
}



///////////////////////////
///ดึงข้อมูลเครื่องจักร
//////////////////////////
function getMachineList($data_itemid)
{
    // $sql = gfn()->db->query("SELECT mat_machine_name FROM machine_template WHERE mat_machine_name LIKE '%$productcode%' Group by mat_machine_name ORDER BY mat_machine_name ASC");

        $sql = gfn()->db->query("SELECT
        machine_template.mat_machine_name,
        msd_template_detail.ted_template_itemuse
        FROM
        machine_template
        INNER JOIN msd_template_detail ON msd_template_detail.ted_template_name = machine_template.mat_machine_name
        WHERE msd_template_detail.ted_template_itemuse LIKE '%$data_itemid%'
        GROUP BY mat_machine_name 
        ORDER BY mat_autoid DESC");

    $output = '<ul class="list-group chooseTemplateUl">';
            foreach ($sql->result() as $rs) {
                $output .= '
                <a href="#" id="chooseTemplate"
                data_tempname = "' . $rs->mat_machine_name . '"
                ><li class="list-group-item">' . $rs->mat_machine_name . '</li></a>
            ';
            }
            $output .= '</ul>';
            echo $output;
}




function getMachineList2($templateName)
{
    // $sql = gfn()->db->query("SELECT mat_machine_name FROM machine_template WHERE mat_machine_name LIKE '%$productcode%' Group by mat_machine_name ORDER BY mat_machine_name ASC");

        $sql = gfn()->db->query("SELECT
        machine_template.mat_machine_name
        FROM
        machine_template
        WHERE machine_template.mat_machine_name LIKE '%$templateName%'
        GROUP BY mat_machine_name 
        ORDER BY mat_autoid DESC");

        $output = '<ul class="list-group chooseTemplateUl">';
        foreach ($sql->result() as $rs) {
            $output .= '
            <a href="#" id="chooseTemplate"
            data_tempname = "' . $rs->mat_machine_name . '"
            ><li class="list-group-item">' . $rs->mat_machine_name . '</li></a>
        ';
        }
        $output .= '</ul>';
        echo $output;
}


////////////////////////////////////////
////// machine template
///////////////////////////////////////






///////////////////////////////////////////
////////Control viewmaindata.html
//////////////////////////////////////////


//////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
///////////////////Get Data To Runscreen Section
//////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
function getsubmaindata2($mainFormno , $detailFormno_now)
{
    $output ='';
    // $fasub_formno = getSubFormNoToModal($mainFormno);

    $output .='
    <div class="row">
    <div class="col-md-12" id="">
        <button type="button" id="btn_addrun" name="btn_addrun" class="button button-small button-circle button-green btn_addrun statusStopBtn" data-toggle="modal" data-target="#runs_modal" 
            data_matchineTemp="'.getModalTitle($mainFormno)->fam_machinename.'" 
            data_mainFormno="'.$mainFormno.'" 
            data_autoid=""
            data_shift=""
            data_systemdatetime = ""
            data_prodid="'.getModalTitle($mainFormno)->fam_prodid.'"
            data_productcode="'.getModalTitle($mainFormno)->fam_productcode.'"
            data_batchnumber="'.getModalTitle($mainFormno)->fam_batchnumber.'"
        ><i class="icon-plus-sign" style="font-size:16px;"></i>&nbsp;เพิ่มข้อมูล</button>

        <button type="button" id="btn_editrun" name="btn_editrun" class="button button-small button-circle button-amber btn_editrun statusStopBtn" data-toggle="modal" data-target="#editRuns_modal" 
            data_matchineTemp="" 
            data_mainFormno="'.$mainFormno.'" 
            data_autoid=""
            data_prodid="'.getModalTitle($mainFormno)->fam_prodid.'"
            data_productcode="'.getModalTitle($mainFormno)->fam_productcode.'"
            data_batchnumber="'.getModalTitle($mainFormno)->fam_batchnumber.'"
        ><i class="icon-edit2" style="font-size:16px;"></i>&nbsp;แก้ไขข้อมูล</button>

        <a href="'.base_url('main/exportdata/exportdata_fromtemplate/').$mainFormno.'"><button type="button" id="btn_exportrun" name="btn_exportrun" class="button button-small button-circle button-aqua btn_exportrun"><i class="icon-file-excel" style="font-size:16px;"></i>&nbsp;ส่งออกข้อมูล</button></a>
    </div>
    </div>
    <hr>
    ';

    $output .='
    <div class="row arrowSection" style="display:none;">
        <div id="arrowDiv" class="col-md-12 d-flex justify-content-between">
            <i class="icon-line-arrow-left iconArrowLeft"></i>
            <i class="icon-line-arrow-right iconArrowRight"></i>
        </div>
    </div><hr class="arrowSection" style="display:none;">
    ';

    $createDate = "";
    $createUserPost = "";
    $modifyDate = "";
    $modifyUserPost = "";
    if(getUserCreate($mainFormno)->num_rows() != 0){
        if(getUserCreate($mainFormno)->row()->far_userpost != null){
            $createDate = conDatetimeFromDb(getUserCreate($mainFormno)->row()->far_datetime);
            $createUserPost = getUserCreate($mainFormno)->row()->far_userpost;
        }else{
            $createDate = "";
            $createUserPost = "";
        }

        if(getUserCreate($mainFormno)->row()->far_userpost != null || getUserCreate($mainFormno)->row()->far_userpost != ""){
            $modifyDate = conDatetimeFromDb(getUserCreate($mainFormno)->row()->far_datetime);
            $modifyUserPost = getUserCreate($mainFormno)->row()->far_userpost;
        }else{
            $modifyDate = "";
            $modifyUserPost = "";
        }
    }

    $output .= '
    <div id="submaindatadiv" class="">
        <table id="runscreenManage" class="table-responsive">
            <thead>
                <tr>
                    <th class="fRunscreen">
                        Run screen
                    </th>
                    <th class="cWorktimeH">S/Point</th>';
    if(getWorktime2($mainFormno)->num_rows() != 0){
        foreach(getWorktime2($mainFormno)->result() as $rs){

            $detailFormno[]=$rs->far_detail_formno;

            $radioCheckGroupLinenum = '';
            if($detailFormno_now == $rs->far_detail_formno){
                $radioCheckGroupLinenum = 'checked';
            }else{
                $radioCheckGroupLinenum = '';
            }
        
                        $output .='
                            <th class="cWorktimeH" style="text-align:center;">'.convertTimeToShift($rs->far_worktime).'<br>'.$rs->far_worktime.'<br>
                            <i class="icon-time sysdt"
                                data_systemDatetime="'.conDateTimeFromDb(getSysDT($rs->far_detail_formno)->far_datetime).'"
                                data_systemDatetime_modify="'.conDateTimeFromDb(getSysDT($rs->far_detail_formno)->far_datetime_modify).'"
                            ></i>
                            <input '.$radioCheckGroupLinenum.' type="radio" name="groupLinenum" id="groupLinenum" class="groupLinenum" value="'.$rs->far_runscreen_group_linenum.'"
                                data_far_detail_formno = "'.$rs->far_detail_formno.'"
                                data_far_main_formno = "'.$mainFormno.'"
                                data_far_runscreen_group_linenum = "'.$rs->far_runscreen_group_linenum.'"
                            >
                            </th>
                                ';
                                
        }
    }

    $createDate = "";
    $createUserPost = "";
    $modifyDate = "";
    $modifyUserPost = "";
    if(getUserCreate($mainFormno)->num_rows() != 0){
        if(getUserCreate($mainFormno)->row()->far_userpost != null){
            $createDate = conDatetimeFromDb(getUserCreate($mainFormno)->row()->far_datetime);
            $createUserPost = getUserCreate($mainFormno)->row()->far_userpost;
        }else{
            $createDate = "";
            $createUserPost = "";
        }


        /////////////////////User modify Zone -> Position Footer ////////////////////////////
        if(getUserCreate($mainFormno)->row()->far_userpost != null){
            $modifyDate = conDatetimeFromDb(getUserCreate($mainFormno)->row()->far_datetime);
            $modifyUserPost = getUserCreate($mainFormno)->row()->far_userpost;
        }else{
            $modifyDate = "";
            $modifyUserPost = "";
        }
        /////////////////////User modify Zone -> Position Footer ////////////////////////////
    }
                
                    
                $output .='               
                </tr>

                <tr>
                    <th class="runMemo">หมายเหตุ</th>
                    <th></th>
                    ';
     
               
                foreach(get_worktime($mainFormno)->result() as $rs){
                    $detailformno = $rs->far_detail_formno;
                    if(get_memo($detailformno , $mainFormno) != ""){
                        $iconNote = '<i class="icon-line-twitch faMemo" data-toggle="modal" data-target="#faMemo_modal"
                        data_faMemo="'.get_memo($detailformno , $mainFormno).'"
                        ></i>';
                    }else{
                        $iconNote = '';
                    }
                    // For loop
                    $output .='
                        <th>'.$iconNote.'</th>
                            ';
                    // For loop
                }
            
                $output .='                
                </tr>
                ';
                


                $output .='
                <tr>
                    <th class="runImage">อัพโหลดไฟล์รูปหน้าจอ</th>
                    <th></th>
                    ';
     
                // For loop
                foreach(get_worktime($mainFormno)->result() as $rs){
                    $detailformno = $rs->far_detail_formno;
                    // For loop
                        if(checkImageRunZero($detailformno , "อัพโหลดไฟล์รูปหน้าจอ" , $mainFormno) != 0){
                            $imageFile1 = getImageRun1($detailformno , $mainFormno)->file_name;
                        }else{
                            $imageFile1 = "";
                        }
                        if($imageFile1 != ""){
                            $iconImage1 = '<i class="icon-image faImage" data-toggle="modal" data-target="#faImage_modal"
                            data_detailFormno="'.$detailformno.'"
                            data_mainFormno="'.$mainFormno.'"
                            data_fileType="'.getImageRun1($detailformno , $mainFormno)->file_type.'"
                            data_filename="'.getImageRun1($detailformno , $mainFormno)->file_name.'"
                            ></i>';
                        }else{
                            $iconImage1 = '';
                        }
    
                    $output .='
                        <th>'.$iconImage1.'</th>
                            ';
                }
            
                // For loop
                $output .='
                </tr>';


                $output .='
                <tr>
                    <th class="runImage">อัพโหลดไฟล์รูปเม็ด MB.</th>
                    <th></th>
                    ';
         
                    foreach(get_worktime($mainFormno)->result() as $rs){
                        $detailformno = $rs->far_detail_formno;  
                        if(checkImageRunZero($detailformno,"อัพโหลดไฟล์รูปเม็ด MB." , $mainFormno) != 0){
                            $imageFile2 = getImageRun2($detailformno , $mainFormno)->file_name;
                        }else{
                            $imageFile2 = "";
                        }
        
                        if($imageFile2 != ""){
                            $iconImage2 = '<i class="icon-image faImage2" data-toggle="modal" data-target="#faImage_modal"
                            data_detailFormno="'.$detailformno.'"
                            data_mainFormno="'.$mainFormno.'"
                            data_fileType="'.getImageRun2($detailformno , $mainFormno)->file_type.'"
                            data_filename="'.getImageRun2($detailformno , $mainFormno)->file_name.'"
                            ></i>';
                        }else{
                            $iconImage2 = '';
                        }
                        // For loop
                        $output .='
                            <th>'.$iconImage2.'</th>
                                ';
                        // For loop
                    }
            
                $output .='
                </tr>';


                $output .='
                <tr>
                    <th class="runImage">อัพโหลดไฟล์รูปปัญหาในการผลิตและการทำงาน</th>
                    <th></th>
                ';
          
                foreach(get_worktime($mainFormno)->result() as $rs){
                    $detailformno = $rs->far_detail_formno;

                    if(checkImageRunZero($detailformno,"อัพโหลดไฟล์รูปปัญหาในการผลิตและการทำงาน" , $mainFormno) != 0){
                        $imageFile3 = getImageRun3($detailformno , $mainFormno)->file_name;
                    }else{
                        $imageFile3 = "";
                    }

                    if($imageFile3 != ""){
                        $iconImage3 = '<i class="icon-image faImage3" data-toggle="modal" data-target="#faImage_modal"
                        data_detailFormno="'.$detailformno.'"
                        data_mainFormno="'.$mainFormno.'"
                        data_fileType="'.getImageRun3($detailformno , $mainFormno)->file_type.'"
                        data_filename="'.getImageRun3($detailformno , $mainFormno)->file_name.'"
                        ></i>';
                    }else{
                        $iconImage3 = '';
                    }
                    // For loop
                    $output .='
                        <th>'.$iconImage3.'</th>
                        ';
                    // For loop
                }
            
                $output .='
                </tr>';



                $output .='<tr>
                    <th class="runImage">อัพโหลดไฟล์อื่นๆ</th>
                    <th></th>
                ';
         
                foreach(get_worktime($mainFormno)->result() as $rs){
                    $detailformno = $rs->far_detail_formno;

                    if(checkImageRunZero($detailformno,"อัพโหลดไฟล์อื่นๆ" , $mainFormno) != 0){
                        $imageFile4 = getImageRun4($detailformno , $mainFormno)->file_name;
                    }else{
                        $imageFile4 = "";
                    }

                    if($imageFile4 != ""){
                        $iconImage4 = '<i class="icon-image faImage4" data-toggle="modal" data-target="#faImage_modal"
                        data_detailFormno="'.$detailformno.'"
                        data_mainFormno="'.$mainFormno.'"
                        data_fileType="'.getImageRun4($detailformno , $mainFormno)->file_type.'"
                        data_filename="'.getImageRun4($detailformno , $mainFormno)->file_name.'"
                        ></i>';
                    }else{
                        $iconImage4 = '';
                    }
                    // For loop
                    $output .='
                        <th>'.$iconImage4.'</th>
                    ';
                    // For loop
                }
            
                $output .='
                </tr>';

            


        $output .='
        </thead>
            <tbody>
            ';

            foreach(get_runscreen_name($mainFormno)->result() as $rs){
                $output .='
                <tr>
                    <td class="cRunscreen" id="1">'.$rs->far_runscreen_name.'</td>
                    <td class="cSpoint">'.valueFormat($rs->far_runscreen_value).'</td>
                    ';

            

                if(getWorktime2($mainFormno)->num_rows() != 0){
                    foreach($detailFormno as $rss){
                    $runTextColor = '';
                    
                    $mixValue = @get_min_max($rss , $rs->far_runscreen_linenum , $mainFormno)->far_runscreen_min;
                    $maxValue = @get_min_max($rss , $rs->far_runscreen_linenum , $mainFormno)->far_runscreen_max;

                    $runValue = get_time_value($rss , $rs->far_runscreen_linenum , $mainFormno);

                    if($runValue < $mixValue || $runValue > $maxValue){
                        $runTextColor = ' style="color:#e20707;" ';
                    }else{
                        $runTextColor = '';
                    }

                    $output .='
                        <td id="time1" class="cWorktime" '.$runTextColor.'>'.valueFormat($runValue ).'</td>
                    ';
                    }
                }
                

                
                        

       
                    $output .='                
                    </tr>
                    ';
            }
                    $output .='
                </tbody>
                
            </table>
        </div>
        ';



        if(getStartAndEnd($mainFormno)->num_rows() != 0){
            $operator = getStartAndEnd($mainFormno)->row()->ptwo_userstart;
            $operatorDate = conDateTimeFromDb(getStartAndEnd($mainFormno)->row()->ptwo_datetimestart);

            // $modifyUserPost = "";
            // $modifyDate = "";

            $approve =  getStartAndEnd($mainFormno)->row()->ptwo_userend;
            $approveDate = conDateTimeFromDb(getStartAndEnd($mainFormno)->row()->ptwo_datetimeend);
        }else{
            $operator = "";
            $operatorDate = "";

            // $modifyUserPost = "";
            // $modifyDate = "";

            $approve = "";
            $approveDate = "";
        }
            $output .='

        <div class="row text-center form-group">
            <div class="col-md-4">
                <span><b>Start by: </b>'.$operator.'</span><br>
                <span><b>Start Date : </b>'.$operatorDate.'</span>
            </div>

            <div class="col-md-4">
                <span><b>Modify by: </b>'.$modifyUserPost.'</span><br>
                <span><b>Modify Date : </b>'.$modifyDate.'</span>
            </div>

            <div class="col-md-4">
                <span><b>Stop by: </b>'.$approve.'</span><br>
                <span><b>End Date : </b>'.$approveDate.'</span>
            </div>
        </div>
                    ';

            
            if(checkSpointStatus($mainFormno) == "yes"){
                echo $output;
            }
}

//////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
///////////////////Get Data To Runscreen Section
//////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////















function checkSpointStatus($mainFormno)
{
    $sql = gfn()->db->query("SELECT ptwo_spointstatus FROM farrel_main WHERE fam_formno = '$mainFormno' ");
    return $sql->row()->ptwo_spointstatus;
}

function get_runscreen_name($mainFormno)
{
    $sql = gfn()->db->query("SELECT far_runscreen_name , far_runscreen_value , far_runscreen_min , far_runscreen_max , far_runscreen_linenum FROM farrel_detail Where far_action = 'spoint' And far_main_formno = '$mainFormno' ");
    return $sql;
}

function get_spoint_value($mainFormno)
{
    $sql = gfn()->db->query("SELECT far_runscreen_value FROM farrel_detail Where far_action = 'spoint' And far_main_formno = '$mainFormno' ");
    return $sql->row()->far_runscreen_value;
}

function get_time_value($detailformno , $runscreenlinenum , $mainFormno)
{
    $sql = gfn()->db->query("SELECT far_runscreen_value FROM farrel_detail 
            Where far_action = 'run' And 
            far_detail_formno = '$detailformno' AND 
            far_runscreen_linenum = '$runscreenlinenum' AND
            far_main_formno = '$mainFormno'
            ");

    if($sql->num_rows() == 0){
        return false;
    }else{
        return $sql->row()->far_runscreen_value;
    }
    
}

function get_min_max($detailformno , $runscreenlinenum , $mainFormno)
{
    $sql = gfn()->db->query("SELECT far_runscreen_value , far_runscreen_min , far_runscreen_max FROM farrel_detail 
            Where far_action = 'run' And 
            far_detail_formno = '$detailformno' AND 
            far_runscreen_linenum = '$runscreenlinenum' AND 
            far_main_formno = '$mainFormno'
            ");

    if($sql->num_rows() == 0){
        return false;
    }else{
        return $sql->row();
    }
}

function get_worktime($mainFormno)
{
    $sql = gfn()->db->query("SELECT far_worktime , far_detail_formno , far_runscreen_value , far_sub_formno FROM farrel_detail WHERE far_main_formno = '$mainFormno' AND far_action = 'run' group by far_runscreen_group_linenum ORDER BY far_runscreen_group_linenum ASC ");
    return $sql;
}

function get_time_detailFormno($far_detail_formno)
{
    $sql = gfn()->db->query("SELECT far_worktime , far_detail_formno FROM farrel_detail WHERE far_sub_formno = '$far_detail_formno' AND far_action = 'run' GROUP BY far_worktime ");
    return $sql->row();
}

function get_memo($far_detail_formno , $far_main_formno)
{
    $sql = gfn()->db->query("SELECT fd_memo FROM msd_memo WHERE fd_refformno='$far_detail_formno' AND fd_refmainformno = '$far_main_formno' ");
    return $sql->row()->fd_memo;
}

function get_image1($far_detail_formno)
{
    $sql = gfn()->db->query("SELECT file_name FROM msd_files WHERE file_detail_formno='$far_detail_formno' AND file_type= 'อัพโหลดไฟล์รูปหน้าจอ' ");
    return $sql;
}

function getModalTitle($mainFormno)
{
    $sql = gfn()->db->query("SELECT * FROM farrel_main WHERE fam_formno = '$mainFormno' ");
    return $sql->row();
}

// function getSubFormNoToModal($mainFormno)
// {
//     $sql = gfn()->db->query("SELECT fasub_formno FROM farrel_submain WHERE fasub_main_formno = '$mainFormno' ORDER BY fasub_autoid DESC LIMIT 1 ");
//     if($sql->num_rows() == 0){
//         return false;
//     }else{
//         return $sql->row()->fasub_formno;
//     }
    
// }

function getSubShiftName($subformno)
{
    $sql = gfn()->db->query("SELECT fasub_worktime FROM farrel_submain WHERE fasub_formno = '$subformno' ");
    if($sql->num_rows() == 0){
        return false;
    }else{
        return $sql->row()->fasub_worktime;
    }
}

///////////////////////////////////////////////////////////////
///Function Get Submain Data2
//////////////////////////////////////////////////////////////
function getWorktime2($mainFormno)
{
    $sql = gfn()->db->query("SELECT far_worktime , far_detail_formno , far_runscreen_group_linenum FROM farrel_detail WHERE far_main_formno = '$mainFormno' AND far_action = 'run' GROUP BY far_runscreen_group_linenum , far_sub_formno , far_detail_formno ORDER BY far_runscreen_group_linenum ASC ");
    return $sql;
}

function convertTimeToShift($workTime)
{
    $shiftName = "";
    if($workTime >= "07:00" && $workTime <= "18:59"){
        $shiftName = "shift-a";
    }else if($workTime >= "19:00" && $workTime <= "23:59"){
        $shiftName = "shift-c";
    }else if($workTime >= "00:00" && $workTime <= "06:59"){
        $shiftName = "shift-c";
    }
    return $shiftName;
}

function getUserCreate($mainFormno)
{
    $sql = gfn()->db->query("SELECT
        far_userpost,
        far_datetime,
        far_user_modify,
        far_datetime_modify,
        far_detail_formno,
        far_worktime 
    FROM
        farrel_detail 
    WHERE
        far_main_formno = '$mainFormno' 
        AND far_action = 'run' 
    GROUP BY
        far_detail_formno 
    ORDER BY
        far_autoid DESC 
        LIMIT 1;");

    return $sql;
}


function getSysDT($detailFormno)
{
    $sql = gfn()->db->query("SELECT
    far_datetime,
    far_datetime_modify
    FROM farrel_detail
    WHERE far_detail_formno = '$detailFormno'
    GROUP BY far_detail_formno
    ");
    return $sql->row();
}

function getStartAndEnd($mainFormno)
{
    $sql = gfn()->db->query("SELECT
    ptwo_datetimestart,
    ptwo_userstart,
    ptwo_datetimeend,
    ptwo_userend
    FROM farrel_main
    WHERE fam_formno = '$mainFormno' AND ptwo_pagestatus in ('Start' , 'Stop' , 'Cancel')
    ");
    return $sql;

}















function valueFormat($inputNumber)
{
    $conToDecimal = floatval($inputNumber);
    $stringafterDot = strstr($conToDecimal, ".");
    $decimalNumber = strlen($stringafterDot);

    if($decimalNumber == 0){
        $conNumber = number_format($inputNumber , 0);
    }else{
        $conNumber = number_format($inputNumber , 4);
    }

    if($conNumber == 0){
        return null;
    }else{
        return $conNumber;
    }
    
}


function valueFormat2($inputNumber)
{
    if(substr($inputNumber , -2 , 1) != 0){
        $rsCheckBumber = number_format($inputNumber,4,'.','');
    }else if(substr($inputNumber , -3 , 1) != 0){
        $rsCheckBumber = number_format($inputNumber,2,'.','');
    }else if(substr($inputNumber , -4 , 1) != 0){
        $rsCheckBumber = number_format($inputNumber,1,'.','');
    }else{
        $rsCheckBumber = number_format($inputNumber,0,'.','');
    }


    return $rsCheckBumber;
}


function getDetailSpoint($mainFormno , $runscreenname)
{
    $sql = gfn()->db->query("SELECT
    farrel_detail.far_runscreen_name,
    farrel_detail.far_runscreen_value
    FROM
    farrel_detail
    WHERE far_main_formno = '$mainFormno' AND far_action = 'spoint' AND far_runscreen_name ='$runscreenname' ORDER BY far_runscreen_name ASC
    ");
    return $sql;
}


function loadRunscreen($mainformno)
{
    $sql = gfn()->db->query("SELECT
    farrel_detail.far_autoid,
    farrel_detail.far_detail_formno,
    farrel_detail.far_main_formno,
    farrel_detail.far_sub_formno,
    farrel_detail.far_worktime,
    farrel_detail.far_action,
    farrel_detail.far_runscreen_name,
    farrel_detail.far_runscreen_value
    FROM
    farrel_detail
    WHERE far_main_formno = '$mainformno' group by far_runscreen_name  ORDER BY far_autoid ASC");

    return $sql;
}



function checkSpoint($mainformno)
{
    $sql = gfn()->db->query("SELECT far_main_formno , far_action FROM farrel_detail WHERE far_main_formno = '$mainformno' AND far_action = 'spoint' ");
    return $sql->num_rows();
}


function getTimerun($subFormno)
{
    $sql = gfn()->db->query("SELECT
    farrel_detail.far_worktime,
    farrel_detail.far_detail_formno
    FROM
    farrel_detail
    where far_sub_formno = '$subFormno'
    group by far_worktime order by far_detail_formno asc");
    return $sql;
}


function getMemoRun($detailFormno , $mainFormno)
{
    $sql = gfn()->db->query("SELECT * FROM msd_memo WHERE fd_refformno='$detailFormno' AND fd_refmainformno = '$mainFormno' ");
    return $sql->row();
}


function getImageRun1($detailFormno , $mainformno)
{
    $sql = gfn()->db->query("SELECT * FROM msd_files WHERE file_detail_formno = '$detailFormno' AND file_type = 'อัพโหลดไฟล์รูปหน้าจอ' AND file_main_formno = '$mainformno' ");
    return $sql->row();
}

function getImageRun2($detailFormno , $mainformno)
{
    $sql = gfn()->db->query("SELECT * FROM msd_files WHERE file_detail_formno = '$detailFormno' AND file_type = 'อัพโหลดไฟล์รูปเม็ด MB.' AND file_main_formno = '$mainformno' ");
    return $sql->row();
}

function getImageRun3($detailFormno , $mainformno)
{
    $sql = gfn()->db->query("SELECT * FROM msd_files WHERE file_detail_formno = '$detailFormno' AND file_type = 'อัพโหลดไฟล์รูปปัญหาในการผลิตและการทำงาน' AND file_main_formno = '$mainformno' ");
    return $sql->row();
}

function getImageRun4($detailFormno , $mainformno)
{
    $sql = gfn()->db->query("SELECT * FROM msd_files WHERE file_detail_formno = '$detailFormno' AND file_type = 'อัพโหลดไฟล์อื่นๆ' AND file_main_formno = '$mainformno' ");
    return $sql->row();
}

function checkImageRunZero($detailFormno , $fileType , $mainformno)
{
    $sql = gfn()->db->query("SELECT * FROM msd_files WHERE file_detail_formno = '$detailFormno' AND file_type = '$fileType' AND file_main_formno = '$mainformno' ");
    return $sql->num_rows();
}


function getRunValue($fardetailformno , $farrunscreenname)
{
    $sql = gfn()->db->query("SELECT
    farrel_detail.far_worktime,
    farrel_detail.far_runscreen_name,
    farrel_detail.far_runscreen_value,
    farrel_detail.far_runscreen_min,
    farrel_detail.far_runscreen_max
    FROM
    farrel_detail
    where far_detail_formno = '$fardetailformno' AND far_runscreen_name = '$farrunscreenname'
    order by far_runscreen_name asc");
    return $sql;
}


function getBom($mainformno)
{
    $sql = gfn()->db->query("SELECT
    farrel_bom.b_autoid,
    farrel_bom.b_mainformno,
    farrel_bom.b_prodid,
    farrel_bom.b_linenum,
    farrel_bom.b_rawmaterial,
    farrel_bom.b_bomqty,
    farrel_bom.b_bomqtyuse,
    farrel_bom.b_bomstatus,
    farrel_bom.b_bomqtyusemix,
    farrel_bom.b_bombalance
    FROM
    farrel_bom    
    WHERE b_mainformno = '$mainformno' and b_bomstatus != 'inactive'
    ");

    $output = '<div class="list-group">';
    foreach($sql->result() as $rs){

        $mainformno = $rs->b_mainformno;
        $prodid = $rs->b_prodid;
        $rawmaterial = $rs->b_rawmaterial;
        $b_autoid = $rs->b_autoid;
        $bomforuse = $rs->b_bombalance;

        $textColor ="";
        if($bomforuse == 0){
            $textColor = 'style="color:#CC0000"';
        }else{
            $textColor ='';
        }

        // Check ว่ามีการจองเพื่อ Mix หรือยัง
            if($rs->b_bomstatus == "wait confirm"){
                $mixStatus = '<span class="badge badge-warning badge-pill ml-3 p-2 bomsum">Wait Mix !</span>';
                $modalId = "";
            }else{
                $mixStatus = "";
                $modalId = "#md_bom";
            }
        // Check ว่ามีการจองเพื่อ Mix หรือยัง

        //////////////////////////////////
        ///// Check Dept permission
        /////////////////////////////////
        if(getUser()->DeptCode == "1007" || getUser()->ecode == "M1809"){
            $output .='
                <a href="javascript:void(0)" class="list-group-item list-group-item-action md_bom"
                data_mainformno="'.$rs->b_mainformno.'"
                data_prodid="'.$rs->b_prodid.'"
                data_rawmaterial="'.$rs->b_rawmaterial.'"
                data_bomqty="'.$rs->b_bomqty.'"
                data_bomqtyuse="'.$rs->b_bomqtyuse.'"
                data_bomsum="'.$bomforuse.'"
                data_bomautoid="'.$rs->b_autoid.'"
                data_bomstatus="'.$rs->b_bomstatus.'"
                data_productcode="'.getMaindataRow($rs->b_mainformno)->fam_productcode.'"
                data_batchnumber="'.getMaindataRow($rs->b_mainformno)->fam_batchnumber.'"

                >'.$rs->b_rawmaterial.'<span class="badge badge-success badge-pill ml-3 p-2 bomtotal">'.$rs->b_bomqty.'</span>
                <span class="badge badge-warning badge-pill ml-3 p-2 bomsum" '.$textColor.'>'.number_format($bomforuse,3).'</span>
                '.$mixStatus.'
                </a>
                ';
        }else{
                $output .='
                <a href="javascript:void(0)" class="list-group-item list-group-item-action">'.$rs->b_rawmaterial.'<span class="badge badge-success badge-pill ml-3 p-2 bomtotal">'.$rs->b_bomqty.'</span>
                <span class="badge badge-warning badge-pill ml-3 p-2 bomsum" '.$textColor.'>'.number_format($bomforuse,3).'</span>
                '.$mixStatus.'
                </a>
                ';
        }
        //////////////////////////////////
        ///// Check Dept permission
        /////////////////////////////////


    }
    $output .='</div>';
    echo $output;
}



function getBomMix($mainformno)
{
    $sql = gfn()->db->query("SELECT
    farrel_bom.b_autoid,
    farrel_bom.b_mainformno,
    farrel_bom.b_prodid,
    farrel_bom.b_linenum,
    farrel_bom.b_rawmaterial,
    farrel_bom.b_bomqty,
    farrel_bom.b_bomtype,
    farrel_bom.b_bomqtyuse
    FROM
    farrel_bom    
    WHERE b_mainformno = '$mainformno' and b_bomtype = 'mix'
    ");

    $countData = $sql->num_rows();
    if($countData == 0){
        $notify = "ยังไม่มีข้อมูลการ Mix";
    }else{
        $notify = "";
    }

    $output = '<div class="list-group">';
    foreach($sql->result() as $rs){


        $mainformno = $rs->b_mainformno;
        $prodid = $rs->b_prodid;
        $rawmaterial = $rs->b_rawmaterial;
        $b_autoid = $rs->b_autoid;
        $bomforuse = $rs->b_bomqty - getBomInFeeder($mainformno , $prodid , $rawmaterial , $b_autoid);

        $textColor ="";
        if($bomforuse == 0){
            $textColor = 'style="color:#CC0000"';
        }else{
            $textColor ='';
        }


        if(getUser()->DeptCode == "1007" || getUser()->ecode == "M1809"){
            $output .='
            <a href="javascript:void(0)" class="list-group-item list-group-item-action bommixed"
            data_mainformno="'.$rs->b_mainformno.'"
            data_prodid="'.$rs->b_prodid.'"
            data_rawmaterial="'.$rs->b_rawmaterial.'"
            data_bomqty="'.$rs->b_bomqty.'"
            data_bomqtyuse="'.$rs->b_bomqtyuse.'"
            data_bomsum="'.$bomforuse.'"
            data_bomtype="'.$rs->b_bomtype.'"
            data_bomautoid="'.$rs->b_autoid.'"
            data_productcode="'.getMaindataRow($rs->b_mainformno)->fam_productcode.'"
            data_batchnumber="'.getMaindataRow($rs->b_mainformno)->fam_batchnumber.'"
            >'.$rs->b_rawmaterial.'
            <span class="badge badge-success badge-pill ml-3 p-2">'.$rs->b_bomqty.'</span>
            <input hidden type="text" name="cBomMix_total" id="cBomMix_total" value="'.$rs->b_bomqty.'">
            <span class="badge badge-warning badge-pill ml-3 p-2 bomsum" '.$textColor.'>'.number_format($bomforuse,3).'</span>
            <input hidden type="text" name="cBomMixUse" id="cBomMixUse" value="'.number_format($bomforuse,3).'">
            </a>
            ';
        }else{
            $output .='
            <a href="javascript:void(0)" class="list-group-item list-group-item-action">'.$rs->b_rawmaterial.'
            <span class="badge badge-success badge-pill ml-3 p-2">'.$rs->b_bomqty.'</span>
            <input hidden type="text" name="cBomMix_total" id="cBomMix_total" value="'.$rs->b_bomqty.'">
            <span class="badge badge-warning badge-pill ml-3 p-2 bomsum" '.$textColor.'>'.number_format($bomforuse,3).'</span>
            <input hidden type="text" name="cBomMixUse" id="cBomMixUse" value="'.number_format($bomforuse,3).'">
            </a>
            ';
        }

        
    }
    $output .='</div>';
    echo $output.$notify;
    
}




function getBomInFeeder($mainformno , $prodid , $rawmaterial , $rawAutoid)
{
    $sql = gfn()->db->query("SELECT
    farrel_feeder.faf_autoid,
    farrel_feeder.faf_mainformno,
    farrel_feeder.faf_prodid,
    farrel_feeder.faf_feedername,
    farrel_feeder.faf_rawmaterial,
    sum(farrel_feeder.faf_value)as sumvalue
    FROM
    farrel_feeder
    WHERE faf_mainformno = '$mainformno' and faf_prodid = '$prodid' and faf_rawmaterial = '$rawmaterial' and faf_rawautoid = '$rawAutoid'
    ");

return $sql->row()->sumvalue;
}


function getBomForMix($mainformno)
{
    $sql = gfn()->db->query("SELECT
    farrel_bom.b_autoid,
    farrel_bom.b_mainformno,
    farrel_bom.b_prodid,
    farrel_bom.b_linenum,
    farrel_bom.b_rawmaterial,
    farrel_bom.b_bomqty,
    farrel_bom.b_bomqtyuse,
    farrel_bom.b_bombalance,
    farrel_bom.b_bomtype,
    farrel_bom.b_bomstatus
    FROM
    farrel_bom
    WHERE b_bomtype != 'Mix' and b_bombalance != 0 and b_mainformno = '$mainformno'
    ");

    $output ='<div class="list-group">';
    foreach($sql->result() as $rs){

        if($rs->b_bomstatus == "wait confirm"){
            $bominactive = '<span class="badge badge-warning badge-pill ml-3 p-2 bomtotal">รอยืนยันการ Mix</span>';
        }else{
            $bominactive = '';
        }

        //ดึงข้อมูล Bom qty มาคำนวณ

        if($rs->b_bomqtyuse == 0){
            $bomqty = $rs->b_bomqty;
        }else{
            $bomqty = $rs->b_bombalance;
        }
    

        $output .='
        <a href="javascript:void(0)" class="list-group-item list-group-item-action mix_bom"
            data_rawmaterial ="'.$rs->b_rawmaterial.'"
            data_bomqty ="'.$rs->b_bomqty.'"
            data_bomqtyuse="'.$rs->b_bomqtyuse.'"
            data_bombalance="'.$rs->b_bombalance.'"
            data_b_autoid="'.$rs->b_autoid.'"
            data_b_prodid="'.$rs->b_prodid.'"
            data_bomstatus="'.$rs->b_bomstatus.'"
        >'.$rs->b_rawmaterial.'<span class="badge badge-success badge-pill ml-3 p-2 bomtotal">'.$rs->b_bombalance.'</span>'.$bominactive.'
        </a>
        ';
    }
    $output .='</div>';
    echo $output;
}



function getWaitConfirmMix($mainformno)
{
    $sql = gfn()->db->query("SELECT
    farrel_bom.b_autoid,
    farrel_bom.b_mainformno,
    farrel_bom.b_prodid,
    farrel_bom.b_linenum,
    farrel_bom.b_rawmaterial,
    farrel_bom.b_bomqty,
    farrel_bom.b_bomqtyuse,
    farrel_bom.b_bombalance,
    farrel_bom.b_bomtype,
    farrel_bom.b_bomstatus
    FROM
    farrel_bom
    WHERE b_mainformno = '$mainformno' and b_bomstatus = 'wait confirm'
    ");
    $output ='';
    foreach($sql->result() as $rs){
        if($output == ''){
            $output .= $rs->b_rawmaterial;
        }else{
            $output .= " + ".$rs->b_rawmaterial;
        }
    }
    echo $output;
}


function countWaitConfirmMix($mainformno)
{
    $sql = gfn()->db->query("SELECT
    sum(b_bombalance)as bomsum
    FROM
    farrel_bom
    WHERE b_mainformno = '$mainformno' and b_bomstatus = 'wait confirm'
    ");
    
    echo $sql->row()->bomsum;
}



function getBomForMix2($mainformno)
{
    $sql = gfn()->db->query("SELECT
    farrel_bom.b_autoid,
    farrel_bom.b_mainformno,
    farrel_bom.b_prodid,
    farrel_bom.b_linenum,
    farrel_bom.b_rawmaterial,
    farrel_bom.b_bomqty,
    farrel_bom.b_bomqtyuse,
    farrel_bom.b_bombalance,
    farrel_bom.b_bomtype
    FROM
    farrel_bom
    WHERE b_bomtype = 'Mix' and b_mainformno = '$mainformno'
    ");

    $output ='<div class="list-group">';
    foreach($sql->result() as $rs){
        $output .='
        
        <a href="javascript:void(0)" class="list-group-item list-group-item-action">'.$rs->b_rawmaterial.'<span class="badge badge-success badge-pill ml-3 p-2 bomtotal">'.$rs->b_bomqty.'</span>
        </a>
        ';
    }
    $output .='</div>';
    echo $output;
}



function getFeederChoose($mainformno)
{
    $sql = gfn()->db->query("SELECT
    farrel_feeder.faf_feedername
    FROM
    farrel_feeder
    WHERE faf_mainformno = '$mainformno' and faf_value is null
    ");
    $output ='<select name="md_chooseFeeder" id="md_chooseFeeder" class="form-control">
    <option value="">กรุณาเลือก Feeder</option>
    ';
    foreach($sql->result() as $rs){
        $output .='
            <option value="'.$rs->faf_feedername.'">'.$rs->faf_feedername.'</option>
        ';
    }
    $output .='</select>';
    echo $output;
}



function getFeederTemp($mainformno)
{
    $sql = gfn()->db->query("SELECT
    faf_autoid,
    faf_mainformno,
    faf_prodid,
    faf_feedername,
    faf_rawmaterial,
    faf_value,
    faf_rawautoid
    FROM
    farrel_feeder
    WHERE faf_mainformno = '$mainformno' ");

    $output = '';

    if($sql->num_rows() == 0){
        $output .='<h3 class="text-center">พบข้อผิดพลาดเกี่ยวกับ Feeder กรุณาติดต่อไอที</h3>';
    }else{
        $output .='
        <div class="table-responsive">
            <table id="runscreenManage" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <th style="width:80px;">Feeder</th>
                    <th>Raw Material</th>
                    <th style="width:90px;">%</th>
                    <th style="width:80px;">#</th>
                </thead>
                <tbody>
        ';
        foreach($sql->result() as $rs){
            if($rs->faf_value != ""){
                if(checkStatusPage2($rs->faf_mainformno)->ptwo_pagestatus == "Stop" || checkStatusPage2($rs->faf_mainformno)->ptwo_pagestatus == "Cancel"){
                    // //ถ้าเป็น User แผนกอื่นเข้ามาดูจะไม่เห็นปุ่มเหล่านี้ ยกเว้น
                    // if(getUser()->ecode == "M1809"){//ถ้าเป็น User ของ Develop จะเห็นปุ่มปกติ
                    //     $iconFeedDel = '<i id="iconFeedDel" class="icon-trash-alt iconFeedDel"
                    //     data_autoid="'.$rs->faf_autoid.'"
                    //     data_mainformno="'.$rs->faf_mainformno.'"
                    //     data_prodid="'.$rs->faf_prodid.'"
                    //     data_rawmaterial="'.$rs->faf_rawmaterial.'"
                    //     data_value="'.$rs->faf_value.'"
                    //     data_rawautoid="'.$rs->faf_rawautoid.'"
                    //     ></i>';
                    // }else{//ถ้าเป็น User ทั่วไป
                    //     $iconFeedDel = '';
                    // }
                    $iconFeedDel = '';
                }else{
                    // ตรวจสอบว่าใช่คนของแผนก Production หรือไม่
                    if(getUser()->DeptCode != 1007){
                        $iconFeedDel = '';
                        // if(getUser()->ecode == "M1809"){ //ถ้าเป็น User Develop
                        //     $iconFeedDel = '<i id="iconFeedDel" class="icon-trash-alt iconFeedDel"
                        //     data_autoid="'.$rs->faf_autoid.'"
                        //     data_mainformno="'.$rs->faf_mainformno.'"
                        //     data_prodid="'.$rs->faf_prodid.'"
                        //     data_rawmaterial="'.$rs->faf_rawmaterial.'"
                        //     data_value="'.$rs->faf_value.'"
                        //     data_rawautoid="'.$rs->faf_rawautoid.'"
                        //     ></i>';
                        // }
                    }else{
                        $iconFeedDel = '<i id="iconFeedDel" class="icon-trash-alt iconFeedDel"
                        data_autoid="'.$rs->faf_autoid.'"
                        data_mainformno="'.$rs->faf_mainformno.'"
                        data_prodid="'.$rs->faf_prodid.'"
                        data_rawmaterial="'.$rs->faf_rawmaterial.'"
                        data_value="'.$rs->faf_value.'"
                        data_rawautoid="'.$rs->faf_rawautoid.'"
                        ></i>';
                    }
                    
                }
                
            }else{
                $iconFeedDel = '';
            }
            $output .='
            <tr>
                <td>'.$rs->faf_feedername.'</td>
                <td>'.$rs->faf_rawmaterial.'</td>
                <td>'.$rs->faf_value.'</td>
                <td>'.$iconFeedDel.'</td>
            </tr>
            ';
            $arvalue[] = $rs->faf_value;
        }
    
        $resultSum = array_sum($arvalue);
    
        if($resultSum != 100){
            $textColor = 'style="color:#CC0000;"';
        }else{
            $textColor = 'style="color:#009900;"';
        }
    
        $output .='
        <tr>
            <td colspan="2" class="text-right"><b>Total</b></td>
            <td colspan="2" '.$textColor.'><b>'.number_format($resultSum,3).'</b></td>
        </tr>
                </tbody>
            </table>
            <input hidden type="text" name="checkFeederSum" id="checkFeederSum" value="'.number_format($resultSum,3).'">
        </div>
        ';
    }


    echo $output;
}

///////////////////////////////////////////////////////////
///////////// Zone Function ของการ Mix
//////////////////////////////////////////////////////////

function checkItemMixAlready($b_autoid)
{
    $sql = gfn()->db->query("SELECT b_bomqtyusemix FROM farrel_bom WHERE b_autoid = '$b_autoid' ");
    $result = $sql->row();
    return $result->b_bomqtyusemix;
}


function checkFeederSumValue($mainformno)
{
    $sql = gfn()->db->query("SELECT sum(faf_value)as sumValue FROM farrel_feeder WHERE faf_mainformno = '$mainformno' ");
    return $sql->row()->sumValue;
}

function selectUseValue($mainformno , $prodid , $rawmaterial , $rawautoid)
{
    $sql = gfn()->db->query("SELECT 
    b_bomqtyuse FROM farrel_bom 
    WHERE b_mainformno='$mainformno' and b_prodid='$prodid' and b_rawmaterial='$rawmaterial' and b_autoid='$rawautoid' 
    ");
    return $sql->row()->b_bomqtyuse;
}

function selectBalanceValue($mainformno , $prodid , $rawmaterial , $rawautoid)
{
    $sql = gfn()->db->query("SELECT 
    b_bombalance FROM farrel_bom 
    WHERE b_mainformno='$mainformno' and b_prodid='$prodid' and b_rawmaterial='$rawmaterial' and b_autoid='$rawautoid' 
    ");
    return $sql->row()->b_bombalance;
}


///////////////////////////////////////////////////////////
///////////// Zone Function ของการ Mix
//////////////////////////////////////////////////////////


function getTemplateType()
{
    $sql = gfn()->db->query("SELECT * FROM machine_type ORDER BY mct_typename ASC");
    $output = '
    <select name="machine_type" id="machine_type" class="form-control" >
        <option value="">กรุณาเลือกประเภทเครื่องจักร</option>
    ';
    foreach($sql->result() as $rs){
        $output .='
            <option value="'.$rs->mct_typename.'">'.$rs->mct_typename.'</option>
        ';
    }
    $output .='</select>';
    echo $output;
}


function getOutput($mainformno)
{
    $sql = gfn()->db->query("SELECT fam_outputhr , fam_deviation FROM farrel_main WHERE fam_formno = '$mainformno' ");
    return $sql->row();
}


function loadCheckListFromDb()
{
    $sql = gfn()->db->query("SELECT * FROM msd_template_checkmachine ORDER BY temck_order ASC");
    return $sql;
}



function checkStatusPage2($mainformno)
{
    $sql = gfn()->db->query("SELECT
    farrel_main.ptwo_pagestatus,
    farrel_main.ptwo_datetimeend,
    farrel_main.ptwo_deptcodeend,
    farrel_main.ptwo_ecodeend,
    farrel_main.ptwo_userend,
    farrel_main.ptwo_datetimestart,
    farrel_main.ptwo_deptcodestart,
    farrel_main.ptwo_ecodestart,
    farrel_main.ptwo_userstart
    FROM
    farrel_main
    WHERE fam_formno = '$mainformno'
    ");

    return $sql->row();
}



function countFeeder($mainformno)
{
    $sql = gfn()->db->query("SELECT * FROM farrel_feeder WHERE faf_mainformno = '$mainformno' and faf_value != '' ");
    return $sql->num_rows();
}


function getShiftStartOnSubmain($mainformno)
{
    $sql = gfn()->db->query("SELECT
    farrel_submain.fasub_worktime
    FROM
    farrel_submain
    WHERE fasub_main_formno = '$mainformno'
    ORDER BY fasub_autoid ASC LIMIT 1
    ");
    $output = '';
    // $countWork = 1;
    // foreach($sql->result() as $rs){
    //     if($countWork <= 1){
    //         $output .= $rs->fasub_worktime;
    //     }else{
    //         $output .= " , ".$rs->fasub_worktime;
    //     }
        
    //     $countWork++;
    // }
    if($sql->num_rows() == 0 ){
        return false;
    }else{
        return $sql->row()->fasub_worktime;
    }
}


function getShiftEndOnSubmain($mainformno)
{

    $sql = gfn()->db->query("SELECT
    farrel_submain.fasub_worktime
    FROM
    farrel_submain
    WHERE fasub_main_formno = '$mainformno'
    ORDER BY fasub_autoid DESC LIMIT 1
    ");
    $output = '';
    // $countWork = 1;
    // foreach($sql->result() as $rs){
    //     if($countWork <= 1){
    //         $output .= $rs->fasub_worktime;
    //     }else{
    //         $output .= " , ".$rs->fasub_worktime;
    //     }
        
    //     $countWork++;
    // }
    if($sql->num_rows() == 0 ){
        return false;
    }else{
        return $sql->row()->fasub_worktime;
    }
}





function checkMainStatus($mainFormno)
{
    $sql = gfn()->db->query("SELECT ptwo_pagestatus FROM farrel_main WHERE fam_formno = '$mainFormno' ");
    if($sql->num_rows() == 0){
        return false;
    }else{
        return $sql->row()->ptwo_pagestatus;
    }
}


function nextDay()
{
    $date = strtotime("+1 day");
    return date('Y-m-d',$date);
}


function checkFeederDataForEdit($mainformno)
{
    $sql = gfn()->db->query("SELECT faf_status FROM farrel_feeder WHERE faf_mainformno = '$mainformno' and faf_status in ('ผ่าน' , 'ไม่ผ่าน') ");
    return $sql->num_rows();
}


function getFileFromDb($detailFormno , $mainFormno)
{
    $sql = gfn()->db->query("SELECT * FROM msd_files WHERE file_detail_formno = '$detailFormno' AND file_main_formno = '$mainFormno' ");
    return $sql;
}


function getDetailFormnoDesc($mainformno)
{
    $sql = gfn()->db->query("SELECT far_detail_formno,far_worktime 
    FROM farrel_detail 
    WHERE far_main_formno = '$mainformno' 
    GROUP BY far_worktime 
    ORDER BY far_detail_formno 
    DESC LIMIT 1");

    return $sql;
}


function getImageType1($fardetailFormno , $imageType , $mainformno)
{
    $sql = gfn()->db->query("SELECT * FROM msd_files WHERE file_detail_formno='$fardetailFormno' AND file_type = '$imageType' AND file_main_formno = '$mainformno' ");
    return $sql;
}
function getImageType2($fardetailFormno , $imageType , $mainformno)
{
    $sql = gfn()->db->query("SELECT * FROM msd_files WHERE file_detail_formno='$fardetailFormno' AND file_type = '$imageType' AND file_main_formno = '$mainformno' ");
    return $sql;
}
function getImageType3($fardetailFormno , $imageType , $mainformno)
{
    $sql = gfn()->db->query("SELECT * FROM msd_files WHERE file_detail_formno='$fardetailFormno' AND file_type = '$imageType' AND file_main_formno = '$mainformno' ");
    return $sql;
}
function getImageType4($fardetailFormno , $imageType , $mainformno)
{
    $sql = gfn()->db->query("SELECT * FROM msd_files WHERE file_detail_formno='$fardetailFormno' AND file_type = '$imageType' AND file_main_formno = '$mainformno' ");
    return $sql;
}

///////////////////////////////////////////
////////Control viewmaindata.html
//////////////////////////////////////////




/////////////////////////////////////////////////////////
///////////Function Resize Image and Fix rotate
////////////////////////////////////////////////////////

function resize($width, $targetFile, $originalFile ) {



    $info = getimagesize($originalFile); 
    $mime = $info['mime']; 
 
    switch ($mime) { 
            case 'image/jpeg':
                    header('Content-Type: image/jpeg');
                    $image_create_func = 'imagecreatefromjpeg'; 
                    $image_save_func = 'imagejpeg'; 
                    $filename_type = 'jpg'; 
                    break; 
 
            case 'image/png': 
                    header('Content-Type: image/png');
                    $image_create_func = 'imagecreatefrompng'; 
                    $image_save_func = 'imagepng'; 
                    $filename_type = 'png'; 
                    break; 
 
            case 'image/gif':
                    header('Content-Type: image/gif');
                    $image_create_func = 'imagecreatefromgif'; 
                    $image_save_func = 'imagegif'; 
                    $filename_type = 'gif'; 
                    break; 
 
            default:  
                    throw error_log('Unknown image type.'); 
    } 
 

    list($width_orig, $height_orig) = getimagesize($originalFile); 
    $height = (int) (($width / $width_orig) * $height_orig); 
    $image_p = imagecreatetruecolor($width, $height);
    $image   = $image_create_func($originalFile);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
 
    
    // $image_save_func($tmp, "$targetFile.$new_image_ext"); 
    //Fix Orientation
    $exif = exif_read_data($originalFile);
    if ($exif && isset($exif['Orientation']))
    {
        $orientation = $exif['Orientation'];
        switch($orientation) {
            case 3:
                $image_p = imagerotate($image_p, 180, 0);
                break;
            case 6:
                $image_p = imagerotate($image_p, -90, 0);
                break;
            case 8:
                $image_p = imagerotate($image_p, 90, 0);
                break;
        }
    }
    // Output
    $image_save_func($image_p, "$targetFile.$filename_type", 90);




}




function Loadimage($imgname)
{

    $infos = getimagesize($imgname); 
    $mimes = $infos['mime'];

    if($mimes == "image/jpeg"){
        /* Attempt to open */
        $im = @imagecreatefromjpeg($imgname);
    }else if($mimes == "image/png"){
        /* Attempt to open */
        $im = @imagecreatefrompng($imgname);
    }else if($mimes == "image/gif"){
        /* Attempt to open */
        $im = @imagecreatefromgif($imgname);
    }

    // $im = @imagecreatefrompng($imgname);

    

    /* See if it failed */
    if(!$im)
    {
        /* Create a blank image */
        $im  = imagecreatetruecolor(150, 30);
        $bgc = imagecolorallocate($im, 255, 255, 255);
        $tc  = imagecolorallocate($im, 0, 0, 0);

        imagefilledrectangle($im, 0, 0, 150, 30, $bgc);

        /* Output an error message */
        imagestring($im, 1, 5, 5, 'Error loading ' . $imgname, $tc);
    }
    
    // imagedestroy($img);

    return $im;
}

/////////////////////////////////////////////////////////
///////////Function Resize Image and Fix rotate
////////////////////////////////////////////////////////



function uploadImage($fileInput , $getDetailFormNo , $fileTypeName , $mainFormno)
{
    // Upload file Zone
    $fileTypeCode = '';
    switch($fileTypeName){
        case "อัพโหลดไฟล์รูปหน้าจอ":
            $fileTypeCode = 1;
            break;
        case "อัพโหลดไฟล์รูปเม็ด MB.":
            $fileTypeCode = 2;
            break;
        case "อัพโหลดไฟล์รูปปัญหาในการผลิตและการทำงาน":
            $fileTypeCode = 3;
            break;
        case "อัพโหลดไฟล์อื่นๆ":
            $fileTypeCode = 4;
            break;
    }



    $file_name = $_FILES[$fileInput]['name'];
    $fileno = 1;
    foreach ($file_name as $key => $value) {
        if ($_FILES[$fileInput]['tmp_name'][$key] != "") {
            $filename_type = '';

            $time = date("H-i-s"); //ดึงเวลามาก่อน
            $path_parts = pathinfo($value);

            if($path_parts['extension'] == "jpeg"){
                $filename_type = "jpg";
            }else{
                $filename_type = $path_parts['extension'];
            }
            
            $file_name_date = substr_replace($value,  $getDetailFormNo . "-" . $time . "-" . $fileTypeCode."-".$fileno .".". $filename_type, 0);

            $file_name_s = substr_replace($value,  $getDetailFormNo . "-" . $time . "-" . $fileTypeCode."-".$fileno, 0);
            // Upload file
            $file_tmp = $_FILES[$fileInput]['tmp_name'][$key];


            

            if($path_parts['extension'] == "jpeg" || $path_parts['extension'] == "jpg"){
                $newWidth = 1000;
                resize($newWidth, "upload/images/" . $file_name_s , $file_tmp );
            }else{
                move_uploaded_file($file_tmp, "upload/images/" . $file_name_date);
            }

            // move_uploaded_file($file_tmp, "upload/images/" . $file_name_date);
            // correctImageOrientation($file_tmp);


            $arfiles = array(
                "file_detail_formno" => $getDetailFormNo,
                "file_main_formno" => $mainFormno,
                "file_name" => $file_name_date,
                "file_userpost" => getUser()->Fname . " " . getUser()->Lname,
                "file_ecodepost" => getUser()->ecode,
                "file_deptcodepost" => getUser()->DeptCode,
                "file_datetime" => date("Y-m-d H:i:s"),
                "file_type" => $fileTypeName
            );
            gfn()->db->insert("msd_files", $arfiles);
            $fileno++;
        } 
      
    }
    // Upload file Zone
}



function uploadImageTempDetail($templatename , $fileInput , $ted_template_itemuse)
{
    // Upload file Zone
    $file_name = $_FILES[$fileInput]['name'];
    $fileno = 1;

    foreach ($file_name as $key => $value) {
        if ($_FILES[$fileInput]['tmp_name'][$key] != "") {

            $time = date("H-i-s"); //ดึงเวลามาก่อน
            $path_parts = pathinfo($value);

            if($path_parts['extension'] == "jpeg"){
                $filename_type = "jpg";
            }else{
                $filename_type = $path_parts['extension'];
            }
            
            $file_name_date = substr_replace($value,  $templatename . "-" . $time ."-".$fileno .".". $filename_type, 0);
            $file_name_s = substr_replace($value,  $templatename . "-" . $time ."-".$fileno, 0);
            // Upload file
            $file_tmp = $_FILES[$fileInput]['tmp_name'][$key];


            

            if($path_parts['extension'] == "jpeg" || $path_parts['extension'] == "jpg"){
                $newWidth = 1000;
                resize($newWidth, "upload/images_template/" . $file_name_s , $file_tmp );
            }else{
                move_uploaded_file($file_tmp, "upload/images_template/" . $file_name_date);
            }
            // move_uploaded_file($file_tmp, "upload/images/" . $file_name_date);
            // correctImageOrientation($file_tmp);


            $arfiles = array(
                "ted_template_name" => $templatename,
                "ted_template_image" => $file_name_date,
                "ted_template_itemuse" => $ted_template_itemuse,
                "ted_template_user" => getUser()->Fname . " " . getUser()->Lname,
                "ted_template_ecode" => getUser()->ecode,
                "ted_template_deptcode" => getUser()->DeptCode,
                "ted_template_datetime" => date("Y-m-d H:i:s")
            );
            gfn()->db->insert("msd_template_detail", $arfiles);

            $fileno++;
        }
    }
    // Upload file Zone
    $output = array(
        "msg" => "บันทึกข้อมูลเรียบร้อยแล้ว",
        "status" => "Insert Success"
    );

    echo json_encode($output);
      
    
    // Upload file Zone
}








function uploadEditImageTempDetail($templatename , $fileInput , $ted_template_itemuse , $ted_template_image_old)
{
    // Upload file Zone
    $file_name = $_FILES[$fileInput]['name'];
    $fileno = 1;


    foreach ($file_name as $key => $value) {
        if ($_FILES[$fileInput]['tmp_name'][$key] != "") {

            if($ted_template_image_old != ""){
                $path = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images_template/".$ted_template_image_old;
                unlink($path);
            }

            $time = date("H-i-s"); //ดึงเวลามาก่อน
            $path_parts = pathinfo($value);

            if($path_parts['extension'] == "jpeg"){
                $filename_type = "jpg";
            }else{
                $filename_type = $path_parts['extension'];
            }
            
            $file_name_date = substr_replace($value,  $templatename . "-" . $time ."-".$fileno .".". $filename_type, 0);
            $file_name_s = substr_replace($value,  $templatename . "-" . $time ."-".$fileno, 0);
            // Upload file
            $file_tmp = $_FILES[$fileInput]['tmp_name'][$key];


            

            if($path_parts['extension'] == "jpeg" || $path_parts['extension'] == "jpg"){
                $newWidth = 1000;
                resize($newWidth, "upload/images_template/" . $file_name_s , $file_tmp );
            }else{
                move_uploaded_file($file_tmp, "upload/images_template/" . $file_name_date);
            }
            // move_uploaded_file($file_tmp, "upload/images/" . $file_name_date);
            // correctImageOrientation($file_tmp);


            $arfiles = array(
                "ted_template_name" => $templatename,
                "ted_template_image" => $file_name_date,
                "ted_template_itemuse" => $ted_template_itemuse,
                "ted_template_user" => getUser()->Fname . " " . getUser()->Lname,
                "ted_template_ecode" => getUser()->ecode,
                "ted_template_deptcode" => getUser()->DeptCode,
                "ted_template_datetime" => date("Y-m-d H:i:s")
            );
            gfn()->db->insert("msd_template_detail", $arfiles);

            $fileno++;
        }else{
            $arfiles = array(
                "ted_template_itemuse" => $ted_template_itemuse,
                "ted_template_user_modi" => getUser()->Fname . " " . getUser()->Lname,
                "ted_template_ecode_modi" => getUser()->ecode,
                "ted_template_deptcode_modi" => getUser()->DeptCode,
                "ted_template_datetime_modi" => date("Y-m-d H:i:s")
            );
            gfn()->db->where("ted_template_name" , $templatename);
            gfn()->db->update("msd_template_detail", $arfiles);
        }
    }
    // Upload file Zone
    $output = array(
        "msg" => "บันทึกข้อมูลเรียบร้อยแล้ว",
        "status" => "Insert Success"
    );

    echo json_encode($output);
      
    
    // Upload file Zone
}







/////New Function

// Query for check
function checkSubmainTable($mainFormno)
{
    $sql = gfn()->db->query("SELECT * FROM farrel_submain WHERE fasub_main_formno = '$mainFormno' ORDER BY fasub_autoid DESC ");
    $numrow = $sql->num_rows();
    echo $numrow;
}

// Query For select
function getSubmainDataForInsert($mainFormno)
{
    $sql = gfn()->db->query("SELECT * FROM farrel_submain WHERE fasub_main_formno = '$mainFormno' ORDER BY fasub_autoid DESC LIMIT 1");
    return $sql;
}

//Function for get cancel memo for use in datatable
function getStatus($mainFormno)
{
    $sql = gfn()->db->query("SELECT fam_cancel_memo , fam_stop_memo , ptwo_pagestatus FROM farrel_main WHERE fam_formno = '$mainFormno' ");
    return $sql->row();
}

// Get data From Template detail
function getdataTemDetail($templateName)
{
    $sql = gfn()->db->query("SELECT * FROM msd_template_detail WHERE ted_template_name = '$templateName' ");
    return $sql;
}


// GET LINE NUM
function getRunLinenum()
{
    $sql = gfn()->db->query("SELECT
    run_linenum
    FROM runscreen_master
    ORDER BY run_linenum DESC LIMIT 1
    ");

    if($sql->num_rows() != 0){
        $lastLineNum = $sql->row()->run_linenum;
        $lastLineNum++;
    }else{
        $lastLineNum = 1;
    }
    return $lastLineNum;
}


function getRunLinenumTemplate($templatename)
{
    $sql = gfn()->db->query("SELECT
    mat_linenum
    FROM machine_template_temp
    WHERE mat_machine_name = '$templatename'
    ORDER BY mat_linenum DESC LIMIT 1
    ");

    if($sql->num_rows() != 0){
        $lastLineNum = $sql->row()->mat_linenum;
        $lastLineNum++;
    }else{
        $lastLineNum = 1;
    }
    return $lastLineNum;
}



function moveElement ($a , $i , $j)
{
      $tmp =  $a[$i];
      if ($i > $j)
      {
           for ($k = $i; $k > $j; $k--) {
                $a[$k] = $a[$k-1]; 
           }        
      }
      else
      { 
           for ($k = $i; $k < $j; $k++) {
                $a[$k] = $a[$k+1];
           }
      }
      $a[$j] = $tmp;
      return $a;
}



function moveElementInArray($array, $toMove, $targetIndex) {
    if (is_int($toMove)) {
        $tmp = array_splice($array, $toMove, 1);
        array_splice($array, $targetIndex, 0, $tmp);
        $output = $array;
    }
    elseif (is_string($toMove)) {
        $indexToMove = array_search($toMove, array_keys($array));
        $itemToMove = $array[$toMove];
        array_splice($array, $indexToMove, 1);
        $i = 0;
        $output = Array();
        foreach($array as $key => $item) {
            if ($i == $targetIndex) {
                $output[$toMove] = $itemToMove;
            }
            $output[$key] = $item;
            $i++;
        }
    }
    return $output;
}











