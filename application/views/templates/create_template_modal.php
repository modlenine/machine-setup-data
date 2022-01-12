
<!-- For New Template -->
<div class="modal fade " id="create_new_template_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <form id="frm_savenew_template" autocomplete="off">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">สร้าง Template ใหม่</h5>

                <button type="button" class="close create_new_template_modal_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-header">
                <div class="col-md-12 form-inline mb-2" id="box_run_type">
                    <div class="form-group pr-2">
                        <input type="radio" name="new_types" id="new_templates" value="new" class="rd18">&nbsp;<i class="icon-line-file-add newTempIcon"></i><label for="new_templates">New</label>
                    </div>
                    <div class="form-group pl-2">
                        <input type="radio" name="new_types" id="copy_templates" value="copy" class="rd18">&nbsp;<i class="icon-copy1 copyTempIcon"></i><label for="copy_templates">Copy</label>
                    </div>
                </div>
            </div>

            <input hidden type="text" name="check_new_types" id="check_new_types">
            <input hidden type="text" name="check_template_nameKey" id="check_template_nameKey">
            <!-- Section ของการ New Template -->
                <div class="modal-header subhead newTemplateSection1">
                    <button type="button" id="btnSaveToMachineTemplate" class="button button-green">บันทึก</button>
                    <button type="button" id="btnCancelMachineTemplate" class="button button-red create_new_template_modal_close" data-dismiss="modal">ยกเลิก</button>
                </div>
                <div class="modal-body newTemplateSection1">
            
                    <div class="row form-group">
                        <div class="col-md-4">
                            <img id="create_new_template_imageshow" width="200" height="200">
                        </div>
                        <div class="col-md-8">

                            <div class="row form-group">
                                <div class="col">
                                    <label>ชื่อ Template : </label>
                                    <input type="text" name="create_new_template_name" id="create_new_template_name" class="form-control">
                                </div>
                            </div>

                            <div id="forCopyTemplate" class="row form-group" style="display:none;">
                                <div class="col">
                                    <label>Template ต้นฉบับ</label>
                                    <input type="text" name="create_new_template_name_old" id="create_new_template_name_old" class="form-control">
                                    <input hidden type="text" name="create_new_template_name_old_use" id="create_new_template_name_old_use">
                                    <div id="showOldTemplate"></div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col">
                                    <label>Product ที่ใช้งาน : </label>
                                    <input type="text" name="create_new_template_itemid" id="create_new_template_itemid" class="form-control text-uppercase">
                                    <div id="create_new_template_itemid_search"></div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col">
                                    <label for="">อัพโหลดรูปภาพ Template</label>
                                    <input type="file" name="ted_template_image[]" id="ted_template_image" accept="image/*" onchange="loadFileCreate(event)" class="form-control">
                                    <input hidden type="text" name="ted_template_image_copy" id="ted_template_image_copy">
                                </div>
                            </div>

                            
                        </div>
                    </div>

                    <div id="alert_create_new_template"></div>
                    <div class="divider divider-center"><i class="icon-line-chevron-down"></i></div>

                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="searchRunscreenMaster" id="searchRunscreenMaster" class="form-control mb-2" placeholder="Search RunScreen Master">
                            <label for="">Total Item : <span id="searchRunTitle"></span> รายการ</label>
                            <div id="show_runscreen_master2"></div>
                            <div id="show_runscreen_master3"></div>
                            <!-- Input Zone -->
                            <input  type="text" name="run_name_use" id="run_name_use">
                            <input  type="text" name="run_type_use" id="run_type_use">
                            <input  type="text" name="run_minvalue_use" id="run_minvalue_use">
                            <input  type="text" name="run_maxvalue_use" id="run_maxvalue_use">
                            <input  type="text" name="run_spoint_use" id="run_spoint_use">
                            <input  type="text" name="run_linenum_use" id="run_linenum_use">
                            <input hidden type="text" name="linenumUsedArray" id="linenumUsedArray" style="width:100%">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="searchRunscreenTemp" id="searchRunscreenTemp" class="form-control mb-2" placeholder="Search RunScreen Selected">
                            <label for="">Select Item : <span id="searchRunTempTitle"></span> รายการ</label>
                            <div id="show_pick_runscreen2"></div>
                        </div>
                    </div>
                    <div id="showQuery"></div>
                </div>
            <!-- Section ของการ New Template -->


        </div>
    </form>
    </div>
