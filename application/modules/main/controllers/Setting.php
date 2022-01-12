<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends MX_Controller {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model("setting_model" , "setting");
    }
    

    public function index()
    {
        $data = array(
            "title" => "ตั้งค่าข้อมูลหลักของโปรแกรม"
        );
        getHead();
        getContent("setting/index" ,$data);
        getFooter();
    }

    public function saveSetShift()
    {
        $this->setting->saveSetShift();
    }

    public function loadUserFromDb()
    {
        $this->setting->loadUserFromDb();
    }


}/* End of file Controllername.php */

?>


