<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Main extends MX_Controller
{


    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set("Asia/Bangkok");
        $this->load->model("main_model", "main");
    }


///////////////////////////////////////////////
//////////////// home.html 
//////////////////////////////////////////////
    public function index()
    {
        $data = array(
            "title" => "หน้าแสดงรายการ Process List"
        );
        getHead();
        getTopmenu("templates/topmenu");
        getContent("home",$data);
        getFooter();
    }

    public function loadMainData()
    {
        $this->main->loadMainData();
    }

    public function saveMainData()
    {
        $this->main->saveMainData();
    }

    public function loadProdId()
    {
        $this->main->loadProdId();
    }

    public function checkPdStart()
    {
        $this->main->checkPdStart();
    }

    public function loadMachineTemplate()
    {
        $this->main->loadMachineTemplate();
    }

    public function loadMachineTemplate2()
    {
        $this->main->loadMachineTemplate2();
    }

///////////////////////////////////////////////
//////////////// home.html 
//////////////////////////////////////////////







///////////////////////////////////////////////
//////////////// viewmaindata.html 
//////////////////////////////////////////////
public function viewMainData($mainformno)
{
  
    $data = array(
        "title" => "หน้าแสดงข้อมูลหลัก",
        "mainformno" => $mainformno,
        "fam_machinename" => getMaindataRow($mainformno)->fam_machinename,
        "fam_productcode" => getMaindataRow($mainformno)->fam_productcode,
        "fam_batchnumber" => getMaindataRow($mainformno)->fam_batchnumber,
        "fam_shit" => getMaindataRow($mainformno)->fam_shit,
        "fam_datetime" => conDateTimeFromDb(getMaindataRow($mainformno)->fam_datetime),
        "fam_prodid" => getMaindataRow($mainformno)->fam_prodid,
        "fam_outputhr" => getMaindataRow($mainformno)->fam_outputhr,
        "fam_deviation" => getMaindataRow($mainformno)->fam_deviation,
        "fam_dataareaid" => getMaindataRow($mainformno)->fam_dataareaid,
        "fam_mis" => getMaindataRow($mainformno)->fam_mis,
        "fam_output" => getMaindataRow($mainformno)->fam_output,

    );
    getHead();
    getContent("viewmaindata" , $data);
    getFooter();
}


// public function report_viewMainData($mainformno)
// {
  
//     $data = array(
//         "title" => "หน้าแสดงข้อมูลรายงานการตรวจสอบเครื่องจักร และอุปกรณ์ก่อนการทำงาน",
//         "mainformno" => $mainformno,
//         "fam_machinename" => getMaindataRow($mainformno)->fam_machinename,
//         "fam_productcode" => getMaindataRow($mainformno)->fam_productcode,
//         "fam_batchnumber" => getMaindataRow($mainformno)->fam_batchnumber,
//         "fam_shit" => getMaindataRow($mainformno)->fam_shit,
//         "fam_datetime" => conDateTimeFromDb(getMaindataRow($mainformno)->fam_datetime),
//         "fam_prodid" => getMaindataRow($mainformno)->fam_prodid

//     );
//     getHead();
//     getContent("report_viewmaindata" , $data);
//     getFooter();
// }


public function saveSubmain()
{
    $this->main->saveSubmain();
}

// public function showSubmainData()
// {
//     $this->main->showSubmainData();
// }

public function loadTemplateSpoint()
{
    $this->main->loadTemplateSpoint();
}

public function loadTemplateRun()
{
    $this->main->loadTemplateRun2();
}

public function saveSpoint()
{
    $this->main->saveSpoint();
}

public function checkSaveSpoint()
{
    $this->main->checkSaveSpoint();
}

public function saveRun()
{
    $this->main->saveRun();
}


public function checkSaveRun()
{
    $this->main->checkSaveRun();
}


public function checkSaveEditRun()
{
    $this->main->checkSaveEditRun();
}




// public function test()
// {
//     echo getSubmainDataForInsert($mainFormno);
// }



public function loadWorkTimeByDetail()
{
    $this->main->loadWorkTimeByDetail();
}

public function loadDataRunEdit()
{
    $this->main->loadDataRunEdit();
}


public function delFileUpload()
{
    $this->main->delFileUpload();
}


public function saveEditRun()
{
    $this->main->saveEditRun();
}

public function deleteEditRun()
{
    $this->main->deleteEditRun();
}


public function chooseFeeder()
{
    $this->main->chooseFeeder();
}


public function saveDataToFeeder()
{
    $this->main->saveDataToFeeder();
}


