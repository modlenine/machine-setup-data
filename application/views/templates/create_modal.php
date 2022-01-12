<!-- Modal รายการหลัก -->
<div class="modal fade " id="create_template_md" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">สร้าง Machine template</h5>
                <button type="button" class="close create_template_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="create_machine_template" autocomplete="off">
                    <!-- <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Template type</label><i class="icon-plus-sign2 addTemType"></i>
                            <?=getTemplateType()?>
                        </div>
                    </div> -->

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>ชื่อ Template</label>
                            <input type="text" name="mat_machine_name" id="mat_machine_name" class="form-control" placeholder="กรุณากรอก ชื่อเครื่อง ที่ต้องการ">
                            <input hidden type="text" name="mat_machine_nameUse" id="mat_machine_nameUse">
                            <div id="showListMachineTemp"></div>
                        </div>
                    </div>
                </form>

                <div id="alertSaveTemplate"></div>
            
                <div class="row">
                    <div class="col-md-6">
                        <div id="show_runscreen_master"></div>
                    </div>
                    <div class="col-md-6">
                        <div id="show_pick_runscreen"></div>
                    </div>
                </div>




            </div>

        </div>
    </div>
</div>
<!-- Modal รายการหลัก -->