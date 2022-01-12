<!-- Modal Create Template -->
<div class="modal fade " id="select_template_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <form id="frm_saveEditTemplate" autocomplete="off">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template : <span id="selectTempTitle"></span></h5>
                <button type="button" class="close select_template_modal_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-header subhead">
                <button type="button" id="btnSelectTemplate_edit" name="btnSelectTemplate_edit" class="button button-amber">แก้ไข</button>
                <button style="display:none;" type="button" id="btnSelectTemplate_canceledit" class="button button-amber select_template_modal_close">ยกเลิกแก้ไข</button>
                <button style="display:none;" type="button" id="btnSaveSelectTemplate_edit" class="button button-green">บันทึก</button>
                <button type="button" id="btnSelectTemplate_delete" name="btnSelectTemplate_delete" class="button button-red">ลบ</button>
                <button type="button" id="btnSelectTemplate_overall" class="button button-gray">ดูภาพรวม</button>
                <button type="button" id="btnSelectTemplate_close" class="button button-gray select_template_modal_close" data-dismiss="modal">ปิด</button>
            </div>

            <input hidden type="text" name="select_check_templatename" id="select_check_templatename">
            <input hidden type="text" name="select_check_templateitemuse" id="select_check_templateitemuse">
            <input hidden type="text" name="select_check_templateimage" id="select_check_templateimage">


            <div class="modal-body select_showdata">
                
                <div class="row form-group">
                    <div class="col-md-4">
                        <img id="select_template_imageshow" width="200" height="200">
                    </div>
                    <div class="col-md-8">

                        <!-- <div class="row form-group">
                            <div class="col">
                                <label for="">อัพโหลดรูปภาพ Template</label>
                                <input type="file" name="ted_template_image[]" id="ted_template_image" accept="image/*" onchange="loadFileCreate(event)" class="form-control" readonly>
                            </div>
                        </div> -->

                        <div class="row form-group">
                            <div class="col">
                                <label>ชื่อ Template : </label>
                                <input type="text" name="select_template_name" id="select_template_name" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col">
                                <label>Product ที่ใช้งาน : </label>
                                <input type="text" name="select_template_itemid" id="select_template_itemid" class="form-control" readonly>
                            </div>
                        </div>

                    </div>
                </div>

                <div id="alert_create_new_template"></div>
                <div class="divider divider-center"><i class="icon-line-chevron-down"></i></div>

                <div class="row">
                    <div class="col-md-12">
                        <input type="text" name="searchRunscreenMaster_edit" id="searchRunscreenMaster_edit" class="form-control mb-2" placeholder="Search RunScreen Master">
                        <label for="">Total Item : <span id="searchRunTitle_edit1"></span> รายการ</label>
                        <div id="show_select_runscreen"></div>
                    </div>
                </div>

            </div>

            <div class="modal-body select_editdata" style="display:none;">
                
                <div class="row form-group">
                    <div class="col-md-4">
                        <img id="select_edit_template_imageshow" width="200" height="200">
                    </div>
                    <div class="col-md-8">

                        <div class="row form-group">
                            <div class="col">
                                <label for="">อัพโหลดรูปภาพ Template</label>
                                <input type="file" name="select_edit_template_image[]" id="select_edit_template_image" accept="image/*" onchange="loadFileCreateEdit(event)" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col">
                                <label>ชื่อ Template : </label>
                                <input type="text" name="select_edit_template_name" id="select_edit_template_name" class="form-control" >
                                <input hidden type="text" name="select_edit_template_name_new" id="select_edit_template_name_new">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col">
                                <label>Product ที่ใช้งาน : </label>
                                <input type="text" name="select_edit_template_itemid" id="select_edit_template_itemid" class="form-control text-uppercase">
                                <input hidden type="text" name="select_edit_template_itemid_new" id="select_edit_template_itemid_new">
                                <div id="create_new_template_itemid_search_edit"></div>
                            </div>
                        </div>

                    </div>
                </div>

                <div id="alert_select_edit_template"></div>
                <div class="divider divider-center"><i class="icon-line-chevron-down"></i></div>

                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="select_edit_searchRunscreenMaster" id="select_edit_searchRunscreenMaster" class="form-control mb-2" placeholder="Search RunScreen Master">
                        <label for="">Total Item : <span id="searchRunTitle_edit"></span> รายการ</label>
                        <div id="show_runscreen_master2_edit"></div>
                        <div id="show_runscreen_master3_edit"></div>
                        <!-- Input Zone -->
                        <input hidden type="text" name="run_name_use_edit" id="run_name_use_edit">
                        <input hidden type="text" name="run_type_use_edit" id="run_type_use_edit">
                        <input hidden type="text" name="run_minvalue_use_edit" id="run_minvalue_use_edit">
                        <input hidden type="text" name="run_maxvalue_use_edit" id="run_maxvalue_use_edit">
                        <input hidden type="text" name="run_spoint_use_edit" id="run_spoint_use_edit">
                        <input hidden type="text" name="run_linenum_use_edit" id="run_linenum_use_edit">

                        <input hidden type="text" name="linenumUsedArray_edit" id="linenumUsedArray_edit" style="width:100%">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="select_edit_searchRunscreenTemp" id="select_edit_searchRunscreenTemp" class="form-control mb-2" placeholder="Search RunScreen Selected">
                        <label for="">Select Item : <span id="searchRunTempTitle_edit"></span> รายการ</label>
                        <div id="show_pick_runscreen2_edit"></div>
                    </div>
                </div>

            </div>

        </div>
    </form>
    </div>
