<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        date_default_timezone_set("Asia/bangkok");
        $this->load->model("login_model" , "login");
    }
    

    public function index()
    {
        $data = array(
            "title" => "Login page"
        );
        getContent("loginpage" , $data);
    }


    public function checklogin()
    {
        $this->login->checklogin();
    }

    public function verifyuser()
    {
    $this->login->callLogin();
       $data = array(
           "title" => "Verify user page"
       );
       getContent("verifyuser" , $data);
       getFooter();
    }


    public function logout()
    {
        $this->login->logout();
    }

    public function test()
    {
        echo $this->login->getuser()->Fname;
    }

    public function save_verify()
    {
        // if($this->login->save_verify() == TRUE){
        //     header("refresh:0; url=".base_url());
        // }else{
        //     header("refresh:0; url=" . base_url('verifyuser.html'));
        // }
        $this->login->save_verify();
        header("refresh:0; url=".base_url());
    }











}/* End of file Controllername.php */






?>