<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Setting_model extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->db2 = $this->load->database('saleecolour', TRUE);
    }

    public function saveSetShift()
    {
        if($this->input->post("shift_name") != ""){
            $shiftname = $this->input->post("shift_name");
            if($this->checkShift($shiftname) == 0){
                $saveShift = array(
                    "shift_name" => $shiftname,
                    "shift_starttime" => $this->input->post("shift_starttime"),
                    "shift_endtime" => $this->input->post("shift_endtime"),
                    "shift_memo" => $this->input->post("shift_memo")
                );
                $this->db->insert("msd_shift" , $saveShift);

                $output = array(
                    "msg" => "บันทึกกะงานสำเร็จ",
                    "status" => "Insert success"
                );
            }else{
                $output = array(
                    "msg" => "พบข้อมูลซ้ำในระบบ",
                    "status" => "Found duplicate data"
                );
            }
            
        }else{
            $output = array(
                "msg" => "ท่านไม่ได้ระบุชื่อกะการทำงาน",
                "status" => "Insert not success"
            );
        }
        echo json_encode($output);
    }

    private function checkShift($shiftname)
    {
        $sql = $this->db->query("SELECT shift_name FROM msd_shift WHERE shift_name = '$shiftname' ");
        return $sql->num_rows();
    }



    public function loadUserFromDb()
    {
        $sql = $this->db2->query("SELECT
        member.username,
        member.Fname,
        member.Lname,
        member.ecode,
        member.DeptCode,
        member.Dept,
        member.posi
        FROM
        member
        WHERE
        member.DeptCode = '1007' and posi > 15 and resigned != 1");

        $output ='
        <div class="table-responsive">
            <table id="loadUserFormDb" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <th>รหัสพนักงาน</th>
                    <th>ชื่อ - สกุล</th>
                    <th>แผนก</th>
                    <th>#</th>
                </thead>
                <tbody>
        ';
        foreach($sql->result() as $rs){

            $iconAddUser = '<i class="icon-trash-alt iconAddUser"
            
            ></i>';

            $output .='
        <tr>
            <td>'.$rs->ecode.'</td>
            <td>'.$rs->Fname." ".$rs->Lname.'</td>
            <td>'.$rs->Dept.'</td>
            <td>'.$iconAddUser.'</td>
        </tr>
        ';
        }
                $output .='
                    </tbody>
                </table>
            </div>
            ';

        echo $output;
    }












}/* End of file ModelName.php */