</div>
<!-- Modal Create Template -->




<!-- Modal Edit Run Template -->
<div class="modal fade " id="edit_runscreen_selectTemplate_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form id="frm_edit_runscreen_edit" autocomplete="off">
        <div class="modal-content editRSC">
            <div class="modal-header">
                <span id="editRSCTitle_edit"></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="row form-group">
                    <div class="col-lg-6 form-group">
                        <label for="">Min Value</label>
                        <input type="text" name="editRSC_min_edit" id="editRSC_min_edit" class="form-control">
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="">Max Value</label>
                        <input type="text" name="editRSC_max_edit" id="editRSC_max_edit" class="form-control">
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="">SPoint Value</label>
                        <input type="text" name="editRSC_spoint_edit" id="editRSC_spoint_edit" class="form-control">
                    </div>
                </div>

                <input hidden type="text" name="editRSC_autoid_edit" id="editRSC_autoid_edit">
                <input hidden type="text" name="editRSC_templatename_edit" id="editRSC_templatename_edit">

                <div class="row form-group">
                    <div class="col-lg-12">
                        <button type="button" class="button button-green" id="save_frm_edit_runscreen_edit">บันทึก</button>
                        <button type="button" class="button button-red" id="cancel_frm_edit_runscreen_edit" data-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>

            </div>
        </div>
        </form>
    </div>
</div>
<!-- Modal Create Template -->



<!-- Modal Edit Run Template -->
<div class="modal fade " id="spinner_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content editRSC">
            
            <div class="modal-body">
                
            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>

            </div>
        </div>
    </div>
</div>
<!-- Modal Create Template -->





<!-- Modal Edit Run Template -->
<div class="modal fade " id="overall_selectTemplate_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">

        <div class="modal-content">
            <div class="modal-header">
                <span id="overall_title"></span>
                <button type="button" class="close close_overall" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div id="show_overall_table"></div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Modal Create Template -->




