<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Machine extends MX_Controller
{


    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model("main/machine_model" , "machine");
    }


    public function index()
    {
        $data = array(
            "title" => "Setting machine page."
        );

        getHead();
        getContent("machine/index", $data);
        getFooter();
    }




////////////////////////////////////////////////////////////
////////////setting.heml
//////////////////////////////////////////////////////////
    public function saveMachineTemplate()
    {
        $this->machine->saveMachineTemplate();
    }

    public function getListMachineTemp()
    {
        $this->machine->getListMachineTemp();
    }

    public function checkDuplicateRunscreen()
    {
        $this->machine->checkDuplicateRunscreen();
    }
    
    public function getRunscreenMaster()
    {
        $this->machine->getRunscreenMaster();
    }

    public function getRunscreenMasterNew()
    {
        $this->machine->getRunscreenMasterNew();
    }

    public function getRunscreenMasterNew2()
    {
        $this->machine->getRunscreenMasterNew2();
    }

    public function getRunscreenMasterNew_arrayNull()
    {
        $action = "";
        $this->machine->getRunscreenMasterNew_arrayNull($action);
    }

    public function getRunscreenMasterNew_search()
    {
        $this->machine->getRunscreenMasterNew_search();
    }

    public function delRunScrFromTempTable()
    {
        $this->machine->delRunScrFromTempTable();
    }

    public function getMachineTemp()
    {
        $this->machine->getMachineTemp();
    }

    public function deleteRunscreenFromTemp()
    {
        $this->machine->deleteRunscreenFromTemp();
    }

    public function runscreenManagement()
    {
        $this->machine->runscreenManagement();
    }

    public function saveRunscreen()
    {
        $this->machine->saveRunscreen();
    }

    public function checkDupRunManage()
    {
        $this->machine->checkDupRunManage();
    }

    public function checkDupEditRunManage()
    {
        $this->machine->checkDupEditRunManage();
    }

    public function editRunscreen()
    {
        $this->machine->editRunscreen();
    }

    public function delRunscreen()
    {
        $this->machine->delRunscreen();
    }

    public function copyTemplate()
    {
        $this->machine->copyTemplate();
    }

    public function saveCopyTemplate()
    {
        $this->machine->saveCopyTemplate();
    }

    public function delTemplate()
    {
        $this->machine->delTemplate();
    }


    public function loadTemplateBox()
    {
        $this->machine->loadTemplateBox();
    }

    /////////////////////////////////////////////////////////
    //////////// template detail page
    public function temDetail()
    {
        $this->machine->temDetail();
    }

    public function saveMinMax()
    {
        $this->machine->saveMinMax();
    }


    public function saveRunScrToTempTable()
    {
        $this->machine->saveRunScrToTempTable();
    }


    public function saveRunScrToTempTable_edit()
    {
        $this->machine->saveRunScrToTempTable_edit();
    }


    public function uploadImageOnly_edit()
    {
        $this->machine->uploadImageOnly_edit();
    }


    public function uploadImageCopyToTemp()
    {
        $this->machine->uploadImageCopyToTemp();
    }


    // public function uploadImageOnly()
    // {
    //     $this->machine->uploadImageOnly();
    // }


    public function loadRunScrFromTempTable()
    {
        $this->machine->loadRunScrFromTempTable();
    }


    public function truncate_machine_template_temp()
    {
        $this->machine->truncate_machine_template_temp();
    }


    public function updateLinenumDown()
    {
        $this->machine->updateLinenumDown();
    }


    public function updateLinenumUp()
    {
        $this->machine->updateLinenumUp();
    }


    public function countTotalRunmaster()
    {
        $this->machine->countTotalRunmaster();
    }


    public function countTotalRunTemp()
    {
        $this->machine->countTotalRunTemp();
    }


    public function save_frm_edit_runscreen_newtemplate()
    {
        $this->machine->save_frm_edit_runscreen_newtemplate();
    }


////////////////////////////////////////////////////////////
////////////setting.heml
//////////////////////////////////////////////////////////




public function testdb()
{
    $arr1 = Array('a', 'e', 'b', 'c', 'd');
    print_r(moveElementInArray($arr1, 1, 0));
}

public function loadLinenumFromTemp()
{
    $this->machine->loadLinenumFromTemp();
}

public function saveDataToMachineTemplate()
{
    $this->machine->saveDataToMachineTemplate();
}

public function saveDataToMachineTemplate_edit()
{
    $this->machine->saveDataToMachineTemplate_edit();
}

public function loadOldTemplate()
{
    $this->machine->loadOldTemplate();
}

public function loadRunscreen()
{
    $this->machine->loadRunscreen();
}


public function copyOriTemplateToTemp()
{
    $this->machine->copyOriTemplateToTemp();
}

public function copyOriTemplateToTemp_edit()
{
    $this->machine->copyOriTemplateToTemp_edit();
}


public function checkTemplateNameDuplicate()
{
    $this->machine->checkTemplateNameDuplicate();
}

public function loadDataTemplate()
{
    $this->machine->loadDataTemplate();
}


public function loadRunscreenFromTemplate()
{
    $this->machine->loadRunscreenFromTemplate();
}


public function deleteTemplate()
{
    $this->machine->deleteTemplate();
}


public function loadItemidFormTable()
{
    $this->machine->loadItemidFormTable();
}


public function loadItemidFormTable_edit()
{
    $this->machine->loadItemidFormTable_edit();
}


public function checkEditTemplateDuplicate()
{
    $this->machine->checkEditTemplateDuplicate();
}


public function save_edittemplate_editrun()
{
    $this->machine->save_edittemplate_editrun();
}

public function countTotalRunMasterShow()
{
    $this->machine->countTotalRunMasterShow();
}


public function overall_template()
{
    $this->machine->overall_template();
}


public function del_dataFromTemptableBy_templatename()
{
    $this->machine->del_dataFromTemptableBy_templatename();
}

public function checkDataOnTemptable()
{
    $this->machine->checkDataOnTemptable();
}

public function del_dataFromTemptable_whenReloadPageByEcode()
{
    $this->machine->del_dataFromTemptable_whenReloadPageByEcode();
}

public function checkDataTempBefore()
{
    $this->machine->checkDataTempBefore();
}







    /* End of file Controllername.php */
}

/* End of file Controllername.php */
