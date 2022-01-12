<!-- Modal เมนู BOM-->

<div class="modal fade " id="md_bom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">คุณต้องการทำอะไร ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div id="md_bom_canuse" class="row">
                    <div class="col-md-12" id="cbtn_addmat">
                        <button type="button" name="btn_addmat" id="btn_addmat" class="button button-xlarge button-circle button-green" style="width:100%">ใส่วัตถุดิบ</button>
                    </div>
                    <div class="col-md-12">
                        <button type="button" name="btn_mixmat" id="btn_mixmat" class="button button-xlarge button-circle button-green" style="width:100%" data-toggle="modal" data-target="md_mixmatFeeder">Mix</button>
                    </div>
                    <div id="md_bom_cancelMix" class="col-md-12" style="display:none;">
                        <input hidden type="text" name="can_mainformno" id="can_mainformno">
                        <button type="button" name="btn_canMixmat" id="btn_canMixmat" class="button button-xlarge button-circle button-red" style="width:100%">ยกเลิกการ Mix ทั้งหมด</button>
                    </div>
                </div>

                <div id="md_bom_notuse" class="row" style="display:none;">
                    <div class="col-md-12">
                        <h3 class="text-center">วัตถุดิบนี้ถูกใช้ไปหมดแล้ว</h3>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Modal เมนู BOM -->





<!-- Modal ใส่วัตถุดิบลง Feeder  -->

<div class="modal fade " id="md_addmatFeeder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">กรุณาเลือก Feeder สำหรับ <span id="textMatname"></span></h5> -->
                <div id="showDetail_md_addmatFeeder"></div>
                <button id="close_md_addmatFeeder" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="feeder_frm" autocomplete="off">
                    <div class="row">
                        <div class="col-md-12">
                            <b><span>ชื่อวัตถุดิบ : </span><span id="textMatname2"></span></b>&nbsp;&nbsp;&nbsp;<b><span>จำนวน : </span><span id="textValue"></span> %</b>&nbsp;&nbsp;&nbsp;<b><span>จำนวนคงเหลือ : </span><span id="textValue2"></span> %</b>
                        </div>
                    </div>
                    <div class="divider divider-center"><i class="icon-line-chevron-down"></i></div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">เลือก Feeder</label>
                            <!-- Feeder list from databas -->
                            <div id="showChooseFeeder"></div>
                            <!-- Feeder list from databas -->
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">จำนวนวัตถุดิบ (%)</label>
                            <input type="number" name="md_value" id="md_value" class="form-control">
                            <div id="alertMdvalue"></div>
                        </div>

                        <!-- Check Zone -->
                        <input hidden type="text" name="md_mainformno" id="md_mainformno">
                        <input hidden type="text" name="md_prodid" id="md_prodid">
                        <input hidden type="text" name="md_rawmaterial" id="md_rawmaterial">
                        <input hidden type="text" name="md_autoid" id="md_autoid">
                        <input hidden type="text" name="md_qtyuse" id="md_qtyuse">

                        <input hidden type="text" id="md_qtyBalance" name="md_qtyBalance">
                        <input hidden type="text" name="md_qtyuseCal" id="md_qtyuseCal">

                        <div class="col-md-12 form-group">
                            <button type="button" name="btn_adddatafeeder" id="btn_adddatafeeder" class="btn btn-success">ยืนยัน</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal ใส่วัตถุดิบลง Feeder -->






<!-- Modal Mix วัตถุดิบ  -->
<div class="modal fade " id="md_mixmatFeeder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">กรุณาเลือกวัตถุดิบสำหรับ Mix</h5>
                <button id="close_md_saveMix" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="confirmMix_frm" autocomplete="off">

                    <input hidden type="text" name="mix_mainformno" id="mix_mainformno">
                    <input hidden type="text" name="mix_prodid" id="mix_prodid">

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <!-- แสดงข้อมูล Bom สำหรับ Mix -->
                            <h5><u>Bom</u></h5>
                            <div id="showBomMix"></div>
                            <!-- แสดงข้อมูล Bom สำหรับ Mix -->
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">รายการ Mix</label>
                            <input type="text" name="mixDataInput" id="mixDataInput" class="form-control" readonly>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">จำนวน Mix (%)</label>
                            <input type="text" name="mixValueDataInput" id="mixValueDataInput" class="form-control" readonly>
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="button" name="btn_adddataMix" id="btn_adddataMix" class="button button-small button-circle button-green">ยืนยันการ Mix</button>
                            <!-- <button type="button" name="btn_clearDatafeeder" id="btn_clearDatafeeder" class="button button-small button-circle button-amber">ล้างข้อมูล Mix</button> -->
                        </div>
                    </div>
                </form>

                <div class="divider divider-center"><i class="icon-line-chevron-down"></i></div>

                <div class="row">
                    <div class="col-md-12">
                        <h5><u>Bom Mix</u></h5>
                        <div id="showBomMix2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Mix วัตถุดิบ  -->






<!-- Modal Mix วัตถุดิบ  -->
<div class="modal fade " id="md_getValueForMix" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">กรุณากำหนดปริมาณสำหรับ Mix</h5>
                <button id="close_md_getValMix" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="getValueConfirmMix" autocomplete="off">

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <!-- แสดงข้อมูล Bom สำหรับ Mix -->
                            <h5>Item : <span id="gv_item"></span></h5>
                            <input type="text" name="gv_bom" id="gv_bom" class="form-control">

                            <input type="text" name="gv_b_autoid" id="gv_b_autoid">
                            <input type="text" name="gv_b_prodid" id="gv_b_prodid">
                            <input type="text" name="gv_mainformNo" id="gv_mainformNo">
                            <input type="text" name="gv_rawmat" id="gv_rawmat">
                            <!-- แสดงข้อมูล Bom สำหรับ Mix -->
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="button" id="gv_btn_confirm" name="gv_btn_confirm" class="btn btn-primary btn-block">ยืนยัน</button>
                        </div>


                    </div>
                </form>

                <div class="divider divider-center"><i class="icon-line-chevron-down"></i></div>


            </div>
        </div>
    </div>
</div>
<!-- Modal Mix วัตถุดิบ  -->