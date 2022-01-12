<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Exportdata extends MX_Controller {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model("main/exportdata_model" , "export");
    }
    

    public function index()
    {

    }

    public function exportdata_fromtemplate($mainFormno)
    {
        $this->export->exportdata_fromtemplate($mainFormno);
    }

    public function testtext()
    {
        $cha = "b";

        for($i = 1; $i < 60 ; $i++){
            $next_cha = ++$cha; 
            //The following if condition prevent you to go beyond 'z' or 'Z' and will reset to 'a' or 'A'.
            // if (strlen($next_cha) > 1) 
            // {
            //     $next_cha = $next_cha[0];
            // }

            echo $next_cha."\n";

        }

        
    }

}

/* End of file Controllername.php */

?>
