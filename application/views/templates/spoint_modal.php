<!-- Modal รายการหลัก -->
<div class="modal fade " id="spoint_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

<div class="mainButton2">
    <div>
        <button type="button" class="btn btn-info btnDown2" name="scroolBtnSpoint" id="scroolBtnSpoint" onclick="footFunction2()">
        <i class="icon-arrow-alt-circle-down1" style="margin-right:5px;"></i>Go Down</button>
    </div>
</div>

    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">บันทึก S/Point เครื่อง <span id="showTemplateText"></span></h5> -->
                <div id="show_spoint_modal"></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="saveSpoint_frm" autocomplete="off">
                    <div class="" id="showTemplateSpoint"></div>
                    <div class="row">
                        <input hidden type="text" name="sPointTemplatename" id="sPointTemplatename">
                        <input hidden type="text" name="sPointMainForm" id="sPointMainForm">
                        <div class="col-md-12 text-center">
                        <div id="showAlertSpoint"></div>
                            <button type="button" id="btn_saveSpoint" name="btn_saveSpoint" class="btn btn-success">บันทึก S/Point</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
<!-- Modal รายการหลัก -->

<script>
    function footFunction2() {
        document.getElementById('btn_saveSpoint').scrollIntoView();
    }
</script>