
<!-- Modal รายการหลัก -->

<div class="modal fade " id="set_shift_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Set Shift</h5>
                <button type="button" class="close setShiftClose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="setShift_frm" autocomplete="off">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">ชื่อกะการทำงาน</label>
                            <input type="text" name="shift_name" id="shift_name" class="form-control">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">เวลาเริ่มงาน</label>
                            <div class="form-group">
                                <div class="input-group text-left" data-target-input="nearest" data-target=".datetimepicker1">
                                    <input type="text" id="shift_starttime" name="shift_starttime" class="form-control datetimepicker-input datetimepickerS" data-target=".datetimepickerS">
                                    <div class="input-group-append" data-target=".datetimepickerS" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="icon-clock"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">เวลาเลิกงาน</label>
                            <div class="form-group">
                                <div class="input-group text-left" data-target-input="nearest" data-target=".datetimepicker1">
                                    <input type="text" id="shift_endtime" name="shift_endtime" class="form-control datetimepicker-input datetimepickerE" data-target=".datetimepickerE">
                                    <div class="input-group-append" data-target=".datetimepickerE" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="icon-clock"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">หมายเหตุ</label>
                            <textarea name="shift_memo" id="shift_memo" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="col-md-12 form-group text-center">
                        <div id="showAlertSetShift"></div>
                            <button type="button" id="btn_saveSetShift" name="btn_saveSetShift" class="btn btn-success">บันทึก</button>
                        </div>
                    </div>
                </form>
                <div class="divider divider-border divider-center"><i class="icon-email2"></i></div>
            </div>

        </div>
    </div>
</div>



<!-- Modal รายการหลัก -->