public function getBomForMix()
{
    $this->main->getBomForMix();
}


public function getBomForMix2()
{
    $this->main->getBomForMix2();
}


public function activeMix()
{
    $this->main->activeMix();
}

public function waitConfirmMix()
{
    $this->main->waitConfirmMix();
}


public function countConfirmMix()
{
    $this->main->countConfirmMix();
}


public function saveDataMix()
{
    $this->main->saveDataMix();
}


public function loadGetBom()
{
    $this->main->loadGetBom();
}


public function loadGetBomMix()
{
    $this->main->loadGetBomMix();
}


public function getValueBomMix()
{
    $this->main->getValueBomMix();
}


public function loadFeederTemp()
{
    $this->main->loadFeederTemp();
}


public function delValueFeeder()
{
    $this->main->delValueFeeder();
}

public function canCelMix()
{
    $this->main->canCelMix();
}

public function startprocess()
{
    $this->main->startprocess();
}

public function endprocess()
{
    $this->main->endprocess();
}


public function delWorktime()
{
    $this->main->delWorktime();
}


public function checkActiveWorktime()
{
    $this->main->checkActiveWorktime();
}


public function reportFarrel()
{
    $this->main->reportFarrel();
}

public function saveOutput()
{
    $this->main->saveOutput();
}


public function saveReportFeeder()
{
    $this->main->saveReportFeeder();
}


public function delReportFeeder()
{
    $this->main->delReportFeeder();
}


public function loadReportCheckMachine()
{
    $this->main->loadReportCheckMachine();
}


public function loadBomReport()
{
    $this->main->loadBomReport();
}


public function loadBomMixReport()
{
    $this->main->loadBomMixReport();
}


public function saveCheckMachine()
{
    $this->main->saveCheckMachine();
}


public function startPageTwo()
{
    $this->main->startPageTwo();
}


public function endPageTwo()
{
    $this->main->endPageTwo();
}


public function cancelPage()
{
    $this->main->cancelPage();
}



public function getDataFeeder()
{
    $this->main->getDataFeeder();
}



public function checkDataFeederForEdit()
{
    $this->main->checkDataFeederForEdit();
}

public function loadDeviation()
{
    $this->main->loadDeviation();
}


public function loadDeviation2()
{
    $this->main->loadDeviation2();
}


public function getdataMachineList()
{
    $this->main->getdataMachineList();
}


public function getImageOnRun()
{
    $this->main->getImageOnRun();
}


public function checkDuplicateTime()
{
    $this->main->checkDuplicateTime();
}


public function countFeeder()
{
    $this->main->countFeeder();
}



public function checkMixBalance()
{
    $this->main->checkMixBalance();
}


///////////////////////////////////////////////
//////////////// viewmaindata.html 
//////////////////////////////////////////////



public function checkimage()
{
    $filename = "http://192.190.10.27/intsys/msd/upload/MyQrcode.png";
    $info = getimagesize($filename);
    // print_r($info['mime']);
    echo $info['mime'];
}



/////////////New Function 
public function checkSubmainTable()
{
    $this->main->checkSubmainTable();
}


public function getCancelMemo()
{
    $this->main->getCancelMemo();
}


public function getProductCode()
{
    $this->main->getProductCode();
}

public function saveTemplateDetail()
{
    $this->main->saveTemplateDetail();
}

public function saveEditTemplateDetail()
{
    $this->main->saveEditTemplateDetail();
}

public function testcode()
{
    $this->main->checkPDWip('PD64001991' , 'poly');
}

public function loadQcSampling()
{
    $this->main->loadQcSampling();
}


public function loadQcsamplingByLinenum()
{
    $this->main->loadQcsamplingByLinenum();
}


//Zone เสียบข้อมูล
// public function load_runscreen_group_linenum()
// {
//     $this->main->load_runscreen_group_linenum();
// }

public function updateGroupLinenumLeft()
{
    $this->main->updateGroupLinenumLeft();
}


public function updateGroupLinenumRight()
{
    $this->main->updateGroupLinenumRight();
}


public function checkMinAndMaxArrow()
{
    $this->main->checkMinAndMaxArrow();
}


public function getSubmainData2()
{
    if($this->input->post("mainformno")){
        $mainformno = $this->input->post("mainformno");
        $detailFormno = $this->input->post("detailFormno");
        getsubmaindata2($mainformno , $detailFormno);
    }
    
}


public function saveEditHead()
{
    $this->main->saveEditHead();
}








































}

/* End of file Controllername.php */
