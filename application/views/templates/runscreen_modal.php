
<!-- Modal รายการหลัก -->
<div class="modal fade " id="runscreen_md" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">จัดการ Run Screen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-header">
                <button type="button" id="btn_new_runscreen" class="button button-small button-circle button-green">เพิ่ม</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div id="show_runscreen_management"></div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- Modal รายการหลัก -->






<!-- New RunScreen Modal -->
<div class="modal fade" id="new_runscreen_md" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header edit_runscreen_md_head">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่ม Run Screen</h5>
                <button type="button" class="close btnCloseNewRun" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body edit_runscreen_md_head">
            <form id="addRunscreen">
                    <div class="form-row">
                        <div class="form-group col-xl-6" id="box_run_name">
                            <label>ชื่อ Run Screen</label>
                            <input type="text" name="run_name" id="run_name" class="form-control" placeholder="กรุณากรอก ชื่อ Run Screen ที่ต้องการ">
                        </div>
                        <div class="form-group col-xl-6" id="box_run_name">
                            <label>ค่า Min</label>
                            <input type="tel" name="run_minvalue" id="run_minvalue" class="form-control" placeholder="กรุณากรอก ค่า Min"/>
                        </div>
                        <div class="form-group col-xl-6" id="box_run_name">
                            <label>ค่า Max</label>
                            <input type="tel" name="run_maxvalue" id="run_maxvalue" class="form-control" placeholder="กรุณากรอก ค่า Max"/>
                        </div>
                        <div class="form-group col-xl-6" id="box_run_name">
                            <label>Set Point</label>
                            <input type="tel" name="run_spoint" id="run_spoint" class="form-control" placeholder="กรุณากรอก ค่า Set Point">
                        </div>
                        
                        <input hidden type="text" name="run_autoid" id="run_autoid">

                        <div class="col-md-12 form-inline mb-2" id="box_run_type">
                            <div class="form-group pr-2">
                                <input type="radio" name="run_type" id="run_typeFeeder" value="Feeder" class="rd18">&nbsp;<label for="">Feeder</label>
                            </div>
                            <div class="form-group pl-2">
                                <input type="radio" name="run_type" id="run_typeExtruder" value="Extruder" class="rd18">&nbsp;<label for="">Extruder</label>
                            </div>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <button type="button" id="btn_runscreenManage" class="button button-small button-circle button-green">บันทึกข้อมูล</button>
                        </div>
                    </div>
                    <div id="alertRunscreenManage"></div>
                </form>
            </div>
        </div>
    </div>
</div>







<!-- Edit RunScreen Modal -->
<div class="modal fade" id="edit_runscreen_md" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header edit_runscreen_md_head">
                <h5 class="modal-title" id="exampleModalLabel">แก้ไข Run Screen</h5>
                <button type="button" class="close btnCloseEditRun" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body edit_runscreen_md_head">
                <form id="editRunscreen" autocomplete="off">
                        <div class="form-row">
                            <div class="form-group col-xl-6" id="box_run_name">
                                <label>ชื่อ Run Screen</label>
                                <input type="text" name="edit_run_name" id="edit_run_name" class="form-control" placeholder="กรุณากรอก ชื่อ Run Screen ที่ต้องการ">
                            </div>
                            <div class="form-group col-xl-6" id="box_run_name">
                                <label>ค่า Min</label>
                                <input type="tel" name="edit_run_minvalue" id="edit_run_minvalue" class="form-control" placeholder="กรุณากรอก ค่า Min">
                            </div>
                            <div class="form-group col-xl-6" id="box_run_name">
                                <label>ค่า Max</label>
                                <input type="tel" name="edit_run_maxvalue" id="edit_run_maxvalue" class="form-control" placeholder="กรุณากรอก ค่า Max">
                            </div>
                            <div class="form-group col-xl-6" id="box_run_name">
                                <label>Set Point</label>
                                <input type="tel" name="edit_run_spoint" id="edit_run_spoint" class="form-control" placeholder="กรุณากรอก ค่า Set Point">
                            </div>
 
                            <input hidden type="text" name="edit_run_autoid" id="edit_run_autoid">

                            <div class="col-md-12 form-inline mb-2" id="box_run_type">
                                <div class="form-group pr-2">
                                    <input type="radio" name="edit_run_type" id="edit_run_typeFeeder" value="Feeder" class="rd18">&nbsp;<label for="">Feeder</label>
                                </div>
                                <div class="form-group pl-2">
                                    <input type="radio" name="edit_run_type" id="edit_run_typeExtruder" value="Extruder" class="rd18">&nbsp;<label for="">Extruder</label>
                                </div>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <button type="button" id="btn_edit_runscreenManage" class="button button-small button-circle button-green" style="width:100%;">บันทึกการแก้ไขข้อมูล</button>
                            </div>
                        </div>
                        <div id="alertEditRunscreenManage"></div>
                        <div id="alertEditRunscreenManage2"></div>
                </form>
            </div>
        </div>
    </div>
</div>









<!-- Modal รายการหลัก -->
<div class="modal fade " id="copy_template_md" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Manage Template</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="showTemplateListCopy"></div>
            </div>

        </div>
    </div>
