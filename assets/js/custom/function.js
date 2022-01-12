//////////////////////////////////////////////////////////////
//////////////Function check User Dept Permission
//////////////////////////////////////////////////////////////
function checkDept(deptCode) {
  // console.log(jQuery.type(deptCode));
  if (deptCode == "1007") {
    return true;
  } else {
    return false;
  }
}
//////////////////////////////////////////////////////////////
//////////////Function check User Dept Permission
//////////////////////////////////////////////////////////////

//////////////////////////////////////////
//////////////Save main data
/////////////////////////////////////////
function savemain() {
  $.ajax({
    url: "/intsys/msd/main/saveMainData",
    method: "POST",
    data: $("#maindata").serialize(),
    beforeSend: function () {
      $("#btn_saveMaindata").prop("disabled", true);
    },
    success: function (res) {

        if(JSON.parse(res).status == "Insert Success"){
                // clear form
              $("#fam_machinename").val("");
              $("#fam_productcode").val("");
              $("#fam_batchnumber").val("");
              $("#fam_shit").val("");
              $("#fam_prodidwip").val("");

              swal(
                {
                    title: 'บันทึกข้อมูลสำเร็จ',
                    showConfirmButton: false,
                    type: 'success',
                    timer: 1000
                }
              );

              let mainformno = JSON.parse(res).mainFormNo;
              let url = JSON.parse(res).url;

              window.location.href = url + "viewmaindata.html/" + mainformno;
        }else{
            swal(
              {
                  title: 'บันทึกข้อมูลไม่สำเร็จ',
                  showConfirmButton: false,
                  type: 'error',
                  timer: 1000
              }
            );
        }



    }
  });
}

//////////////////////////////////////////
//////////////Save main data
/////////////////////////////////////////

//////////////////////////////////////////
//////////////Save sub main data
/////////////////////////////////////////

// function saveSubMain() {
//     $.ajax({
//         url: "/intsys/msd/main/saveSubMainData",
//         method: "POST",
//         data: $('#submaindata').serialize(),
//         beforesend: function () {

//         },
//         success: function (res) {

//             let mainformno = JSON.parse(res).mainFormNo;
//             let url = JSON.parse(res).url;
//             let result = JSON.parse(res);
//             let status = JSON.parse(res).status;
//             window.location.href = url + 'viewmaindata.html/' + mainformno;
//         }
//     });
// }

//////////////////////////////////////////
//////////////Save sub main data
/////////////////////////////////////////

///////////////////////////////////////////
///////////Control add main data
/////////////////////////////////////////

////////////////////////
////load prodid
function loadProdId(dataareaid, searchProdid) {
  $.ajax({
    url: "/intsys/msd/main/loadProdId",
    method: "POST",
    data: {
      dataareaid: dataareaid,
      searchProdid: searchProdid,
    },
    beforesend: function () {},
    success: function (res) {
      $("#showProdId").html(res);
    },
  });
}

