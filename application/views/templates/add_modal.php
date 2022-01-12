<!-- Modal รายการหลัก -->

<div class="modal fade " id="md_adddata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มรายการหลัก</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <form id="maindata" autocomplete="off">
                <section class="mb-2">

                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="">เลือกบริษัท <span class="requestText">*</span></label>
                            <select name="fam_dataareaid" id="fam_dataareaid" class="form-control">
                                <option value="">กรุณาเลือกบริษัท</option>
                                <?=getDataareaid()?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Production No. <span class="requestText">*</span></label>
                            <input type="text" name="fam_prodid" id="fam_prodid" class="form-control">
                            <input hidden type="text" name="fam_prodidwip" id="fam_prodidwip">
                            <div id="showProdId"></div>
                        </div>
                    </div>


                    <div class="row form-group">
                        <div class="col-md-6">
                            <label>เลือกเครื่องจักร <span class="requestText">*</span></label>
                            <input type="text" name="machineSearch" id="machineSearch" class="form-control" >
                            <input hidden type="text" name="fam_machinename" id="fam_machinename">
                            <div id="show_famprocode"></div>
                        </div>


                        <div class="col-md-6">
                            <label for="">MIS <span class="requestText">*</span></label>
                            <input type="number" name="fam_mis" id="fam_mis" class="form-control">
                        </div>
                    </div>


                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="">Output <span class="requestText">*</span></label>
                            <input type="number" name="fam_output" id="fam_output" class="form-control">
                        </div>


                        <div class="col-md-6">
                            <label>Product Code</label>
                            <input type="text" name="fam_productcode" id="fam_productcode" class="form-control" readonly>
                        </div>
                    </div>
                    

                    <div class="row form-group">
                        <div class="form-group col-md-6">
                            <label>Batch number</label>
                            <input type="text" name="fam_batchnumber" id="fam_batchnumber" class="form-control" readonly>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Shift</label>
                            <input type="text" name="fam_shit" id="fam_shit" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label>Date</label>
                            <input readonly type="text" name="fam_datetime" id="fam_datetime" class="form-control" value="<?= date("d/m/Y") ?>">
                        </div>

                        
                    </div>

                    <div class="form-row">
                        <div class="col-md-12">
                        <button type="button" name="btn_saveMaindata" id="btn_saveMaindata" class="button button-small button-circle button-green">บันทึกข้อมูล</button>
                        <button type="button" name="btn_closeMaindata" id="btn_closeMaindata" class="button button-small button-circle button-red" data-dismiss="modal">ปิด</button>
                        <div id="alertMainModal"></div>
                        </div>
                        
                    </div>
                </section>
                <hr>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Modal รายการหลัก -->



<!-- Modal Edit Run Template -->
<div class="modal fade " id="editHeadData_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">

        <div class="modal-content">
<form id="editHeadData" autocomplete="off">
            <div class="modal-header">
                <h4>แก้ไขข้อมูลหลัก : <span id="textEditHead"></span></h4>
                <button type="button" class="close close_EditHead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-header subhead">
                <button type="button" id="saveEditHead" name="saveEditHead" class="btn btn-warning">Save Edit</button>
                <button type="button" id="close_EditHead" name="close_EditHead" class="btn btn-danger ml-2 close_EditHead" data-dismiss="modal">Close</button>
            </div>
            
            <div class="modal-body">
                <!-- Check Zone -->
                <input hidden type="text" name="editHead_checkMainformno" id="editHead_checkMainformno">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">MIS <span class="requestText">*</span></label>
                        <input type="number" name="edit_fam_mis" id="edit_fam_mis" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label for="">Output <span class="requestText">*</span></label>
                        <input type="number" name="edit_fam_output" id="edit_fam_output" class="form-control">
                    </div>
                </div>
            </div>
</form>
        </div>

    </div>
</div>
<!-- Modal Create Template -->



<!-- Modal Edit Run Template -->
<div class="modal fade " id="stopMemo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-scrollable">

        <div class="modal-content">
<form id="stopMemo" autocomplete="off">
            <div class="modal-header">
                <h4>Stop Memo</h4>
                <button type="button" class="close close_stopmemo" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-header subhead">
                <button type="button" id="save_stopmemo" name="save_stopmemo" class="btn btn-warning">Save</button>
                <button type="button" id="close_stopmemo" name="close_stopmemo" class="btn btn-danger ml-2 close_stopmemo" data-dismiss="modal">Close</button>
            </div>
            
            <div class="modal-body">
                <!-- Check Zone -->
                <input hidden type="text" name="stopmemo_checkMainformno" id="stopmemo_checkMainformno">

                <div class="row">
                    <div class="col-md-12">
                        <label for="">เหตุผล : </label>
                        <textarea id="stopmemo_value" name="stopmemo_value" rows="10" cols="5" class="form-control"></textarea>
                    </div>
                </div>
            </div>
</form>
        </div>

    </div>
</div>
<!-- Modal Create Template -->


<!-- Modal Edit Run Template -->
<div class="modal fade " id="stopMemoView_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-md modal-dialog-scrollable">

        <div class="modal-content">
            
            <div class="modal-body">
                <!-- Check Zone -->
                <div class="row">
                    <div class="col-md-12">
                        <label for="">เหตุผล : </label>
                        <textarea id="stopmemo_view" name="stopmemo_view" rows="10" cols="5" class="form-control" readonly></textarea>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- Modal Create Template -->



<script>
    $(document).ready(function(){

        // Control การเปลี่ยนบริษัท
        $('#fam_dataareaid').change(function(){
            $('#fam_prodid').val('');
            $('#machineSearch').val('');
            $('#fam_productcode').val('');
            $('#fam_batchnumber').val('');
        });
        // Control การเปลี่ยนบริษัท
    });
</script>
