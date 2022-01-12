<!-- Modal รายการหลัก -->
<div class="modal fade " id="tempdetail_md" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template เครื่อง <span id="tempDetailTitle"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div id="show_tempdetail"></div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>
<!-- Modal รายการหลัก -->







<!-- Modal รายการหลัก -->
<div class="modal fade bg_min_max_md" id="min_max_md" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Min , Max , S Point Value For <span id="minMaxTitle"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="saveMinMax_frm">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="">Min value</label>
                        <input type="text" name="minvalue" id="minvalue" class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Max value</label>
                        <input type="text" name="maxvalue" id="maxvalue" class="form-control">
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="">S Point value</label>
                        <input type="text" name="spointvalue" id="spointvalue" class="form-control">
                    </div>

                    <input hidden type="text" name="minMaxAutoid" id="minMaxAutoid">
                    <input hidden type="text" name="minMaxMachinename" id="minMaxMachinename">

                    <div class="col-md-12">
                        <button type="button" name="btn_addMinMax" id="btn_addMinMax" data-dismiss="modal" class="button button-small button-circle button-green">บันทึก</button>
                    </div>
                </div>
            </form>


            </div>

        </div>
    </div>
</div>
<!-- Modal รายการหลัก -->