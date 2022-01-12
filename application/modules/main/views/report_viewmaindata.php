<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{title}</title>
</head>

<body>
    <!-- Check zone -->
    <input hidden type="text" name="view_loadMainData" id="view_loadMainData" value="<?= $mainformno ?>">
    <!-- Check zone -->

    <div class="container px-5" id="app">
        <div class="row">
            <div class="col-md-12 mt-2">
                <h3 class="text-center">รายงานการตรวจสอบเครื่องจักร และอุปกรณ์ก่อนการทำงาน<span id="textTitle"></span></h3>
            </div>

        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="">Machine name</label>
                <input readonly type="text" name="fam_machinenameV" id="fam_machinenameV" class="form-control" value="<?= $fam_machinename ?>">
            </div>

            <div class="form-group col-md-4">
                <label for="">Product ID</label>
                <input readonly type="text" name="fam_prodid" id="fam_prodid" class="form-control" value="{fam_prodid}">
            </div>

            <div class="form-group col-md-4">
                <label for="">Product Code</label>
                <input readonly type="text" name="fam_productcode" id="fam_productcode" class="form-control" value="{fam_productcode}">
            </div>

            <div class="form-group col-md-4">
                <label for="">Batch Number</label>
                <input readonly type="text" name="fam_batchnumber" id="fam_batchnumber" class="form-control" value="{fam_batchnumber}">
            </div>

            <div class="form-group col-md-4">
                <label for="">Shift</label>
                <input readonly type="text" name="fam_shit" id="fam_shit" class="form-control text-uppercase" value="<?= getShiftOnSubmain($mainformno) ?>">
            </div>

            <div class="form-group col-md-4">
                <label for="">Date</label>
                <input readonly type="text" name="fam_datetime" id="fam_datetime" class="form-control" value="{fam_datetime}">
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-12">
                <a href="<?= base_url('viewmaindata.html/') . $mainformno ?>"><button class="button button-desc button-3d button-rounded button-green center">กลับหน้าข้อมูลหลัก</button></a>
            </div>
        </div>
        <div class="divider divider-center"><i class="icon-cloud"></i></div>

        <div class="row form-group">
            <!-- Input check Start page 2 -->
            <input hidden type="text" name="checkStartPage2" id="checkStartPage2" value="<?= checkStatusPage2($mainformno)->ptwo_pagestatus ?>">
            <input hidden type="text" name="checkPosiPage2" id="checkPosiPage2" value="<?= getUser()->posi ?>">
            <input hidden type="text" name="countFeeder" id="countFeeder" value="<?= countFeeder($mainformno) ?>">
            <input hidden type="text" name="getUrl" id="getUrl" value="<?= base_url() ?>">

            <div class="col-md-12">
                <button class="btn btn-primary addoutPuts" name="btns_addOutput" id="btns_addOutput" data-toggle="modal" data-target="#checkFeeder_modal" style="display:none;">กำหนด Output และ ค่าเบี่ยงเบน</button>
                <button class="btn btn-success startBtn" name="btn_reportStart" id="btn_reportStart">Start</button>
                <button class="btn btn-danger startBtn" name="btn_reportStop" id="btn_reportStop" style="display:none;">Stop</button>
            </div>
        </div>

        <div class="divider divider-center btnzone"><i class="icon-cloud"></i></div>

        <div class="row control_report">
            <div id="showReportByTemplate" class="" style="width:100%"></div>
        </div>
        <div class="divider divider-center control_report"><i class="icon-cloud"></i></div>
        <div class="row control_report">
            <div id="showReportMachineCheck" class="" style="width:100%"></div>
        </div>
        <div class="divider divider-center control_report"><i class="icon-cloud"></i></div>
        <div class="row control_report">
            <div id="showBomReport" class="col-sm-6" style="width:100%"></div>
            <div id="showBomMixReport" class="col-sm-6" style="width:100%"></div>
        </div>


        <div class="divider divider-center"><i class="icon-cloud"></i></div>
        <div class="row text-center mb-5">
            <div class="col-md-6">
                <span><b>Operator : </b><?= checkStatusPage2($mainformno)->ptwo_userstart ?></span><br>
                <span><b>Date : </b><?= conDateTimeFromDb(checkStatusPage2($mainformno)->ptwo_datetimestart) ?></span>
            </div>
            <div class="col-md-6">
                <span><b>Approve : </b><?= checkStatusPage2($mainformno)->ptwo_userend ?></span><br>
                <span><b>Date : </b><?= conDateTimeFromDb(checkStatusPage2($mainformno)->ptwo_datetimeend) ?></span>
            </div>
        </div>









    </div>


</body>



</html>