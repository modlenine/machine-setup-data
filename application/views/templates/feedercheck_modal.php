<!-- Modal รายการหลัก -->

<div class="modal fade " id="checkFeeder_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">การตรวจสอบ Feeder</h5> -->
                <div id="show_checkFeeder_modal"></div>
                <button type="button" class="close outputClose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_outputfix" autocomplete="off">
                    <input hidden type="text" name="check_output_mainform" id="check_output_mainform" value="<?= $this->uri->segment(2) ?>">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="">กำหนด Output</label>
                            <input type="number" name="cf_output" id="cf_output" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">กำหนด ค่าเบี่ยงเบน</label>
                            <div id="show_cf_deviation"></div>
                            
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="button" name="btn_addoutput" id="btn_addoutput" class="btn btn-success">บันทึก</button>
                            <button type="button" name="btn_editoutput" id="btn_editoutput" class="btn btn-warning">แก้ไขรายการ</button>
                        </div>
                    </div>
                </form>
                <div class="divider divider-center"><i class="icon-cloud"></i></div>

            </div>

        </div>
    </div>
</div>
<!-- Modal รายการหลัก -->







<!-- Modal รายการหลัก -->

<div class="modal fade " id="addFeeder_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">การตรวจสอบ <span id="showTxtCheckFeeder"></span> </h5> -->
                <div id="show_addFeeder_modal"></div>
                <button type="button" class="close clsaddFeeder" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_saveCheckFeeder">

                <!-- input for check -->
                <input hidden type="text" name="checkAddfAutoid" id="checkAddfAutoid">

                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="">รหัสวัตถุดิบ</label>
                        <input type="text" name="addf_rawmaterial" id="addf_rawmaterial" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="">ส่วนผสม %</label>
                        <input type="text" name="addf_value" id="addf_value" class="form-control" readonly>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="">กำหนด Output kg. / hr</label>
                        <input type="text" name="addf_output" id="addf_output" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="">ค่าเบี่ยงเบน</label>
                        <!-- <input type="text" name="getFeederDeviation" id="getFeederDeviation" class="form-control" style="display:none;"> -->
                        <div id="showMainDeviation"></div>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="">น้ำหนักต่อ 1 ชั่วโมง (kg.)</label>
                        <input type="text" name="addf_perhr" id="addf_perhr" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="">น้ำหนักต่อ 1 นาที (kg.)</label>
                        <input type="text" name="addf_permin" id="addf_permin" class="form-control" readonly>
                    </div>
                </div>
                <div class="divider divider-center"><i class="icon-cloud"></i></div>
                <div class="row">
                    <div id="alertEx"></div>
                    <div class="col-md-12 form-group">
                        <label for="">ตัวอย่างที่ 1</label>
                        <input type="number" name="addf_ex1" id="addf_ex1" class="form-control ex adex">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">ตัวอย่างที่ 2</label>
                        <input type="number" name="addf_ex2" id="addf_ex2" class="form-control ex adex">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">ตัวอย่างที่ 3</label>
                        <input type="number" name="addf_ex3" id="addf_ex3" class="form-control ex adex">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">ตัวอย่างที่ 4</label>
                        <input type="number" name="addf_ex4" id="addf_ex4" class="form-control ex adex">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">ตัวอย่างที่ 5</label>
                        <input type="number" name="addf_ex5" id="addf_ex5" class="form-control ex adex">
                    </div>
                    <!-- <div class="col-md-12 form-group text-center">
                        <button type="button" name="btnCalEx" id="btnCalEx" class="btn btn-primary">คำนวณ</button>
                    </div> -->
                    <div class="col-md-12 form-group">
                        <label for="">ค่าเฉลี่ย</label>
                        <input type="text" name="addf_exAvg" id="addf_exAvg" class="form-control ex" readonly>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">ค่าเบี่ยงเบน</label>
                        <input type="text" name="addf_accept" id="addf_accept" class="form-control ex" readonly>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <div id="checkBoxDiv">
                            <input id="pass" class="checkbox-style radio" name="addf_checkpass" type="checkbox" value="ผ่าน" onclick="return false">
                            <label for="pass" class="checkbox-style-3-label">ผ่าน</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div id="checkBoxDiv">
                            <input id="notpass" class="checkbox-style radio" name="addf_checkpass" type="checkbox" value="ไม่ผ่าน" onclick="return false">
                            <label for="notpass" class="checkbox-style-3-label">ไม่ผ่าน</label>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="">หมายเหตุ</label>
                        <textarea name="addf_memo" id="addf_memo" cols="30" rows="5" class="form-control ex adex"></textarea>
                    </div>
                </div>

                <div class="row form-group text-center">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <button type="button" name="btn_saveAddf" id="btn_saveAddf" class="btn btn-success btn-block">บันทึก</button>
                        <button type="button" name="btn_editAddf" id="btn_editAddf" class="btn btn-warning btn-block">แก้ไข</button>
                        <button type="button" name="btn_delAddfCheck" id="btn_delAddfCheck" class="btn btn-danger btn-block" disabled>ลบรายการ</button>
                        <input type="button" name="btn_closeAddf" id="btn_closeAddf" class="btn btn-secondary btn-block" value="ปิด" data-dismiss="modal">
                    </div>
                    <div class="col-md-4"></div>
                </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Modal รายการหลัก -->










<!-- Modal รายการหลัก -->

<div class="modal fade " id="addCheckMachine_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">การตรวจสอบเครื่องจักร</h5> -->
                <div id="show_addCheckMachine_modal"></div>
                <button type="button" class="close clsCheckMachine" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_saveCheckMachine">

                <!-- Check input Zone -->
                <input hidden type="text" name="addMc_checkFormno" id="addMc_checkFormno">
                <input hidden type="text" name="addMc_checkAutoid" id="addMc_checkAutoid">

                    <div class="row form-group">
                        <div class="col-md-4">
                            <div id="checkBoxDiv">
                                <input id="addMc_status1" class="checkbox-style radio" name="addMc_status" type="radio" value="ปกติ">
                                <label for="addMc_status1" class="checkbox-style-3-label">ปกติ</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div id="checkBoxDiv">
                                <input id="addMc_status2" class="checkbox-style radio" name="addMc_status" type="radio" value="ไม่ปกติ">
                                <label for="addMc_status2" class="checkbox-style-3-label">ไม่ปกติ</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div id="checkBoxDiv">
                                <input id="addMc_status3" class="checkbox-style radio" name="addMc_status" type="radio" value="ไม่ได้ใช้งาน">
                                <label for="addMc_status3" class="checkbox-style-3-label">ไม่ได้ใช้งาน</label>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="">หมายเหตุ</label>
                            <textarea name="addMc_memo" id="addMc_memo" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                    </div>

                    <!-- <div class="row form-group">
                        <div class="col-md-6">
                            <label for="">RM ที่ส่งเช็ค QC</label>
                            <input type="text" name="addMc_emQc" id="addMc_emQc" class="form-control" value="0">
                        </div>
                        <div class="col-md-6">
                            <label for="">ค่า Moisture</label>
                            <input type="number" name="addMc_moisture" id="addMc_moisture" class="form-control" value="0">
                        </div>
                    </div> -->


                    <div class="row form-group text-center">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button type="button" name="btn_saveAddCheckMachine" id="btn_saveAddCheckMachine" class="btn btn-success btn-block" disabled>บันทึก</button>
                            <input type="button" name="btn_closeAddCheckMachine" id="btn_closeAddCheckMachine" class="btn btn-secondary btn-block" data-dismiss="modal" value="ปิด">
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Modal รายการหลัก -->