</div>
<!-- For New Template -->




<!-- Modal Edit Run Template -->
<div class="modal fade " id="edit_runscreen_newtemplate_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form id="frm_edit_runscreen_newtemplate" autocomplete="off">
        <div class="modal-content editRSC">
            <div class="modal-header">
                <span id="editRSCTitle"></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="row form-group">
                    <div class="col-lg-6 form-group">
                        <label for="">Min Value</label>
                        <input type="text" name="editRSC_min" id="editRSC_min" class="form-control">
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="">Max Value</label>
                        <input type="text" name="editRSC_max" id="editRSC_max" class="form-control">
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="">SPoint Value</label>
                        <input type="text" name="editRSC_spoint" id="editRSC_spoint" class="form-control">
                    </div>
                </div>

                <input hidden type="text" name="editRSC_autoid" id="editRSC_autoid">
                <input hidden type="text" name="editRSC_templatename" id="editRSC_templatename">

                <div class="row form-group">
                    <div class="col-lg-12">
                        <button type="button" class="button button-green" id="save_frm_edit_runscreen_newtemplate">บันทึก</button>
                        <button type="button" class="button button-red" id="cancel_frm_edit_runscreen_newtemplate" data-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>

            </div>
        </div>
        </form>
    </div>
</div>
<!-- Modal Create Template -->