// Check PD Start process
function checkPdStart(dataareaid, searchProdid) {
  $.ajax({
    url: "/intsys/msd/main/checkPdStart",
    method: "POST",
    data: {
      dataareaid: dataareaid,
      searchProdid: searchProdid,
    },
    beforesend: function () {},
    success: function (res) {
      // console.log(JSON.parse(res));

      if (JSON.parse(res).status == "Found PD Onprocess") {
        $("#alertMainModal").fadeIn();
        $("#alertMainModal").html(
          '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>ระบบตรวจสอบพบว่า PD ดังกล่าวกำลัง Start หรือ รอ Start อยู่</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        $("#alertMainModal").delay(3000).fadeOut();

        $("#fam_productcode").val("");
        $("#fam_batchnumber").val("");
        $("#fam_prodid").val("");
        $("#showProdId").html("");
      }
    },
  });
}

function loadMachineTemplate(data_itemid)
{
  $.ajax({
    url:"/intsys/msd/main/loadMachineTemplate",
    method:"POST",
    data:{
      data_itemid : data_itemid,
    },
    beforeSend(){

    },
    success(data){
      console.log(data);
      $("#show_famprocode").html(data);
    }
  });
}


function loadMachineTemplate2(templateName)
{
  $.ajax({
    url:"/intsys/msd/main/loadMachineTemplate2",
    method:"POST",
    data:{
      templateName : templateName,
    },
    beforeSend(){

    },
    success(data){
      console.log(data);
      $("#show_famprocode").html(data);
    }
  });
}

///////////////////////////////////////////////////////////////////////
////////Setting page function
/////// setting.html
//////////////////////////////////////////////////////////////////////

function saveMachineTemplate(machineName, runscreenName, runscreenType) {
  $.ajax({
    url: "/intsys/msd/main/machine/saveMachineTemplate",
    method: "POST",
    data: {
      machineName: machineName,
      runscreenName: runscreenName,
      runscreenType: runscreenType,
    },
    beforesend: function () {},
    success: function (res) {
      // console.log(JSON.parse(res));
      getMachineTemp(machineName);
      $("#alertSaveTemplate").fadeIn();
      $("#alertSaveTemplate").html(
        '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>เพิ่ม Runscreen สำเร็จ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
      );
      $("#alertSaveTemplate").fadeOut(1000);
    },
  });
}

function checkDuplicateRunscreen(machineName, runscreenName, runscreenType) {
  $.ajax({
    url: "/intsys/msd/main/machine/checkDuplicateRunscreen",
    method: "POST",
    data: {
      machineName: machineName,
      runscreenName: runscreenName,
      runscreenType: runscreenType,
    },
    beforesend: function () {},
    success: function (res) {
      let status = JSON.parse(res).status;
      if (status == "ok") {
        saveMachineTemplate(machineName, runscreenName, runscreenType);
        $("#alertSaveTemplate").html("");
      } else {
        $("#alertSaveTemplate").fadeIn();
        $("#alertSaveTemplate").html(
          '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>พบข้อมูลซ้ำในระบบ</strong>กรุณาเลือกรายการอื่นต่อไป<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        $("#alertSaveTemplate").delay(3000).fadeOut(1000);
      }
    },
  });
}

function getRunscreenMaster() {
  $.ajax({
    url: "/intsys/msd/main/machine/getRunscreenMaster",
    method: "POST",
    data: {},
    beforesend: function () {},
    success: function (res) {
      $("#show_runscreen_master").html(res);

      $("#runscreen_master_table thead th").each(function () {
        var title = $(this).text();
        $(this).html(
          title +
            ' <input type="text" class="col-search-input" placeholder="Search ' +
            title +
            '" />'
        );
      });

      var table = $("#runscreen_master_table").DataTable({
        columnDefs: [
          {
            searching: false,
            orderable: false,
            targets: "_all",
          },
        ],
        ordering: false,
        paging: false,
      });

      table.columns().every(function () {
        var table = this;
        $("input", this.header()).on("keyup change", function () {
          if (table.search() !== this.value) {
            table.search(this.value).draw();
          }
        });
      });
    },
  });
}





function getListMachineTemp(machineName) {
  $.ajax({
    url: "/intsys/msd/main/machine/getListMachineTemp",
    method: "POST",
    data: {
      machineName: machineName,
    },
    beforeSend() {},
    success(res) {
      $("#showListMachineTemp").html(res);
    },
  });
}



function getMachineTemp(machineName) {
  $.ajax({
    url: "/intsys/msd/main/machine/getMachineTemp",
    method: "POST",
    data: {
      machineName: machineName,
    },
    beforesend: function () {},
    success: function (res) {
      $("#show_pick_runscreen").html(res);

      $("#machineTemplate thead th").each(function () {
        var title = $(this).text();
        $(this).html(
          title +
            ' <input type="text" class="col-search-input" placeholder="Search ' +
            title +
            '" />'
        );
      });

      var table = $("#machineTemplate").DataTable({
        columnDefs: [
          {
            searching: false,
            orderable: false,
            targets: "_all",
          },
        ],
        ordering: false,
        paging: false,
      });

      table.columns().every(function () {
        var table = this;
        $("input", this.header()).on("keyup change", function () {
          if (table.search() !== this.value) {
            table.search(this.value).draw();
          }
        });
      });
    },
  });
}

function deleteRunscreenFromTemp(runscreenAutoid, machineName) {
  $.ajax({
    url: "/intsys/msd/main/machine/deleteRunscreenFromTemp",
    method: "POST",
    data: {
      runscreenAutoid: runscreenAutoid,
    },
    beforesend: function () {},
    success: function (res) {
      // console.log(JSON.parse(res));
      let deleteStatus = JSON.parse(res).status;
      if (deleteStatus == "DeleteSuccess") {
        getMachineTemp(machineName);
        $("#alertSaveTemplate").fadeIn();
        $("#alertSaveTemplate").html(
          '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>ลบ Runscreen สำเร็จ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        $("#alertSaveTemplate").fadeOut(1000);
      } else {
        $("#alertSaveTemplate").fadeIn();
        $("#alertSaveTemplate").html(
          '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>ลบ Runscreen ไม่สำเร็จ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        $("#alertSaveTemplate").fadeOut(1000);
      }
    },
  });
}

function runacreenManagement() {
  $.ajax({
    url: "/intsys/msd/main/machine/runscreenManagement",
    method: "POST",
    data: {},
    beforesend: function () {},
    success: function (res) {
      $("#show_runscreen_management").html(res);
      $("#runscreenManage thead th").each(function () {
        var title = $(this).text();
        $(this).html(
          title +
            ' <input type="text" class="col-search-input" placeholder="Search ' +
            title +
            '" />'
        );
      });

      var table = $("#runscreenManage").DataTable({
        columnDefs: [
          {
            searching: false,
            orderable: false,
            targets: "_all",
          },
        ],
        ordering: false,
        paging: false,
      });

      table.columns().every(function () {
        var table = this;
        $("input", this.header()).on("keyup change", function () {
          if (table.search() !== this.value) {
            table.search(this.value).draw();
          }
        });
      });
    },
  });
}

function saveRunscreen() {
  $.ajax({
    url: "/intsys/msd/main/machine/saveRunscreen",
    method: "POST",
    data: $("#addRunscreen").serialize(),
    beforesend: function () {},
    success: function (res) {
      // console.log(JSON.parse(res));
      let saveRunStatus = JSON.parse(res).status;

      if (saveRunStatus == "insert success") {
        $("#run_name , #run_minvalue , #run_maxvalue , #run_spoint").val("");
        $('input:radio[name="run_type"]').prop("checked", false);
        $('#new_runscreen_md').modal("hide");
        runacreenManagement();
        getRunscreenMaster();
        $("#alertRunscreenManage").fadeIn();
        $("#alertRunscreenManage").html(
          '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>เพิ่ม Runscreen สำเร็จ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        $("#alertRunscreenManage").fadeOut(1000);
      } else {
        $("#alertRunscreenManage").fadeIn();
        $("#alertRunscreenManage").html(
          '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>ลบ Runscreen ไม่สำเร็จ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        $("#alertRunscreenManage").fadeOut(1000);
      }
    },
  });
}

function checkDupRunManage() {
  $.ajax({
    url: "/intsys/msd/main/machine/checkDupRunManage",
    method: "POST",
    data: $("#addRunscreen").serialize(),
    beforesend: function () {},
    success: function (res) {
      // console.log(JSON.parse(res));

      let dupRunStatus = JSON.parse(res).status;
      let msgRun = JSON.parse(res).msg;

      if (dupRunStatus == "Not Found Duplicate Data") {
        if ($("#btn_runscreenManage").text() == "บันทึกข้อมูล") {
          saveRunscreen();
        } else if ($("#btn_runscreenManage").text() == "บันทึกการแก้ไขข้อมูล") {
          editRunManage();
        }
      } else {
        $("#alertRunscreenManage").fadeIn();
        $("#alertRunscreenManage").html(
          '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>' +
            msgRun +
            '</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        $("#alertRunscreenManage").fadeOut(1000);
      }
    },
  });
}


function checkDupEditRunManage() {
  $.ajax({
    url: "/intsys/msd/main/machine/checkDupEditRunManage",
    method: "POST",
    data: $("#editRunscreen").serialize(),
    beforesend: function () {},
    success: function (res) {
      // console.log(JSON.parse(res));

      let dupRunStatus = JSON.parse(res).status;
      let msgRun = JSON.parse(res).msg;

      // if (dupRunStatus == "Not Found Duplicate Data"){
      //   editRunManage();
      // }else{
      //   $("#alertEditRunscreenManage").fadeIn();
      //   $("#alertEditRunscreenManage").html(
      //     '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>'+msgRun+'</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
      //   );
      //   $("#alertEditRunscreenManage").delay(1000).fadeOut(1000);
      //   return false;
      // }
      if(JSON.parse(res).status == "Pass"){
        editRunManage();
      }

      

    },
  });
}

function editRunManage() {
  $.ajax({
    url: "/intsys/msd/main/machine/editRunscreen",
    method: "POST",
    data: $("#editRunscreen").serialize(),
    beforesend: function () {},
    success: function (res) {
      // console.log(JSON.parse(res));
      let editRunStatus = JSON.parse(res).status;

      if (editRunStatus == "Update success") {
        $("#run_name").val("");
        $("#run_autoid").val("");
        $('input:radio[name="run_type"]').prop("checked", false);
        $('#edit_runscreen_md').modal("hide");
          
        runacreenManagement();
        getRunscreenMaster();

        $("#alertEditRunscreenManage").fadeIn();
        $("#alertEditRunscreenManage").html(
          '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>แก้ไข Runscreen สำเร็จ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        $("#alertEditRunscreenManage").fadeOut(1000);
      } else {
        $("#alertEditRunscreenManage").fadeIn();
        $("#alertEditRunscreenManage").html(
          '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>แก้ไข Runscreen ไม่สำเร็จ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        $("#alertEditRunscreenManage").fadeOut(1000);
      }
    },
  });
}



function delRunManage(runAutoid) {
  $.ajax({
    url: "/intsys/msd/main/machine/delRunscreen",
    method: "POST",
    data: {
      runAutoid: runAutoid,
    },
    beforesend: function () {},
    success: function (res) {
      // console.log(JSON.parse(res));
      let delRunStatus = JSON.parse(res).status;

      if (delRunStatus == "Delete success") {
        runacreenManagement();
        getRunscreenMaster();
        $("#alertRunscreenManage").fadeIn();
        $("#alertRunscreenManage").html(
          '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>ลบ Runscreen สำเร็จ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        $("#alertRunscreenManage").delay(2000).fadeOut(1000);
      } else {
        $("#alertRunscreenManage").fadeIn();
        $("#alertRunscreenManage").html(
          '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>ลบ Runscreen ไม่สำเร็จ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        $("#alertRunscreenManage").delay(2000).fadeOut(1000);
      }
    },
  });
}

//////////////////////////////////////////////////////////
/////////Control template detail page
function tempDetail(machinename) {
  $.ajax({
    url: "/intsys/msd/main/machine/temDetail",
    method: "POST",
    data: {
      machinename: machinename,
    },
    beforesend: function () {},
    success: function (res) {
      $("#show_tempdetail").html(res);
      $("#tempDetail thead th").each(function () {
        var title = $(this).text();
        $(this).html(
          title +
            ' <input type="text" class="col-search-input" placeholder="Search ' +
            title +
            '" />'
        );
      });

      var table = $("#tempDetail").DataTable({
        columnDefs: [
          {
            searching: false,
            orderable: false,
            targets: "_all",
          },
        ],
        ordering: false,
        paging: false,
      });

      table.columns().every(function () {
        var table = this;
        $("input", this.header()).on("keyup change", function () {
          if (table.search() !== this.value) {
            table.search(this.value).draw();
          }
        });
      });
    },
  });
}

function addMinMax() {
  $.ajax({
    url: "/intsys/msd/main/machine/saveMinMax",
    method: "POST",
    data: $("#saveMinMax_frm").serialize(),
    beforesend: function () {},
    success: function (res) {
      console.log(JSON.parse(res));
      if (JSON.parse(res).status == "Update success") {
        const minMaxMachinename = JSON.parse(res).machineName;
        tempDetail(minMaxMachinename);

        $("#minvalue").val("");
        $("#maxvalue").val("");
        $("#spointvalue").val("");
      }
    },
  });
}

function copyTemplate() {
  $.ajax({
    url: "/intsys/msd/main/machine/copyTemplate",
    method: "POST",
    data: {},
    beforesend: function () {},
    success: function (res) {
      $("#showTemplateListCopy").html(res);
      $("#copyTemplateTable thead th").each(function () {
        var title = $(this).text();
        $(this).html(
          title +
            ' <input type="text" class="col-search-input" placeholder="Search ' +
            title +
            '" />'
        );
      });

      var table = $("#copyTemplateTable").DataTable({
        columnDefs: [
          {
            searching: false,
            orderable: false,
            targets: "_all",
          },
          { width: "150", targets: 0 },
          { width: "80", targets: 1 },
          { width: "50", targets: 2 },
          { width: "50", targets: 3 },
          { width: "50", targets: 4 },
        ],
        ordering: false,
        paging: false,
      });

      table.columns().every(function () {
        var table = this;
        $("input", this.header()).on("keyup change", function () {
          if (table.search() !== this.value) {
            table.search(this.value).draw();
          }
        });
      });
    },
  });
}

function saveTemplateCopy() {
  $.ajax({
    url: "/intsys/msd/main/machine/saveCopyTemplate",
    method: "POST",
    data: $("#frm_copyTemplate").serialize(),
    beforeSend: function () {
      $("#btn_saveCopyTem").prop("disabled", true);
    },
    success: function (res) {
      // console.log(JSON.parse(res));
      if (JSON.parse(res).status == "Copy Data Success") {
        location.reload();
      }
    },
  });
}

function delTemplate(matchinename) {
  $.ajax({
    url: "/intsys/msd/main/machine/delTemplate",
    method: "POST",
    data: {
      matchinename: matchinename,
    },
    beforeSend: function () {},
    success: function (res) {
      // console.log(JSON.parse(res));
      if (JSON.parse(res).status == "Delete Template Successfuly") {
        location.reload();
      }
    },
  });
}

function loadTemplateBox(templatename) {
  $.ajax({
    url: "/intsys/msd/main/machine/loadTemplateBox",
    method: "POST",
    data: {
      templatename: templatename,
    },
    beforeSend: function () {},
    success: function (res) {
      // console.log(JSON.parse(res));
      $("#showMachineBox").html(res);
    },
  });
}

///////////////////////////////////////////////////////////////////////
////////Setting page function
/////// setting.html
//////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////
/////////////Control page viewmaindata.html
////////////////////////////////////////////////////////////

function loadTemplateSpoint(template) {
  $.ajax({
    url: "/intsys/msd/main/loadTemplateSpoint",
    method: "POST",
    data: {
      template: template,
    },
    beforesend: function () {},
    success: function (res) {
      $("#showTemplateSpoint").html(res);
    },
  });
}

function loadTemplateRun(template, subFormno , data_mainFormno) {
  $.ajax({
    url: "/intsys/msd/main/loadTemplateRun",
    method: "POST",
    data: {
      template: template,
      subFormno: subFormno,
      data_mainFormno:data_mainFormno
    },
    beforesend: function () {},
    success: function (res) {
      $("#showTemplateRun").html(res);
    },
  });
}

function loadDataRunEdit(fardetailFormno , farDetailMainFormno) {
  $.ajax({
    url: "/intsys/msd/main/loadDataRunEdit",
    method: "POST",
    data: {
      fardetailFormno: fardetailFormno,
      farDetailMainFormno:farDetailMainFormno
    },
    beforesend: function () {},
    success: function (res) {
      $("#showdataRunEdit").html(res);
    },
  });
}

function delFileUpload(fileautoid, filename, fardetailFormno , farDetailMainFormno) {
  $.ajax({
    url: "/intsys/msd/main/delFileUpload",
    method: "POST",
    data: {
      fileautoid: fileautoid,
      filename: filename,
    },
    beforeSend: function () {},
    success: function (res) {
      // console.log(JSON.parse(res));
      loadDataRunEdit(fardetailFormno , farDetailMainFormno);
    },
  });
}

function loadWorkTimeByDetail(mainFormno) {
  $.ajax({
    url: "/intsys/msd/main/loadWorkTimeByDetail",
    method: "POST",
    data: {
      mainFormno: mainFormno,
    },
    beforesend: function () {},
    success: function (res) {
      $("#editRunWorktime").html(res);
    },
  });
}

function saveSpoint() {
  $.ajax({
    url: "/intsys/msd/main/saveSpoint",
    method: "POST",
    data: $("#saveSpoint_frm").serialize(),
    beforesend: function () {
      $("#btn_saveSpoint").prop("disabled", true);
      $('.loader').fadeIn(1000);
    },
    success: function (res) {
      // console.log(JSON.parse(res));
      $('.loader').fadeOut(1000);
      if (JSON.parse(res).status == "Insert success") {
        swal(
          {
              title: 'บันทึกข้อมูลสำเร็จ',
              showConfirmButton: false,
              type: 'success',
              timer: 1000
          }
        );
        window.location.reload();
        // alert(JSON.parse(res).status);
      } else {
        $("#showAlertSpoint").fadeIn();
        $("#showAlertSpoint").html(
          '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>ระบบตรวจสอบพบค่าว่าง กรุณากรอกข้อมูลให้ครบ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        $("#showAlertSpoint").delay(1000).fadeOut(500);
      }
    },
  });
}

function checkSaveSpoint() {
  $.ajax({
    url: "/intsys/msd/main/checkSaveSpoint",
    method: "POST",
    data: $("#saveSpoint_frm").serialize(),
    beforeSend: function () {
      $('#btn_saveSpoint').prop('disabled' , true);
    },
    success: function (res) {
      if (res == 1) {
        saveSpoint();
      } else {
        $("#showAlertSpoint").fadeIn();
        $("#showAlertSpoint").html(
          '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>ระบบตรวจสอบพบค่าว่าง กรุณากรอกข้อมูลให้ครบ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        $("#showAlertSpoint").delay(2000).fadeOut(500);
      }

      // console.log(res);
    },
  });
}

function saveSubmain() {
  $.ajax({
    url: "/intsys/msd/main/saveSubmain",
    method: "POST",
    data: $("#submain_frm").serialize(),
    beforesend: function () {},
    success: function (res) {
      // console.log(JSON.parse(res));
      if (JSON.parse(res).status == "Insert success") {
        location.reload();
      } else {
        alert(JSON.parse(res).msg);
      }
    },
  });
}




// function showSubmainData(mainFormno)
// {
//   $.ajax({
//     url:"/intsys/msd/main/showSubmainData",
//     method:"POST",
//     data:{
//       mainFormno:mainFormno
//     },
//     beforeSend(){

//     },
//     success(res){
//       $('#showGetSubmainData').html(res);
//     }
//   });
// }


function saveRun() {
  const form = $("#saveRun_frm")[0];
  const data = new FormData(form);

  $.ajax({
    url: "/intsys/msd/main/saveRun",
    type: "POST",
    enctype: "multipart/form-data",
    data: data,
    processData: false,
    contentType: false,
    beforeSend: function () {
      $('.loader').fadeIn(1000);
    },
    success: function (res) {
      // console.log(JSON.parse(res));

      if (JSON.parse(res).status == "Insert success") {
        $('.loader').fadeOut(1000);
        location.reload();
        // const mainFormno = $("#view_loadMainData").val();
        // showSubmainData(mainFormno);
      }
    },
  });
}

function check_saveRun() {
  $.ajax({
    url: "/intsys/msd/main/checkSaveRun",
    method: "POST",
    data: $("#saveRun_frm").serialize(),
    beforeSend: function () {
      $("#btn_saveRunForm").prop("disabled", true);
      $('.loader').fadeIn(1000);
      // $("#runs_modal").modal("hide");
    },
    success: function (res) {
      console.log(res);
      if (res == 0) {
        swal(
          {
              title: 'กรุณากรอกข้อมูลให้ครบถ้วนด้วยค่ะ',
              showConfirmButton: false,
              type: 'warning',
              timer: 1000
          }
        );
        $('.loader').fadeOut(1000);
        $("#btn_saveRunForm").prop("disabled", false);
      } else if (res == 1) {
        $("#runs_modal").modal("hide");
        $('.loader').fadeIn(1000);
        saveRun();
      }
    },
  });
}

function check_saveEditRun() {
  $.ajax({
    url: "/intsys/msd/main/checkSaveEditRun",
    method: "POST",
    data: $("#saveEditRun_frm").serialize(),
    beforeSend: function () {
      $("#btn_saveEditRunForm").prop("disabled", true);
      $('.loader').fadeIn(1000);
      $("#editRuns_modal").modal("hide");
    },
    success: function (res) {
      $('.loader').fadeOut(1000);
      // console.log(res);
      // if (res == 0) {
      //   // $("#spinner_load").modal("hide");
      //   alert("กรุณากรอกข้อมูลให้ครบถ้วนด้วยค่ะ");
      // } else if (res == 1) {
      //   saveEditRun();
      // }
      saveEditRun();
    },
  });
}

function saveEditRun() {
  const form = $("#saveEditRun_frm")[0];
  const data = new FormData(form);

  $.ajax({
    url: "/intsys/msd/main/saveEditRun",
    method: "POST",
    enctype: "multipart/form-data",
    data: data,
    processData: false,
    contentType: false,
    beforeSend: function () {
      $('.loader').fadeIn(1000);
    },
    success: function (res) {
      $('.loader').fadeOut(1000);
      // console.log(JSON.parse(res));
      // window.location.reload();
      location.reload();
    },
  });
}

function deleteEditRun() {
  $.ajax({
    url: "/intsys/msd/main/deleteEditRun",
    method: "POST",
    data: $("#saveEditRun_frm").serialize(),
    beforesend: function () {},
    success: function (res) {
      // console.log(JSON.parse(res));
      // window.location.reload();
      location.reload();
    },
  });
}

function chooseFeeder(mainformno) {
  $.ajax({
    url: "/intsys/msd/main/chooseFeeder",
    method: "POST",
    data: {
      mainformno: mainformno,
    },
    beforesend: function () {},
    success: function (res) {
      $("#showChooseFeeder").html(res);
    },
  });
}

function saveDataToFeeder() {
  // Check Feeder Value null
  if ($("#md_chooseFeeder").val() != "" && $("#md_value").val() != "") {
    $.ajax({
      url: "/intsys/msd/main/saveDataToFeeder",
      method: "POST",
      data: $("#feeder_frm").serialize(),
      beforeSend: function () {
        $('.loader').fadeIn(1000);
      },
      success: function (res) {
        console.log(JSON.parse(res));
        $('.loader').fadeOut(1000);
        // location.reload();
        const mainformno = JSON.parse(res).mainformno;
        loadGetBom(mainformno);
        loadGetBomMix(mainformno);
        loadFeederTemp(mainformno);
        loadReportFarrel(mainformno);
        countFeeder(mainformno);
        loadBomMixReport(mainformno);
        // location.reload();
        $("#md_addmatFeeder , #md_bom").modal("hide");
        swal(
          {
              title: 'บันทึกข้อมูลสำเร็จ',
              showConfirmButton: false,
              type: 'success',
              timer: 1000
          }
        );
      },
    });
  } else {
    if ($("#md_chooseFeeder").val() == "") {
      $("#md_chooseFeeder").addClass("inputNull");
    }
    if ($("#md_value").val() == "") {
      $("#md_value").addClass("inputNull");
    }
    alert("กรุณากรอกข้อมูลให้ครบทุกช่อง");

    // Function change ของตัวเลือก Feeder
    $("#md_chooseFeeder").change(function () {
      if ($(this).val() != "") {
        $("#md_chooseFeeder").removeClass("inputNull");
      }
    });
  }
}

function getBomForMix(mainformno) {
  $.ajax({
    url: "/intsys/msd/main/getBomForMix",
    method: "POST",
    data: {
      mainformno: mainformno,
    },
    beforeSend: function () {},
    success: function (res) {
      $("#showBomMix").html(res);
    },
  });
}

function getBomForMix2(mainformno) {
  $.ajax({
    url: "/intsys/msd/main/getBomForMix2",
    method: "POST",
    data: {
      mainformno: mainformno,
    },
    beforeSend: function () {},
    success: function (res) {
      if (res == "") {
        $("#showBomMix2").html("");
      } else {
        $("#showBomMix2").html(res);
      }
    },
  });
}

function activeMix(b_autoid, mainformno, calBomqtyUseMix) {
  $.ajax({
    url: "/intsys/msd/main/activeMix",
    method: "POST",
    data: {
      b_autoid: b_autoid,
      calBomqtyUseMix: calBomqtyUseMix,
    },
    beforeSend: function () {},
    success: function (res) {
      // console.log(JSON.parse(res));
      // if(JSON.parse(res).bomstatus == "wait confirm" || $('#mixDataInput').val() != ""){
      //   $('#btn_adddataMix').css('display' , '');
      // }else{
      //   $('#btn_adddataMix').css('display' , 'none');
      // }
      getBomForMix(mainformno);
      waitConfirmMix(mainformno);
      countConfirmMix(mainformno);
      return JSON.parse(res).bomstatus;
    },
  });
}

function waitConfirmMix(mainformno) {
  $.ajax({
    url: "/intsys/msd/main/waitConfirmMix",
    method: "POST",
    data: {
      mainformno: mainformno,
    },
    beforeSend: function () {},
    success: function (res) {
      // console.log(res);
      $("#mixDataInput").val(res);
    },
  });
}

function countConfirmMix(mainformno) {
  $.ajax({
    url: "/intsys/msd/main/countConfirmMix",
    method: "POST",
    data: {
      mainformno: mainformno,
    },
    beforeSend: function () {},
    success: function (res) {
      console.log(res);
      if(res == ""){
        $('#btn_adddataMix').css('display' , 'none');
      }else{
        $('#btn_adddataMix').css('display' , '');
      }
      $("#mixValueDataInput").val(res);
    },
  });
}

function saveDataMix(mainformno, prodid, material, bomqty) {
  $.ajax({
    url: "/intsys/msd/main/saveDataMix",
    method: "POST",
    data: {
      mainformno: mainformno,
      prodid: prodid,
      material: material,
      bomqty: bomqty,
    },
    beforeSend: function () {
      $('.loader').fadeIn(1000);
    },
    success: function (res) {
      // console.log(JSON.parse(res));
      $('.loader').fadeOut(1000);
      getBomForMix(mainformno);
      getBomForMix2(mainformno);

      $("#mixDataInput").val("");
      $("#mixValueDataInput").val("");
      $('#btn_adddataMix').css('display' , 'none');
      sumdata = 0;
      loadGetBom(mainformno);
      loadGetBomMix(mainformno);

      swal(
        {
            title: 'บันทึกข้อมูลสำเร็จ',
            showConfirmButton: false,
            type: 'success',
            timer: 1000
        }
      );

    },
  });
}

function canCelMix(mainformno) {
  $.ajax({
    url: "/intsys/msd/main/canCelMix",
    method: "POST",
    data: {
      mainformno: mainformno,
    },
    beforeSend: function () {
      $('.loader').fadeIn(1000);
    },
    success: function (res) {
      // console.log(res);
      // getBomForMix(mainformno);
      // getBomForMix2(mainformno);
      // loadGetBom(mainformno);
      // loadGetBomMix(mainformno);
      $('.loader').fadeOut(1000);
      swal(
        {
            title: 'ยกเลิกการ Mix ทั้งหมด สำเร็จ',
            showConfirmButton: false,
            type: 'success',
            timer: 1000
        }
      );
      location.reload();
    },
  });
}

function loadGetBom(mainformno) {
  $.ajax({
    url: "/intsys/msd/main/loadGetBom",
    method: "POST",
    data: {
      mainformno: mainformno,
    },
    beforeSend: function () {},
    success: function (res) {
      $("#loadGetBom").html(res);
    },
  });
}

function loadGetBomMix(mainformno) {
  $.ajax({
    url: "/intsys/msd/main/loadGetBomMix",
    method: "POST",
    data: {
      mainformno: mainformno,
    },
    beforeSend: function () {},
    success: function (res) {
      $("#loadGetBomMix").html(res);
    },
  });
}

function getValueBomMix() {
  $.ajax({
    url: "/intsys/msd/main/getValueBomMix",
    method: "POST",
    data: $("#getValueConfirmMix").serialize(),
    beforeSend() {},
    success(res) {
      console.log(res);
    },
  });
}

function loadFeederTemp(mainformno) {
  $.ajax({
    url: "/intsys/msd/main/loadFeederTemp",
    method: "POST",
    data: {
      mainformno: mainformno,
    },
    beforeSend: function () {},
    success: function (res) {
      $("#loadFeederTemp").html(res);
      if ($("#checkFeederSum").val() != 100) {
        console.log("ไม่เท่ากับ 100");
        $('#btn_addrun').attr('data-target' , '#');
        $('#showFeedAlt').html(`<div class="alert alert-danger mb-0">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon-remove-sign"></i><strong>พบข้อผิดพลาด !</strong> กรุณาใส่วัตถุดิบลง Feeder ให้เรียบร้อยก่อนดำเนินการต่อด้วยค่ะ
      </div>`);
      } else {
        console.log("เท่ากับ 100");
        $('#btn_addrun').attr('data-target' , '#runs_modal');
        $('#showFeedAlt').html('')
      }
      checkFeederPercen();
      countFeeder(mainformno);
      console.log($("#checkFeederSum").val());
    },
  });
}

function delValueFeeder(
  autoid,
  mainformno,
  prodid,
  rawmaterial,
  value,
  rawautoid
) {
  $.ajax({
    url: "/intsys/msd/main/delValueFeeder",
    method: "POST",
    data: {
      autoid: autoid,
      mainformno: mainformno,
      prodid: prodid,
      rawmaterial: rawmaterial,
      value: value,
      rawautoid: rawautoid,
    },
    beforeSend: function () {},
    success: function (res) {
      console.log(JSON.parse(res));
      if(JSON.parse(res).status == "Cannot Delete"){
        alert(JSON.parse(res).msg);
      }
      
      loadGetBom(mainformno);
      loadGetBomMix(mainformno);
      loadFeederTemp(mainformno);
      loadReportFarrel(mainformno);
      checkFeederPercen();
      countFeeder(mainformno);
      // location.reload();
    },
  });
}

function startprocess(subformno) {
  $.ajax({
    url: "/intsys/msd/main/startprocess",
    method: "POST",
    data: {
      subformno: subformno,
    },
    beforeSend: function () {},
    success: function (res) {
      // console.log(res);
      location.reload();
    },
  });
}

function endprocess(subformno) {
  $.ajax({
    url: "/intsys/msd/main/endprocess",
    method: "POST",
    data: {
      subformno: subformno,
    },
    beforeSend: function () {},
    success: function (res) {
      // console.log(res);
      location.reload();
    },
  });
}

function delWorktime(subformno) {
  $.ajax({
    url: "/intsys/msd/main/delWorktime",
    method: "POST",
    data: {
      subformno: subformno,
    },
    beforeSend: function () {},
    success: function (res) {
      // console.log(JSON.parse(res));
      if (JSON.parse(res).status == "Delete success") {
        location.reload();
      }
    },
  });
}

function checkActiveWorktime(mainformno, subformno) {
  $.ajax({
    url: "/intsys/msd/main/checkActiveWorktime",
    method: "POST",
    data: {
      mainformno: mainformno,
    },
    beforeSend: function () {},
    success: function (res) {
      // console.log(JSON.parse(res));
      if (JSON.parse(res).status == "Ready for start") {
        startprocess(subformno);
      } else {
        alert(JSON.parse(res).msg);
      }
    },
  });
}

function loadReportFarrel(mainform) {
  $.ajax({
    url: "/intsys/msd/main/reportFarrel",
    method: "POST",
    data: {
      mainform: mainform,
    },
    beforeSend: function () {},
    success: function (res) {
      $("#showReportByTemplate").html(res);

      var table = $("#reportMachine").DataTable({
        paging: false,
        columnDefs: [
          {
            searching: false,
            orderable: false,
            targets: "_all",
          },
          { width: "120", targets: 0 },
          { width: "300", targets: 1 },
          { width: "50", targets: 2 },
          { width: "100", targets: 3 },
          { width: "100", targets: 4 },
          { width: "80", targets: 5 },
          { width: "80", targets: 6 },
          { width: "80", targets: 7 },
          { width: "80", targets: 8 },
          { width: "80", targets: 9 },
          { width: "80", targets: 10 },
          { width: "80", targets: 11 },
          { width: "80", targets: 12 },
          { width: "150", targets: 13 },
        ],
        ordering: false,
      });
    },
  });
}

function saveOutput() {
  $.ajax({
    url: "/intsys/msd/main/saveOutput",
    method: "POST",
    data: $("#frm_outputfix").serialize(),
    beforeSend: function () {
      $('#btn_addoutput').prop('disabled' , true);
    },
    success: function (res) {
      // console.log(JSON.parse(res));
      alert("บันทึกข้อมูลสำเร็จ");
      location.reload();
      const mainformno = JSON.parse(res).mainformno;

      loadReportFarrel(mainformno);
      loadReportCheckMachine(mainformno);
      loadBomReport(mainformno);
      loadBomMixReport(mainformno);

      $("#checkFeeder_modal").modal("hide");
    },
  });
}

function loadDeviation(mainformno) {
  $.ajax({
    url: "/intsys/msd/main/loadDeviation",
    method: "POST",
    data: {
      mainformno: mainformno,
    },
    beforeSend: function () {},
    success: function (res) {
      $("#show_cf_deviation").html(res);
      $("#showMainDeviation").html(res);
      if ($("#cf_output").val() != "" && $("#cf_deviation").val() != "") {
        $("#cf_deviation").prop("disabled", true);
      }
    },
  });
}

function loadDeviation2(mainformno, feederAutoid) {
  $.ajax({
    url: "/intsys/msd/main/loadDeviation2",
    method: "POST",
    data: {
      mainformno: mainformno,
      feederAutoid: feederAutoid,
    },
    beforeSend: function () {},
    success: function (res) {
      $("#showMainDeviation").html(res);
      $("#acf_deviation").change(function () {
        $(".adex").val("");
        // console.log($(this).val());
      });
    },
  });
}

function checkDataFeederForEdit(mainformno) {
  $.ajax({
    url: "/intsys/msd/main/checkDataFeederForEdit",
    method: "POST",
    data: {
      mainformno: mainformno,
    },
    beforeSend: function () {},
    success: function (res) {
      // console.log(JSON.parse(res));
      $("#checkFeederDataForEdit").val(JSON.parse(res).feederRow);
    },
  });
}

function getDataFeeder(feederAutoid, mainform) {
  $.ajax({
    url: "/intsys/msd/main/getDataFeeder",
    method: "POST",
    data: {
      feederAutoid: feederAutoid,
    },
    beforeSend: function () {},
    success: function (res) {
      // console.log(JSON.parse(res));
      let fafEx1 = "";
      let fafEx2 = "";
      let fafEx3 = "";
      let fafEx4 = "";
      let fafEx5 = "";

      if(JSON.parse(res).faf_ex1 == "0.000"){
        fafEx1 = "";
        $('#addf_ex1').addClass("inputNull");
      }else{
        fafEx1 = JSON.parse(res).faf_ex1;
      }

      if(JSON.parse(res).faf_ex2 == "0.000"){
        fafEx2 = "";
        $('#addf_ex2').addClass("inputNull");
      }else{
        fafEx2 = JSON.parse(res).faf_ex2;
      }

      if(JSON.parse(res).faf_ex3 == "0.000"){
        fafEx3 = "";
        $('#addf_ex3').addClass("inputNull");
      }else{
        fafEx3 = JSON.parse(res).faf_ex3;
      }

      if(JSON.parse(res).faf_ex4 == "0.000"){
        fafEx4 = "";
        $('#addf_ex4').addClass("inputNull");
      }else{
        fafEx4 = JSON.parse(res).faf_ex4;
      }

      if(JSON.parse(res).faf_ex5 == "0.000"){
        fafEx5 = "";
        $('#addf_ex5').addClass("inputNull");
      }else{
        fafEx5 = JSON.parse(res).faf_ex5;
      }

      $("#getFeederDeviation").val(JSON.parse(res).faf_deviation);
      $("#addf_ex1").val(fafEx1);
      $("#addf_ex2").val(fafEx2);
      $("#addf_ex3").val(fafEx3);
      $("#addf_ex4").val(fafEx4);
      $("#addf_ex5").val(fafEx5);
      $("#addf_exAvg").val(JSON.parse(res).faf_exavg);
      $("#addf_accept").val(JSON.parse(res).faf_accept);
      $("#addf_memo").val(JSON.parse(res).faf_memo);

      // Control status
      if (JSON.parse(res).faf_status == "ผ่าน") {
        $('input:checkbox[id="pass"]').prop("checked", true);
      } else if (JSON.parse(res).faf_status == "ไม่ผ่าน") {
        $('input:checkbox[id="notpass"]').prop("checked", true);
      }

      if (
        JSON.parse(res).faf_status == "ผ่าน" ||
        JSON.parse(res).faf_status == "ไม่ผ่าน"
      ) {
        $("#btn_saveAddf").css("display", "none");
        $("#btn_editAddf").css("display", "");
        $(".ex").prop("readonly", true);
        $("#btn_delAddfCheck").prop("disabled", false);
        const getDeviation =
          '<select name="showDevia" id="showDevia" class="form-control" disabled>' +
          '<option value="' +
          JSON.parse(res).faf_deviation +
          '">' +
          JSON.parse(res).faf_deviation +
          "</option>" +
          '<option value="0.5">0.5</option>' +
          '<option value="1">1</option>' +
          "</select>";
        $("#showMainDeviation").html(getDeviation);
        // $('#getFeederDeviation').css('display' , '');
      } else {
        loadDeviation2(mainform, feederAutoid);
        $("#btn_saveAddf").css("display", "");
        $(".adex").prop("readonly", false);
        $("#btn_saveAddf")
          .text("บันทึก")
          .removeClass("btn-warning")
          .addClass("btn-success");
        $("#btn_editAddf").css("display", "none");
      }
    },
  });
}

function getdataMachineList(data_ckautoid) {
  $.ajax({
    url: "/intsys/msd/main/getdataMachineList",
    method: "POST",
    data: {
      data_ckautoid: data_ckautoid,
    },
    beforeSend: function () {},
    success: function (res) {
      // console.log(JSON.parse(res));
      if (
        JSON.parse(res).ck_status == "ปกติ" ||
        JSON.parse(res).ck_status == "ไม่ปกติ" ||
        JSON.parse(res).ck_status == "ไม่ได้ใช้งาน"
      ) {
        if (JSON.parse(res).ck_status == "ปกติ") {
          $("#addMc_status1").prop("checked", true);
        } else if (JSON.parse(res).ck_status == "ไม่ปกติ") {
          $("#addMc_status2").prop("checked", true);
        } else if (JSON.parse(res).ck_status == "ไม่ได้ใช้งาน") {
          $("#addMc_status3").prop("checked", true);
        }

        $("#addMc_memo").val(JSON.parse(res).ck_memo);
        $("#addMc_emQc").val(JSON.parse(res).ck_rmqc);
        $("#addMc_moisture").val(JSON.parse(res).ck_moisture);

        $("#btn_saveAddCheckMachine")
          .text("บันทึกการแก้ไข")
          .prop("disabled", false);
      } else {
        $("#btn_saveAddCheckMachine").text("บันทึก");
      }
    },
  });
}

function saveReportFeeder() {
  $.ajax({
    url: "/intsys/msd/main/saveReportFeeder",
    method: "POST",
    data: $("#frm_saveCheckFeeder").serialize(),
    beforeSend: function () {},
    success: function (res) {
      // console.log(JSON.parse(res));
      if (JSON.parse(res).status == "Update success") {
        // location.reload();
        let mainformno = $("#view_loadMainData").val();
        loadReportFarrel(mainformno);
        // loadReportCheckMachine(mainformno);
        // loadBomReport(mainformno);
        // loadBomMixReport(mainformno);

        $(".ex").val("");
        $('input:checkbox[id="notpass"]').prop("checked", false);
        $('input:checkbox[id="pass"]').prop("checked", false);
        $("#btn_saveAddf").prop("disabled", false);

        $("#addFeeder_modal").modal("hide");
      }
    },
  });
}

function delReportFeeder() {
  $.ajax({
    url: "/intsys/msd/main/delReportFeeder",
    method: "POST",
    data: $("#frm_saveCheckFeeder").serialize(),
    beforeSend: function () {},
    success: function (res) {
      // console.log(JSON.parse(res));
      if (JSON.parse(res).status == "Update success") {
        // location.reload();
        let mainformno = $("#view_loadMainData").val();
        loadReportFarrel(mainformno);
        // loadReportCheckMachine(mainformno);
        // loadBomReport(mainformno);
        // loadBomMixReport(mainformno);

        $(".ex").val("");
        $('input:checkbox[id="notpass"]').prop("checked", false);
        $('input:checkbox[id="pass"]').prop("checked", false);
        $("#btn_saveAddf").prop("disabled", false);

        $("#addFeeder_modal").modal("hide");
      }
    },
  });
}

function loadReportCheckMachine(mainform) {
  $.ajax({
    url: "/intsys/msd/main/loadReportCheckMachine",
    method: "POST",
    data: {
      mainform: mainform,
    },
    beforeSend: function () {},
    success: function (res) {
      $("#showReportMachineCheck").html(res);

      const browserWidth = $(window).width();
      if (browserWidth <= 768) {
        $("#reportMachineCheckList").addClass("table-responsive");
      }

      $(window).resize(function () {
        if (browserWidth <= 768) {
          $("#reportMachineCheckList").addClass("table-responsive");
        }
      });

      var table = $("#reportMachineCheckList").DataTable({
        // scrollY:        "300px",
        // scrollX:        true,
        // scrollCollapse: true,
        paging: false,
        columnDefs: [
          {
            searching: false,
            orderable: false,
            targets: "_all",
          },
          { width: "600", targets: 0 },
          { width: "300", targets: 1 },
          { width: "300", targets: 2 }
        ],
        ordering: false,
      });
    },
  });
}

function loadBomReport(mainform) {
  $.ajax({
    url: "/intsys/msd/main/loadBomReport",
    method: "POST",
    data: {
      mainform: mainform,
    },
    beforeSend: function () {},
    success: function (res) {
      $("#showBomReport").html(res);

      const browserWidth = $(window).width();
      if (browserWidth <= 768) {
        $("#reportBomFormdb").addClass("table-responsive");
      }

      $(window).resize(function () {
        if (browserWidth <= 768) {
          $("#reportBomFormdb").addClass("table-responsive");
        }
      });

      var table = $("#reportBomFormdb").DataTable({
        // scrollY:        "300px",
        // scrollX:        true,
        // scrollCollapse: true,
        paging: false,
        columnDefs: [
          {
            searching: false,
            orderable: false,
            targets: "_all",
          },
          { width: "50", targets: 0 },
          { width: "300", targets: 1 },
          { width: "65", targets: 2 },
        ],
        ordering: false,
      });
    },
  });
}

function loadBomMixReport(mainform) {
  $.ajax({
    url: "/intsys/msd/main/loadBomMixReport",
    method: "POST",
    data: {
      mainform: mainform,
    },
    beforeSend: function () {},
    success: function (res) {
      $("#showBomMixReport").html(res);

      const browserWidth = $(window).width();
      if (browserWidth <= 768) {
        $("#reportBomMixFormdb").addClass("table-responsive");
      }

      $(window).resize(function () {
        if (browserWidth <= 768) {
          $("#reportBomMixFormdb").addClass("table-responsive");
        }
      });

      var table = $("#reportBomMixFormdb").DataTable({
        // scrollY:        "300px",
        // scrollX:        true,
        // scrollCollapse: true,
        paging: false,
        columnDefs: [
          {
            searching: false,
            orderable: false,
            targets: "_all",
          },
          { width: "50", targets: 0 },
          { width: "200", targets: 1 },
          { width: "50", targets: 2 },
        ],
        ordering: false,
      });
    },
  });
}

function saveCheckMachine() {
  $.ajax({
    url: "/intsys/msd/main/saveCheckMachine",
    method: "POST",
    data: $("#frm_saveCheckMachine").serialize(),
    beforeSend: function () {},
    success: function (res) {
      // console.log(JSON.parse(res));
      if (JSON.parse(res).status == "Update success") {
        // location.reload();

        let mainformno = $("#view_loadMainData").val();
        loadReportFarrel(mainformno);
        loadReportCheckMachine(mainformno);
        loadBomReport(mainformno);
        loadBomMixReport(mainformno);

        $('input:radio[name="addMc_status"]').prop("checked", false);
        $("#addMc_memo").val("");
        $("#addMc_emQc").val("");
        $("#addMc_moisture").val("");
        // $("#btn_saveAddCheckMachine").prop("disabled", true);

        $("#addCheckMachine_modal").modal("hide");
      }
    },
  });
}

function startPageTwo(mainform) {
  $.ajax({
    url: "/intsys/msd/main/startPageTwo",
    method: "POST",
    data: {
      mainform: mainform,
    },
    beforeSend: function () {
      $("#btn_reportStart").prop("disabled", true);
      $('.loader').fadeIn(1000);
    },
    success: function (res) {
      // console.log(JSON.parse(res));
      $('.loader').fadeOut(1000);
      if (JSON.parse(res).status == "Update success") {
        location.reload();
      }
    },
  });
}


function endPageTwo(mainform , stopmemo) {
  $.ajax({
    url: "/intsys/msd/main/endPageTwo",
    method: "POST",
    data: {
      mainform: mainform,
      stopmemo:stopmemo
    },
    beforeSend: function () {
      $('.loader').fadeIn(1000);
    },
    success: function (res) {
      // console.log(JSON.parse(res));
      $('.loader').fadeOut(1000);
      if (JSON.parse(res).status == "Update success") {
        location.reload();
      }
    },
  });
}


function cancelPage(mainform , cancelMemo) {
  $.ajax({
    url: "/intsys/msd/main/cancelPage",
    method: "POST",
    data: {
      mainform: mainform,
      cancelMemo: cancelMemo
    },
    beforeSend: function () {
      $('.loader').fadeIn(1000);
    },
    success: function (res) {
      // console.log(JSON.parse(res));
      $('.loader').fadeOut(1000);
      if (JSON.parse(res).status == "Update success") {
        location.reload();
      }
    },
  });
}




function calAvg(sumperhr, sumpermin) {
  let countVal = 0;
  let famDeviation = $("#acf_deviation").val();
  if ($("#addf_ex1").val() != "") {
    countVal += 1;
    $("#addf_ex1").removeClass("inputNull");
  } else {
    $("#addf_ex1").addClass("inputNull");
  }

  if ($("#addf_ex2").val() != "") {
    countVal += 1;
    $("#addf_ex2").removeClass("inputNull");
  } else {
    $("#addf_ex2").addClass("inputNull");
  }

  if ($("#addf_ex3").val() != "") {
    countVal += 1;
    $("#addf_ex3").removeClass("inputNull");
  } else {
    $("#addf_ex3").addClass("inputNull");
  }

  if ($("#addf_ex4").val() != "") {
    countVal += 1;
    $("#addf_ex4").removeClass("inputNull");
  } else {
    $("#addf_ex4").addClass("inputNull");
  }

  if ($("#addf_ex5").val() != "") {
    countVal += 1;
    $("#addf_ex5").removeClass("inputNull");
  } else {
    $("#addf_ex5").addClass("inputNull");
  }

  let sumPlus =
    parseFloat($("#addf_ex1").val()) +
    parseFloat($("#addf_ex2").val()) +
    parseFloat($("#addf_ex3").val()) +
    parseFloat($("#addf_ex4").val()) +
    parseFloat($("#addf_ex5").val());
  let sumAvg = sumPlus / countVal;
  let useSumAvg = 0;

  if (isNaN(sumAvg) == true) {
    useSumAvg = "-";
  } else {
    useSumAvg = sumAvg.toFixed(3);
  }

  $("#addf_exAvg").val(useSumAvg);

  // สูตรการหาค่าเบี่ยงเบน
  let deviation =
    ((sumAvg.toFixed(3) - sumpermin.toFixed(3)) * 100) / sumpermin.toFixed(3);
  let useDeviation = 0;

  if (isNaN(deviation) == true) {
    useDeviation = "-";
  } else {
    useDeviation = deviation.toFixed(3);
  }

  $("#addf_accept").val(useDeviation);

  // check pass or not pass
  // console.log(useDeviation);

  let conDeviation = parseFloat(Math.abs(useDeviation));

  if (useDeviation == "-") {
    $('input:checkbox[id="notpass"]').prop("checked", false);
    $('input:checkbox[id="pass"]').prop("checked", false);
    $("#btn_saveAddf").prop("disabled", false);
  } else {
    if (conDeviation <= parseFloat(famDeviation)) {
      $('input:checkbox[id="pass"]').prop("checked", true);
      $('input:checkbox[id="notpass"]').prop("checked", false);
    } else if (conDeviation > parseFloat(famDeviation)) {
      $('input:checkbox[id="notpass"]').prop("checked", true);
      $('input:checkbox[id="pass"]').prop("checked", false);
    }
  }

  // console.log(conDeviation + " "+ parseFloat(famDeviation));
  // console.log(jQuery.type(famDeviation));

  let checkBoxCheck = $('input:checkbox[name="addf_checkpass"]:checked');
  if (checkBoxCheck.length > 0) {
    $("#btn_saveAddf").prop("disabled", false);
  }
}

// Function สำหรับแปลงเวลาเป็น Milisecond
function conTimeInput(chooseTime) {
  const datenow = $("#nowdate").val() + " " + chooseTime;
  const new_Date = new Date(datenow);
  const resultTime = new_Date.getTime();
  return resultTime;
}

function conTimeInput2(chooseTime) {
  const datenow = $("#direcdate").val() + " " + chooseTime;
  const new_Date = new Date();
  const resultTime = new_Date.getMilliseconds();
  return resultTime;
}

function checkShiftTime(inputTime, ShiftTimeStart, ShiftTimeEnd) {
  const checkMdShift = $("#checkMdShift").val();

  if (inputTime < ShiftTimeStart) {
    // alert('กรุณาเลือกเวลาให้สัมพันธ์กับกะงาน'+checkMdShift);

    $("#alertChooseTime").fadeIn();
    $("#alertChooseTime").html(
      '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>กรุณาเลือกเวลาให้สัมพันธ์กับกะงาน ' +
        checkMdShift +
        '</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
    );
    $("#alertChooseTime").delay(3000).fadeOut();

    $("#rChooseTime").val("");
    return false;
  }
  if (inputTime > ShiftTimeEnd) {
    // alert('กรุณาเลือกเวลาให้สัมพันธ์กับกะงาน'+checkMdShift);

    $("#alertChooseTime").fadeIn();
    $("#alertChooseTime").html(
      '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>กรุณาเลือกเวลาให้สัมพันธ์กับกะงาน ' +
        checkMdShift +
        '</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
    );
    $("#alertChooseTime").delay(3000).fadeOut();

    $("#rChooseTime").val("");
    return false;
  }
}

function checkShiftTime2(inputTime, ShiftTimeStart, ShiftTimeEnd) {
  const checkMdShift = $("#checkMdShift").val();

  let nd = Date.parse($("#nowdate").val());
  let sd = Date.parse($("#direcdate").val());

  if (nd === sd) {
    // ถ้าเป็นวันเดียวกัน
    // console.log('เท่ากัน');
    if (inputTime < ShiftTimeStart) {
      // alert('กรุณาเลือกเวลาให้สัมพันธ์กับกะงาน '+checkMdShift);

      $("#alertChooseTime").fadeIn();
      $("#alertChooseTime").html(
        '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>กรุณาเลือกเวลาให้สัมพันธ์กับกะงาน ' +
          checkMdShift +
          '</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
      );
      $("#alertChooseTime").delay(3000).fadeOut();

      $("#rChooseTime").val("");
      return false;
    }
  } else {
    // console.log('ไม่เท่ากัน');
    if (inputTime > ShiftTimeEnd) {
      alert(
        "กรุณาเลือกเวลาให้สัมพันธ์กับกะงานโดยท่านสามารถ Key ล่วงหน้าได้ไม่เกิน 5 นาที " +
          checkMdShift
      );
      $("#rChooseTime").val("");
      return false;
    }
  }

  // console.log(nd+' '+sd);
}

//////////////////////////////////////////////
////////// Check เวลาซ้ำกันในกะนั้นๆ
/////////////////////////////////////////////
function checkDuplicateTime(subformno, inputTime) {
  $.ajax({
    url: "/intsys/msd/main/checkDuplicateTime",
    method: "POST",
    data: {
      subformno: subformno,
      inputTime: inputTime,
    },
    beforeSend() {},
    success(res) {
      // console.log(JSON.parse(res));
      if (JSON.parse(res).status == "Found Duplicate Data") {
        $("#rChooseTime").val("");

        $("#alertChooseTime").fadeIn();
        $("#alertChooseTime").html(
          '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>พบช่วงเวลาซ้ำในระบบ กรุณาระบุช่วงเวลาใหม่</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        $("#alertChooseTime").delay(3000).fadeOut();
      }
    },
  });
}

// Function Check Feeder percen
function checkFeederPercen() {
  const checkSumFeederValue = parseFloat($("#checkFeederSum").val());
  if (checkSumFeederValue != 100) {
    $("#btn_reportStart").prop("disabled", true);
  } else {
    $("#btn_reportStart").prop("disabled", false);
  }
}

// Control Image on runscreen
function getImageOnRun(detailFormno, data_fileType , mainFormno) {
  $.ajax({
    url: "/intsys/msd/main/getImageOnRun",
    method: "POST",
    data: {
      detailFormno: detailFormno,
      data_fileType: data_fileType,
      mainFormno:mainFormno
    },
    beforeSend: function () {},
    success: function (res) {
      $("#showImageonRun").html(res);
    },
  });
}


function countFeeder(mainformno)
{
  $.ajax({
    url:"/intsys/msd/main/countFeeder",
    method:"POST",
    data:{
      mainformno:mainformno
    },
    beforeSend(){

    },
    success(res){
      console.log(res);
      $('#countFeeder').val(res);
    }
  });
}



////////////////////////////////////////////////////////////
/////////////Control page viewmaindata.html
////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////
/////////////Control page setting_main.html class
////////////////////////////////////////////////////////////

//////////////////////////////////////////////
//////////Control หน้าบันทึกกะงาน
function saveSetShift() {
  $.ajax({
    url: "/intsys/msd/main/setting/saveSetShift",
    method: "POST",
    data: $("#setShift_frm").serialize(),
    beforeSend: function () {},
    success: function (res) {
      // console.log(JSON.parse(res));
      if (JSON.parse(res).status == "Insert success") {
        location.reload();
      }
    },
  });
}

function loadUserFromDb() {
  $.ajax({
    url: "/intsys/msd/main/setting/loadUserFromDb",
    method: "POST",
    data: {},
    beforeSend: function () {},
    success: function (res) {
      $("#showUserFromDb").html(res);

      $("#loadUserFormDb thead th").each(function () {
        var title = $(this).text();
        $(this).html(
          title +
            ' <input type="text" class="col-search-input" placeholder="Search ' +
            title +
            '" />'
        );
      });

      var table = $("#loadUserFormDb").DataTable({
        columnDefs: [
          {
            searching: false,
            orderable: false,
            targets: "_all",
          },
        ],
        ordering: false,
      });

      table.columns().every(function () {
        var table = this;
        $("input", this.header()).on("keyup change", function () {
          if (table.search() !== this.value) {
            table.search(this.value).draw();
          }
        });
      });
    },
  });
}

// FUNCTION CAL
function calBalance(value1, value2) {
  const bomBalance = parseFloat(value1) - parseFloat(value2);
  return bomBalance;
}








///////////////////////////////New Function /////////////////////////////////
function checkMixBalance(minInput , data_bomautoid)
{
  $.ajax({
    url:"/intsys/msd/main/countFeeder",
    method:"POST",
    data:{
      minInput:minInput,
      data_bomautoid: data_bomautoid

    },
    beforeSend:function(){

    },
    success:function(res){
      console.log(res);
    }
  });
}



////////////////////////////////////////////////////
///Check กะการทำงานตามช่วงเวลา
/// shift-a = 07.00 - 19.00
// shift-b = 19.00 - 07.00
function checkshift(inputtime , inputdate , datesystem)
{
  //inputdate = วันที่ปัจจุบัน , inputtime อันนี้ user เลือกเองได้
  // check time for assign shift
  if(inputtime > "07:00" && inputtime < "19:00"){
    console.log('test');
  }
}


function checkSubmainTable(mainFormno)
{
  $.ajax({
    url:"/intsys/msd/main/checkSubmainTable",
    method:"POST",
    data:{
      mainFormno:mainFormno
    },
    beforeSend(){

    },
    success(res){
      $('#returnCheckShift').val(res);
    }
  });
}



function getProductCode(productCode)
{
  $.ajax({
    url:"/intsys/msd/main/getProductCode",
    method:"POST",
    data:{
      productCode: productCode
    },
    beforeSend(){

    },
    success(res){
      $('#showProductCode').html(res);
    }
  });
}



function saveTemplateDetail()
{
  const form = $("#frm_editTemplate")[0];
  const data = new FormData(form);

  $.ajax({
    url: "/intsys/msd/main/saveTemplateDetail",
    type: "POST",
    enctype: "multipart/form-data",
    data: data,
    processData: false,
    contentType: false,
    beforeSend: function () {},
    success: function (res) {
      console.log(JSON.parse(res));

      if (JSON.parse(res).status == "Insert Success") {
        location.reload();
      }

    },
  });
}


function saveChangeTemplateDetail()
{
  const form = $("#frm_editTemplate")[0];
  const data = new FormData(form);

  $.ajax({
    url: "/intsys/msd/main/saveEditTemplateDetail",
    type: "POST",
    enctype: "multipart/form-data",
    data: data,
    processData: false,
    contentType: false,
    beforeSend: function () {},
    success: function (res) {
      console.log(JSON.parse(res));

      if (JSON.parse(res).status == "Insert Success") {
        location.reload();
      }

    },
  });
}



function exportdata(mainformno)
{
  $.ajax({
    url:"/intsys/msd/main/exportdata",
    method:"POST",
    data:{
      mainformno: mainformno
    },
    beforeSend(){},
    success(res){
      console.log(res);
    }
  });
}



function loadQcSampling(batchnumber , productnumber , productcode , dataareaid) {
  $.ajax({
    url: "/intsys/msd/main/loadQcSampling",
    method: "POST",
    data: {
      batchnumber: batchnumber,
      productnumber: productnumber,
      productcode: productcode,
      dataareaid: dataareaid
    },
    beforeSend: function () {},
    success: function (res) {

      // console.log(res);

      $("#showQcSampling").html(res);

      const browserWidth = $(window).width();
      if (browserWidth <= 768) {
        $("#qcSamplingTable").addClass("table-responsive");
      }

      $(window).resize(function () {
        if (browserWidth <= 768) {
          $("#qcSamplingTable").addClass("table-responsive");
        }
      });

      var table = $("#qcSamplingTable").DataTable({
        paging: false,
        columnDefs: [
          {
            searching: false,
            orderable: false,
            targets: "_all",
          },
          { width: "120", targets: 0 },
          { width: "100", targets: 1 },
          { width: "50", targets: 2 },
          { width: "100", targets: 3 },
          { width: "100", targets: 4 },
          { width: "80", targets: 5 },
          { width: "80", targets: 6 },
          { width: "80", targets: 7 },
          { width: "80", targets: 8 },
          { width: "80", targets: 9 },
          { width: "200", targets: 10 }
        ],
        ordering: false,
      });

      const checkQcID = $('#checkQcID').val();
      const mainformno = $('#view_loadMainData').val();
      if(checkQcID != "" && mainformno != ""){
        loadGraphByItem(checkQcID , mainformno);
      }
      

    }
  });
}






