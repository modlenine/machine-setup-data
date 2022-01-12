<!-- Modal รายการหลัก -->

<div class="modal fade " id="runs_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">บันทึก การ Run เครื่อง <span id="show_runs_modal_title"></span></h5><br> -->
                <span id="showMainDetailOnRunModal"></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="saveRun_frm" enctype="multipart/form-data" method="post" autocomplete="off">
                    <div class="form-group row">

                        <div class="col-md-12">
                            <label for="">กรุณาเลือกเวลา</label>
                            <div class="form-group">
                                <div class="input-group text-left" data-target-input="nearest" data-target=".datetimepicker1">
                                    <input type="text" id="rChooseTime" name="rChooseTime" class="form-control datetimepicker-input datetimepicker1" data-target=".datetimepicker1" placeholder="กรุณาเลือกเวลาการเดินเครื่อง">
                                    <div class="input-group-append" data-target=".datetimepicker1" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="icon-clock"></i></div>
                                    </div>
                                </div>
                            </div>
                            <input hidden type="text" name="nowdate" id="nowdate">
                            <input hidden type="text" name="direcdate" id="direcdate" value="<?=date("Y-m-d")?>">
                            <input hidden type="text" name="returnCheckShift" id="returnCheckShift">
                            <div id="alertChooseTime"></div>
                        </div>

                        <div class="col-md-12">
                            <label>กะงานปัจจุบัน</label>
                            <select id="fasub_worktime" name="fasub_worktime" class="form-control">
                                <option value="">กรุณากำหนดกะงาน</option>
                                <option value="shift-a">shift-a</option>
                                <option value="shift-b">shift-a</option>
                                <option value="shift-c">shift-c</option>
                            </select>
                        </div>


                    </div>
                    <div class="row form-group m-3">
                        <div class="col-md-12">
                            <label for="">หมายเหตุ</label>
                            <textarea name="fd_memo" id="fd_memo" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12 bottommargin">
                        <label>อัพโหลดไฟล์รูปหน้าจอ</label><br>
                        <input id="fd_files1" name="fd_files1[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-show-preview="true" accept="image/*">
                    </div>
                    <div class="col-lg-12 bottommargin">
                        <label>อัพโหลดไฟล์รูปเม็ด MB.</label><br>
                        <input id="fd_files2" name="fd_files2[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-show-preview="true" accept="image/*">
                    </div>
                    <div class="col-lg-12 bottommargin">
                        <label>อัพโหลดไฟล์รูปปัญหาในการผลิตและการทำงาน</label><br>
                        <input id="fd_files3" name="fd_files3[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-show-preview="true" accept="image/*">
                    </div>
                    <div class="col-lg-12 bottommargin">
                        <label>อัพโหลดไฟล์อื่นๆ</label><br>
                        <input id="fd_files4" name="fd_files4[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-show-preview="true" accept="image/*">
                    </div>

                    <div class="divider divider-center"><i class="icon-cloud"></i></div>
                    <div class="" id="showTemplateRun"></div>
                    <div class="row">
                        <input hidden type="text" name="rMainFormno" id="rMainFormno">
                        <input hidden type="text" name="rSubFormno" id="rSubFormno">
                        <input hidden type="text" name="rMachineTemp" id="rMachineTemp">
                        <input hidden type="text" name="checkMdShift" id="checkMdShift">
                        <input hidden type="text" name="rAutoidCheck" id="rAutoidCheck">
                        <div class="col-md-12 text-center">
                            <button type="button" id="btn_saveRunForm" name="btn_saveRunForm" class="btn btn-success">บันทึกข้อมูล</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Modal รายการหลัก -->










<!-- Modal รายการหลัก -->

<div class="modal fade " id="editRuns_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="row mainButton text-right">
        <div class="col-md-12">
            <button type="button" class="btn btn-info btnDown" name="scroolBtn" id="scroolBtn" onclick="footFunction()"><i class="icon-arrow-alt-circle-down1" style="margin-right:5px;"></i>Go Down</button>
        </div>
    </div>

    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">แก้ไขบันทึก การ Run เครื่อง <span id="showTemplateTextEdit"></span></h5> -->
                <span id="showMainDetailOnEditRunModal"></span>
                <button type="button" class="close editrunclose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="saveEditRun_frm" enctype="multipart/form-data" method="post" autocomplete="off">
                    <div class="form-group row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <label for="">กรุณาเลือกเวลา</label>
                            <select name="editRunWorktime" id="editRunWorktime" class="form-control">
                            </select>
                        </div>
                        <div class="col-md-2"></div>
                    </div>

                    <div class="divider divider-center"><i class="icon-cloud"></i></div>

                    <div id="buttonBlock" class="p-3" style="display:none;">

                        <div class="col-md-12">
                            <label for="">แก้ไขเวลาการเดินเครื่อง</label>
                            <div class="form-group">
                                <div class="input-group text-left" data-target-input="nearest" data-target=".datetimepicker1">
                                    <input type="text" id="rChooseTime_edit" name="rChooseTime_edit" class="form-control datetimepicker-input datetimepicker1" data-target=".datetimepicker1" placeholder="กรุณาเลือกเวลาการเดินเครื่อง">
                                    <div class="input-group-append" data-target=".datetimepicker1" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="icon-clock"></i></div>
                                    </div>
                                </div>
                            </div>
                            <!-- <input hidden type="text" name="nowdate" id="nowdate">
                            <input hidden type="text" name="direcdate" id="direcdate" value="<?=date("Y-m-d")?>">
                            <input hidden type="text" name="returnCheckShift" id="returnCheckShift">
                            <div id="alertChooseTime"></div> -->
                        </div>

                        <div class="row mb-3" style="border:solid 1px #17a2b8;padding:20px;">
                            <div class="col-lg-12 bottommargin fileSection1" style="display:none;">
                                <label>อัพโหลดไฟล์รูปหน้าจอ</label><br>
                                <input id="fd_files1" name="fd_files1[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-show-preview="true" accept="image/*">
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="button" class="btn btn-info btn-block fileup1">อัพโหลดไฟล์รูปหน้าจอ
                                    <i class="icon-cloud-upload fileup" style="float:right;color:aliceblue;"></i>
                                </button>
                            </div>
                        </div>


                        <div class="row mb-3" style="border:solid 1px #ccc;padding:20px;">
                            <div class="col-lg-12 bottommargin fileSection2" style="display:none;">
                                <label>อัพโหลดไฟล์รูปเม็ด MB.</label><br>
                                <input id="fd_files2" name="fd_files2[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-show-preview="true" accept="image/*">
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="button" class="btn btn-secondary btn-block fileup2">อัพโหลดไฟล์รูปเม็ด MB.
                                    <i class="icon-cloud-upload fileup" style="float:right;color:aliceblue;"></i>
                                </button>
                            </div>
                        </div>


                        <div class="row mb-3" style="border:solid 1px #17a2b8;padding:20px;">
                            <div class="col-lg-12 bottommargin fileSection3" style="display:none;">
                                <label>อัพโหลดไฟล์รูปปัญหาในการผลิตและการทำงาน</label><br>
                                <input id="fd_files3" name="fd_files3[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-show-preview="true" accept="image/*">
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="button" class="btn btn-info btn-block fileup3">อัพโหลดไฟล์รูปปัญหาในการผลิตและการทำงาน
                                    <i class="icon-cloud-upload fileup" style="float:right;color:aliceblue;"></i>
                                </button>
                            </div>
                        </div>


                        <div class="row mb-3" style="border:solid 1px #ccc;padding:20px;">
                            <div class="col-lg-12 bottommargin fileSection4" style="display:none;">
                                <label>อัพโหลดไฟล์อื่นๆ</label><br>
                                <input id="fd_files4" name="fd_files4[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-show-preview="true" accept="image/*">
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="button" class="btn btn-secondary btn-block fileup4">อัพโหลดไฟล์อื่นๆ
                                    <i class="icon-cloud-upload fileup" style="float:right;color:aliceblue;"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                    <div class="" id="showdataRunEdit"></div>
                    
                    <div class="row">
                        <input hidden type="text" name="eMainFormno" id="eMainFormno">
                        <input hidden type="text" name="eSubFormno" id="eSubFormno">
                        <input hidden type="text" name="eMachineTemp" id="eMachineTemp">
                        <input hidden type="text" name="eDetailFormno" id="eDetailFormno">
                        <input hidden type="text" name="eLinenumGroup" id="eLinenumGroup">

                        <div class="col-md-12 text-center fileSectionBtn" style="display:none;">
                            <div id="alert_btn_saveEditRunForm"></div>
                            <button type="button" id="btn_saveEditRunForm" name="btn_saveEditRunForm" class="button button-small button-circle button-green">บันทึกการแก้ไขข้อมูล</button>
                            <button type="button" id="btn_saveDelEditRunForm" name="btn_saveDelEditRunForm" class="button button-small button-circle button-red">ลบข้อมูลช่วงเวลา</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    function footFunction() {
        document.getElementById('btn_saveEditRunForm').scrollIntoView();
    }
</script>


<!-- Modal รายการหลัก -->










<!-- Modal รายการหลัก -->

<div class="modal fade " id="faMemo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">หมายเหตุ</h5>
                <button type="button" class="close editrunclose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea name="view_faMemo" id="view_faMemo" cols="30" rows="5" class="form-control" readonly></textarea>
            </div>

        </div>
    </div>
</div>



<!-- Modal รายการหลัก -->




<!-- Modal รายการหลัก -->

<div class="modal fade " id="faImage_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">รูปภาพประกอบ : <span id="runImageTitle"></span></h5>
                <button type="button" class="close editrunclose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="showImageonRun"></div>
                        <div class="line"></div>
                    </div>
                </div>


            </div>

        </div>
    </div>
</div>



<!-- Modal รายการหลัก -->

<div class="modal fade " id="spinner_load" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="spinner-border text-success"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>