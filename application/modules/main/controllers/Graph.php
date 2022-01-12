<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Graph extends MX_Controller {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model("graph_model" , "graph");
    }
    

    public function index()
    {
        $this->graph->loadGraphByItemLot();
    }


    public function loadCheckGraph()
    {
        $this->graph->loadCheckGraph();
    }


    public function updateTestIDUse()
    {
        $this->graph->updateTestIDUse();
    }

    public function graphPage()
    {
        $data = array(
            "title" => "Graph Page"
        );
        getHead();
        getContent("graph/graphmain" , $data);
        getFooter();
    }


    public function loadItemid()
    {
        $this->graph->loadItemid();
    }


    public function loadItemLot()
    {
        $this->graph->loadItemLot();
    }


    public function loadGraphDataByCheckLot()
    {
        $this->graph->loadGraphDataByCheckLot();
    }


    public function loadTestid_checkLot()
    {
        $this->graph->loadTestid_checkLot();
    }


    public function loadCheckGraphByCheckLotNum()
    {
        $this->graph->loadCheckGraphByCheckLotNum();
    }

    public function checkDataGraph()
    {
        $this->graph->checkDataGraph();
    }

    public function loadAlldataForUseGraph()
    {
        $this->graph->loadAlldataForUseGraph();
    }


    public function updateTestIDUseCheckLot()
    {
        $this->graph->updateTestIDUseCheckLot();
    }


    public function loadItemidAndLotNumber()
    {
        $this->graph->loadItemidAndLotNumber();
    }


}
/* End of file Controllername.php */
?>