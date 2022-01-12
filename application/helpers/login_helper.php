<?php
class loginfn{
    private $ci;
    function __construct()
    {
        date_default_timezone_set("Asia/Bangkok");
        $this->ci =&get_instance();
    }

    function loginci()
    {
        return $this->ci;
    }
}


function lfn()
{
    $obj = new loginfn();
    return $obj->loginci();
}

function checkVerifyUser($ecode)
{
    $sql = lfn()->db->query("SELECT * FROM kb_user WHERE user_ecode = '$ecode' ");
    if($sql->num_rows() == 0){
        return false;
    }else{
        return true;
    }
}


function getUser()
{
    lfn()->load->model("login/login_model" , "login");
    return lfn()->login->getuser();
}


function linkImg($img)
{
    if ($img != "") {
        $linkimg = $img;
    } else {
        $linkimg = "defualt.jpg";
    }
    $link = "http://intranet.saleecolour.com/intsys/usermanagement/uploads/$linkimg";
    return $link;
}






?>