<!-- Modal รายการหลัก -->
<div class="modal fade " id="cancel_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">บันทึก การ Run เครื่อง <span id="show_runs_modal_title"></span></h5><br> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="saveCancel_frm" enctype="multipart/form-data" method="post" autocomplete="off">
                    <div class="form-group row">

                        <div class="col-md-12">
                            <label>เหตุผลในการยกเลิก</label>
                            <textarea name="cancel_memo" id="cancel_memo" cols="30" rows="5" class="form-control"></textarea>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="button" id="btn_saveCancelForm" name="btn_saveCancelForm" class="btn btn-success">ยืนยันการยกเลิกรายการ</button>
                            <button type="button" id="btn_CloseCancelForm" name="btn_CloseCancelForm" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Modal รายการหลัก -->






<!-- Modal รายการหลัก -->
<div class="modal fade " id="cancelView_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">บันทึก การ Run เครื่อง <span id="show_runs_modal_title"></span></h5><br> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                    <div class="form-group row">

                        <div class="col-md-12">
                            <label>เหตุผลในการยกเลิก</label>
                            <textarea name="cancelView_memo" id="cancelView_memo" cols="30" rows="5" class="form-control" readonly></textarea>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="button" id="btn_CloseViewCancelForm" name="btn_CloseViewCancelForm" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        </div>
                    </div>
            </div>

        </div>
    </div>
</div>
<!-- Modal รายการหลัก -->