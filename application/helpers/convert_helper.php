<?php
class convertfn{
    public $ci;
    function __construct()
    {
        $this->ci = &get_instance();
        date_default_timezone_set("Asia/Bangkok");
    }
    public function gci()
    {
        return $this->ci;
    }
}

function getcon()
{
    $obj = new convertfn();
    return $obj->gci();
}

function conDateTimeFromDb($datetime)
{
    if($datetime != ""){
        $datetimeIn = date_create($datetime);
        return date_format($datetimeIn,"d-m-Y H:i:s");
    }else{
        return $datetime;
    }
    
}

function conDateFormat($datetime)
{
    if($datetime != ""){
        $datetimeIn = date_create($datetime);
        return date_format($datetimeIn,"Y-m-d");
    }else{
        return $datetime;
    }
}



function conPrice($priceinput)
{
    $oriprice = str_replace("," , "" , $priceinput);
    return $oriprice;
}

function conNumToNull($number)
{
    if($number == 0.0000 || $number == ""){
        return "";
    }else{
        return valueFormat($number);
    }
}

function conNumToText($number)
{
    if($number == 0.0000 || $number == ""){
        return "None";
    }else{
        return valueFormat($number);
    }
}





?>