<script>
    $(document).ready(function(){

        //check for Navigation Timing API support
        // if (window.performance) {
        // console.info("window.performance works fine on this browser");
        // }
        // console.info("type : "+performance.navigation.type);

        if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
            console.info( "This page is reloaded" );
            const ecode = $('#checkSessionEcode').val();
            del_dataFromTemptable_whenReloadPageByEcode(ecode);
        } else {
            console.info( "This page is not reloaded");
        }

        let objGroup = [];


        $('#btnCreateTemplateMain').click(function(){
            $('input:radio[name="new_types"]').prop('checked' , false);
            $('.newTemplateSection1').css('display' , 'none');
            // truncate_machine_template_temp();
        });

        $('#create_new_template_itemid').keyup(function(){
            if($(this).val() != ""){
                loadItemidFormTable($(this).val());
            }else{
                $('#create_new_template_itemid_search').html('');
            }
        });

        $(document).on('click' , '#itemidA' ,function(){
            const data_itemid = $(this).attr("data_itemid");
            $('#create_new_template_itemid').val(data_itemid);
            $('#create_new_template_itemid_search').html('');
        });

        $('input:radio[name="new_types"]').click(function(){
            // truncate_machine_template_temp();
            // ลบข้อมูลใน Temp table เมื่อมีการ Toggle ไปมา
            if($('#check_template_nameKey').val() != ""){
                const templatename = $('#check_template_nameKey').val();
                const ecode = $('#checkSessionEcode').val();
                del_dataFromTemptableBy_templatename(templatename , ecode);
            }

            $('#create_new_template_name_old_use').val('');
            $('#ted_template_image_copy').val('');
            $('#searchRunscreenMaster , #searchRunscreenTemp').val('');

            $('#check_new_types').val($(this).val());
            if($(this).val() == "new"){
                objGroup = [];
                $('.newTemplateSection1').css('display' , '');
                $('#forCopyTemplate').css('display' , 'none');
                 // Truncate Temp table frist

                //Clear data on input
                $('#create_new_template_name').prop("readonly" , false).removeClass("inputNull inputSuccess");
                $('#create_new_template_itemid').prop("readonly" , false).removeClass("inputNull inputSuccess");
                $('#show_pick_runscreen2').html('');
                $('#ted_template_image').val('');
                $('input:file').val('');
                $('#create_new_template_name').val('');
                $('#create_new_template_itemid').val('');
                //Clear data on input
                $('#show_runscreen_master3').html('');
                $('#linenumUsedArray').val('');

                // $('#create_new_template_modal').modal("show");
                // $('#create_template_modal').modal("hide");

                // default image
                const imageurl = "/intsys/msd/upload/noimage2.jpg";
                $('#create_new_template_imageshow').attr("src" , imageurl);

                //Load Runscreen Master
                

                // getRunscreenMasterNew();
                getRunscreenMasterNew_search();
                $('#searchRunscreenMaster').keyup(function(){
                    if($(this).val() != ""){
                        if($('#linenumUsedArray').val() != ""){
                            loadRunScrMasUsed($('#linenumUsedArray').val() , $('#searchRunscreenMaster').val());
                        }else{
                            getRunscreenMasterNew_search($(this).val());
                            $('#show_runscreen_master3').html('');
                        }
                    }else{
                        if($('#linenumUsedArray').val() != ""){
                            loadRunScrMasUsed($('#linenumUsedArray').val() , $('#searchRunscreenMaster').val());
                        }else{
                            getRunscreenMasterNew_search();
                        }
                    }
                });


                $('#searchRunscreenTemp').keyup(function(){
                    if($(this).val() != ""){
                        loadRunScrFromTempTable($('#create_new_template_name').val() , $(this).val());
                    }else{
                        loadRunScrFromTempTable($('#create_new_template_name').val());
                    }
                });


                const dataUse = $('#linenumUsedArray').val();
                countTotalRunmaster(dataUse);
                countTotalRunTemp($('#create_new_template_name').val());
                // loadRunScrMasUsed(linenumUsed);

                // $('#searchRunscreenMaster').keyup(function(){
                //     const value = $(this).val().toLowerCase();
                //     $('.runScMasLi').filter(function(){
                //         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                //     });
                // });

                // $('#searchRunscreenTemp').keyup(function(){
                //     const value = $(this).val().toLowerCase();
                //     $('.runScMasTempLi').filter(function(){
                //         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                //     });
                // });

            }else if($(this).val() == "copy"){
                objGroup = [];
                $('.newTemplateSection1').css('display' , '');
                $('#forCopyTemplate').css('display' , '');
                

                // truncate_machine_template_temp();

                //Clear data on input
                $('#create_new_template_name').prop("readonly" , false).removeClass("inputNull inputSuccess");
                $('#create_new_template_itemid').prop("readonly" , false).removeClass("inputNull inputSuccess");
                $('#show_pick_runscreen2').html('');
                $('#ted_template_image').val('');
                $('input:file').val('');
                $('#create_new_template_name').val('');
                $('#create_new_template_itemid').val('');
                $('#create_new_template_name_old').val('');
                //Clear data on input
                
                $('#show_runscreen_master3 , #show_runscreen_master2').html('');
                $('#linenumUsedArray').val('');

                // $('#create_new_template_modal').modal("show");
                // $('#create_template_modal').modal("hide");

                // default image
                const imageurl = "/intsys/msd/upload/noimage2.jpg";
                $('#create_new_template_imageshow').attr("src" , imageurl);

                //Load Runscreen Master
                // getRunscreenMasterNew();

                $('#searchRunscreenMaster').keyup(function(){
                    if($(this).val() != ""){
                        if($('#linenumUsedArray').val() != ""){
                            loadRunScrMasUsed($('#linenumUsedArray').val() , $('#searchRunscreenMaster').val());
                        }else{
                            getRunscreenMasterNew_search($(this).val());
                            $('#show_runscreen_master3').html('');
                        }
                    }else{
                        if($('#linenumUsedArray').val() != ""){
                            loadRunScrMasUsed($('#linenumUsedArray').val() , $('#searchRunscreenMaster').val());
                        }else{
                            getRunscreenMasterNew_search();
                        }
                    }
                });


                $('#searchRunscreenTemp').keyup(function(){
                    if($(this).val() != ""){
                        loadRunScrFromTempTable($('#create_new_template_name').val() , $(this).val());
                    }else{
                        loadRunScrFromTempTable($('#create_new_template_name').val());
                    }
                });

                const dataUse = $('#linenumUsedArray').val();
                countTotalRunmaster(dataUse);
                countTotalRunTemp();
                // loadRunScrMasUsed(linenumUsed);

                // $('#searchRunscreenMaster').keyup(function(){
                //     const value = $(this).val().toLowerCase();
                //     $('.runScMasLi').filter(function(){
                //         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                //     });
                // });

                // $('#searchRunscreenTemp').keyup(function(){
                //     const value = $(this).val().toLowerCase();
                //     $('.runScMasTempLi').filter(function(){
                //         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                //     });
                // });
            }
        });





        $(document).on('click' , '.create_new_template_modal_close' , function(){

            const templatename = $('#check_template_nameKey').val();
            const ecode = $('#checkSessionEcode').val();

            if(templatename != ""){
                del_dataFromTemptableBy_templatename(templatename,ecode);
                $('#check_template_nameKey , #check_new_types').val('');
            }
            
        });

        $('#create_new_template_name').keyup(function(){
            $('#check_template_nameKey').val($(this).val());
        });



        // Function Run Screen Master
        
        $(document).on('click' , '#runScMaster_attr',function(){

            // Check Input null
            if($('#create_new_template_name').val() != ""){

                

                $('#create_new_template_name').prop("readonly" , true).removeClass("inputNull").addClass("inputSuccess");
                // $('#create_new_template_itemid').prop("readonly" , true).removeClass("inputNull").addClass("inputSuccess");

                const data_run_autoid = $(this).attr("data_run_autoid");
                const data_run_name = $(this).attr("data_run_name");
                const data_run_minvalue = $(this).attr("data_run_minvalue");
                const data_run_maxvalue = $(this).attr("data_run_maxvalue");
                const data_run_spoint = $(this).attr("data_run_spoint");
                const data_run_linenum = $(this).attr("data_run_linenum");
                const data_run_type = $(this).attr("data_run_type");

                $('#run_name_use').val(data_run_name);
                $('#run_type_use').val(data_run_type);
                $('#run_minvalue_use').val(data_run_minvalue);
                $('#run_maxvalue_use').val(data_run_maxvalue);
                $('#run_spoint_use').val(data_run_spoint);
                $('#run_linenum_use').val(data_run_linenum);

                // Check Array value
                if($('#linenumUsedArray').val() == ""){
                    objGroup=[];
                    objGroup.push(data_run_linenum);
                    $('#linenumUsedArray').val(objGroup);
                }else{
                    const stringArray = $('#linenumUsedArray').val();
                    let arrayFromCon = stringArray.split(",");
                    arrayFromCon.push(data_run_linenum);
                    $('#linenumUsedArray').val(arrayFromCon);
                    console.log(arrayFromCon);
                }

                const template_newname = $('#create_new_template_name').val();
                checkTemplateNameDuplicate2(template_newname);


            }else{
                $('#create_new_template_name').addClass("inputNull");
                $('#alert_create_new_template').fadeIn();
                $('#alert_create_new_template').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>กรุณากรอกข้อมูลที่สำคัญให้ครบถ้วนด้วยค่ะ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                $('#alert_create_new_template').delay(2000).fadeOut(500);
            }
        });


        let masLinenum = [];
        let delRun;
        $(document).on('click' , '.runScMasTempI' , function(){
            if($('#check_new_types').val() == "new"){
                const data_mat_autoid = $(this).attr("data_mat_autoid");
                const data_mat_master_linenum = $(this).attr("data_mat_master_linenum");
                const data_mat_machine_name = $(this).attr("data_mat_machine_name");

                const getarray = $('#linenumUsedArray').val();
                let splitArr = getarray.split(",");
                splitArr = splitArr.filter(function(value , index , arr){
                    return value != data_mat_master_linenum;
                });
                $('#linenumUsedArray').val(splitArr);
                let linenumUsedRes = $('#linenumUsedArray').val();
                loadRunScrMasUsed(linenumUsedRes , $('#searchRunscreenMaster').val());
                countTotalRunmaster(linenumUsedRes);
                delRunScrFromTempTable(data_mat_autoid , data_mat_machine_name);
            }else if($('#check_new_types').val() == "copy"){
                const data_mat_autoid = $(this).attr("data_mat_autoid");
                const data_mat_master_linenum = $(this).attr("data_mat_master_linenum");
                const data_mat_machine_name = $(this).attr("data_mat_machine_name");

                let linenumUsedRe = $('#linenumUsedArray').val();
                const usingSpread = linenumUsedRe.split(",");

                let masterLinenum = usingSpread.filter(function(value , index , arr){
                    return value != data_mat_master_linenum;
                });

                $('#linenumUsedArray').val(masterLinenum);
                loadRunScrMasUsed($('#linenumUsedArray').val() , $('#searchRunscreenMaster').val());
                countTotalRunmaster($('#linenumUsedArray').val());
                delRunScrFromTempTable(data_mat_autoid , data_mat_machine_name);


                console.log("Old"+usingSpread+" New"+masterLinenum);
            }


            
        });


        $(document).on('click' , '.runScDownI' , function(){
            
            const data_mat_autoid = $(this).attr("data_mat_autoid");
            const data_mat_linenum = $(this).attr("data_mat_linenum");

            console.log(data_mat_linenum);
            // Show ข้อมูล linenum ปัจจุบัน
            let checkAfterLinenumNow = parseFloat(data_mat_linenum) + 1;

            updateLinenumDown(data_mat_linenum , data_mat_autoid);

        });




        $(document).on('click' , '.runScUpI' , function(){
            
            const data_mat_autoid = $(this).attr("data_mat_autoid");
            const data_mat_linenum = $(this).attr("data_mat_linenum");

            console.log(data_mat_linenum);
            // Show ข้อมูล linenum ปัจจุบัน
            updateLinenumUp(data_mat_linenum , data_mat_autoid);

        });

        $(document).on('click' , '.runScMasTempIedit' , function(){
            const data_mat_autoid = $(this).attr("data_mat_autoid");
            const data_mat_min_value = $(this).attr("data_mat_min_value");
            const data_mat_max_value = $(this).attr("data_mat_max_value");
            const data_mat_spoint_value = $(this).attr("data_mat_spoint_value");
            const data_mat_column_name = $(this).attr("data_mat_column_name");
            const data_mat_machine_type = $(this).attr("data_mat_machine_type");
            const data_mat_machine_name = $(this).attr("data_mat_machine_name");

            let dataRunEditTitle = '<b>Name : </b>'+data_mat_column_name+' <b>Type : </b>'+data_mat_machine_type;

            $('#edit_runscreen_newtemplate_modal').modal("show");
            $('#editRSC_min').val(data_mat_min_value);
            $('#editRSC_max').val(data_mat_max_value);
            $('#editRSC_spoint').val(data_mat_spoint_value);
            $('#editRSCTitle').html(dataRunEditTitle);
            $('#editRSC_autoid').val(data_mat_autoid);
            $('#editRSC_templatename').val(data_mat_machine_name);
        });


        $('#save_frm_edit_runscreen_newtemplate').click(function(){
            save_frm_edit_runscreen_newtemplate();
        });


        $('#btnSaveToMachineTemplate').click(function(){
            // const itemid = $('#create_new_template_itemid').val();
            // const templatename = $('#create_new_template_name').val();
            // saveDataToMachineTemplate(itemid,templatename);
            // Check Template Click
            if($('#check_new_types').val() == "copy"){
                if($('#create_new_template_name_old_use').val() == ""){
                $('#alert_create_new_template').fadeIn();
                $('#alert_create_new_template').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>กรุณาเลือก Template ด้วยค่ะ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                $('#alert_create_new_template').delay(2000).fadeOut(500);
                }else{
                    uploadImageCopyToTemp();
                }
            }else{
                uploadImageCopyToTemp();
            }
            
            
        });

        $('#create_new_template_name_old').keyup(function(){
            if($(this).val() != ""){
                let templatename = $(this).val();
                loadOldTemplate(templatename);
            }else{
                $('#showOldTemplate').html('');
            }
        });

        $(document).on('click' , '.oldTemplateLi' , function(){
            const data_templatename = $(this).attr("data_templatename");
            const data_template_image = $(this).attr("data_template_image");
            const data_template_itemuse = $(this).attr("data_template_itemuse");
            const template_newname = $('#create_new_template_name').val();
            const itemused = $('#create_new_template_itemid').val();
            const template_image = $('#ted_template_image').val();

            // truncate_machine_template_temp();
            // Check input value
            if($('#create_new_template_name').val() == ""){
                $('#create_new_template_name ').removeClass("inputSuccess").addClass("inputNull");
                $('#alert_create_new_template').fadeIn();
                $('#alert_create_new_template').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>กรุณากรอกข้อมูลที่สำคัญให้ครบถ้วนด้วยค่ะ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                $('#alert_create_new_template').delay(2000).fadeOut(500);
            }else{
                $('#create_new_template_name_old').val(data_templatename);
                $('#create_new_template_name_old_use').val(data_templatename);
                $('#ted_template_image_copy').val(data_template_image);
                $('#create_new_template_itemid').val(data_template_itemuse);
                $('#showOldTemplate').html('');
                $('#create_new_template_name').removeClass("inputNull").addClass("inputSuccess").prop('readonly' , false);

                // default image
                let imageurl="";
                if(data_template_image == ""){
                    imageurl = "/intsys/msd/upload/noimage2.jpg";
                }else{
                    imageurl = "/intsys/msd/upload/images_template/"+data_template_image;
                }
                
                $('#create_new_template_imageshow').attr("src" , imageurl);

                // loadRunscreen(data_templatename);

                console.log(data_templatename+" "+template_newname+" "+template_image);
                // copyOriTemplateToTemp(data_templatename , template_newname , itemused , template_image);
                checkTemplateNameDuplicate(data_templatename , template_newname , itemused , template_image , data_template_image , data_template_itemuse);
                
            }

            
        });
        

    });//END Document Ready Function