<script>
    $(document).ready(function(){


        $('#btnSelectTemplate_edit').click(function(){

            const templatename = $('#select_check_templatename').val();
            const templateitemuse = $('#select_check_templateitemuse').val();
            const templateimage = $('#select_check_templateimage').val();
            const ecode = $('#checkSessionEcode').val();

            // Check ก่อนว่ามีคนอื่นแก้ไขรายการนี้อยู่หรือไม่
            checkDataTempBefore(templatename , templateitemuse , templateimage , ecode);
            // Check ก่อนว่ามีคนอื่นแก้ไขรายการนี้อยู่หรือไม่

        });

        $('#btnSelectTemplate_canceledit').click(function(){
            $('.select_showdata').css('display' , '');
            $('.select_editdata').css('display' , 'none');

            $('#btnSelectTemplate_edit').css('display' , '');
            $('#btnSelectTemplate_canceledit').css('display' , 'none');

            $('#btnSaveSelectTemplate_edit').css('display' , 'none');

            $('#select_edit_template_name_new , #select_edit_template_itemid_new').val('');
            
        });


        $('#btnSelectTemplate_delete').click(function(){
            const templatename = $('#select_check_templatename').val();
            if(confirm('คุณต้องการลบ Template นี้ใช่หรือไม่') == true){
                deleteTemplate(templatename);
            }
            
        });


        $('#select_edit_template_name').keyup(function(){
            const templatenamenew = $(this).val();
            $('#select_edit_template_name_new').val(templatenamenew);
            if($(this).val() == $('#select_check_templatename').val()){
                $('#select_edit_template_name_new').val('');
            }
        });

        $('#select_edit_template_itemid').keyup(function(){
            const templateitemidnew = $(this).val();
            $('#select_edit_template_itemid_new').val(templateitemidnew);
            if($(this).val() == $('#select_check_templateitemuse').val()){
                $('#select_edit_template_itemid_new').val('');
            }
        });


        $('#select_edit_searchRunscreenMaster').keyup(function(){
                const linenum = $('#linenumUsedArray_edit').val();
                const searchRunMaster = $('#select_edit_searchRunscreenMaster').val();
                loadRunScrMasUsed_edit( linenum , 'edit_template' , searchRunMaster);
            
        });

        $('#select_edit_searchRunscreenTemp').keyup(function(){
            const templatename = $('#select_check_templatename').val();
            const searchRunTemp = $('#select_edit_searchRunscreenTemp').val();
            loadRunScrFromTempTable_edit(templatename , 'edit_template' , searchRunTemp);
        });


        $('#searchRunscreenMaster_edit').keyup(function(){
            const value = $(this).val().toLowerCase();
            $('.runScSelectLi').filter(function(){
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });



        // Function Run Screen Master
        
        $(document).on('click' , '.runScMaster_attr_edit',function(){

            // Check Input null
            if($('#select_edit_template_name').val() != "" && $('#select_edit_template_itemid').val() != ""){

                    $('#select_edit_template_name').removeClass("inputNull").addClass("inputSuccess");
                    $('#select_edit_template_itemid').removeClass("inputNull").addClass("inputSuccess");

                    const data_run_autoid = $(this).attr("data_run_autoid");
                    const data_run_name = $(this).attr("data_run_name");
                    const data_run_minvalue = $(this).attr("data_run_minvalue");
                    const data_run_maxvalue = $(this).attr("data_run_maxvalue");
                    const data_run_spoint = $(this).attr("data_run_spoint");
                    const data_run_linenum = $(this).attr("data_run_linenum");
                    const data_run_type = $(this).attr("data_run_type");

                    $('#run_name_use_edit').val(data_run_name);
                    $('#run_type_use_edit').val(data_run_type);
                    $('#run_minvalue_use_edit').val(data_run_minvalue);
                    $('#run_maxvalue_use_edit').val(data_run_maxvalue);
                    $('#run_spoint_use_edit').val(data_run_spoint);
                    $('#run_linenum_use_edit').val(data_run_linenum);


                    // Check Array value
                    if($('#linenumUsedArray_edit').val() == ""){
                        objGroup = [];
                        objGroup.push(data_run_linenum);
                        $('#linenumUsedArray_edit').val(objGroup);
                    }else{
                        const stringArray = $('#linenumUsedArray_edit').val();
                        let arrayFromCon = stringArray.split(",");
                        arrayFromCon.push(data_run_linenum);
                        $('#linenumUsedArray_edit').val(arrayFromCon);
                        console.log(arrayFromCon);
                    }

                    // checkTemplateNameDuplicate2_edit(template_newname);
                    saveRunScrToTempTable_edit();
                


            }else{
                $('#select_edit_template_name , #select_edit_template_itemid').addClass("inputNull");
                $('#alert_select_edit_template').fadeIn();
                $('#alert_select_edit_template').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>กรุณากรอกข้อมูลที่สำคัญให้ครบถ้วนด้วยค่ะ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                $('#alert_select_edit_template').delay(2000).fadeOut(500);
            }
        });



        $(document).on('click' , '.runScMasTempI_edit' , function(){
            const data_mat_autoid = $(this).attr("data_mat_autoid");
            const data_mat_master_linenum = $(this).attr("data_mat_master_linenum");
            const data_mat_machine_name = $(this).attr("data_mat_machine_name");

            let linenumUsedRe = $('#linenumUsedArray_edit').val();
            const usingSpread = linenumUsedRe.split(",");

            let masterLinenum = usingSpread.filter(function(value , index , arr){
                return value != data_mat_master_linenum;
            });

            $('#linenumUsedArray_edit').val(masterLinenum);
            loadRunScrMasUsed_edit($('#linenumUsedArray_edit').val() , 'edit_template' , $('#select_edit_searchRunscreenMaster').val());
            countTotalRunmaster_edit($('#linenumUsedArray_edit').val());
            delRunScrFromTempTable_edit(data_mat_autoid , data_mat_machine_name);

            console.log("Old"+usingSpread+" New"+masterLinenum);
            
        });



        $(document).on('click' , '.runScMasTempIedit_edit' , function(){
            const data_mat_autoid = $(this).attr("data_mat_autoid");
            const data_mat_min_value = $(this).attr("data_mat_min_value");
            const data_mat_max_value = $(this).attr("data_mat_max_value");
            const data_mat_spoint_value = $(this).attr("data_mat_spoint_value");
            const data_mat_column_name = $(this).attr("data_mat_column_name");
            const data_mat_machine_type = $(this).attr("data_mat_machine_type");
            const data_mat_machine_name = $(this).attr("data_mat_machine_name");

            $('#edit_runscreen_selectTemplate_modal').modal('show');

            $('#editRSCTitle_edit').html('<b>'+data_mat_column_name+'</b>');
            $('#editRSC_min_edit').val(data_mat_min_value);
            $('#editRSC_max_edit').val(data_mat_max_value);
            $('#editRSC_spoint_edit').val(data_mat_spoint_value);
            $('#editRSC_autoid_edit').val(data_mat_autoid);
            $('#editRSC_templatename_edit').val(data_mat_machine_name);

        });


        $('#save_frm_edit_runscreen_edit').click(function(){
            save_edittemplate_editrun();
        });



        $(document).on('click' , '.runScUpI_edit' , function(){
            
            const data_mat_autoid = $(this).attr("data_mat_autoid");
            const data_mat_linenum = $(this).attr("data_mat_linenum");

            console.log(data_mat_linenum);
            // Show ข้อมูล linenum ปัจจุบัน
            updateLinenumUp_edit(data_mat_linenum , data_mat_autoid);

        });


        $(document).on('click' , '.runScDownI_edit' , function(){
            
            const data_mat_autoid = $(this).attr("data_mat_autoid");
            const data_mat_linenum = $(this).attr("data_mat_linenum");

            console.log(data_mat_linenum);
            // Show ข้อมูล linenum ปัจจุบัน
            let checkAfterLinenumNow = parseFloat(data_mat_linenum) + 1;

            updateLinenumDown_edit(data_mat_linenum , data_mat_autoid);

        });


        $('#btnSaveSelectTemplate_edit').click(function(){
            const oldtemplate = $('#select_check_templatename').val();
            const editfile = $('input:file[id="select_edit_template_image"]').val();
            const templatename = $('#select_edit_template_name').val();
            const itemid = $('#select_edit_template_itemid').val();
            const checkTname = $('#select_edit_template_name_new').val();
            const checkItemId = $('#select_edit_template_itemid_new').val();
            checkEditTemplateDuplicate(oldtemplate , editfile , templatename , itemid , checkTname , checkItemId);

        });

        $('#select_edit_template_itemid').keyup(function(){
            if($(this).val() != ""){
                loadItemidFormTable_edit($(this).val());
            }else{
                $('#create_new_template_itemid_search_edit').html('');
            }
        });

        $(document).on('click' , '#itemidA_edit' ,function(){
            const data_itemid = $(this).attr("data_itemid");
            $('#select_edit_template_itemid').val(data_itemid);
            $('#select_edit_template_itemid_new').val(data_itemid);
            $('#create_new_template_itemid_search_edit').html('');
        });



        $('#btnSelectTemplate_overall').click(function (){
            $('#select_template_modal').modal('hide');
            $('#overall_selectTemplate_modal').modal('show');

            const templatename = $('#select_check_templatename').val();
            let ovrTitle = '<b>Template Name : </b>'+templatename;
            $('#overall_title').html(ovrTitle);
            // Run function call data
            overall_template(templatename);

            
        });



        $(document).on('click' , '.select_template_modal_close' , function(){
            const templatename = $('#select_check_templatename').val();
            const ecode = $('#checkSessionEcode').val();
            del_dataFromTemptableBy_templatename(templatename,ecode);
        });


        $(document).on('click' , '.close_overall' , function (){
            const templatename = $('#select_check_templatename').val();
            const ecode = $('#checkSessionEcode').val();
            del_dataFromTemptableBy_templatename(templatename,ecode);
        });



        
    });//End Ready Function
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////End Ready Function
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





    // FUNCTION ZONE
    const loadFileCreateEdit = function(event) {
        const reader = new FileReader();
        reader.onload = function(){
        const output = document.getElementById('select_edit_template_imageshow');
        output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);

        uploadImageOnly();
    };

    function uploadImageOnly()
    {
        const form = $("#frm_saveEditTemplate")[0];
        const data = new FormData(form);

        $.ajax({
            url: "/intsys/msd/main/machine/uploadImageOnly_edit",
            type: "POST",
            enctype: "multipart/form-data",
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function () {},
            success: function (res) {
            console.log(JSON.parse(res));

            },
        });
    }


    function loadDataTemplate(templatename)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/loadDataTemplate",
            method:"POST",
            data:{
                templatename:templatename
            },
            beforeSend(){},
            success(res){
                console.log(JSON.parse(res));
                const templateimage = JSON.parse(res).ted_template_image;
                const templatename = JSON.parse(res).ted_template_name;
                const template_itemuse = JSON.parse(res).ted_template_itemuse;

                let imageurl;

                if(templateimage == "" || templateimage == null){
                    // default image
                    imageurl = "/intsys/msd/upload/noimage2.jpg";
                    $('#select_template_imageshow').attr("src" , imageurl);
                }else{
                    imageurl = "/intsys/msd/upload/images_template/"+templateimage;
                    $('#select_template_imageshow').attr("src" , imageurl);
                }

                $('#select_template_name').val(templatename);
                $('#select_template_itemid').val(template_itemuse);

                $('#select_check_templateimage').val(templateimage);
                $('#select_check_templateitemuse').val(template_itemuse);
                $('#selectTempTitle').html('<b>'+templatename+'</b>');

                loadRunscreenFromTemplate(templatename);
                
            }
        });
    }



    function loadDataTemplate_edit(templatename)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/loadDataTemplate",
            method:"POST",
            data:{
                templatename:templatename
            },
            beforeSend(){},
            success(res){
                console.log(JSON.parse(res));
                const templateimage = JSON.parse(res).ted_template_image;
                const templatename = JSON.parse(res).ted_template_name;
                const template_itemuse = JSON.parse(res).ted_template_itemuse;

                if(templateimage == "" || templateimage == null){
                    // default image
                    let imageurl = "/intsys/msd/upload/noimage2.jpg";
                    $('#select_edit_template_imageshow').attr("src" , imageurl);
                }else{
                    imageurl = "/intsys/msd/upload/images_template/"+templateimage;
                    $('#select_edit_template_imageshow').attr("src" , imageurl);
                }

                $('#select_edit_template_name').val(templatename);
                $('#select_edit_template_itemid').val(template_itemuse);

                // loadRunscreenFromTemplate_edit(templatename);
                
            }
        });
    }



    function loadRunscreenFromTemplate(templatename)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/loadRunscreenFromTemplate",
            method:"POST",
            data:{
                templatename:templatename
            },
            beforeSend(){},
            success(res){
                // console.log(res);
                $('#show_select_runscreen').html(res);
                countTotalRunMasterShow(templatename);
            }
        });
    }


    function loadRunscreenFromTemplate_edit(templatename , select_edit_searchRunscreenMaster)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/loadRunscreenFromTemplate",
            method:"POST",
            data:{
                templatename:templatename,
                select_edit_searchRunscreenMaster:select_edit_searchRunscreenMaster
            },
            beforeSend(){},
            success(res){
                // console.log(res);
                $('#show_select_runscreen_edit').html(res);
            }
        });
    }



    function copyOriTemplateToTemp_edit(templatename , itemuse , template_image)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/copyOriTemplateToTemp_edit",
            method:"POST",
            data:{
                templatename:templatename,
                itemuse:itemuse,
                template_image:template_image
            },
            beforeSend(){
            },
            success : function(res){
                console.log(JSON.parse(res));

                if(JSON.parse(res).status == "Insert Success"){
                    loadDataTemplate_edit(templatename);
                    loadRunScrFromTempTable_edit(templatename , 'edit_template' , $('#select_edit_searchRunscreenTemp').val());
                    const masterline = JSON.parse(res).masterlinenum;
                    $('#linenumUsedArray_edit').val(masterline);
                    countTotalRunTemp_edit(templatename);
                    // $('#show_runscreen_master2').html('');
                    countTotalRunmaster_edit($('#linenumUsedArray_edit').val());
                    loadRunScrMasUsed_edit($('#linenumUsedArray_edit').val() , 'edit_template' , $('#select_edit_searchRunscreenMaster').val());
                }
                
            }
        });
    }



    function loadRunScrFromTempTable_edit(templatename , action , searchSelectRun)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/loadRunScrFromTempTable",
            method:"POST",
            data:{
                templatename:templatename,
                action:action,
                searchSelectRun:searchSelectRun
            },
            beforeSend(){

            },
            success(res){
                // console.log(res);
                $('#show_pick_runscreen2_edit').html(res);
            }
        });
    }



    function countTotalRunTemp_edit(templatename)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/countTotalRunTemp",
            method:"POST",
            data:{templatename:templatename},
            beforeSend(){},
            success(res){
                console.log(JSON.parse(res));
                $('#searchRunTempTitle_edit').html(JSON.parse(res).countdata);
            }
        });
    }


    function countTotalRunmaster_edit(dataUse)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/countTotalRunmaster",
            method:"POST",
            data:{dataUse:dataUse},
            beforeSend(){},
            success(res){
                $('#searchRunTitle_edit').html(JSON.parse(res).countdata);
            }
        });
    }




    function loadRunScrMasUsed_edit(linenumUsed , action , searchMasterRun)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/getRunscreenMasterNew2",
            method:"POST",
            data:{
                linenumUsed:linenumUsed,
                action:action,
                searchMasterRun:searchMasterRun
            },
            beforeSend(){},
            success(res){
            // console.log(res);
                $("#show_runscreen_master3_edit").html(res);
            }
        });
    }



    function updateLinenumUp_edit(data_mat_linenum , data_mat_autoid)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/updateLinenumUp",
            method:"POST",
            data:{
                data_mat_linenum:data_mat_linenum,
                data_mat_autoid:data_mat_autoid
            },
            beforeSend(){
                console.log("กำลังดำเนินการ");
            },
            success(res){
                console.log(JSON.parse(res));
                console.log("ดำเนินการเสร็จสิ้น");
                const autoid = JSON.parse(res).autoid;
                // $('#runScMasTempLi_edit_'+autoid).addClass('runScMasTempLi_edit_ef');

                if(JSON.parse(res).status == "Change Position Success"){
                    loadRunScrFromTempTable_edit(JSON.parse(res).templatename , 'edit_template');
                }

            }
        });
    }


    function updateLinenumDown_edit(data_mat_linenum , data_mat_autoid)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/updateLinenumDown",
            method:"POST",
            data:{
                data_mat_linenum:data_mat_linenum,
                data_mat_autoid:data_mat_autoid
            },
            beforeSend(){},
            success(res){
                console.log(JSON.parse(res));

                if(JSON.parse(res).status == "Change Position Success"){
                    loadRunScrFromTempTable_edit(JSON.parse(res).templatename , 'edit_template');
                }
            }
        });
    }



    function delRunScrFromTempTable_edit(data_mat_autoid ,data_mat_machine_name)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/delRunScrFromTempTable",
            method:"POST",
            data:{
                data_mat_autoid:data_mat_autoid
            },
            beforeSend(){},
            success(res){
                console.log(res);
                if(JSON.parse(res).status == "Delete Success"){
                    loadRunScrFromTempTable_edit(data_mat_machine_name , 'edit_template' , $('#select_edit_searchRunscreenTemp').val());
                    countTotalRunTemp_edit(data_mat_machine_name);
                } 
            }
        });
    }



    // function checkTemplateNameDuplicate2_edit(template_newname)
    // {
    //     $.ajax({
    //         url:"/intsys/msd/main/machine/checkTemplateNameDuplicate",
    //         method:"POST",
    //         data:{
    //             template_newname:template_newname
    //         },
    //         beforeSend(){},
    //         success(res){
    //             // console.log(JSON.parse(res));
    //             if(JSON.parse(res).status == "Found Duplicate Template Name"){
    //                 $('#create_new_template_name').val('');

    //                 $('#create_new_template_name').removeClass("inputSuccess").addClass("inputNull");
    //                 $('#alert_create_new_template').fadeIn();
    //                 $('#alert_create_new_template').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>ชื่อ Template ซ้ำในระบบค่ะ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    //                 $('#alert_create_new_template').delay(2000).fadeOut(500);
    //                 $('#create_new_template_name').prop("readonly" , false);
    //             }else{
    //                 saveRunScrToTempTable();
    //             }
    //         }
    //     });
    // }




    function saveRunScrToTempTable_edit()
    {
        const form = $("#frm_saveEditTemplate")[0];
        const data = new FormData(form);

        $.ajax({
            url: "/intsys/msd/main/machine/saveRunScrToTempTable_edit",
            type: "POST",
            enctype: "multipart/form-data",
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function () {},
            success: function (res) {
            console.log(JSON.parse(res));

            let linenumUsed = $('#linenumUsedArray_edit').val();
            // let searchRun2 = $('#searchRunscreenMaster').val();

            if (JSON.parse(res).status == "Insert Success") {
  
                loadRunScrFromTempTable_edit(JSON.parse(res).templatename , 'edit_template' , $('#select_edit_searchRunscreenTemp').val());
                $("#show_runscreen_master2_edit").html('');
                loadRunScrMasUsed_edit(linenumUsed , 'edit_template' , $('#select_edit_searchRunscreenMaster').val());
                // countTotalRunmasterUse(linenumUsed);
                countTotalRunmaster_edit(linenumUsed);
                countTotalRunTemp_edit(JSON.parse(res).templatename);
            }

            },
        });
    }




    function saveDataToMachineTemplate_edit(oldtemplate , editfile , templatename , itemid , checkTname , checkItemId)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/saveDataToMachineTemplate_edit",
            method:"POST",
            data:{
                oldtemplate:oldtemplate,
                editfile:editfile,
                templatename:templatename,
                itemid:itemid,
                checkTname:checkTname,
                checkItemId:checkItemId
            },
            beforeSend(){},
            success(res){
                console.log(JSON.parse(res));
                if(JSON.parse(res).status == "Insert Success"){
                    $('input:file[id="select_edit_template_image"]').val('');
                    $('#select_template_modal').modal("hide");
                    loadTemplateBox();
                }
            }
        });
    }



    function deleteTemplate(templatename , filename)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/deleteTemplate",
            method:"POST",
            data:{
                templatename:templatename,
                filename:filename
            },
            beforeSend(){

            },
            success(res){
                console.log(JSON.parse(res));
            
                if(JSON.parse(res).status == "Delete Template Success"){
                    $('#select_template_modal').modal('hide');
                    loadTemplateBox();
                }
            }
        });
    }





    function loadItemidFormTable_edit(itemid)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/loadItemidFormTable_edit",
            method:"POST",
            data:{itemid:itemid},
            beforeSend(){},
            success(res){
                $('#create_new_template_itemid_search_edit').html(res);
            }
        });
    }



    function checkEditTemplateDuplicate(oldtemplate , editfile , templatename , itemid , checkTname , checkItemId)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/checkEditTemplateDuplicate",
            method:"POST",
            data:{
                checkTname:checkTname
            },
            beforeSend(){},
            success(res){
                console.log(JSON.parse(res));
                if(JSON.parse(res).status == "Found Duplicate Template Name"){
                    $('#alert_select_edit_template').fadeIn();
                    $('#alert_select_edit_template').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>'+JSON.parse(res).msg+'</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    $('#alert_select_edit_template').delay(2000).fadeOut(500);

                    $('#select_edit_template_name').removeClass("inputSuccess").addClass("inputNull");
                }else{
                    $('#alert_select_edit_template').html('');
                    $('#select_edit_template_name').removeClass("inputNull").addClass("inputSuccess");
                    saveDataToMachineTemplate_edit(oldtemplate , editfile , templatename , itemid , checkTname , checkItemId);
                }
            }
        });
    }


    function save_edittemplate_editrun()
    {
        $.ajax({
            url:"/intsys/msd/main/machine/save_edittemplate_editrun",
            method:"POST",
            data:$('#frm_edit_runscreen_edit').serialize(),
            beforeSend(){},
            success(res){
                console.log(res);
                if(JSON.parse(res).status == "Update Success"){
                    const templatename = JSON.parse(res).templatename;
                    loadRunScrFromTempTable_edit(templatename , 'edit_template' , $('#select_edit_searchRunscreenTemp').val());
                    $('#edit_runscreen_selectTemplate_modal').modal('hide');
                }
                
            }
        });
    }


    function countTotalRunMasterShow(templatename)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/countTotalRunMasterShow",
            method:"POST",
            data:{
                templatename:templatename
            },
            beforeSend(){},
            success(res){
                $('#searchRunTitle_edit1').html(res);
            }
        });
    }

    function overall_template(templatename)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/overall_template",
            method:"POST",
            data:{
                templatename:templatename
            },
            beforeSend(){},
            success(res){
                $('#show_overall_table').html(res);
            }
        });
    }


    function checkDataTempBefore(templatename , templateitemuse , templateimage , ecode)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/checkDataTempBefore",
            method:"POST",
            data:{
                templatename:templatename,
                ecode:ecode
            },
            beforeSend:function(){},
            success:function(res){
                console.log(JSON.parse(res));
                if(JSON.parse(res).status == "Found other user edit template"){
                    alert(JSON.parse(res).msg);
                    $('#select_template_modal').modal('hide');
                }else if(JSON.parse(res).status == "Clear data"){
                    del_dataFromTemptableBy_templatename(templatename,ecode);
                    copyOriTemplateToTemp_edit(templatename , templateitemuse , templateimage);

                    $('.select_showdata').css('display' , 'none');
                    $('.select_editdata').css('display' , '');
                    $('#select_edit_template_image').val('');

                    $('#btnSelectTemplate_edit').css('display' , 'none');
                    $('#btnSelectTemplate_canceledit').css('display' , '');
                    $('#btnSaveSelectTemplate_edit').css('display' , '');

                    $('#select_edit_template_name , #select_edit_template_itemid').removeClass('inputSuccess').removeClass('inputNull');
                    $('#select_edit_searchRunscreenMaster , #select_edit_searchRunscreenTemp').val('');
                }else if(JSON.parse(res).status == "Ok"){
                    copyOriTemplateToTemp_edit(templatename , templateitemuse , templateimage);
                    // console.log(templatename+"---"+templateitemuse+"---"+templateimage);
                    $('.select_showdata').css('display' , 'none');
                    $('.select_editdata').css('display' , '');
                    $('#select_edit_template_image').val('');

                    $('#btnSelectTemplate_edit').css('display' , 'none');
                    $('#btnSelectTemplate_canceledit').css('display' , '');
                    $('#btnSaveSelectTemplate_edit').css('display' , '');

                    $('#select_edit_template_name , #select_edit_template_itemid').removeClass('inputSuccess').removeClass('inputNull');
                    $('#select_edit_searchRunscreenMaster , #select_edit_searchRunscreenTemp').val('');
                }
            }
        });
    }






</script>