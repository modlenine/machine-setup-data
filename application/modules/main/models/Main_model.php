<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Main_model extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->db3 = $this->load->database("prodplan", true);

    }




    // Load ข้อมูลตามหมวดหมู่ของหน่วยงานนั้นๆ แบบ Server side
    // Function สำหรับ ดึงข้อมูลใส่ Data table แบบ Server side
    // List data zone
    public function loadMainData()
    {

        // DB table to use
        $table = 'farrelmain';
        // $table = <<<EOT
        // (
        //     select * from listdefault
        // )temp
        // EOT;

        // Table's primary key
        $primaryKey = 'fam_autoid';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes

        $columns = array(
            array(
                'db' => 'fam_formno', 'dt' => 0,
                'formatter' => function ($d, $row) {
                    $output = '';
                    $output .= '
                <a id="l_viewmain" href="' . base_url('viewmaindata.html/') . $d . '"><b>' . $d . '</b></a>
                ';
                    return $output;
                }
            ),
            array('db' => 'fam_machinename', 'dt' => 1),
            array('db' => 'fam_productcode', 'dt' => 2),
            array('db' => 'fam_prodid', 'dt' => 3),
            array('db' => 'fam_batchnumber', 'dt' => 4),
            array(
                'db' => 'fam_mis', 'dt' => 5,
                'formatter' => function($d , $row){
                    return number_format($d , 3);
                }
            ),
            array(
                'db' => 'fam_output', 'dt' => 6,
                'formatter' => function($d , $row){
                    return valueFormat($d);
                }
            ),
            array(
                'db' => 'ptwo_datetimestart', 'dt' => 7,
                'formatter' => function($d , $row){
                    return conDateTimeFromDb($d);
                }
            ),
            array(
                'db' => 'fam_formno', 'dt' => 8,
                'formatter' => function ($d, $row) {

                    $iconCancel = "";
                    if(getStatus($d)->fam_cancel_memo != ""){
                        $iconCancel = '<i class="icon-exclamation-sign cancelMemoView" style="color:#dc3545;font-size:20px;" 
                        data_cancelMemo="'.getStatus($d)->fam_cancel_memo.'"></i>';
                    }else if(getStatus($d)->fam_stop_memo != ""){
                        $iconCancel = '<i class="icon-comment21 stopMemoView" style="color:#dc3545;font-size:20px;" 
                        data_stopMemo="'.getStatus($d)->fam_stop_memo.'"></i>';
                    }

                    $output = '';
                    if (getStatus($d)->ptwo_pagestatus == "Start") {
                        $output = '
                    <span class="badge badge-success" style="font-size:12px;padding:5px;"><b>' . getStatus($d)->ptwo_pagestatus . '</b></span>
                    ';
                    } else if(getStatus($d)->ptwo_pagestatus == "Stop" || getStatus($d)->ptwo_pagestatus == "Cancel"){
                        $output = '
                    <span class="badge badge-danger" style="font-size:12px;padding:5px;"><b>' . getStatus($d)->ptwo_pagestatus . '</b></span>
                    ';
                    }else if(getStatus($d)->ptwo_pagestatus == "Wait Start"){
                        $output = '
                    <span class="badge badge-warning" style="font-size:12px;padding:5px;"><b>' . getStatus($d)->ptwo_pagestatus . '</b></span>
                    ';
                    }
                    return $output.'&nbsp;&nbsp;'.$iconCancel;
                }
            )
        );

        // SQL server connection information
        $sql_details = array(
            'user' => getDb()->db_username,
            'pass' => getDb()->db_password,
            'db'   => getDb()->db_databasename,
            'host' => getDb()->db_host
        );

        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        * If you just want to use the basic configuration for DataTables with PHP
        * server-side, there is no need to edit below this line.
        */
        require('server-side/scripts/ssp.class.php');

        $ecode = getUser()->ecode;
        $deptcode = getUser()->DeptCode;

        // if (getUser()->ecode == "M1848" || getUser()->ecode == "M0051" || getUser()->ecode == "M0112") {
        //     echo json_encode(
        //         SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        //     );
        // } else if (getUser()->posi > 75) {
        //     echo json_encode(
        //         SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        //     );
        // } else {
        //     echo json_encode(
        //         SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, null, "m_owner = '$ecode' ")
        //     );
        // }


        echo json_encode(
            SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        );
    }
    // Function สำหรับ ดึงข้อมูลใส่ Data table แบบ Server side



    //////////////////////////////////////////////////////////
    ////////////Home page
    /////////////////////////////////////////////////////////


    public function saveMainData()
    {
        if (isset($_POST['fam_machinename'])) {

            ////////////////////////////////
            /////Main table
            /////////////////////////
            $farMainFormno = getFormNo();
            $arMaindata = array(
                "fam_formno" => $farMainFormno,
                "fam_machinename" => $this->input->post("fam_machinename"),
                "fam_productcode" => $this->input->post("fam_productcode"),
                "fam_batchnumber" => $this->input->post("fam_batchnumber"),
                "fam_shit" => $this->input->post("fam_shit"),
                "fam_prodid" => $this->input->post("fam_prodid"),
                "fam_dataareaid" => $this->input->post("fam_dataareaid"),
                "fam_mis" => $this->input->post("fam_mis"),
                "fam_output" => $this->input->post("fam_output"),
                "fam_username" => getUser()->Fname . " " . getUser()->Lname,
                "fam_userecode" => getUser()->ecode,
                "fam_userdeptcode" => getUser()->DeptCode,
                "fam_datetime" => date("Y-m-d H:i:s"),
                "ptwo_pagestatus" => "Wait Start"

            );
            $this->db->insert("farrel_main", $arMaindata);
            ////////////////////////////////
            /////Main table
            //////////////////////////



            ////////////////////////////////
            /////Bom table
            ///////////////////////
            if($this->input->post("fam_prodidwip") != ""){
                $bom_prodid = $this->input->post("fam_prodidwip");
            }else{
                $bom_prodid = $this->input->post("fam_prodid");
            }
            
            $bom_dataareaid = $this->input->post("fam_dataareaid");
            // Get Bom from prodbom table Query ข้อมูลมาจาก Bomtable เพื่อรอใช้งาน
            $sqlBom = $this->db3->query("SELECT * FROM prodbom WHERE prodid = '$bom_prodid' AND dataareaid = '$bom_dataareaid' AND bomqtyserie != 0 ");
            foreach ($sqlBom->result() as $rsbom) {
                $bomArray = array(
                    "b_mainformno" => $farMainFormno,
                    "b_prodid" => $bom_prodid,
                    "b_linenum" => $rsbom->linenum,
                    "b_rawmaterial" => $rsbom->itemid,
                    "b_bomqty" => $rsbom->bomqty,
                    "b_bombalance" => $rsbom->bomqty,
                    "b_bomtype" => "original",
                    "b_bomstatus" => "active"
                );

                $this->db->insert("farrel_bom", $bomArray);
            }
            ////////////////////////////////
            /////Bom table
            /////////////////////////



            ////////////////////////////////////
            //////Check Machine list
            ///////////////////////////////////

            foreach (loadCheckListFromDb()->result() as $ckrs) {
                $arSaveCklist = array(
                    "ck_checklist" => $ckrs->temck_listname,
                    "ck_mainformno" => $farMainFormno
                );
                $this->db->insert("msd_checkmachine",  $arSaveCklist);
            }

            ////////////////////////////////////
            //////Check Machine list
            ///////////////////////////////////




            /////////////////////////////////
            //////Feeder table
            /////////////////////////
            $templatename = $this->input->post("fam_machinename");
            $sqlFeeder = $this->db->query("SELECT
            machine_template.mat_autoid,
            machine_template.mat_column_name,
            machine_template.mat_machine_name
            FROM
            machine_template
            WHERE mat_machine_name = '$templatename' and mat_machine_type = 'Feeder' ");

            foreach ($sqlFeeder->result() as $rsFeeder) {
                $feederArray = array(
                    "faf_mainformno" => $farMainFormno,
                    "faf_prodid" => $this->input->post("fam_prodid"),
                    "faf_feedername" => $rsFeeder->mat_column_name
                );
                $this->db->insert("farrel_feeder", $feederArray);
            }

            $output = array(
                "mainFormNo" => $farMainFormno,
                "status" => "Insert Success",
                "url" => base_url()
            );

            echo json_encode($output);
        } else {
            $output = array(
                "msg" => "บันทึกข้อมูลไม่สำเร็จ",
                "status" => "Insert Not Success"
            );

            echo json_encode($output);
        }
    }


    public function loadProdId()
    {
        $dataareaid = "";
        $searchProdid = "";
        $arr = [];
        $arrs="";
        $pidarrs = "";
        if ($this->input->post("dataareaid")) {
            $dataareaid = $this->input->post("dataareaid");
            $searchProdid = $this->input->post("searchProdid");

            $sqlmain = $this->db->query("SELECT fam_prodid From farrel_main WHERE fam_dataareaid = '$dataareaid' and ptwo_pagestatus IN ('Start' , 'Wait Start') ");

            if($sqlmain->num_rows() == 0){
                $pidarrs = "";
            }else{
                foreach($sqlmain->result_array() as $rss){
                    array_push($arr , '"'.$rss['fam_prodid'].'"');
                    $arrs = implode("," , $arr);
                }

                $pidarrs = "AND prodtable.prodid NOT IN ($arrs)";
            }
            $output = '';
            


            $sql = $this->db3->query("SELECT
                prodtable.itemid,
                prodtable.dataareaid,
                prodtable.prodid,
                prodtable.inventdimid,
                inventdim.inventbatchid,
                prodtable.slc_orgreference
                FROM
                prodtable
                LEFT JOIN inventdim ON inventdim.inventdimid = prodtable.inventdimid AND inventdim.dataareaid = prodtable.dataareaid
                WHERE prodtable.dataareaid = '$dataareaid' $pidarrs AND prodtable.prodid like '%$searchProdid%' AND prodtable.prodstatus NOT IN (7, 8)
                LIMIT 20
                ");

            $output = '<ul class="list-group lgprodid">';
            foreach ($sql->result() as $rs) {

                if(substr($rs->slc_orgreference , 0 , 2) == "PD"){
                    $wipProdid = $this->checkPDWip($searchProdid , $dataareaid);

                    $sql2 = $this->db3->query("SELECT
                        prodtable.itemid,
                        prodtable.dataareaid,
                        prodtable.prodid,
                        prodtable.inventdimid,
                        inventdim.inventbatchid,
                        prodtable.slc_orgreference
                        FROM
                        prodtable
                        LEFT JOIN inventdim ON inventdim.inventdimid = prodtable.inventdimid AND inventdim.dataareaid = prodtable.dataareaid
                        WHERE prodtable.dataareaid = '$dataareaid' $pidarrs AND prodtable.prodid = '$wipProdid'
                        LIMIT 20
                        ");

                    foreach($sql2->result() as $rss){
                        $output .= '
                        <a href="#" id="prodid_attr"
                        data_prodid = "' . $rs->prodid . '"
                        data_prodiduse = "'.$rss->prodid.'"
                        data_itemid = "' . $rss->itemid . '"
                        data_inventbatchid = "' . $rss->inventbatchid . '"
                        data_dataareaid = "' . $rss->dataareaid . '"
                        data_slc_orgreference = "'.substr($rss->slc_orgreference , 0 , 2).'"
                        ><li class="list-group-item">' . $rs->prodid . '</li></a>
                        ';
                    }

                }else{
                    $output .= '
                    <a href="#" id="prodid_attr"
                    data_prodid = "' . $rs->prodid . '"
                    data_prodiduse = ""
                    data_itemid = "' . $rs->itemid . '"
                    data_inventbatchid = "' . $rs->inventbatchid . '"
                    data_dataareaid = "' . $rs->dataareaid . '"
                    data_slc_orgreference = "'.substr($rs->slc_orgreference , 0 , 2).'"
                    ><li class="list-group-item">' . $rs->prodid . '</li></a>
                    ';
                }


                
            }
            $output .= '</ul>';
            echo $output;
        }
    }



    //Recursive Function loop
    public function checkPDWip($prodid , $dataareaid)
    {
        $checkWip = "";
        $sql = $this->db3->query("SELECT
                prodtable.itemid,
                prodtable.dataareaid,
                prodtable.prodid,
                prodtable.inventdimid,
                prodtable.slc_orgreference
                FROM
                prodtable
                WHERE prodtable.dataareaid = '$dataareaid' AND prodtable.prodid like '%$prodid%'
                ");
        if($sql->num_rows() != 0){
            $checkWip = $sql->row()->slc_orgreference;
            if(substr($checkWip , 0 , 2) == "PD"){
                return $this->checkPDWip($checkWip , $dataareaid);
            }else{
                return $sql->row()->prodid;
            }
        }  
    }
    //Recursive Function loop



    public function loadMachineTemplate()
    {
        $data_itemid = $this->input->post("data_itemid");
        getMachineList($data_itemid);
    }

    public function loadMachineTemplate2()
    {
        $templateName = $this->input->post("templateName");
        getMachineList2($templateName);
    }




    public function checkPdStart()
    {
        $dataareaid = "";
        $searchProdid = "";
        if($this->input->post("dataareaid")){
            $dataareaid = $this->input->post("dataareaid");
            $searchProdid = $this->input->post("searchProdid");
            $sql = $this->db->query("SELECT fam_prodid , fam_dataareaid FROM farrel_main WHERE fam_prodid='$searchProdid' AND fam_dataareaid='$dataareaid' AND ptwo_pagestatus in ('Start' , 'Wait Start') ");

            if($sql->num_rows() != 0){
                $output = array(
                    "msg" => "ตรวจพบว่า PD ดังกล่าวกำลัง Start หรือ รอ Start อยู่",
                    "status" => "Found PD Onprocess"
                );
            }else{
                $output = array(
                    "msg" => "PD ดังกล่าวสามารถสร้างรายการได้",
                    "status" => "This PD Ready"
                );
            }
            echo json_encode($output);
        }
    }
    //////////////////////////////////////////////////////////
    ////////////Home page
    /////////////////////////////////////////////////////////







    ///////////////////////////////////////////////
    //////////////// viewmaindata.html 
    //////////////////////////////////////////////


    public function loadTemplateSpoint()
    {
        $template = "";
        if ($this->input->post("template")) {
            $template = $this->input->post("template");
            $sql = $this->db->query("SELECT
                machine_template.mat_autoid,
                machine_template.mat_column_name,
                machine_template.mat_machine_name,
                machine_template.mat_min_value,
                machine_template.mat_max_value,
                machine_template.mat_userpost,
                machine_template.mat_ecodepost,
                machine_template.mat_datetime,
                machine_template.mat_spoint_value,
                machine_template.mat_linenum
            FROM
            machine_template
            WHERE mat_machine_name = '$template' AND 
            mat_machine_type = 'Extruder' ORDER BY mat_linenum ASC");

            $output = '';

            foreach ($sql->result() as $rs) {
                $output .= '
            <div class="row form-group">
                <div class="col-md-6">
                    <label class="textNoUpper">' . $rs->mat_column_name . '</label>
                   <input hidden type="text" id="sRunscreenName" name="sRunscreenName[]" value="' . $rs->mat_column_name . '">
                   <input hidden type="text" id="sRunscreenLinenum" name="sRunscreenLinenum[]" value="'.$rs->mat_linenum.'">
                </div>
                <div class="col-md-6">
                    <input type="text" id="sRunscreenValue' . $rs->mat_autoid . '" name="sRunscreenValue[]" class="form-control runvalueCheck"
                    data_mat_autoid = "' . $rs->mat_autoid . '" value="' . valueFormat2($rs->mat_spoint_value) . '" required
                    />
                    <input hidden type="text" name="sMinValue[]" id="sMinValue' . $rs->mat_autoid . '" value="' . $rs->mat_min_value . '">
                    <input hidden type="text" name="sMaxValue[]" id="sMaxValue' . $rs->mat_autoid . '" value="' . $rs->mat_max_value . '">
                </div>
            </div>
            ';
            }
            echo $output;
        }
    }




    public function loadTemplateRun()
    {
        $template = "";
        $subformno = "";
        if ($this->input->post("template")) {
            $template = $this->input->post("template");
            $subformno = $this->input->post("subFormno");


            if(getDetailFormnoDesc($subformno)->num_rows() == 0){
                $wherefardetail = "";
            }else{
                $far_detail_formno = getDetailFormnoDesc($subformno)->row()->far_detail_formno;
                $wherefardetail = " AND farrel_detail.far_detail_formno = '$far_detail_formno' ";
            }
            

            $sql = $this->db->query("SELECT
            machine_template.mat_autoid,
            machine_template.mat_column_name,
            machine_template.mat_machine_name,
            machine_template.mat_machine_type,
            machine_template.mat_min_value,
            machine_template.mat_max_value,
            machine_template.mat_spoint_value,
            farrel_detail.far_runscreen_value,
            maghine_template.mat_linenum
            FROM
            machine_template
            LEFT JOIN farrel_detail ON farrel_detail.far_runscreen_linenum = machine_template.mat_linenum
            WHERE
            machine_template.mat_machine_name = '$template' AND
            machine_template.mat_column_name NOT LIKE 'Feeder%' AND
            farrel_detail.far_action NOT LIKE '%spoint%' AND
            farrel_detail.far_sub_formno = '$subformno' $wherefardetail
            GROUP BY mat_column_name
            ORDER BY mat_autoid ASC");

            $sqlJoin = $this->db->query("SELECT
            machine_template.mat_autoid,
            machine_template.mat_column_name,
            machine_template.mat_machine_name,
            machine_template.mat_machine_type,
            machine_template.mat_min_value,
            machine_template.mat_max_value,
            machine_template.mat_spoint_value,
            maghine_template.mat_linenum
            FROM
            machine_template
            WHERE
            machine_template.mat_machine_name = '$template' AND
            machine_template.mat_column_name NOT LIKE 'Feeder%'
            ORDER BY mat_autoid ASC");

            $output = '';

            if ($sql->num_rows() == 0) {
                $rsSql = $sqlJoin;
                foreach ($rsSql->result() as $rs) {
                    $output .= '
                <div class="row form-group">
                    <div class="col-md-6">
                        <label class="textNoUpper">' . $rs->mat_column_name . '</label>
                    <input hidden type="text" id="sRunscreenName" name="sRunscreenName[]" value="' . $rs->mat_column_name . '">
                    <input  type="text" id="sRunscreenLinenum" name="sRunscreenLinenum[]" value="' . $rs->mat_linenum . '">
                    </div>
                    <div class="col-md-6">
                    <input type="tel" id="sRunscreenValue' . $rs->mat_autoid . '" name="sRunscreenValue[]" class="form-control runvalueCheck" 
                    data_mat_autoid = "' . $rs->mat_autoid . '" required value="' . valueFormat2($rs->mat_spoint_value) . '"
                    />
                    <input hidden type="text" name="sMinValue[]" id="sMinValue' . $rs->mat_autoid . '" value="' . valueFormat2($rs->mat_min_value) . '">
                    <input hidden type="text" name="sMaxValue[]" id="sMaxValue' . $rs->mat_autoid . '" value="' . $rs->mat_max_value . '">
                    </div>
                </div>
                ';
                }
            } else {
                $rsSql = $sql;

                foreach ($rsSql->result() as $rs) {
                    $output .= '
                <div class="row form-group">
                    <div class="col-md-6">
                        <label class="textNoUpper">' . $rs->mat_column_name . '</label>
                        <input hidden type="text" id="sRunscreenName" name="sRunscreenName[]" value="' . $rs->mat_column_name . '">
                        <input  type="text" id="sRunscreenLinenum" name="sRunscreenLinenum[]" value="' . $rs->mat_linenum . '">
                    </div>
                    <div class="col-md-6">
                        <input type="tel" id="sRunscreenValue' . $rs->mat_autoid . '" name="sRunscreenValue[]" class="form-control runvalueCheck" value="' . valueFormat2($rs->far_runscreen_value) . '"
                        data_mat_autoid = "' . $rs->mat_autoid . '" required
                        />
                        <input hidden type="text" name="sMinValue[]" id="sMinValue' . $rs->mat_autoid . '" value="' . valueFormat2($rs->mat_min_value) . '">
                        <input hidden type="text" name="sMaxValue[]" id="sMaxValue' . $rs->mat_autoid . '" value="' . valueFormat2($rs->mat_max_value) . '">
                    </div>
                </div>
                ';
                }
            }


            echo $output;
        }
    }




    public function loadTemplateRun2()
    {
        $template = "";
        $subformno = "";
        $data_mainFormno = "";
        $detailFormno = "";
        if ($this->input->post("template")) {
            $template = $this->input->post("template");
            $subformno = $this->input->post("subFormno");
            $data_mainFormno = $this->input->post("data_mainFormno");
            $output = '';



            if(getDetailFormnoDesc($data_mainFormno)->num_rows() == 0){//เช็คส่วนของ Detail ว่ามีค่าของ Run Screen อยู่หรือยัง
                //ถ้ายังไม่มี
                $sqlGetSpoint = $this->db->query("SELECT
                    machine_template.mat_autoid,
                    machine_template.mat_column_name,
                    machine_template.mat_machine_name,
                    machine_template.mat_machine_type,
                    machine_template.mat_min_value,
                    machine_template.mat_max_value,
                    machine_template.mat_spoint_value,
                    farrel_detail.far_runscreen_value,
                    machine_template.mat_linenum
                    FROM
                    machine_template
                    LEFT JOIN farrel_detail ON farrel_detail.far_runscreen_linenum = machine_template.mat_linenum
                    WHERE
                    machine_template.mat_machine_name = '$template' AND
                    farrel_detail.far_main_formno = '$data_mainFormno' AND
                    machine_template.mat_machine_type NOT IN ('Feeder')
                    ORDER BY mat_autoid ASC");

                    foreach ($sqlGetSpoint->result() as $rs) {
                        $output .= '
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label class="textNoUpper">' . $rs->mat_column_name . '</label>
                                <input hidden type="text" id="sRunscreenName" name="sRunscreenName[]" value="' . $rs->mat_column_name . '">
                                <input hidden type="text" id="sRunscreenLinenum" name="sRunscreenLinenum[]" value="' . $rs->mat_linenum . '">
                            </div>
                            <div class="col-md-6">
                                <input type="tel" id="sRunscreenValue' . $rs->mat_autoid . '" name="sRunscreenValue[]" class="form-control runvalueCheck" 
                                data_mat_autoid = "' . $rs->mat_autoid . '" required value="' . valueFormat2($rs->far_runscreen_value) . '"
                                />
                                <input hidden type="text" name="sMinValue[]" id="sMinValue' . $rs->mat_autoid . '" value="' . valueFormat2($rs->mat_min_value) . '">
                                <input hidden type="text" name="sMaxValue[]" id="sMaxValue' . $rs->mat_autoid . '" value="' . valueFormat2($rs->mat_max_value) . '">
                            </div>
                        </div>
                        ';
                    }
                
            }else{
                //ถ้ามีแล้ว

                $sqlGetRun = $this->db->query("SELECT
                farrel_detail.far_autoid,
                farrel_detail.far_main_formno,
                farrel_detail.far_action,
                farrel_detail.far_runscreen_name,
                farrel_detail.far_runscreen_linenum,
                farrel_detail.far_runscreen_group_linenum,
                farrel_detail.far_runscreen_value,
                farrel_detail.far_runscreen_min,
                farrel_detail.far_runscreen_max
                FROM
                farrel_detail
                where far_main_formno = '$data_mainFormno' and far_action = 'spoint' order by far_runscreen_linenum asc");

                foreach ($sqlGetRun->result() as $rs) {
                    $output .= '
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label class="textNoUpper">' . $rs->far_runscreen_name . '</label>
                                <input hidden type="text" id="sRunscreenName" name="sRunscreenName[]" value="' . $rs->far_runscreen_name . '">
                                <input hidden type="text" id="sRunscreenLinenum" name="sRunscreenLinenum[]" value="' . $rs->far_runscreen_linenum . '">
                            </div>
                            <div class="col-md-6">
                                <input type="tel" id="sRunscreenValue' . $rs->far_autoid . '" name="sRunscreenValue[]" class="form-control runvalueCheck" 
                                data_mat_autoid = "' . $rs->far_autoid . '" required value="' . valueFormat2($rs->far_runscreen_value) . '"
                                />
                                <input hidden type="text" name="sMinValue[]" id="sMinValue' . $rs->far_autoid . '" value="' . valueFormat2($rs->far_runscreen_min) . '">
                                <input hidden type="text" name="sMaxValue[]" id="sMaxValue' . $rs->far_autoid . '" value="' . valueFormat2($rs->far_runscreen_max) . '">
                            </div>
                        </div>
                        ';
                }
                
            }
            


            echo $output;
        }
    }




    public function loadDataRunEdit()
    {
        $fardetailFormno = "";
        if ($this->input->post("fardetailFormno")) {
            $fardetailFormno = $this->input->post("fardetailFormno");
            $farDetailMainFormno = $this->input->post("farDetailMainFormno");

            $sql = $this->db->query("SELECT
            farrel_detail.far_autoid,
            farrel_detail.far_detail_formno,
            farrel_detail.far_runscreen_name,
            farrel_detail.far_runscreen_value,
            farrel_detail.far_runscreen_min,
            farrel_detail.far_runscreen_max,
            farrel_detail.far_sub_formno
            FROM
            farrel_detail
            WHERE far_detail_formno = '$fardetailFormno' AND far_main_formno = '$farDetailMainFormno' ORDER BY far_runscreen_linenum ASC ");
        $output = '';

        $output .= '
        ';


        ////////////////////////////////////
        /////////Section Image 1
            $sqlFileType1 = getImageType1($fardetailFormno , "อัพโหลดไฟล์รูปหน้าจอ" , $farDetailMainFormno);
            $output .='
            <div class="card bg-light mb-3">
            <div class="card-header">ไฟล์รูปหน้าจอ</div>
            <div class="card-body">
                <div class="row">';
            if($sqlFileType1->num_rows() != 0){
                foreach ($sqlFileType1->result() as $rs) {
                    if ($rs->file_name != "") {
                        $output .= '
                        <div class="col-md-3 mb-2 text-center">
                            <a href="' . base_url('upload/images/') . $rs->file_name . '" target="_blank">
                            <img alt="100%x100" src="' . base_url('upload/images/') . $rs->file_name . '" class="img-thumbnail w-100 d-block runImageView">
                            </a>
                            <i class="icon-trash iconImageDel" 
                                data_fileAutoid="'.$rs->file_autoid.'"
                                data_fileName = "'.$rs->file_name.'"
                             ></i>
                        </div>
                ';
                    }
                }
            }else{
                $output .='
                <div class="col-md-12 text-center">
                    <h3>ไม่พบไฟล์รูปภาพ</h3>
                </div>';
            }
            

            $output .= '
                    </div>
                </div>
            </div>
            ';
        /////////Section Image 1
        ////////////////////////////////////




        ////////////////////////////////////
        /////////Section Image 2
        $sqlFileType2 = getImageType2($fardetailFormno , "อัพโหลดไฟล์รูปเม็ด MB." , $farDetailMainFormno);
        $output .='
        <div class="card bg-light mb-3">
        <div class="card-header">ไฟล์รูปเม็ด MB.</div>
        <div class="card-body">
            <div class="row">';
        if($sqlFileType2->num_rows() != 0){
            foreach ($sqlFileType2->result() as $rs) {
                if ($rs->file_name != "") {
                    $output .= '
                    <div class="col-md-3 mb-2 text-center">
                        <a href="' . base_url('upload/images/') . $rs->file_name . '" target="_blank">
                        <img alt="100%x180" src="' . base_url('upload/images/') . $rs->file_name . '" class="img-thumbnail w-100 d-block runImageView">
                        </a>
                        <i class="icon-trash iconImageDel" 
                            data_fileAutoid="'.$rs->file_autoid.'"
                            data_fileName = "'.$rs->file_name.'"
                        ></i>
                    </div>
            ';
                }
            }
        }else{
            $output .='
            <div class="col-md-12 text-center">
                <h3>ไม่พบไฟล์รูปภาพ</h3>
            </div>';
        }
        

        $output .= '
                </div>
            </div>
        </div>
        ';
    /////////Section Image 2
    ////////////////////////////////////







    ////////////////////////////////////
    /////////Section Image 3
        $sqlFileType3 = getImageType3($fardetailFormno , "อัพโหลดไฟล์รูปปัญหาในการผลิตและการทำงาน" , $farDetailMainFormno);
        $output .='
        <div class="card bg-light mb-3">
        <div class="card-header">ไฟล์รูปปัญหาในการผลิตและการทำงาน</div>
        <div class="card-body">
            <div class="row">';
        if($sqlFileType3->num_rows() != 0){
            foreach ($sqlFileType3->result() as $rs) {
                if ($rs->file_name != "") {
                    $output .= '
                    <div class="col-md-3 mb-2 text-center">
                        <a href="' . base_url('upload/images/') . $rs->file_name . '" target="_blank">
                        <img alt="100%x180" src="' . base_url('upload/images/') . $rs->file_name . '" class="img-thumbnail w-100 d-block runImageView">
                        </a>
                        <i class="icon-trash iconImageDel" 
                            data_fileAutoid="'.$rs->file_autoid.'"
                            data_fileName = "'.$rs->file_name.'"
                        ></i>
                    </div>
            ';
                }
            }
        }else{
            $output .='
            <div class="col-md-12 text-center">
                <h3>ไม่พบไฟล์รูปภาพ</h3>
            </div>';
        }
        

        $output .= '
                </div>
            </div>
        </div>
        ';
    /////////Section Image 3
    ////////////////////////////////////








    ////////////////////////////////////
    /////////Section Image 4
    $sqlFileType4 = getImageType4($fardetailFormno , "อัพโหลดไฟล์อื่นๆ" , $farDetailMainFormno);
    $output .='
    <div class="card bg-light mb-3">
    <div class="card-header">อัพโหลดไฟล์อื่นๆ</div>
    <div class="card-body">
        <div class="row">';
    if($sqlFileType4->num_rows() != 0){
        foreach ($sqlFileType4->result() as $rs) {
            if ($rs->file_name != "") {
                $output .= '
                <div class="col-md-3 mb-2 text-center">
                    <a href="' . base_url('upload/images/') . $rs->file_name . '" target="_blank">
                    <img alt="100%x180" src="' . base_url('upload/images/') . $rs->file_name . '" class="img-thumbnail w-100 d-block runImageView">
                    </a>
                    <i class="icon-trash iconImageDel" 
                        data_fileAutoid="'.$rs->file_autoid.'"
                        data_fileName = "'.$rs->file_name.'"
                    ></i>
                </div>
        ';
            }
        }
    }else{
        $output .='
        <div class="col-md-12 text-center">
            <h3>ไม่พบไฟล์รูปภาพ</h3>
        </div>';
    }
    

    $output .= '
            </div>
        </div>
    </div>
    ';
    /////////Section Image 4
    ////////////////////////////////////





        $output .= '

            <div class="col-md-12">
                <label for="">หมายเหตุ</label>
                <textarea name="eMemo" id="eMemo" cols="30" rows="5" class="form-control">' . getMemoRun($fardetailFormno , $farDetailMainFormno)->fd_memo . '</textarea>
            </div>

            <div class="divider divider-center"><i class="icon-cloud"></i></div>
    
            ';

            foreach ($sql->result() as $rs) {
                $output .= '
            <div class="row form-group">
                <div class="col-md-6">
                    <label>' . $rs->far_runscreen_name . '</label>
                   <input hidden type="text" id="efar_autoid" name="efar_autoid[]" value="' . $rs->far_autoid . '">
                </div>
                <div class="col-md-6">
                    <input type="text" min="0" id="sRunscreenValue'.$rs->far_autoid.'" name="sRunscreenValue[]" class="form-control runvalueCheckEdit" value="' . valueFormat($rs->far_runscreen_value) . '"
                    data_far_autoid = "'.$rs->far_autoid.'"
                    >
                    
                    <input hidden type="number" name="editMinValue[]" id="editMinValue'.$rs->far_autoid.'" value="'.valueFormat2($rs->far_runscreen_min).'">
                    <input hidden type="number" name="editMaxValue[]" id="editMaxValue'.$rs->far_autoid.'" value="'.$rs->far_runscreen_max.'">
                </div>
            </div>
            ';
            }
            echo $output;
        }
    }










    public function delFileUpload()
    {
        $fileAutoId = "";
        $fileName = "";
        if($this->input->post("fileautoid")){
            $fileAutoId = $this->input->post("fileautoid");
            $fileName = $this->input->post("filename");
            $this->db->where("file_autoid" , $fileAutoId);
            $this->db->delete("msd_files");

            $path = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images/".$fileName;
            unlink($path);

            $output = array(
                "msg" => "ลบรูป ".$fileAutoId." สำเร็จ",
                "status" => "Delete File Successfuly"
            );

            echo json_encode($output);
        }

        
    }








    public function saveSpoint()
    {
        if (isset($_POST['sPointTemplatename'])) {
            $sRunscreenName = $this->input->post("sRunscreenName");
            foreach ($sRunscreenName as $key => $sRunscreenNames) {

                $arSaveSpoint = array(
                    "far_main_formno" => $this->input->post("sPointMainForm"),
                    "far_action" => "spoint",
                    "far_runscreen_name" => $sRunscreenNames,
                    "far_runscreen_value" => $this->input->post("sRunscreenValue")[$key],
                    "far_runscreen_min" => $this->input->post("sMinValue")[$key],
                    "far_runscreen_max" => $this->input->post("sMaxValue")[$key],
                    "far_runscreen_linenum" => $this->input->post("sRunscreenLinenum")[$key]
                );
                $this->db->insert("farrel_detail", $arSaveSpoint);

                $output = array(
                    "msg" => "บันทึก S/Point เรียบร้อยแล้ว",
                    "status" => "Insert success"
                );
            }

            $arSaveSpointStatus = array(
                "ptwo_spointstatus" => "yes"
            );
            $this->db->where("fam_formno" , $this->input->post("sPointMainForm"));
            $this->db->update("farrel_main" , $arSaveSpointStatus);
        }
        echo json_encode($output);
    }



    public function checkSaveSpoint()
    {
        if (isset($_POST['sPointTemplatename'])) {
            $sRunscreenName = $this->input->post("sRunscreenName");
            $countNullSpoint = 1;
            foreach ($sRunscreenName as $key => $sRunscreenNames) {
                if ($this->input->post("sRunscreenValue")[$key] == "") {
                    $countNullSpoint *= 0;
                } else {
                    $countNullSpoint *= 1;
                }
            }

            echo $countNullSpoint;
        }
    }



    public function saveSubmain()
    {
        $submainFormno = getSubFormNo();

        if ($this->input->post("choose_worksection") != "") {

            $arSaveSubmain = array(
                "fasub_formno" => $submainFormno,
                "fasub_main_formno" => $this->input->post("check_fasub_main_formno"),
                "fasub_worktime" => $this->input->post("choose_worksection"),
                "fasub_machinename" => $this->input->post("check_machinename"),
                "fasub_op_username" => getUser()->Fname . " " . getUser()->Lname,
                "fasub_op_ecode" => getUser()->ecode,
                "fasub_op_deptcode" => getUser()->DeptCode,
                "fasub_op_datetime" => date("Y-m-d H:i:s")
            );
            $this->db->insert("farrel_submain", $arSaveSubmain);


            $output = array(
                "msg" => "บันทึกข้อมูลกะงานสำเร็จ",
                "status" => "Insert success"
            );
        } else {
            $output = array(
                "msg" => "บันทึกข้อมูลกะงานไม่สำเร็จ",
                "status" => "Insert not success"
            );
        }
        echo json_encode($output);
    }



// public function showSubmainData()
// {
//     $mainformno = $this->input->post("mainFormno");
//     getSubmaindata($mainformno);
// }




    public function saveRun()
    {

        if (isset($_POST['rChooseTime'])) {

            $submainFormno = "";
            $mainFormno = $this->input->post("rMainFormno");
            // Save Submain frist

            // if($this->input->post("returnCheckShift") == 0){
                
            //     $submainFormno = getSubFormNo();
            //     $arSaveSubmain = array(
            //         "fasub_formno" => $submainFormno,
            //         "fasub_main_formno" => $this->input->post("rMainFormno"),
            //         "fasub_worktime" => $this->input->post("fasub_worktime"),
            //         "fasub_machinename" => $this->input->post("rMachineTemp"),
            //         "fasub_op_username" => getUser()->Fname . " " . getUser()->Lname,
            //         "fasub_op_ecode" => getUser()->ecode,
            //         "fasub_op_deptcode" => getUser()->DeptCode,
            //         "fasub_op_datetime" => date("Y-m-d H:i:s")
            //     );
            //     $this->db->insert("farrel_submain", $arSaveSubmain);
            // }else{

            //     if(getSubmainDataForInsert($mainFormno)->row()->fasub_worktime != $this->input->post("fasub_worktime")){
            //         $submainFormno = getSubFormNo();
            //         $arSaveSubmain = array(
            //             "fasub_formno" => $submainFormno,
            //             "fasub_main_formno" => $this->input->post("rMainFormno"),
            //             "fasub_worktime" => $this->input->post("fasub_worktime"),
            //             "fasub_machinename" => $this->input->post("rMachineTemp"),
            //             "fasub_op_username" => getUser()->Fname . " " . getUser()->Lname,
            //             "fasub_op_ecode" => getUser()->ecode,
            //             "fasub_op_deptcode" => getUser()->DeptCode,
            //             "fasub_op_datetime" => date("Y-m-d H:i:s")
            //         );
            //     $this->db->insert("farrel_submain", $arSaveSubmain);
            //     }else{
            //         $submainFormno = getSubmainDataForInsert($mainFormno)->row()->fasub_formno;
            //     }
            // }


            $getDetailFormNo = getDetailFormNo();
            $rRunscreenName = $this->input->post("sRunscreenName");
            $fileInput1 = "fd_files1";
            $fileInput2 = "fd_files2";
            $fileInput3 = "fd_files3";
            $fileInput4 = "fd_files4";

            $fileTypeName1 = "อัพโหลดไฟล์รูปหน้าจอ";
            $fileTypeName2 = "อัพโหลดไฟล์รูปเม็ด MB.";
            $fileTypeName3 = "อัพโหลดไฟล์รูปปัญหาในการผลิตและการทำงาน";
            $fileTypeName4 = "อัพโหลดไฟล์อื่นๆ";

            uploadImage($fileInput1 , $getDetailFormNo , $fileTypeName1 , $mainFormno);
            uploadImage($fileInput2 , $getDetailFormNo , $fileTypeName2 , $mainFormno);
            uploadImage($fileInput3 , $getDetailFormNo , $fileTypeName3 , $mainFormno);
            uploadImage($fileInput4 , $getDetailFormNo , $fileTypeName4 , $mainFormno);


            // Save Memo to Memo table
            $arMemoDetail = array(
                "fd_refformno" => $getDetailFormNo,
                "fd_refmainformno" => $mainFormno,
                "fd_memo" => $this->input->post("fd_memo"),
                "fd_userpost" => getUser()->Fname . " " . getUser()->Lname,
                "fd_ecodepost" => getUser()->ecode,
                "fd_datetime" => date("Y-m-d H:i:s")
            );
            $this->db->insert("msd_memo", $arMemoDetail);

            $getLinenumGroup = getGroup_linenumber($mainFormno);



            foreach ($rRunscreenName as $key => $rRunscreenNames) {

                $arSaveSpoint = array(
                    "far_detail_formno" => $getDetailFormNo,
                    "far_main_formno" => $this->input->post("rMainFormno"),
                    // "far_sub_formno" => $submainFormno,
                    "far_worktime" => $this->input->post("rChooseTime"),
                    "far_action" => "run",
                    "far_runscreen_name" => $rRunscreenNames,
                    "far_runscreen_value" => $this->input->post("sRunscreenValue")[$key],
                    "far_runscreen_linenum" => $this->input->post("sRunscreenLinenum")[$key],
                    "far_runscreen_group_linenum" => $getLinenumGroup,
                    "far_runscreen_min" => $this->input->post("sMinValue")[$key],
                    "far_runscreen_max" => $this->input->post("sMaxValue")[$key],
                    "far_userpost" => getUser()->Fname . " " . getUser()->Lname,
                    "far_ecodepost" => getUser()->ecode,
                    "far_datetime" => date("Y-m-d H:i:s")
                );
                $this->db->insert("farrel_detail", $arSaveSpoint);
                $output = array(
                    "msg" => "บันทึก Run/Point เรียบร้อยแล้ว",
                    "status" => "Insert success"
                );
            }
        }
        echo json_encode($output);
    }



    public function checkSaveRun()
    {
        $checkRunscreen = $this->input->post("sRunscreenName");
        $checkpoint = 1;
        foreach ($checkRunscreen as $key => $values) {
            if ($this->input->post("sRunscreenValue")[$key] == "") {
                $checkpoint = $checkpoint * 0;
            } else {
                $checkpoint = $checkpoint * 1;
            }
            // 0 คือตรวจสอบพบค่าว่าง , 1 คือตรวจสอบไม่พบค่าว่าง
        }
        echo $checkpoint;
    }



    public function checkSaveEditRun()
    {
        if ($this->input->post("editRunWorktime") != "") {

            $far_runscreen_value = $this->input->post("sRunscreenValue");
            $checkpointE = 1;
            foreach ($far_runscreen_value as $key => $values) {
                if ($values == "") {
                    $checkpointE = $checkpointE * 0;
                } else {
                    $checkpointE = $checkpointE * 1;
                }
            }
            echo $checkpointE;
        }
    }



    public function loadWorkTimeByDetail()
    {
        $mainFormno = "";
        if ($this->input->post("mainFormno")) {
            $mainFormno = $this->input->post("mainFormno");

            $sql = $this->db->query("SELECT
            farrel_detail.far_worktime,
            farrel_detail.far_detail_formno,
            farrel_detail.far_runscreen_group_linenum
            FROM
            farrel_detail
            WHERE
            farrel_detail.far_main_formno = '$mainFormno' AND
            farrel_detail.far_action = 'run'
            GROUP BY
            farrel_detail.far_worktime,
            farrel_detail.far_sub_formno,
            farrel_detail.far_detail_formno
            ORDER BY
            farrel_detail.far_runscreen_group_linenum ASC");

            $output = '<option value="">กรุณาเลือกช่วงเวลา</option>';

            foreach ($sql->result() as $rs) {
                $output .= '
                <option id="op_'.$rs->far_detail_formno.'" value="' . $rs->far_detail_formno . '"
                    data_group_linenum = "'.$rs->far_runscreen_group_linenum.'"
                    data_far_worktime = "'.$rs->far_worktime.'"
                >' . convertTimeToShift($rs->far_worktime) .'&nbsp;|&nbsp;'.$rs->far_worktime.'</option>
            ';
            }

            echo $output;
        }
    }



    public function saveEditRun()
    {
        if ($this->input->post("editRunWorktime") != "") {

            $eDetailFormno = $this->input->post("eDetailFormno");
            $mainFormno = $this->input->post("eMainFormno");

            $fileInput1 = "fd_files1";
            $fileInput2 = "fd_files2";
            $fileInput3 = "fd_files3";
            $fileInput4 = "fd_files4";

            $fileTypeName1 = "อัพโหลดไฟล์รูปหน้าจอ";
            $fileTypeName2 = "อัพโหลดไฟล์รูปเม็ด MB.";
            $fileTypeName3 = "อัพโหลดไฟล์รูปปัญหาในการผลิตและการทำงาน";
            $fileTypeName4 = "อัพโหลดไฟล์อื่นๆ";

            uploadImage($fileInput1 , $eDetailFormno , $fileTypeName1 , $mainFormno);
            uploadImage($fileInput2 , $eDetailFormno , $fileTypeName2 , $mainFormno);
            uploadImage($fileInput3 , $eDetailFormno , $fileTypeName3 , $mainFormno);
            uploadImage($fileInput4 , $eDetailFormno , $fileTypeName4 , $mainFormno);



            $far_runscreen_value = $this->input->post("sRunscreenValue");
            foreach ($far_runscreen_value as $key => $far_runscreen_values) {
                $arSaveEdit = array(
                    "far_runscreen_value" => conPrice($far_runscreen_values),
                    "far_worktime" => $this->input->post("rChooseTime_edit"),
                    "far_user_modify" => getUser()->Fname . " " . getUser()->Lname,
                    "far_ecode_modify" => getUser()->ecode,
                    "far_datetime_modify" => date("Y-m-d H:i:s")
                );

                $this->db->where("far_autoid", $this->input->post("efar_autoid")[$key]);
                $this->db->update("farrel_detail", $arSaveEdit);
            }


            $arSaveMemo = array(
                "fd_memo" => $this->input->post("eMemo"),
                "fd_usermodify" => getUser()->Fname . " " . getUser()->Lname,
                "fd_ecodemodify" => getUser()->ecode,
                "fd_datetimemodify" => date("Y-m-d H:i:s")
            );
            $this->db->where("fd_refformno", $this->input->post("eDetailFormno"));
            $this->db->where("fd_refmainformno", $this->input->post("eMainFormno"));
            $this->db->update("msd_memo", $arSaveMemo);


            $output = array(
                "msg" => "แก้ไขข้อมูลเรียบร้อยแล้ว",
                "status" => "Edit success"
            );
        } else {
            $output = array(
                "msg" => "แก้ไขข้อมูลไม่สำเร็จ",
                "status" => "Edit not success"
            );
        }
        echo json_encode($output);
    }




    public function deleteEditRun()
    {
        if ($this->input->post("editRunWorktime") != "") {
            $delDetailFormno = $this->input->post("eDetailFormno");
            $mainFormno = $this->input->post("eMainFormno");
            $subFormno = $this->input->post("getESubMainFormno");

            $this->db->where("far_detail_formno", $delDetailFormno);
            $this->db->where("far_main_formno", $mainFormno);
            $this->db->delete("farrel_detail");


            $this->db->where("fd_refformno", $delDetailFormno);
            $this->db->where("fd_refmainformno", $mainFormno);
            $this->db->delete("msd_memo");

            foreach(getFileFromDb($delDetailFormno , $mainFormno)->result() as $gf){
                $path = $_SERVER['DOCUMENT_ROOT']."/intsys/msd/upload/images/".$gf->file_name;
                unlink($path);
            }

            $this->db->where("file_detail_formno", $delDetailFormno);
            $this->db->where("file_main_formno", $mainFormno);
            $this->db->delete("msd_files");


            // //Check Shift ว่ามี Detail อยู่ไหมถ้าไม่มีอยู่ปล้วให้ลบ Shift ทิ้งเลย
            // $sql = $this->db->query("SELECT far_sub_formno , far_detail_formno from farrel_detail where far_sub_formno = '$subFormno' GROUP BY far_detail_formno");
            // if($sql->num_rows() == 0){
            //     //ถ้าไม่มีรายการ Detail แล้วให้ลบ Shift ออกด้วย
            //     $this->db->where("fasub_formno", $subFormno);
            //     $this->db->delete("farrel_submain");
            // }

            $output = array(
                "msg" => "ลบข้อมูลสำเร็จ",
                "status" => "Delete success"
            );
        }
        echo json_encode($output);
    }



    public function chooseFeeder()
    {
        $mainformno = "";
        if ($this->input->post("mainformno")) {
            $mainformno = $this->input->post("mainformno");
            getFeederChoose($mainformno);
        }
    }


    public function saveDataToFeeder()
    {
        if ($this->input->post("md_value") != "") {

            // if ($this->input->post("md_qtyuse") == 0) {
            //     $mdvalueSet = $this->input->post("md_value");
            // } else {
            //     $mdvalueSet = $this->input->post("md_qtyuse") + $this->input->post("md_value");
            // }


            // Update value on bom table
            $bomArrayTb = array(
                "b_bomqtyuse" => $this->input->post("md_qtyuseCal"),
                "b_bombalance" => $this->input->post("md_qtyBalance")
            );
            $this->db->where("b_autoid", $this->input->post("md_autoid"));
            $this->db->update("farrel_bom", $bomArrayTb);



            $feederAr = array(
                "faf_rawmaterial" => $this->input->post("md_rawmaterial"),
                "faf_value" => $this->input->post("md_value"),
                "faf_rawautoid" => $this->input->post("md_autoid")
            );
            $this->db->where("faf_mainformno", $this->input->post("md_mainformno"));
            $this->db->where("faf_prodid", $this->input->post("md_prodid"));
            $this->db->where("faf_feedername", $this->input->post("md_chooseFeeder"));


            if ($this->db->update("farrel_feeder", $feederAr)) {
                $output = array(
                    "msg" => "บันทึกข้อมูลสำเร็จ",
                    "status" => "Update success",
                    "mainformno" => $this->input->post("md_mainformno")
                );
            } else {
                $output = array(
                    "msg" => "บันทึกข้อมูลไม่สำเร็จ",
                    "status" => "Update not success"
                );
            }
        }
        echo json_encode($output);
    }



    public function getBomForMix()
    {
        $mainformno = "";
        $mainformno = $this->input->post("mainformno");
        getBomForMix($mainformno);
    }


    public function getBomForMix2()
    {
        $mainformno = "";
        $mainformno = $this->input->post("mainformno");
        getBomForMix2($mainformno);
    }


    public function activeMix()
    {
        $b_autoid = '';
        $calBomqtyUseMix = '';
        if ($this->input->post("b_autoid")) {
            $b_autoid = $this->input->post("b_autoid");
            $calBomqtyUseMix = $this->input->post("calBomqtyUseMix");


            // Check b_bomstatus
            $sql = $this->db->query("SELECT b_bomstatus FROM farrel_bom WHERE b_autoid = '$b_autoid' ");
            if ($sql->row()->b_bomstatus == "active") {
                $bomstatusText = "wait confirm";
            } else {
                $bomstatusText = "active";
            }

            $arActiveMix = array(
                "b_bomstatus" => $bomstatusText,
                "b_bomqtyusemix" => $calBomqtyUseMix
            );
            $this->db->where("b_autoid",  $b_autoid);
            if ($this->db->update("farrel_bom", $arActiveMix)) {
                $output = array(
                    "msg" => "อัพเดต สำเร็จ Status ปัจจุบันคือ $bomstatusText",
                    "status" => "Update status success",
                    "bomstatus" => $bomstatusText,
                    "bomusemix" => $calBomqtyUseMix
                );
            } else {
                $output = array(
                    "msg" => "อัพเดต ไม่สำเร็จ",
                    "status" => "Update status not success"
                );
            }
            echo json_encode($output);
        }
    }


    public function waitConfirmMix()
    {
        $mainformno = "";
        $mainformno = $this->input->post("mainformno");
        getWaitConfirmMix($mainformno);
    }


    public function countConfirmMix()
    {
        $mainformno = "";
        $mainformno = $this->input->post("mainformno");
        countWaitConfirmMix($mainformno);
    }


    public function saveDataMix()
    {
        $mainformno = '';
        $prodid = '';
        $material = '';
        $bomqty = '';

        if ($this->input->post("mainformno")) {
            $mainformno = $this->input->post("mainformno");
            $prodid = $this->input->post("prodid");
            $material = $this->input->post("material");
            $bomqty = $this->input->post("bomqty");

            // check bom use
            $sqlCheckBom = $this->db->query("SELECT b_autoid , b_bomqty , b_bomqtyuse FROM farrel_bom WHERE b_mainformno = '$mainformno' and b_bomstatus = 'wait confirm' ");
            foreach ($sqlCheckBom->result() as $brs) {
                if($brs->b_bomqtyuse != 0){
                    $bomstatus = "split mix";
                }else{
                    $bomstatus = "inactive";
                }
                $arupdateUserBom = array(
                    "b_bombalance" => 0,
                    "b_bomstatus" => $bomstatus
                );
                $this->db->where("b_autoid", $brs->b_autoid);
                $this->db->update("farrel_bom", $arupdateUserBom);
            }

            $saveMixArray = array(
                "b_mainformno" => $mainformno,
                "b_prodid" => $prodid,
                "b_rawmaterial" => $material,
                "b_bomqty" => $bomqty,
                "b_bomtype" => "Mix"
            );
            $this->db->insert("farrel_bom", $saveMixArray);
            $output = array(
                "msg" => "บันทึกข้อมูลสำเร็จ",
                "status" => "Insert success"
            );
        } else {
            $output = array(
                "msg" => "บันทึกข้อมูลไม่สำเร็จ",
                "status" => "Insert not success"
            );
        }
        echo json_encode($output);
    }



    public function canCelMix()
    {
        $mainformno = "";
        if ($this->input->post("mainformno")) {
            $mainformno = $this->input->post("mainformno");

            // Quety ลบข้อมูลการ Mix ออกจากฐานข้อมูล

            $this->db->where("b_bomtype", "Mix");
            $this->db->where("b_mainformno", $mainformno);
            $this->db->delete("farrel_bom");
            
            // Quety ลบข้อมูลการ Mix ออกจากฐานข้อมูล


            $sql = $this->db->query("SELECT b_bomqtyusemix , b_autoid FROM farrel_bom WHERE b_mainformno = '$mainformno' ");
            foreach($sql->result() as $rs){
                if($rs->b_bomqtyusemix != 0){

                    $arrayUpdate = array(
                        "b_bombalance" => $rs->b_bomqtyusemix,
                        "b_bomqtyusemix" => 0 ,
                        "b_bomstatus" => "active"
                    );

                    $this->db->where("b_autoid", $rs->b_autoid);
                    $this->db->update("farrel_bom", $arrayUpdate);

                    $output = array(
                        "msg" => $rs->b_bomqtyusemix."<br>",
                        "status" => "Update data success"
                    );

                    echo json_encode($output);
                }
            }

            // $arUpdateBom = array(
            //     "b_bomqtyuse" => 0.000,
            //     "b_bomstatus" => "active"
            // );

            
            // $output = array(
            //     "msg" => "ยกเลิกการสร้าง Bom เรียบร้อยแล้ว",
            //     "status" => "Update data success"
            // );
        }
        
    }



    public function loadGetBom()
    {
        $mainformno = $this->input->post("mainformno");
        getBom($mainformno);
    }


    public function loadGetBomMix()
    {
        $mainformno = $this->input->post("mainformno");
        getBomMix($mainformno);
    }


    public function getValueBomMix()
    {
        if($this->input->post("gv_bom") != ""){
            $arrayGetValue = array(
                "b_mainformno" => $this->input->post("gv_mainformNo"),
                "b_prodid" => $this->input->post("gv_b_prodid"),
                "b_rawmaterial" => $this->input->post("gv_rawmat"),
                "b_bomqty" => $this->input->post("gv_bom"),
                "b_bomstatus" => "separate mix"
            );
            if($this->db->insert("farrel_bom" , $arrayGetValue)){


                $arUpdateOld = array(
                    "b_bomqtyuse" => $this->input->post("gv_bom")
                );
                $this->db->where("b_autoid" , $this->input->post("gv_b_autoid"));
                $this->db->update("farrel_bom" , $arUpdateOld);

                $output = array(
                    "msg" => "อัพเดตข้อมูลสำเร็จ",
                    "status" => "Update successfuly"
                );

                echo json_encode($output);
            }
        }
    }


    public function loadFeederTemp()
    {
        $mainformno = $this->input->post("mainformno");
        getFeederTemp($mainformno);
    }


    public function delValueFeeder()
    {
        $fee_autoid = '';
        $fee_mainformno = '';
        $fee_prodid = '';
        $fee_rawmaterial = '';
        $fee_value = '';
        $raw_autoid = '';

        if ($this->input->post("autoid")) {
            $fee_autoid = $this->input->post("autoid");
            $fee_mainformno = $this->input->post("mainformno");
            $fee_prodid = $this->input->post("prodid");
            $fee_rawmaterial = $this->input->post("rawmaterial");
            $fee_value = $this->input->post("value");
            $raw_autoid = $this->input->post("rawautoid");

            // Check ว่าเรื่องการ Mix อยู่หรือไม่
            if(checkItemMixAlready($raw_autoid) != 0){
                $output = array(
                    "msg" => "ไม่สามารถลบไอเท็มนี้ได้เนื่องจากติดสถานะการ Mix กรุณายกเลิกการ Mix ทั้งหมดก่อน",
                    "status" => "Cannot Delete"
                );
                echo json_encode($output);
                exit;
            }else{
                // Delete data on Feeder table
                $arDeleteData = array(
                    "faf_rawmaterial" => null,
                    "faf_value" => null,
                    "faf_rawautoid" => null,

                    "faf_deviation" => null,
                    "faf_kghr" => null,
                    "faf_kgmin" => null,
                    "faf_ex1" => null,
                    "faf_ex2" => null,
                    "faf_ex3" => null,
                    "faf_ex4" => null,
                    "faf_ex5" => null,
                    "faf_exavg" => null,
                    "faf_accept" => null,
                    "faf_status" => null,
                    "faf_memo" => null,
                    "faf_userpost" => null,
                    "faf_ecodepost" => null,
                    "faf_deptcodepost" => null,
                    "faf_datetime" => null,
                );
                $this->db->where("faf_autoid", $fee_autoid);
                $this->db->update("farrel_feeder", $arDeleteData);
                // Delete data on Feeder table


                // Return rawmaterial data to Bom table
                $calBomReturn = selectUseValue($fee_mainformno, $fee_prodid, $fee_rawmaterial, $raw_autoid) - $fee_value;
                $calBomBalanceReturn = selectBalanceValue($fee_mainformno, $fee_prodid, $fee_rawmaterial, $raw_autoid) + $fee_value;

                $arUpdateBomTable = array(
                    "b_bomqtyuse" => $calBomReturn,
                    "b_bombalance" => $calBomBalanceReturn
                );
                $this->db->where("b_mainformno", $fee_mainformno);
                $this->db->where("b_prodid", $fee_prodid);
                $this->db->where("b_rawmaterial", $fee_rawmaterial);
                $this->db->where("b_autoid", $raw_autoid);
                $this->db->update("farrel_bom", $arUpdateBomTable);

                $output = array(
                    "msg" => "Update ข้อมูลสำเร็จ",
                    "status" => "Update data success"
                );
            }

            
        }
        echo json_encode($output);
    }




    public function startprocess()
    {
        $subformno = "";
        if ($this->input->post("subformno")) {
            $subformno = $this->input->post("subformno");

            $arUpdateSubform = array(
                "fasub_status" => "start",
                "fasub_start_username" => getUser()->Fname . " " . getUser()->Lname,
                "fasub_start_ecode" => getUser()->ecode,
                "fasub_start_deptcode" => getUser()->DeptCode,
                "fasub_start_datetime" => date("Y-m-d H:i:s")
            );
            $this->db->where("fasub_formno", $subformno);
            $this->db->update("farrel_submain", $arUpdateSubform);

            $output = array(
                "msg" => "Start process",
                "status" => "Update success"
            );
        }
        echo json_encode($output);
    }



    public function endprocess()
    {
        $subformno = "";
        if ($this->input->post("subformno")) {
            $subformno = $this->input->post("subformno");

            $arUpdateSubform = array(
                "fasub_status" => "stop",
                "fasub_stop_username" => getUser()->Fname . " " . getUser()->Lname,
                "fasub_stop_ecode" => getUser()->ecode,
                "fasub_stop_deptcode" => getUser()->DeptCode,
                "fasub_stop_datetime" => date("Y-m-d H:i:s")
            );
            $this->db->where("fasub_formno", $subformno);
            $this->db->update("farrel_submain", $arUpdateSubform);

            $output = array(
                "msg" => "Stop process",
                "status" => "Update success"
            );
        }
        echo json_encode($output);
    }



    public function delWorktime()
    {
        $subformno = "";
        if ($this->input->post("subformno")) {
            $subformno = $this->input->post("subformno");
            $this->db->where("fasub_formno", $subformno);
            $this->db->delete("farrel_submain");

            $this->db->where("far_sub_formno", $subformno);
            $this->db->delete("farrel_detail");

            $output = array(
                "msg" => "ลบข้อมูลกะงานสำเร็จ",
                "status" => "Delete success"
            );
        }
        echo json_encode($output);
    }


    public function checkActiveWorktime()
    {
        $mainformno = "";
        if ($this->input->post("mainformno")) {
            $mainformno = $this->input->post("mainformno");
            $sql = $this->db->query("SELECT fasub_status FROM farrel_submain WHERE fasub_main_formno = '$mainformno' and fasub_status = 'start' ");
            if ($sql->num_rows() != 0) {
                $output = array(
                    "msg" => "ตรวจสอบพบว่ามี กะงานกำลัง Start อยู่ กรุณา Stop กะงานก่อนหน้านี้ให้เรียบร้อยก่อนค่ะ",
                    "status" => "Found work onprocess"
                );
            } else {
                $output = array(
                    "msg" => "ท่านสามารถเริ่ม Start กะงานได้เลยค่ะ",
                    "status" => "Ready for start"
                );
            }
        }
        echo json_encode($output);
    }



    public function reportFarrel()
    {
        $mainform = "";
        if ($this->input->post("mainform")) {
            $mainform = $this->input->post("mainform");
            $sql = $this->db->query("SELECT
        farrel_feeder.faf_autoid,
        farrel_feeder.faf_mainformno,
        farrel_feeder.faf_prodid,
        farrel_feeder.faf_feedername,
        farrel_feeder.faf_rawmaterial,
        farrel_feeder.faf_value,
        farrel_feeder.faf_kghr,
        farrel_feeder.faf_kgmin,
        farrel_feeder.faf_deviation,
        farrel_feeder.faf_ex1,
        farrel_feeder.faf_ex2,
        farrel_feeder.faf_ex3,
        farrel_feeder.faf_ex4,
        farrel_feeder.faf_ex5,
        farrel_feeder.faf_exavg,
        farrel_feeder.faf_accept,
        farrel_feeder.faf_outputhr,
        farrel_feeder.faf_status,
        farrel_feeder.faf_memo
        FROM
        farrel_feeder
        WHERE faf_mainformno = '$mainform'
        ");
        }

        $output = '
    <table id="reportMachine" class="table table-bordered table-responsive nowrap" cellspacing="0" style="width:100%">
        <col>
        <colgroup span="3"></colgroup>
        <colgroup span="2"></colgroup>
<thead>
            <tr class="text-center">
                <th colspan="3" scope="colgroup" class="table-secondary">การตรวจสอบ Feeder</th>
                <th class="table-secondary">น้ำหนักต่อ</th>
                <th class="table-secondary">น้ำหนักต่อ</th>
                <th colspan="9" class="table-secondary">การทดสอบความเที่ยงตรงของ Feeder กำหนด Output &nbsp;&nbsp; ' . getOutput($mainform)->fam_outputhr . ' &nbsp;&nbsp; kg./ hr</th>
            </tr>
            <tr class="text-center">
                <th scope="col" class="table-secondary">Feeder</th>
                <th scope="col" class="table-secondary">รหัสวัตถุดิบ</th>
                <th scope="col" class="table-secondary">%</th>
                <th scope="col" class="table-secondary">1 ชั่วโมง (kg.)</th>
                <th scope="col" class="table-secondary">1 นาที (kg.)</th>
                <th scope="col" class="table-secondary">ตัวอย่างที่1</th>
                <th scope="col" class="table-secondary">ตัวอย่างที่2</th>
                <th scope="col" class="table-secondary">ตัวอย่างที่3</th>
                <th scope="col" class="table-secondary">ตัวอย่างที่4</th>
                <th scope="col" class="table-secondary">ตัวอย่างที่5</th>
                <th scope="col" class="table-secondary">ค่าเฉลี่ย</th>
                <th scope="col" class="table-secondary">ค่าเบี่ยงเบน +- ' . getOutput($mainform)->fam_deviation . '%</th>
                <th scope="col" class="table-secondary">สถานะ</th>
                <th scope="col" class="table-secondary">หมายเหตุ</th>
            </tr>
            </thead>
            <tbody>';

        foreach ($sql->result() as $rs) {

            if ($rs->faf_rawmaterial != "") {

                if (checkStatusPage2($rs->faf_mainformno)->ptwo_pagestatus == "Stop" || getUser()->DeptCode != "1007") {
                    if(getUser()->ecode == "M1809"){
                        if (getOutput($mainform)->fam_deviation == '' && getOutput($mainform)->fam_outputhr == '') {
                            $modalCon = '';
                        } else {
                            $modalCon = 'data-toggle="modal"';
                        }
                        $feedernamelink = '<a href="javascript:void(0)" class="feederCheck" ' . $modalCon . ' data-target="#addFeeder_modal"
                        data_faf_mainformno = "' . $rs->faf_mainformno . '"
                        data_faf_feedername = "' . $rs->faf_feedername . '"
                        data_faf_rawmaterial = "' . $rs->faf_rawmaterial . '"
                        data_faf_value = "' . $rs->faf_value . '"
                        data_faf_autoid = "' . $rs->faf_autoid . '"
                        data_fam_deviation = "' . getOutput($mainform)->fam_deviation . '"
                        data_fam_outputhr = "' . getOutput($mainform)->fam_outputhr . '"
                        data_prodid="' . getMaindataRow($mainform)->fam_prodid . '"
                        data_productcode="' . getMaindataRow($mainform)->fam_productcode . '"
                        data_batchnumber="' . getMaindataRow($mainform)->fam_batchnumber . '"
                        ><i class="icon-plus-sign2 addTemType"></i><b>' . $rs->faf_feedername . '</b></a>';
                    }else{
                        $feedernamelink = '<b>' . $rs->faf_feedername . '</b>';
                    }
                    
                } else {

                    if (getOutput($mainform)->fam_deviation == '' && getOutput($mainform)->fam_outputhr == '') {
                        $modalCon = '';
                    } else {
                        $modalCon = 'data-toggle="modal"';
                    }
                    $feedernamelink = '<a href="javascript:void(0)" class="feederCheck" ' . $modalCon . ' data-target="#addFeeder_modal"
                    data_faf_mainformno = "' . $rs->faf_mainformno . '"
                    data_faf_feedername = "' . $rs->faf_feedername . '"
                    data_faf_rawmaterial = "' . $rs->faf_rawmaterial . '"
                    data_faf_value = "' . $rs->faf_value . '"
                    data_faf_autoid = "' . $rs->faf_autoid . '"
                    data_fam_deviation = "' . getOutput($mainform)->fam_deviation . '"
                    data_fam_outputhr = "' . getOutput($mainform)->fam_outputhr . '"
                    data_prodid="' . getMaindataRow($mainform)->fam_prodid . '"
                    data_productcode="' . getMaindataRow($mainform)->fam_productcode . '"
                    data_batchnumber="' . getMaindataRow($mainform)->fam_batchnumber . '"
                    ><i class="icon-plus-sign2 addTemType"></i><b>' . $rs->faf_feedername . '</b></a>';
                }
            } else {
                $feedernamelink = $rs->faf_feedername;
            }


            if($rs->faf_deviation != ""){
                $deviationValue = ' ( '.$rs->faf_deviation.' ) ';
            }else{
                $deviationValue = '';
            }

            $output .= '
                <tr>
                    <td>' . $feedernamelink . '</td>
                    <td>' . $rs->faf_rawmaterial . '</td>
                    <td>' . $rs->faf_value . '</td>
                    <td>' . $rs->faf_kghr . '</td>
                    <td>' . $rs->faf_kgmin . '</td>
                    <td>' . $rs->faf_ex1 . '</td>
                    <td>' . $rs->faf_ex2 . '</td>
                    <td>' . $rs->faf_ex3 . '</td>
                    <td>' . $rs->faf_ex4 . '</td>
                    <td>' . $rs->faf_ex5 . '</td>
                    <td>' . $rs->faf_exavg . '</td>
                    <td>' . $rs->faf_accept .$deviationValue. '</td>
                    <td>' . $rs->faf_status . '</td>
                    <td>' . $rs->faf_memo . '</td>
                </tr>
        ';
            }


                $output .= '
        </tbody>
            </table>
        ';

        echo $output;
    }




    public function saveOutput()
    {
        if ($this->input->post("cf_output") != "") {
            $arSaveOutput = array(
                "fam_outputhr" => $this->input->post("cf_output"),
                "fam_deviation" => $this->input->post("cf_deviation")
            );
            $this->db->where("fam_formno", $this->input->post("check_output_mainform"));
            $this->db->update("farrel_main", $arSaveOutput);

            $output = array(
                "msg" => "บันทึก output สำเร็จ",
                "status" => "Update success",
                "mainformno" => $this->input->post("check_output_mainform")
            );
        }
        echo json_encode($output);
    }



    public function checkDataFeederForEdit()
    {
        $mainformno = '';
        if ($this->input->post("mainformno")) {
            $mainformno = $this->input->post("mainformno");

            $sql = $this->db->query("SELECT faf_status FROM farrel_feeder WHERE faf_mainformno = '$mainformno' and faf_status in ('ผ่าน' , 'ไม่ผ่าน') ");

            $output = array(
                "msg" => "เช็คข้อมูลการตรวจสอบ Feeder เรียบร้อยแล้ว",
                "status" => "Check success",
                "feederRow" => $sql->num_rows()
            );

            echo json_encode($output);
        }
    }



    public function getDataFeeder()
    {
        $feederAutoid = '';
        if ($this->input->post("feederAutoid")) {
            $feederAutoid = $this->input->post("feederAutoid");

            $sql = $this->db->query("SELECT
        farrel_feeder.faf_value,
        farrel_feeder.faf_kghr,
        farrel_feeder.faf_kgmin,
        farrel_feeder.faf_deviation,
        farrel_feeder.faf_ex1,
        farrel_feeder.faf_ex2,
        farrel_feeder.faf_ex3,
        farrel_feeder.faf_ex4,
        farrel_feeder.faf_ex5,
        farrel_feeder.faf_exavg,
        farrel_feeder.faf_accept,
        farrel_feeder.faf_memo,
        farrel_feeder.faf_status
        FROM
        farrel_feeder
        where farrel_feeder.faf_autoid = '$feederAutoid'
        ");

            $result = $sql->row();

            $output = array(
                "faf_value" => $result->faf_value,
                "faf_kghr" => $result->faf_kghr,
                "faf_kgmin" => $result->faf_kgmin,
                "faf_deviation" => $result->faf_deviation,
                "faf_ex1" => $result->faf_ex1,
                "faf_ex2" => $result->faf_ex2,
                "faf_ex3" => $result->faf_ex3,
                "faf_ex4" => $result->faf_ex4,
                "faf_ex5" => $result->faf_ex5,
                "faf_exavg" => $result->faf_exavg,
                "faf_accept" => $result->faf_accept,
                "faf_memo" => $result->faf_memo,
                "faf_status" => $result->faf_status

            );

            echo json_encode($output);
        }
    }



    public function saveReportFeeder()
    {
        
            $arSaveFeeder = array(
                "faf_kghr" => $this->input->post("addf_perhr"),
                "faf_kgmin" => $this->input->post("addf_permin"),
                "faf_deviation" => $this->input->post("acf_deviation"),
                "faf_ex1" => $this->input->post("addf_ex1"),
                "faf_ex2" => $this->input->post("addf_ex2"),
                "faf_ex3" => $this->input->post("addf_ex3"),
                "faf_ex4" => $this->input->post("addf_ex4"),
                "faf_ex5" => $this->input->post("addf_ex5"),
                "faf_exavg" => $this->input->post("addf_exAvg"),
                "faf_accept" => $this->input->post("addf_accept"),
                "faf_status" => $this->input->post("addf_checkpass"),
                "faf_memo" => $this->input->post("addf_memo"),
                "faf_userpost" => getUser()->Fname . " " . getUser()->Lname,
                "faf_ecodepost" => getUser()->ecode,
                "faf_deptcodepost" => getUser()->DeptCode,
                "faf_datetime" => date("Y-m-d H:i:s")
            );
            $this->db->where("faf_autoid", $this->input->post("checkAddfAutoid"));
            $this->db->update("farrel_feeder", $arSaveFeeder);

            $output = array(
                "msg" => "บันทึกข้อมูลสำเร็จ",
                "status" => "Update success"
            );
            echo json_encode($output);
        
    }




    public function delReportFeeder()
    {
        if ($this->input->post("addf_checkpass") != "") {
            $arSaveFeeder = array(
                "faf_kghr" => null,
                "faf_kgmin" => null,
                "faf_ex1" => null,
                "faf_ex2" => null,
                "faf_ex3" => null,
                "faf_ex4" => null,
                "faf_ex5" => null,
                "faf_exavg" => null,
                "faf_accept" => null,
                "faf_status" => null,
                "faf_memo" => null,
                "faf_userpost" => getUser()->Fname . " " . getUser()->Lname,
                "faf_ecodepost" => getUser()->ecode,
                "faf_deptcodepost" => getUser()->DeptCode,
                "faf_datetime" => date("Y-m-d H:i:s")
            );
            $this->db->where("faf_autoid", $this->input->post("checkAddfAutoid"));
            $this->db->update("farrel_feeder", $arSaveFeeder);

            $output = array(
                "msg" => "บันทึกข้อมูลสำเร็จ",
                "status" => "Update success"
            );
        }

        echo json_encode($output);
    }




    public function loadReportCheckMachine()
    {
        $mainformno = $this->input->post("mainform");
        $sql = $this->db->query("SELECT
    msd_checkmachine.ck_autoid,
    msd_checkmachine.ck_mainformno,
    msd_checkmachine.ck_checklist,
    msd_checkmachine.ck_status,
    msd_checkmachine.ck_memo,
    msd_checkmachine.ck_rmqc,
    msd_checkmachine.ck_moisture,
    msd_checkmachine.ck_userpost,
    msd_checkmachine.ck_ecodepost,
    msd_checkmachine.ck_deptcodepost,
    msd_checkmachine.ck_datetime
    FROM
    msd_checkmachine
    WHERE ck_mainformno = '$mainformno'
    ");

        $output = '
    <table id="reportMachineCheckList" class="table table-bordered nowrap" cellspacing="0" style="width:100%">

        <thead class="text-center">
            <tr>
                <th class="table-secondary">การตรวจสอบเครื่อง</th>
                <th class="table-secondary">สถานะ</th>
                <th class="table-secondary">หมายเหตุ</th>
            </tr>
            
        </thead>
        <tbody>
    ';

        foreach ($sql->result() as $rs) {



            if (checkStatusPage2($rs->ck_mainformno)->ptwo_pagestatus == "Stop" || getUser()->DeptCode != "1007") {
                if(getUser()->ecode == "M1809"){
                    $checklistIcon = '<a href="javascript:void(0)" class="machineCheckList" data-toggle="modal" data-target="#addCheckMachine_modal"
                    data_ckautoid = "' . $rs->ck_autoid . '"
                    data_prodid="' . getMaindataRow($mainformno)->fam_prodid . '"
                    data_productcode="' . getMaindataRow($mainformno)->fam_productcode . '"
                    data_batchnumber="' . getMaindataRow($mainformno)->fam_batchnumber . '"
                    data_checklistname="' . $rs->ck_checklist . '"
                    ><i class="icon-plus-sign2 addTemType"></i><b>' . $rs->ck_checklist . '</b></a>';
                }else{
                    $checklistIcon = '<b>' . $rs->ck_checklist . '</b>';
                }
                
            } else {
                $checklistIcon = '<a href="javascript:void(0)" class="machineCheckList" data-toggle="modal" data-target="#addCheckMachine_modal"
            data_ckautoid = "' . $rs->ck_autoid . '"
            data_prodid="' . getMaindataRow($mainformno)->fam_prodid . '"
            data_productcode="' . getMaindataRow($mainformno)->fam_productcode . '"
            data_batchnumber="' . getMaindataRow($mainformno)->fam_batchnumber . '"
            data_checklistname="' . $rs->ck_checklist . '"
            ><i class="icon-plus-sign2 addTemType"></i><b>' . $rs->ck_checklist . '</b></a>';
            }


            $output .= '
            <tr>
                <td>' . $checklistIcon . '</td>
                <td>' . $rs->ck_status . '</td>
                <td>' . $rs->ck_memo . '</td>
            </tr>
        ';
        }

        $output .= '
        </tbody>
    </table>
    ';

        echo $output;
    }




    public function loadBomReport()
    {
        $mainformno = $this->input->post("mainform");
        $sqlbom = $this->db->query("SELECT
            farrel_bom.b_rawmaterial,
            farrel_bom.b_bomqty
            FROM
            farrel_bom
            WHERE b_bomtype = 'original' and b_mainformno = '$mainformno' order by b_autoid asc
            ");


        $output = '
    <table id="reportBomFormdb" class="table table-bordered nowrap" cellspacing="0" style="width:100%">

        <thead class="text-center">
            <tr>
                <th colspan="3" class="table-secondary">BOM</th>
            </tr>

            <tr>
                <th scope="col">ลำดับที่</th>
                <th scope="col">รหัสวัตถุดิบ</th>
                <th scope="col">%</th>
            </tr>
            
        </thead>
        <tbody>
    ';
        $no = 1;
        foreach ($sqlbom->result() as $rs) {



            $output .= '
            <tr>
                <td>' . $no . '</td>
                <td>' . $rs->b_rawmaterial . '</td>
                <td>' . $rs->b_bomqty . '</td>
            </tr>
        ';

            $no++;
        }

        $output .= '
        </tbody>
    </table>
    ';

        echo $output;
    }






    public function loadBomMixReport()
    {
        $mainformno = $this->input->post("mainform");

        $sqlMixBom = $this->db->query("SELECT
            farrel_feeder.faf_feedername,
            farrel_feeder.faf_rawmaterial,
            farrel_feeder.faf_value
            FROM
            farrel_feeder
            INNER JOIN farrel_bom ON farrel_bom.b_autoid = farrel_feeder.faf_rawautoid
            WHERE
            farrel_feeder.faf_mainformno = '$mainformno' AND
            farrel_feeder.faf_value != '' AND
            farrel_bom.b_bomtype = 'Mix'
            ");


        $output = '
    <table id="reportBomMixFormdb" class="table table-bordered nowrap" cellspacing="0" style="width:100%">

        <thead class="text-center">
            <tr>
                <th colspan="3" class="table-secondary">สูตร Mix ในแต่ละ Feeder</th>
            </tr>

            <tr>
                <th scope="col">Feeder</th>
                <th scope="col">รหัสวัตถุดิบ</th>
                <th scope="col">%</th>
            </tr>
            
        </thead>
        <tbody>
    ';

        foreach ($sqlMixBom->result() as $rs) {


            $output .= '
            <tr>
                <td>' . $rs->faf_feedername . '</td>
                <td class="rawText">' . $rs->faf_rawmaterial . '</td>
                <td>' . $rs->faf_value . '</td>
            </tr>
        ';
        }

        $output .= '
        </tbody>
    </table>
    ';

        echo $output;
    }





    public function saveCheckMachine()
    {
        if ($this->input->post("addMc_status") != "") {
            $saveCheckMachine = array(
                "ck_status" => $this->input->post("addMc_status"),
                "ck_memo" => $this->input->post("addMc_memo"),
                "ck_userpost" => getUser()->Fname . " " . getUser()->Lname,
                "ck_ecodepost" => getUser()->ecode,
                "ck_deptcodepost" => getUser()->DeptCode,
                "ck_datetime" => date("Y-m-d H:i:s")
            );
            $this->db->where("ck_autoid", $this->input->post("addMc_checkAutoid"));
            $this->db->update("msd_checkmachine", $saveCheckMachine);

            $output = array(
                "msg" => "บันทึกข้อมูลสำเร็จ",
                "status" => "Update success"
            );
        }

        echo json_encode($output);
    }


    public function loadDeviation()
    {
        $mainformno = '';
        if($this->input->post("mainformno")){
            $mainformno = $this->input->post("mainformno");
            $sql = $this->db->query("SELECT fam_deviation FROM farrel_main WHERE fam_formno = '$mainformno' ");

            $output = '
                <select name="cf_deviation" id="cf_deviation" class="form-control">';

                if($sql->num_rows() == 0){
                    $output .= '';
                }else{
                    $output .='
                        <option value="'.$sql->row()->fam_deviation.'">'.$sql->row()->fam_deviation.'</option>
                    ';
                }

            $output .='
                <option value="0.5">0.5</option>
                <option value="1">1</option>
                </select>
            ';

            echo $output;

        }
    }



    public function loadDeviation2()
    {
        $mainformno = '';
        $feederAutoid = '';
        if($this->input->post("mainformno")){
            $mainformno = $this->input->post("mainformno");
            $feederAutoid = $this->input->post("feederAutoid");

            // Check Deviation from feeder first

            $sqlMain = $this->db->query("SELECT fam_deviation FROM farrel_main WHERE fam_formno = '$mainformno' ");
            $sqlFeeder = $this->db->query("SELECT faf_deviation FROM farrel_feeder WHERE faf_mainformno = '$mainformno' AND faf_autoid = '$feederAutoid' AND faf_deviation IS NOT NULL ");

            $output = '';
            if($sqlFeeder->num_rows() == 0){
                $output .= '
                <select name="acf_deviation" id="acf_deviation" class="form-control getDeviation">';
                
                    $output .='
                        <option value="'.$sqlMain->row()->fam_deviation.'">'.$sqlMain->row()->fam_deviation.'</option>
                    ';
                
                    $output .='
                        <option value="0.5">0.5</option>
                        <option value="1">1</option>
                        </select>
                    ';
            }else{
                $output .= '
                <select name="acf_deviation" id="acf_deviation" class="form-control getDeviation">';
                
                    $output .='
                        <option value="'.$sqlFeeder->row()->faf_deviation.'">'.$sqlFeeder->row()->faf_deviation.'</option>
                    ';
                
                    $output .='
                        <option value="0.5">0.5</option>
                        <option value="1">1</option>
                        </select>
                    ';
            }
            echo $output;

        }
    }


    public function getdataMachineList()
    {
        $data_ckautoid = '';
        if ($this->input->post("data_ckautoid")) {
            $data_ckautoid = $this->input->post("data_ckautoid");

            $sql = $this->db->query("SELECT
        msd_checkmachine.ck_autoid,
        msd_checkmachine.ck_mainformno,
        msd_checkmachine.ck_checklist,
        msd_checkmachine.ck_status,
        msd_checkmachine.ck_memo,
        msd_checkmachine.ck_rmqc,
        msd_checkmachine.ck_moisture,
        msd_checkmachine.ck_userpost,
        msd_checkmachine.ck_ecodepost,
        msd_checkmachine.ck_deptcodepost,
        msd_checkmachine.ck_datetime
        FROM
        msd_checkmachine
        WHERE ck_autoid = '$data_ckautoid'
        ");

            $result = $sql->row();

            $output = array(
                "ck_status" => $result->ck_status,
                "ck_memo" => $result->ck_memo,
                "ck_rmqc" => $result->ck_rmqc,
                "ck_moisture" => $result->ck_moisture
            );

            echo json_encode($output);
        }
    }



    public function startPageTwo()
    {
        $mainform = "";
        if ($this->input->post("mainform")) {
            $mainform = $this->input->post("mainform");
            $arUpdateMain = array(
                "ptwo_userstart" => getUser()->Fname . " " . getUser()->Lname,
                "ptwo_ecodestart" => getUser()->ecode,
                "ptwo_deptcodestart" => getUser()->DeptCode,
                "ptwo_datetimestart" => date("Y-m-d H:i:s"),
                "ptwo_pagestatus" => "Start"
            );

            $this->db->where("fam_formno", $mainform);
            $this->db->update("farrel_main", $arUpdateMain);

            $output = array(
                "msg" => "บันทึกข้อมูลสำเร็จ",
                "status" => "Update success"
            );
        }

        echo json_encode($output);
    }




    public function endPageTwo()
    {
        $mainform = "";
        if ($this->input->post("mainform")) {
            $mainform = $this->input->post("mainform");
            $stopmemo = $this->input->post("stopmemo");
            $arUpdateMain = array(
                "fam_stop_memo" => $stopmemo,
                "ptwo_userend" => getUser()->Fname . " " . getUser()->Lname,
                "ptwo_ecodeend" => getUser()->ecode,
                "ptwo_deptcodeend" => getUser()->DeptCode,
                "ptwo_datetimeend" => date("Y-m-d H:i:s"),
                "ptwo_pagestatus" => "Stop"
            );

            $this->db->where("fam_formno", $mainform);
            $this->db->update("farrel_main", $arUpdateMain);

            $output = array(
                "msg" => "บันทึกข้อมูลสำเร็จ",
                "status" => "Update success"
            );
        }

        echo json_encode($output);
    }




    public function cancelPage()
    {
        $mainform = "";
        if ($this->input->post("mainform")) {
            $mainform = $this->input->post("mainform");
            $cancelMemo = $this->input->post("cancelMemo");
            $arUpdateMain = array(
                "ptwo_usercancel" => getUser()->Fname . " " . getUser()->Lname,
                "ptwo_ecodecancel" => getUser()->ecode,
                "ptwo_deptcodecancel" => getUser()->DeptCode,
                "ptwo_datetimecancel" => date("Y-m-d H:i:s"),
                "ptwo_pagestatus" => "Cancel",
                "fam_cancel_memo" => $cancelMemo
            );

            $this->db->where("fam_formno", $mainform);
            $this->db->update("farrel_main", $arUpdateMain);

            $output = array(
                "msg" => "บันทึกข้อมูลสำเร็จ",
                "status" => "Update success"
            );
        }

        echo json_encode($output);
    }





    public function getImageOnRun()
    {
        $detailFormno = '';
        $data_fileType='';
        $mainFormno='';
        if ($this->input->post("detailFormno")) {
            $detailFormno = $this->input->post("detailFormno");
            $data_fileType = $this->input->post("data_fileType");
            $mainFormno = $this->input->post("mainFormno");

            $sql = $this->db->query("SELECT * FROM msd_files WHERE file_detail_formno='$detailFormno' AND file_main_formno = '$mainFormno' AND file_type = '$data_fileType' ");

            $output = '
        <div class="row">
        ';
            foreach ($sql->result() as $rs) {
                $output .= '
            <div class="col-12 col-sm-4 col-lg-4 mb-3 mb-lg-0">
                <a href="' . base_url('upload/images/') . $rs->file_name . '" target="_blank">
                <img alt="100%x180" src="' . base_url('upload/images/') . $rs->file_name . '" class="img-thumbnail w-100 d-block runImageView">
                </a>
            </div>
            ';
            }

            $output .= '
        </div>
        ';


            echo $output;
        }
    }




    public function checkDuplicateTime()
    {
        $subformno = "";
        $inputTime = "";

        if($this->input->post("subformno")){
            $subformno = $this->input->post("subformno");
            $inputTime = $this->input->post("inputTime");

            $sql = $this->db->query("SELECT far_autoid , far_detail_formno , far_sub_formno , far_worktime from farrel_detail where far_sub_formno = '$subformno' and far_worktime = '$inputTime' group by far_sub_formno");

            if($sql->num_rows() != 0){
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




    public function countFeeder()
    {
        $mainformno = $this->input->post("mainformno");
        echo countFeeder($mainformno);
    }



    public function checkMixBalance()
    {
        $mixinput = $this->input->post("minInput");
        $data_bomautoid = $this->input->post("data_bomautoid");

        $sql = $this->db->query("SELECT b_bombalance FROM farrel_bom WHERE b_autoid = '$data_bomautoid' ");
        $rsBombalance = $sql->row()->b_bombalance;
        $output = array(
            "msg" => "ดึงข้อมูลสำเร็จ",
            "bombalance" => $rsBombalance
        );

        echo json_encode($output);
    }




    ///////////////////////////////////////////////
    //////////////// viewmaindata.html 
    //////////////////////////////////////////////







    //////New Function 
    public function checkSubmainTable()
    {
        $mainFormno = $this->input->post("mainFormno");
        checkSubmainTable($mainFormno);
    }


    public function getProductCode()
    {
        $productCode = $this->input->post("productCode");
        $sql = $this->db3->query("SELECT itemid FROM prodtable WHERE itemid like '%$productCode%' GROUP BY itemid");
        if($sql->num_rows() != 0){

            $output = '<ul class="list-group lgprodcode">';
            foreach ($sql->result() as $rs) {
                $output .= '
                <a href="#" id="prodcode_attr"
                data_itemid = "' . $rs->itemid . '"
                ><li class="list-group-item">' . $rs->itemid . '</li></a>
            ';
            }
            $output .= '</ul>';
            echo $output;

        }else{
            echo $sql->num_rows();
        }
    }




    public function saveTemplateDetail()
    {
        $ted_template_name = $this->input->post("ted_template_name");
        $ted_template_image = "ted_template_image";
        $ted_template_itemuse = $this->input->post("ted_template_itemuse_2");
        uploadImageTempDetail($ted_template_name , $ted_template_image , $ted_template_itemuse);
    }


    public function saveEditTemplateDetail()
    {
        $ted_template_name = $this->input->post("ted_template_name");
        $ted_template_image = "ted_template_image";
        $ted_template_image_old = $this->input->post("ted_template_image_old");
        $ted_template_itemuse = $this->input->post("ted_template_itemuse_2");
        uploadEditImageTempDetail($ted_template_name , $ted_template_image , $ted_template_itemuse , $ted_template_image_old);
    }



    public function loadQcSampling()
    {
            $batchnumber = $this->input->post("batchnumber");
            $productnumber = $this->input->post("productnumber");
            $productcode = $this->input->post("productcode");
            $dataareaid = $this->input->post("dataareaid");

            $sql = $this->db3->query("SELECT
            slc_qcsampletable.QCSampleId,
            slc_qcsampletable.QualityOrderId,
            slc_qcsampletable.InventBatchId,
            slc_qcsampletable.ItemId,
            slc_qcsampletable.SampleNo,
            slc_qcsampletable.Approve,
            slc_qcsampletable.ApproveBy,
            slc_qcsampletable.ApproveDateTime,
            slc_qcsampletable.QcBy,
            slc_qcsampletable.QCDateTime,
            slc_qcsampletable.Remark,
            slc_qcsampletable.TestGroupId,
            slc_qcsampletable.SamplingGroupId,
            slc_qcsampletable.LineNum,
            slc_qcsampletable.TestStatus,
            slc_qcsampletable.InventRefId,
            slc_qcsampletable.COAuse,
            slc_qcsampletable.modifiedDateTime,
            slc_qcsampletable.modifiedBy,
            slc_qcsampletable.createdDateTime,
            slc_qcsampletable.createBy,
            slc_qcsampletable.dataAreaId
            FROM
            slc_qcsampletable
            WHERE ItemId = '$productcode' AND 
            InventBatchId = '$batchnumber' AND 
            InventRefId = '$productnumber' AND 
            dataAreaId = '$dataareaid'
            ORDER BY LineNum ASC");

            if($sql->num_rows() != 0){
                $qCSampleId = $sql->row()->QCSampleId;
            }else{
                $qCSampleId = '';
            }

            $output = '
            <input hidden type="text" id="checkQcID" name="checkQcID" value="'.$qCSampleId.'">
            <table id="qcSamplingTable" class="table table-bordered table-responsive nowrap" cellspacing="0" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th class="table-secondary">QC Sampling No.</th>
                        <th class="table-secondary">Sample Series</th>
                        <th class="table-secondary">Item Number</th>
                        <th class="table-secondary">Batch Number</th>
                        <th class="table-secondary">Reference</th>
                        <th class="table-secondary">Status</th>
                        <th class="table-secondary">Sample No.</th>
                        <th class="table-secondary">QC By</th>
                        <th class="table-secondary">QC Date Time</th>
                        <th class="table-secondary">Approve By</th>
                        <th class="table-secondary">Remark</th>
                    </tr>
                </thead>
                <tbody>';

                    foreach ($sql->result() as $rs)
                    {
                        $testStatus = '';
                        switch($rs->TestStatus){
                            case 0:
                                $testStatus = "Open";
                                break;
                            case 1:
                                $testStatus = "Fail";
                                break;
                            case 2:
                                $testStatus = "Pass";
                                break;
                        }

                        $output .= '
                            <tr>
                                <td><span class="qclink"
                                    data_qcSampleId="'.$rs->QCSampleId.'"
                                    data_qcSampleNum="'.$rs->LineNum.'"
                                    data_areaId="'.$rs->dataAreaId.'"
                                >' . $rs->QCSampleId . '</span></td>
                                <td>' . $rs->LineNum . '</td>
                                <td>' . $rs->ItemId . '</td>
                                <td>' . $rs->InventBatchId . '</td>
                                <td>' . $rs->InventRefId . '</td>
                                <td>' . $testStatus . '</td>
                                <td>' . $rs->SampleNo . '</td>
                                <td>' . $rs->QcBy . '</td>
                                <td>' . conDatetimeFromDb($rs->QCDateTime) . '</td>
                                <td>' . $rs->ApproveBy . '</td>
                                <td>' . $rs->Remark . '</td>
                            </tr>
                        ';
                    }


                    $output .= '
                </tbody>
            </table>
            ';

            // $output = '
            //     Batch Number : '.$batchnumber.'
            //     Product Number : '.$productnumber.'
            //     Product Code : '.$productcode.'
            //     Data areaid : '.$dataareaid.'
            // ';

            
            echo $output;
    }



    public function loadQcsamplingByLinenum()
    {
        if($this->input->post("data_qcSampleId") != ""){

            $data_qcSampleId = $this->input->post("data_qcSampleId");
            $data_qcSampleNum = $this->input->post("data_qcSampleNum");
            $data_areaId = $this->input->post("data_areaId");

            $sql = $this->db3->query("SELECT
            slc_qcsampleline.SLC_QCSampleId,
            slc_qcsampleline.TestSequence,
            slc_qcsampleline.TestId,
            slc_qcsampleline.TestResult,
            slc_qcsampleline.StandardValue,
            slc_qcsampleline.LowerLimit,
            slc_qcsampleline.UpperLimit,
            slc_qcsampleline.LowerTolerance,
            slc_qcsampleline.VariableId,
            slc_qcsampleline.VariableOutcomeIdStandard,
            slc_qcsampleline.CertificateOfAnalysisReport,
            slc_qcsampleline.ActionOnFailure,
            slc_qcsampleline.TestInstrumentId,
            slc_qcsampleline.TestUnitID,
            slc_qcsampleline.IncludeResults,
            slc_qcsampleline.AcceptableQualityLevel,
            slc_qcsampleline.TestResultValueReal,
            slc_qcsampleline.QCSampleNum,
            slc_qcsampleline.TestResultValueOutcome,
            slc_qcsampleline.LABComment,
            slc_qcsampleline.BPC_SpecificationId,
            slc_qcsampleline.dataAreaId,
            slc_qcsampleline.TestOutcomeStatus
            FROM
            slc_qcsampleline
            WHERE SLC_QCSampleId = '$data_qcSampleId' AND
            QCSampleNum = '$data_qcSampleNum' AND
            dataAreaId = '$data_areaId' ORDER BY TestSequence ASC");

            $output = '
            <table id="qcSamplingTableByLinenum" class="table table-bordered" cellspacing="0" style="width:100%;">
                <thead>
                    <tr class="text-center">
                        <th class="table-secondary">Seq No.</th>
                        <th class="table-secondary" style="width:200px;">Test ID</th>
                        <th class="table-secondary">Test Value</th>
                        <th class="table-secondary" style="width:80px;">Pass / Fail</th>
                        <th class="table-secondary">Test Result</th>
                        <th class="table-secondary" style="width:300px;">Comment From LAB</th>
                    </tr>
                </thead>
                <tbody>';

                    foreach ($sql->result() as $rs)
                    {
                        $testStatus = '';
                        switch($rs->TestOutcomeStatus){
                            case "Open":
                                $testStatus = '<i class="icon-minus1 iconTestFail"></i>';
                                break;
                            case "Pass":
                                $testStatus = '<i class="icon-ok iconTestPass"></i>';
                                break;
                            case "Fail":
                                $testStatus = '<i class="icon-remove iconTestFail"></i>';
                        }

                        

                        $output .= '
                            <tr>
                                <td class="text-center">' . $rs->TestSequence . '</td>
                                <td>' . $rs->TestId . '</td>
                                <td>' . $rs->TestResultValueReal . '</td>
                                <td>' . $rs->TestResultValueOutcome . '</td>
                                <td class="text-center">' . $testStatus . '</td>
                                <td>' . $rs->LABComment . '</td>
                            </tr>
                        ';
                    }


                    $output .= '
                </tbody>
            </table>
            ';


            echo $output;

        }

        
    }





    //Zone เสียบข้อมูล
    public function load_runscreen_group_linenum()
    {
        if($this->input->post("mainformno") != ""){
            $mainformno = $this->input->post("mainformno");
            $sqlGet_groupLinenum = $this->db->query("SELECT
            farrel_detail.far_detail_formno,
            farrel_detail.far_main_formno,
            farrel_detail.far_sub_formno,
            farrel_detail.far_worktime,
            farrel_detail.far_action,
            farrel_detail.far_runscreen_linenum,
            farrel_detail.far_runscreen_group_linenum
            FROM
            farrel_detail
            WHERE far_main_formno = '$mainformno' AND far_action = 'run'
            GROUP BY far_runscreen_group_linenum ORDER BY far_runscreen_group_linenum ASC");


            if($sqlGet_groupLinenum->num_rows() != 0){
                foreach($sqlGet_groupLinenum->result() as $rs){
                    $groupLinenum[] = $rs->far_runscreen_group_linenum;
                }

                $output = array(
                    "msg" => "ดึงข้อมูล Group Linenum เรียบร้อยแล้ว",
                    "status" => "Select data Success",
                    "grouplinenum" => $groupLinenum
                );

                
            }else{
                $output = array(
                    "msg" => "ดึงข้อมูลไม่สำเร็จ",
                    "status" => "Select data Not Success",
                );
            }
            echo json_encode($output);
            
        }
    }


    public function updateGroupLinenumLeft()
    {
        if($this->input->post("mainFormno") != ""){
            $mainFormno = $this->input->post("mainFormno");
            $detailFormno = $this->input->post("detailFormno");
            $groupLinenum = $this->input->post("groupLinenum");

            $getGroupLinenumAll = $this->db->query("SELECT
            farrel_detail.far_main_formno,
            farrel_detail.far_runscreen_group_linenum,
            farrel_detail.far_detail_formno
            FROM
            farrel_detail
            WHERE far_main_formno = '$mainFormno' AND far_action = 'run'
            GROUP BY far_runscreen_group_linenum ORDER BY far_runscreen_group_linenum ASC");


            foreach($getGroupLinenumAll->result() as $rs){
                $output[] = $rs->far_runscreen_group_linenum;
            }

            $result = array_search($groupLinenum , $output); //return position array หาตำแหน่ง array ของ Linenum ตัวที่คลิกมา
            $j = $result-1; // -1 คือลดลง 1 ตำแหน่ง
            $moveArray = moveElementInArray($output, $result, $j);//ใช้ Function เคลื่อนย้ายตำแหน่ง

            //อัพเดตตำแหน่งใหม่ลงฐานข้อมูล
            $i = 0;
            foreach($getGroupLinenumAll->result() as $rs){
                $arUpdate = array(
                    "far_runscreen_group_linenum" => $moveArray[$i]
                );
                $this->db->where("far_detail_formno" , $rs->far_detail_formno);
                $this->db->where("far_main_formno" , $rs->far_main_formno);
                $this->db->update("farrel_detail" , $arUpdate);
                $i++;
            }
            //อัพเดตตำแหน่งใหม่ลงฐานข้อมูล


            // Get เอาตำแหน่ง Linenum ล่าสุดของรายการดังกล่าวออกมา อัพเดตลง Local storage
            $getLineNumGroupUpdate = $this->db->query("SELECT
            farrel_detail.far_runscreen_group_linenum,
            farrel_detail.far_worktime
            FROM
            farrel_detail
            WHERE
            farrel_detail.far_main_formno = '$mainFormno' AND
            farrel_detail.far_detail_formno = '$detailFormno' AND
            farrel_detail.far_action = 'run'
            GROUP BY
            farrel_detail.far_runscreen_group_linenum
            ");


            $outputJson = array(
                "msg" => "เลื่อนตำแหน่งเรียบร้อย",
                "status" => "Change Position Success",
                "now" => $result,
                "to" => $j,
                "array" => $moveArray,
                "detailformno" => $detailFormno,
                "mainformno" => $mainFormno,
                "grouplinenum" => $getLineNumGroupUpdate->row()->far_runscreen_group_linenum
            );

            echo json_encode($outputJson);

        }
    }






    public function updateGroupLinenumRight()
    {
        if($this->input->post("mainFormno") != ""){
            $mainFormno = $this->input->post("mainFormno");
            $detailFormno = $this->input->post("detailFormno");
            $groupLinenum = $this->input->post("groupLinenum");

            $getGroupLinenumAll = $this->db->query("SELECT
            farrel_detail.far_main_formno,
            farrel_detail.far_runscreen_group_linenum,
            farrel_detail.far_detail_formno
            FROM
            farrel_detail
            WHERE far_main_formno = '$mainFormno' AND far_action = 'run'
            GROUP BY far_runscreen_group_linenum ORDER BY far_runscreen_group_linenum ASC");


            foreach($getGroupLinenumAll->result() as $rs){
                $output[] = $rs->far_runscreen_group_linenum;
            }

            $result = array_search($groupLinenum , $output); //return position array หาตำแหน่ง array ของ Linenum ตัวที่คลิกมา
            $j = $result+1; // -1 คือลดลง 1 ตำแหน่ง
            $moveArray = moveElementInArray($output, $result, $j);//ใช้ Function เคลื่อนย้ายตำแหน่ง

            //อัพเดตตำแหน่งใหม่ลงฐานข้อมูล
            $i = 0;
            foreach($getGroupLinenumAll->result() as $rs){
                $arUpdate = array(
                    "far_runscreen_group_linenum" => $moveArray[$i]
                );
                $this->db->where("far_detail_formno" , $rs->far_detail_formno);
                $this->db->where("far_main_formno" , $rs->far_main_formno);
                $this->db->update("farrel_detail" , $arUpdate);
                $i++;
            }
            //อัพเดตตำแหน่งใหม่ลงฐานข้อมูล


            // Get เอาตำแหน่ง Linenum ล่าสุดของรายการดังกล่าวออกมา อัพเดตลง Local storage
            $getLineNumGroupUpdate = $this->db->query("SELECT
            farrel_detail.far_runscreen_group_linenum,
            farrel_detail.far_worktime
            FROM
            farrel_detail
            WHERE
            farrel_detail.far_main_formno = '$mainFormno' AND
            farrel_detail.far_detail_formno = '$detailFormno' AND
            farrel_detail.far_action = 'run'
            GROUP BY
            farrel_detail.far_runscreen_group_linenum
            ");


            $outputJson = array(
                "msg" => "เลื่อนตำแหน่งเรียบร้อย",
                "status" => "Change Position Success",
                "now" => $result,
                "to" => $j,
                "array" => $moveArray,
                "detailformno" => $detailFormno,
                "mainformno" => $mainFormno,
                "grouplinenum" => $getLineNumGroupUpdate->row()->far_runscreen_group_linenum
            );

            echo json_encode($outputJson);

        }
    }








    public function checkMinAndMaxArrow()
    {
        if($this->input->post("mainformno")){
            // $groupLinenumNow = $this->input->post("groupLinenumNow");
            $mainformno = $this->input->post("mainformno");

            $sqlMin = $this->db->query("SELECT
            farrel_detail.far_main_formno,
            farrel_detail.far_runscreen_linenum,
            farrel_detail.far_runscreen_group_linenum
            FROM
            farrel_detail
            WHERE far_main_formno = '$mainformno' AND far_action = 'run'
            GROUP BY far_runscreen_group_linenum ORDER BY far_runscreen_group_linenum ASC LIMIT 1");

            $sqlMax = $this->db->query("SELECT
            farrel_detail.far_main_formno,
            farrel_detail.far_runscreen_linenum,
            farrel_detail.far_runscreen_group_linenum
            FROM
            farrel_detail
            WHERE far_main_formno = '$mainformno' AND far_action = 'run'
            GROUP BY far_runscreen_group_linenum ORDER BY far_runscreen_group_linenum DESC LIMIT 1");

            $output = array(
                "msg" => "ดึงข้อมูลสำเร็จ",
                "status" => "Select Data Success",
                "groupLinenumMin" => $sqlMin->row()->far_runscreen_group_linenum,
                "groupLinenumMax" => $sqlMax->row()->far_runscreen_group_linenum,
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูลไม่สำเร็จ",
                "status" => "Select Data Noe Success",
            );
        }

        echo json_encode($output);
    }







    public function saveEditHead()
    {
        if($this->input->post("editHead_checkMainformno")){
            $arSaveEditHead = array(
                "fam_mis" => $this->input->post("edit_fam_mis"),
                "fam_output" => $this->input->post("edit_fam_output")
            );

            $this->db->where("fam_formno" , $this->input->post("editHead_checkMainformno"));
            $this->db->update("farrel_main" , $arSaveEditHead);

            $output = array(
                "msg" => "อัพเดต Head data เรียบร้อยแล้ว",
                "status" => "Update Data Success"
            );
        }else{
            $output = array(
                "msg" => "อัพเดต Head data ไม่ได้",
                "status" => "Cannot Update Data"
            );
        }
        echo json_encode($output);
    }












}

/* End of file ModelName.php */