//////////////////////////////////////////////////////////////////////////////////////////////
/////////////// Function Zone
    const loadFileCreate = function(event) {
        const reader = new FileReader();
        reader.onload = function(){
        const output = document.getElementById('create_new_template_imageshow');
        output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);

        // uploadImageOnly_create();
    };

    // function uploadImageOnly_create()
    // {
    //     const form = $("#frm_saveEditTemplate")[0];
    //     const data = new FormData(form);

    //     $.ajax({
    //         url: "/intsys/msd/main/machine/uploadImageOnly",
    //         type: "POST",
    //         enctype: "multipart/form-data",
    //         data: data,
    //         processData: false,
    //         contentType: false,
    //         beforeSend: function () {},
    //         success: function (res) {
    //         console.log(JSON.parse(res));

    //         },
    //     });
    // }



    function uploadImageCopyToTemp()
    {
        const form = $("#frm_savenew_template")[0];
        const data = new FormData(form);

        $.ajax({
            url: "/intsys/msd/main/machine/uploadImageCopyToTemp",
            type: "POST",
            enctype: "multipart/form-data",
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function () {},
            success: function (res) {
            console.log(JSON.parse(res));
                if(JSON.parse(res).status == "Upload File Success"){
                    const itemid = JSON.parse(res).itemid;
                    const templatename = JSON.parse(res).templatename;
                    saveDataToMachineTemplate(itemid,templatename);
                }
            },
        });
    }


    function saveRunScrToTempTable()
    {
        const form = $("#frm_savenew_template")[0];
        const data = new FormData(form);

        $.ajax({
            url: "/intsys/msd/main/machine/saveRunScrToTempTable",
            type: "POST",
            enctype: "multipart/form-data",
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function () {},
            success: function (res) {
            console.log(JSON.parse(res));

            let linenumUsed = $('#linenumUsedArray').val();
            const searchTempRun = $('#searchRunscreenTemp').val();
            const searchMasterRun = $('#searchRunscreenMaster').val();

            if (JSON.parse(res).status == "Insert Success") {
                let linenumOrder = "";
                loadRunScrFromTempTable(JSON.parse(res).templatename , searchTempRun);
                $("#show_runscreen_master2").html('');
                loadRunScrMasUsed(linenumUsed , searchMasterRun);
                // countTotalRunmasterUse(linenumUsed);
                countTotalRunmaster(linenumUsed);
                countTotalRunTemp(JSON.parse(res).templatename);
            }

            },
        });
    }


    function loadRunScrFromTempTable(templatename , searchSelectRun)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/loadRunScrFromTempTable",
            method:"POST",
            data:{
                templatename:templatename,
                searchSelectRun:searchSelectRun
            },
            beforeSend(){

            },
            success(res){
                // console.log(res);
                $('#show_pick_runscreen2').html(res);
            }
        });
    }





    function truncate_machine_template_temp()
    {
        $.ajax({
            url:"/intsys/msd/main/machine/truncate_machine_template_temp",
            method:"POST",
            data:{},
            beforeSend(){},
            success(res){
                console.log(JSON.parse(res));
            }
        });
    }


    function loadRunScrMasUsed(linenumUsed , searchMasterRun)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/getRunscreenMasterNew2",
            method:"POST",
            data:{
                linenumUsed:linenumUsed,
                searchMasterRun:searchMasterRun
            },
            beforeSend(){},
            success(res){
            // console.log(res);
                $("#show_runscreen_master3").html(res);
            }
        });
    }


    function delRunScrFromTempTable(data_mat_autoid ,data_mat_machine_name)
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
                    loadRunScrFromTempTable(data_mat_machine_name , $('#searchRunscreenTemp').val());
                    countTotalRunTemp(data_mat_machine_name);
                } 
            }
        });
    }


    function updateLinenumDown(data_mat_linenum , data_mat_autoid)
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
                    loadRunScrFromTempTable(JSON.parse(res).templatename);
                }
            }
        });
    }


    function updateLinenumUp(data_mat_linenum , data_mat_autoid)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/updateLinenumUp",
            method:"POST",
            data:{
                data_mat_linenum:data_mat_linenum,
                data_mat_autoid:data_mat_autoid
            },
            beforeSend(){},
            success(res){
                console.log(JSON.parse(res));
                if(JSON.parse(res).status == "Change Position Success"){
                    loadRunScrFromTempTable(JSON.parse(res).templatename);
                }
            }
        });
    }


    function countTotalRunmaster(dataUse)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/countTotalRunmaster",
            method:"POST",
            data:{dataUse:dataUse},
            beforeSend(){},
            success(res){
                $('#searchRunTitle').html(JSON.parse(res).countdata);
            }
        });
    }


    function countTotalRunmasterUse(dataUse)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/countTotalRunmaster",
            method:"POST",
            data:{dataUse:dataUse},
            beforeSend(){},
            success(res){
                console.log(JSON.parse(res));
                $('#searchRunTitle').html(JSON.parse(res).countdata);
            }
        });
    }


    function countTotalRunTemp(templatename)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/countTotalRunTemp",
            method:"POST",
            data:{
                templatename:templatename
            },
            beforeSend(){},
            success(res){
                console.log(JSON.parse(res));
                $('#searchRunTempTitle').html(JSON.parse(res).countdata);
            }
        });
    }


    function save_frm_edit_runscreen_newtemplate()
    {
        $.ajax({
            url:"/intsys/msd/main/machine/save_frm_edit_runscreen_newtemplate",
            method:"POST",
            data:$('#frm_edit_runscreen_newtemplate').serialize(),
            beforeSend(){},
            success(res){
                console.log(JSON.parse(res));
                $('#edit_runscreen_newtemplate_modal').modal("hide");
                loadRunScrFromTempTable(JSON.parse(res).templatename);
            }
        });
    }


    function loadLinenumFromTemp()
    {
        $.ajax({
            url:"/intsys/msd/main/machine/loadLinenumFromTemp",
            method:"POST",
            data:{},
            beforeSend(){},
            success(res){
                console.log(JSON.parse(res));
            }
        });
    }

    function saveDataToMachineTemplate(itemid,templatename)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/saveDataToMachineTemplate",
            method:"POST",
            data:{
                itemid:itemid,
                templatename:templatename

            },
            beforeSend(){},
            success(res){
                console.log(JSON.parse(res));
                if(JSON.parse(res).status == "Insert Success"){
                    $('#create_new_template_modal').modal("hide");
                    $('#check_new_types , #check_template_nameKey').val('');
                    loadTemplateBox();
                }
            }
        });
    }


    function loadOldTemplate(templatename)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/loadOldTemplate",
            method:"POST",
            data:{
                templatename:templatename
            },
            beforeSend(){},
            success(res){
                $('#showOldTemplate').html(res);
            }
        });
    }


    function loadRunscreen(templatename)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/loadRunscreen",
            method:"POST",
            data:{
                templatename:templatename
            },
            beforeSend(){

            },
            success(res){
                // console.log(res);
                $('#show_pick_runscreen2').html(res);
            }
        });
    }

    function copyOriTemplateToTemp(templatename , template_newname , itemuse , template_image , data_template_image , data_template_itemuse)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/copyOriTemplateToTemp",
            method:"POST",
            data:{
                templatename:templatename,
                template_newname:template_newname,
                itemuse:itemuse,
                template_image:template_image,
                data_template_image:data_template_image,
                data_template_itemuse:data_template_itemuse
            },
            beforeSend(){

            },
            success(res){
                console.log(JSON.parse(res));
                if(JSON.parse(res).status == "Insert Success"){

                    loadRunScrFromTempTable(template_newname , $('#searchRunscreenTemp').val());
                    const masterline = JSON.parse(res).masterlinenum;
                    $('#linenumUsedArray').val(masterline);
                    countTotalRunTemp();
                    $('#show_runscreen_master2').html('');
                    countTotalRunmaster($('#linenumUsedArray').val());
                    loadRunScrMasUsed($('#linenumUsedArray').val() , $('#searchRunscreenMaster').val());

                }
            }
        });
    }



    function checkTemplateNameDuplicate(templatename , template_newname , itemuse , template_image , data_template_image , data_template_itemuse)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/checkTemplateNameDuplicate",
            method:"POST",
            data:{
                template_newname:template_newname
            },
            beforeSend(){},
            success(res){
                // console.log(JSON.parse(res));
                if(JSON.parse(res).status == "Found Duplicate Template Name"){
                    $('#create_new_template_name , #create_new_template_name_old , #create_new_template_name_old_use , #create_new_template_itemid').val('');

                    $('#create_new_template_name').removeClass("inputSuccess").addClass("inputNull");
                    $('#alert_create_new_template').fadeIn();
                    $('#alert_create_new_template').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>ชื่อ Template ซ้ำในระบบค่ะ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    $('#alert_create_new_template').delay(2000).fadeOut(500);
                }else{
                    if($('#create_new_template_name_old_use').val() == ""){
                        $('#alert_create_new_template').fadeIn();
                        $('#alert_create_new_template').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>กรุณากดเลือก Template ด้วยค่ะ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        $('#alert_create_new_template').delay(2000).fadeOut(500);
                    }else{
                        copyOriTemplateToTemp(templatename , template_newname , itemuse , template_image , data_template_image , data_template_itemuse);
                    }
                    
                }
            }
        });
    }


    function checkTemplateNameDuplicate2(template_newname)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/checkTemplateNameDuplicate",
            method:"POST",
            data:{
                template_newname:template_newname
            },
            beforeSend(){},
            success(res){
                // console.log(JSON.parse(res));
                if(JSON.parse(res).status == "Found Duplicate Template Name"){
                    $('#create_new_template_name').val('');

                    $('#create_new_template_name').removeClass("inputSuccess").addClass("inputNull");
                    $('#alert_create_new_template').fadeIn();
                    $('#alert_create_new_template').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>ชื่อ Template ซ้ำในระบบค่ะ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    $('#alert_create_new_template').delay(2000).fadeOut(500);
                    $('#create_new_template_name').prop("readonly" , false);
                }else{
                    saveRunScrToTempTable();
                    // checkDataOnTemptable(template_newname);
                    // Check ข้อมูลการสร้าง Template ว่ามีรายการดังกล่าวนั้นค้างอยู่หรือไม่
                }
            }
        });
    }


    // function checkDataOnTemptable(templatename)
    // {
    //     $.ajax({
    //         url:"/intsys/msd/main/machine/checkDataOnTemptable",
    //         method:"POST",
    //         data:{
    //             templatename:templatename
    //         },
    //         beforeSend:function(){

    //         },
    //         success:function(res){
    //             console.log(JSON.parse(res));
    //             if(JSON.parse(res).process == "Done"){
    //                 saveRunScrToTempTable();
    //             }
    //         }
    //     });
    // }



    function loadItemidFormTable(itemid)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/loadItemidFormTable",
            method:"POST",
            data:{itemid:itemid},
            beforeSend(){},
            success(res){
                $('#create_new_template_itemid_search').html(res);
            }
        });
    }



    function getRunscreenMasterNew()
    {
        $.ajax({
            url:"/intsys/msd/main/machine/getRunscreenMasterNew_arrayNull",
            method:"POST",
            data:{
            },
            beforeSend(){},
            success(res){
            // console.log(res);
            $("#show_runscreen_master2").html(res);
            }
        });
    }


    function getRunscreenMasterNew_search(searchMasterRun)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/getRunscreenMasterNew_search",
            method:"POST",
            data:{
                searchMasterRun:searchMasterRun
            },
            beforeSend(){},
            success(res){
            // console.log(res);
            $("#show_runscreen_master2").html(res);
            }
        });
    }

    function del_dataFromTemptableBy_templatename(templatename,ecode)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/del_dataFromTemptableBy_templatename",
            method:"POST",
            data:{
                templatename:templatename,
                ecode:ecode
            },
            beforeSend:function(){

            },
            success:function(res){
                console.log(JSON.parse(res));
            }
        });
    }

    function del_dataFromTemptable_whenReloadPageByEcode(ecode)
    {
        $.ajax({
            url:"/intsys/msd/main/machine/del_dataFromTemptable_whenReloadPageByEcode",
            method:"POST",
            data:{
                ecode:ecode
            },
            beforeSend:function(){

            },
            success:function(res){
                // console.log(JSON.parse(res));
            }
        });
    }


</script>