<!-- Modal Edit Run Template -->
<div class="modal fade " id="qcsampling_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg qcsampling_md modal-dialog-scrollable">

        <div class="modal-content">

            <div class="modal-header">
                <h4 class="add_title_h">QC Sampling Series : <span id="titleQcnumber"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- <div class="modal-header subhead">
                <button type="button" id="close_qcline" name="close_qcline" class="btn btn-danger">Close</button>
            </div> -->
            
            <div class="modal-body">
                <div class="row rowQcline">
                    <div id="showQcSamplingByLinenum"></div>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- Modal Create Template -->



<!-- Modal Edit Run Template -->
<div class="modal fade " id="selectLotnumber_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg qcsampling_md modal-dialog-scrollable">

        <div class="modal-content">

            <div class="modal-header">
                <h4 class="add_title_h">เลือก Lot Number ที่ต้องการ</h4>
                <button type="button" class="close clearDivIconModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-header subhead">
                <button type="button" id="confirm_checkboxLotnum" name="confirm_checkboxLotnum" class="btn btn-success">Confirm</button>
                <button type="button" id="close_qcline" name="close_qcline" class="btn btn-danger ml-2 clearDivIconModal" data-dismiss="modal">Close</button>
            </div>
            
            <div class="modal-body">
                <div id="showLotNumberBy"></div>
            </div>

        </div>

    </div>
</div>
<!-- Modal Create Template -->




<!-- Modal Edit Run Template -->
<div class="modal fade " id="showSystemDatetime_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm qcsampling_md modal-dialog-scrollable">

        <div class="modal-content">


            <div class="row p-5 text-center">
                <div class="col-md-12">
                    <h3>System Date</h3>
                    <span id="sysTextShow"></span>
                </div>
            </div>


        </div>

    </div>
</div>
<!-- Modal Create Template -->