</div>
<!-- Modal รายการหลัก -->






<!-- Modal รายการหลัก -->
<div class="modal fade" id="confirm_copy_template_md" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ยืนยันการ Copy Template</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_copyTemplate">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">ชื่อ Template (New)</label>
                            <input type="text" name="newTemplatename" id="newTemplatename" class="form-control">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">ชื่อ Template (Old)</label>
                            <input type="text" name="oldTemplatename" id="oldTemplatename" class="form-control" readonly>
                        </div>
                
                            <div class="col-md-6">
                                <button type="button" name="btn_saveCopyTem" id="btn_saveCopyTem" class="btn btn-primary btn-block">ยืนยัน</button>
                            </div>
                 
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Modal รายการหลัก -->




<!-- Modal รายการหลัก -->
<div class="modal fade" id="edit_template_md" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Template : <span id="template_name"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_editTemplate" enctype="multipart/form-data" method="post" autocomplete="off">
                    <div class="row form-group">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <img id="ted_template_imageShow">
                        </div>
                        <div class="col-md-3"></div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <label for="">อัพโหลดรูปภาพ Template</label>
                            <input type="file" name="ted_template_image[]" id="ted_template_image" accept="image/*" onchange="loadFile(event)">
                            <input hidden type="text" name="ted_template_image_old" id="ted_template_image_old" >
                        </div>
                        <div class="col-md-3"></div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <label for="">กำหนด Product</label>
                            <input type="text" name="ted_template_itemuse" id="ted_template_itemuse" class="form-control">
                            <input hidden type="text" name="ted_template_itemuse_2" id="ted_template_itemuse_2">
                            <div id="showProductCode"></div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>


                    <div class="row form-group">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <button type="button" name="btnSaveTemplateDetail" id="btnSaveTemplateDetail" class="btn btn-primary btn-block">บันทึก</button>
                        </div>
                        <div class="col-md-3"></div>
                    </div>

                    <!-- Zone use save to database -->
                    <input hidden type="text" name="ted_template_name" id="ted_template_name">
                </form>

                <div class="row">
                    <div class="col-md-12 text-right">
                        <button class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Modal รายการหลัก -->

<script>
    const loadFile = function(event) {
    const reader = new FileReader();
    reader.onload = function(){
    const output = document.getElementById('ted_template_imageShow');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };

  $(document).ready(function(){



      $(document).on('focus' , '#run_decimalPosition' , function(){
          if($(this).val() > 4 ){
            $('#alert_run_decimalPosition').html(`
                <div class="alert alert-danger" role="alert">
                    ตำแหน่งทศนิยมตั้งได้สูงสุด 4 ตำแหน่ง
                </div>
            `);
            $(this).val(0)
          }else{
            $('#alert_run_decimalPosition').html('');
          }
      });

      $(document).on('keyup' , '#run_decimalPosition' , function(){
          if($(this).val() > 4 ){
            $('#alert_run_decimalPosition').html(`
                <div class="alert alert-danger" role="alert">
                    ตำแหน่งทศนิยมตั้งได้สูงสุด 4 ตำแหน่ง
                </div>
            `);
            $(this).val(0)
          }else{
            $('#alert_run_decimalPosition').html('');
          }
      });

      $(document).on('blur' , '#run_decimalPosition' , function(){
          if($(this).val() > 4 ){
            $('#alert_run_decimalPosition').html(`
                <div class="alert alert-danger" role="alert">
                    ตำแหน่งทศนิยมตั้งได้สูงสุด 4 ตำแหน่ง
                </div>
            `);
            $(this).val(0)
          }else{
            $('#alert_run_decimalPosition').html('');
          }
      });











      $(document).on('focus' , '#edit_run_decimalPosition' , function(){
          if($(this).val() > 4 ){
            $('#alert_edit_run_decimalPosition').html(`
                <div class="alert alert-danger" role="alert">
                    ตำแหน่งทศนิยมตั้งได้สูงสุด 4 ตำแหน่ง
                </div>
            `);
            $(this).val(0)
          }else{
            $('#alert_edit_run_decimalPosition').html('');
          }
      });

      $(document).on('keyup' , '#edit_run_decimalPosition' , function(){
          if($(this).val() > 4 ){
            $('#alert_edit_run_decimalPosition').html(`
                <div class="alert alert-danger" role="alert">
                    ตำแหน่งทศนิยมตั้งได้สูงสุด 4 ตำแหน่ง
                </div>
            `);
            $(this).val(0)
          }else{
            $('#alert_edit_run_decimalPosition').html('');
          }
      });

      $(document).on('blur' , '#edit_run_decimalPosition' , function(){
          if($(this).val() > 4 ){
            $('#alert_edit_run_decimalPosition').html(`
                <div class="alert alert-danger" role="alert">
                    ตำแหน่งทศนิยมตั้งได้สูงสุด 4 ตำแหน่ง
                </div>
            `);
            $(this).val(0)
          }else{
            $('#alert_edit_run_decimalPosition').html('');
          }
      });





  });

</script>