$(document).ready(function () {

$(document).on('click' , '#l_viewmain' , function(){
  $('.loader').fadeIn();
});


  // Check แผนกว่าใช่ Production ไหม
  if ($("#checkDeptCode").val() == "1007") {
    console.log("สวัสดีทีมงาน Production");

    // Check ตำแหน่งงานว่าเป็นพนักงานระดับไหนเพื่อกำหนด Permission
    if ($("#checkPosi").val() == 15) {
      console.log("คุณคือ พนักงานทั่วไป");
      $("#m_list").css("display", "none");
    } else if ($("#checkPosi").val() > 15) {
      console.log("คุณคือ พนักงานระดับหัวหน้างานขึ้นไป");
    }
  } else {
    console.log("คุณไม่ได้อยู่แผนก Production ครับ");
  }

  let checkDeptCode = $("#checkDeptCode").val();
  //////////////////////////////////
  /////Check session ecode
  //////////////////////////////////
  let sessionEcode = $("#checkSessionEcode").val();

  if (sessionEcode !== "") {
    $("#nonelogin").css("display", "none");
    $("#loginalready").css("display", "");
  } else {
    $("#nonelogin").css("display", "");
    $("#loginalready").css("display", "none");
  }

  ///////////////////////////////////
  ///////////Save main data
  //////////////////////////////////

  // Check Dept Permission ก่อนที่จะรันคำสั่งอื่นให้ทำการเช็คสิทธิ์ก่อน
  if (checkDept(checkDeptCode) == true) {
    $(".topmenu").css("display", ""); //ซ่อนปุ่ม เพิ่มรายการหลัก
  } else {
    if (sessionEcode != "M1809") {
      $(".topmenu").css("display", "none"); //ซ่อนปุ่ม เพิ่มรายการหลัก
      $("#m_list").css("display", "none"); //ซ่อนเมนู Setting

      if ($("#checkpage").val() == "viewmaindata.html") {
        $(".btnViewPage1").css("display", "none");
        $(".forViewPage21").css("display", "none");

        // Control Section สร้างกะงาน
        $("#submain_frm").css("display", "none");
        $(".sectionShift").css("display", "none");
        // Control Section สร้างกะงาน

        $(".forviewPage1").css("display", "none");

      }

    }
  }
  // Check Dept Permission ก่อนที่จะรันคำสั่งอื่นให้ทำการเช็คสิทธิ์ก่อน



  // Control add_modal
  $("#btn_saveMaindata").click(function () {
    //////////////////////////
    // Validate input element
    if ($("#fam_dataareaid").val() == "") {
      $("#fam_dataareaid").addClass("inputNullNew");
    } else {
      $("#fam_dataareaid").removeClass("inputNullNew");
    }
    $("#fam_dataareaid").blur(function () {
      if ($(this).val() != "") {
        $("#fam_dataareaid").removeClass("inputNullNew");
      }
    });


    if ($("#fam_prodid").val() == "") {
      $("#fam_prodid").addClass("inputNullNew");
    } else {
      $("#fam_prodid").removeClass("inputNullNew");
    }
    $("#fam_prodid").blur(function () {
      if ($(this).val() != "") {
        $("#fam_prodid").removeClass("inputNullNew");
      }
    });


    if ($("#fam_machinename").val() == "") {
      $("#fam_machinename , #machineSearch , .chooseTemplateUl").addClass("inputNullNew");
      // alert('กรุณาคลิกเลือกเครื่องจักรด้วยค่ะ');
    } else {
      $("#fam_machinename , #machineSearch , .chooseTemplateUl").removeClass("inputNullNew");
    }
    $("#fam_machinename").blur(function () {
      if ($(this).val() != "") {
        $("#fam_machinename , #machineSearch , .chooseTemplateUl").removeClass("inputNullNew");
      }
    });


    if ($("#fam_mis").val() == "") {
      $("#fam_mis").addClass("inputNullNew");
    } else {
      $("#fam_mis").removeClass("inputNullNew");
    }
    $("#fam_mis").blur(function () {
      if ($(this).val() != "") {
        $("#fam_mis").removeClass("inputNullNew");
      }
    });


    if ($("#fam_output").val() == "") {
      $("#fam_output").addClass("inputNullNew");
    } else {
      $("#fam_output").removeClass("inputNullNew");
    }
    $("#fam_output").blur(function () {
      if ($(this).val() != "") {
        $("#fam_output").removeClass("inputNullNew");
      }
    });


    $("#fam_prodid").keyup(function () {
      if ($(this).val() == "") {
        $("#fam_productcode , #fam_batchnumber").val("");
      }
    });


    //////////////////////////
    // Validate input element

    if (
      $("#fam_dataareaid").val() != "" &&
      $("#fam_prodid").val() != "" &&
      $("#fam_machinename").val() != "" &&
      $("#fam_productcode").val() != "" &&
      // $("#fam_batchnumber").val() != "" &&
      $('#fam_mis').val() != "" &&
      $('#fam_output').val() != ""
    ) {
      savemain();
    }
  });

  ///////////////////////////////////
  ///////////Save main data
  //////////////////////////////////

  $('#btn_closeMaindata').click(function(){
    $('form#maindata input').val('');
    $('#fam_dataareaid').val('');
  })
// Control add_modal



  //////////////////////////////////
  /////////Save sub main data
  //////////////////////////////////

  $("#btn_addSub").click(function () {
    saveSubMain();
  });

  //////////////////////////////////
  /////////Save sub main data
  //////////////////////////////////

  $(document).on('click' , '.cancelMemoView' , function(){
    const data_cancelMemo = $(this).attr("data_cancelMemo");
    $('#cancelView_modal').modal("show");
    
    $('#cancelView_memo').text(data_cancelMemo);
  });

  ////////////////////////////////////////////////////////////
  /////////////Control page viewmaindata.html
  ////////////////////////////////////////////////////////////

  if ($("#checkpage").val() == "viewmaindata.html") {
    // Frist load on page

    let browserScreen = $(window).width();
    if (browserScreen <= 375) {
      $(
        "#btn_addrun1 , #btn_editrun1 , #btn_stopprocess1 , #btn_add_submain_frm"
      ).css("width", "100%");
    }

    if ($("#check_fasub_formno").val() != "") {
      $("#runscreen_sec").css("display", "none");
    }

    /////////////////////////////////////////////////////////////////
    // Function นี้จะทำงานเมื่อกดที่วัตถุดิบนั้นๆ
    // จากนั้นจะทำการส่งค่าต่างๆที่เกี่ยวข้องกับวัตถุดิบนั้นผ่าน Attribute ต่างๆ
    $(document).on("click", ".md_bom", function () {
      $("#md_bom").modal("show");

      const data_mainformno = $(this).attr("data_mainformno");
      const data_prodid = $(this).attr("data_prodid");
      const data_rawmaterial = $(this).attr("data_rawmaterial");
      const data_bomqty = $(this).attr("data_bomqty");
      const data_bomsum = $(this).attr("data_bomsum");
      const data_bomautoid = $(this).attr("data_bomautoid");
      const data_bomqtyuse = $(this).attr("data_bomqtyuse");
      const data_productcode = $(this).attr("data_productcode");
      const data_batchnumber = $(this).attr("data_batchnumber");
      const data_bomstatus = $(this).attr("data_bomstatus");
      const data_bombalance = $(this).attr("data_bombalance");

      // console.log(data_rawmaterial+" = "+data_bomqty);

      $("#btn_mixmat").css("display", "");
      $("#md_bom_cancelMix").css("display", "none");

      ////////////////////////////////////////////////
      // Condition สำหรับการ Control Modal จัดการวัตถุดิบ
      if (data_bomsum == 0) {
        $("#md_bom_canuse").css("display", "none");
        $("#md_bom_notuse").css("display", "");
      } else {
        $("#md_bom_canuse").css("display", "");
        $("#md_bom_notuse").css("display", "none");
      }

      if (data_bomstatus == "wait confirm") {
        $("#cbtn_addmat").css("display", "none");
      } else {
        $("#cbtn_addmat").css("display", "");
      }
      // Condition สำหรับการ Control Modal จัดการวัตถุดิบ
      ///////////////////////////////////////////////



      ////////////////////////////////////////////////////////////
      // Check ช่องรายการ Mix และ จำนวน Value รวมของการ Mix
      // ที่อยู่ใน bom_modal
      // Check mix input
      if (
        $("#mixDataInput").val() == "" &&
        $("#mixValueDataInput").val() == ""
      ) {
        waitConfirmMix(data_mainformno);
        countConfirmMix(data_mainformno);
      }
      
      // Check ช่องรายการ Mix และ จำนวน Value รวมของการ Mix
      // ที่อยู่ใน bom_modal
      ////////////////////////////////////////////////////////////




    ///////////////////////////////////////////////////////////////////////////////////
    //ถ้ากดปุ่ม Mix เข้ามาและพบว่า Input:mixDataInput ไม่มีข้อมูลอยู่ให้เอาปุ่ม ยืนยันการ Mix ออก
      if($("#mixDataInput").val() == ""){
        $('#btn_adddataMix').css('display' , 'none');
      }
    //ถ้ากดปุ่ม Mix เข้ามาและพบว่า Input:mixDataInput ไม่มีข้อมูลอยู่ให้เอาปุ่ม ยืนยันการ Mix ออก
    ///////////////////////////////////////////////////////////////////////////////////






      ////////////////////////////////////////////////////////////////////////////////////////
      ////////////////การตำนวณ แบ่ง Item ลง Feeder
      ///////////////////////////////////////////////////////////////////////////////////////
      let bombalance = 0;
      let bomQty = 0;
      let bomQtyUse = 0;
      let bombalance2 = 0;
      let result = 0;

      if (parseFloat(data_bomqtyuse) === 0) {
        bombalance = parseFloat(data_bomqty);
        bomQty = parseFloat(data_bomqty);
        bomQtyUse = parseFloat(data_bomqtyuse);
      } else if (parseFloat(data_bomqtyuse) > 0) {
        bombalance = parseFloat(data_bomsum);
        bomQty = parseFloat(data_bomqtyuse) + parseFloat(data_bomsum);
        bomQtyUse = parseFloat(data_bomqtyuse);
      }

      console.log(
        "AutoID: " +
          data_bomautoid +
          " " +
          " Bom Balance: " +
          data_bombalance +
          " Bom QTY: " +
          bomQty +
          " Bom QTY USE:" +
          bomQtyUse
      );

      $("#textMatname , #textMatname2").text(data_rawmaterial);
      $("#textValue , #textValue2").text(bombalance.toFixed(3));
      $("#md_mainformno").val(data_mainformno);
      $("#md_prodid").val(data_prodid);
      $("#md_rawmaterial").val(data_rawmaterial);
      $("#md_autoid").val(data_bomautoid);
      $("#md_qtyuse").val(data_bomqtyuse);

      $("#md_qtyBalance").val(bomQty - bomQty);
      $("#md_qtyuseCal").val(bomQty);

      // ส่งค่าไป Form ใส่วัตถุดิบลง Feeder
      $("#md_value").val(bombalance.toFixed(3));

      // ส่งค่าไป Form Mix bom
      $("#mix_prodid").val(data_prodid);

      // ส่งค่าไป Title modal
      $("#showDetail_md_addmatFeeder").html(
        "<b>Product ID : </b>" +
          data_prodid +
          "&nbsp;&nbsp;<b>Product Code : </b>" +
          data_productcode +
          "<br><b>Batch Number : </b>" +
          data_batchnumber
      );

      chooseFeeder(data_mainformno);

      $("#md_value").keyup(function () {
        let sumValue = 0;
        let sumUse = 0;
        if ($("#md_value").val() == "") {
          sumValue = parseFloat(bombalance);
        } else {
          // sumValue = parseFloat(resultQty) - parseFloat($('#md_value').val());
          sumValue = calBalance(parseFloat(bombalance), $("#md_value").val());
        }

        if (sumValue < 0) {
          $("#textValue2").text(sumValue.toFixed(3)).css("color", "#e20707");
        } else {
          $("#textValue2").text(sumValue.toFixed(3)).css("color", "#009900");
        }

        sumUse = parseFloat($("#md_value").val()) + bomQtyUse;

        if (isNaN(sumUse) == true) {
          sumUse = 0;
        }

        $("#md_qtyBalance").val(sumValue.toFixed(3));
        $("#md_qtyuseCal").val(sumUse.toFixed(3));

        // Check จำนวนของวัตถุดิบที่ระบุว่า เกินจำนวนที่มีอยู่หรือไม่
        const inputvalue = parseFloat($("#md_value").val());
        if (inputvalue > parseFloat(bombalance)) {
          // console.log('จำนวน วัตถุดิบไม่พอ');
          $("#btn_adddatafeeder").prop("disabled", true);
          $("#alertMdvalue").html(
            '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>วัตถุดิบไม่พอค่ะ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
          );
          $("#md_value").addClass("inputNull");
        } else {
          $("#alertMdvalue").html("");
          $("#btn_adddatafeeder").prop("disabled", false);
          $("#md_value").removeClass("inputNull");
        }
        // Check จำนวนของวัตถุดิบที่ระบุว่า เกินจำนวนที่มีอยู่หรือไม่
      });

      ////////////////////////////////////////////////////////////////////////////////////////
      ////////////////การตำนวณ แบ่ง Item ลง Feeder
      ///////////////////////////////////////////////////////////////////////////////////////

      // Mix modal
      $("#mix_mainformno").val(data_mainformno);
      getBomForMix(data_mainformno);
      getBomForMix2(data_mainformno);
    });

    // ถ้าเลือกกดที่ปุ่ม "ใส่วัตถุดิบ"
    $("#btn_addmat").click(function () {
      $("#md_addmatFeeder").modal("show");
      $("#md_bom").modal("hide");
    });
    //ถ้ากดปิด Modal "ใส่วัตถุดิบ"
    $("#close_md_addmatFeeder").click(function () {
      $("#md_addmatFeeder").modal("hide");
      $("#md_bom").modal("show");
      $("#md_chooseFeeder , #md_value").val("");
      $("#textValue2").text("");
    });

    // Function นี้จะทำงานเมื่อกดที่วัตถุดิบนั้นๆ
    // จากนั้นจะทำการส่งค่าต่างๆที่เกี่ยวข้องกับวัตถุดิบนั้นผ่าน Attribute ต่างๆ
    /////////////////////////////////////////////////////////////////

    let sumdata = 0;
    $("#btn_clearDatafeeder").click(function () {
      $("#mixDataInput").val("");
      $("#mixValueDataInput").val("");
      sumdata = 0;
    });

    $("#close_md_saveMix").click(function () {
    let mainFormno = $("#view_loadMainData").val();
      $("#mixDataInput").val("");
      $("#mixValueDataInput").val("");
      sumdata = 0;
      // location.reload();
      loadGetBom(mainFormno);
      loadGetBomMix(mainFormno);
    });

    $("#btn_adddataMix").click(function () {
      let material = $("#mixDataInput").val();
      let bomqty = $("#mixValueDataInput").val();
      const data_mainformno = $("#mix_mainformno").val();
      const data_prodid = $("#mix_prodid").val();

      saveDataMix(data_mainformno, data_prodid, material, bomqty);
    });

    $("#btn_mixmat").click(function () {
      $("#md_mixmatFeeder").modal("show");
      $("#md_bom").modal("hide");
    });

    //////////////////////////////////////////////////
    /////// Function การกดเลือกวัตถุดิบที่จะผสม

    $(document).on("click", ".mix_bom", function () {
      const data_rawmaterial = $(this).attr("data_rawmaterial");
      const data_bomqty = $(this).attr("data_bomqty");
      const data_bomqtyuse = $(this).attr("data_bomqtyuse");
      const data_bombalance = $(this).attr("data_bombalance");
      const data_b_autoid = $(this).attr("data_b_autoid");
      const data_mainformno = $("#mix_mainformno").val();
      const data_b_prodid = $(this).attr("data_b_prodid");
      const data_bomstatus = $(this).attr("data_bomstatus");

      // $('#md_getValueForMix').modal('show');
      // $('#md_mixmatFeeder .modal-content').css('display' , 'none');
      // $('#md_mixmatFeeder').modal('hide');

      //Cal สำหรับใช้งานตอน Mix
      let calBombalance = 0;
      let calBomqtyUse = 0;
      let calBomqtyUseMix = 0;
      if (data_bomstatus == "active") {
        calBomqtyUseMix = parseFloat(data_bombalance);
      } else if (data_bomstatus == "wait confirm") {
        calBomqtyUseMix = 0;
      }

      activeMix(data_b_autoid, data_mainformno, calBomqtyUseMix);

      console.log("AutoID:" + data_b_autoid + " BomBalance:" + data_bombalance);

      //get value to md_getValueForMix Modal
      $("#gv_bom").val(data_bomqty);
      $("#gv_item").text(data_rawmaterial);
      $("#gv_b_autoid").val(data_b_autoid);
      $("#gv_b_prodid").val(data_b_prodid);
      $("#gv_mainformNo").val(data_mainformno);
      $("#gv_rawmat").val(data_rawmaterial);
      //get value to md_getValueForMix Modal



      // if($("#mixDataInput").val() == ""){
      //   $('#btn_adddataMix').css('display' , 'none');
      // }else{
      //   $('#btn_adddataMix').css('display' , '');
      // }

     
    });

    ///////////////////////////////////////////////////
    //////////////Confirm for mix
    // $('#gv_btn_confirm').click(function(){
    //     getValueBomMix();
    // });








    $(document).on("click", "#close_md_getValMix", function () {
      // $('#md_mixmatFeeder .modal-content').css('display' , '');
      $("#md_getValueForMix").modal("hide");
      $("#md_mixmatFeeder").modal("show");
    });
    //////////////////////////////////////////////////
    /////// Function การกดเลือกวัตถุดิบที่จะผสม

    $(document).on("click", ".bommixed", function () {
        $("#md_bom").modal("show");
      const data_mainformno = $(this).attr("data_mainformno");
      const data_prodid = $(this).attr("data_prodid");
      const data_rawmaterial = $(this).attr("data_rawmaterial");
      const data_bomqty = $(this).attr("data_bomqty");
      const data_bomsum = $(this).attr("data_bomsum");
      const data_bomtype = $(this).attr("data_bomtype");
      const data_bomautoid = $(this).attr("data_bomautoid");
      const data_bomqtyuse = $(this).attr("data_bomqtyuse");
      const data_productcode = $(this).attr("data_productcode");
      const data_batchnumber = $(this).attr("data_batchnumber");

      $("#can_mainformno").val(data_mainformno);

      // Hide button mix bom on modal
      if (data_bomtype == "Mix") {
        $("#btn_mixmat").css("display", "none");
      } else {
        $("#btn_mixmat").css("display", "");
      }

      $("#btn_addmat").css("display", "");

     $("#cbtn_addmat").css("display", "");


      // $('#md_bom_cancelMix').css('display' , '');
      // Check การใช้ Bommix ว่ามีการ๔ุกดึงไปใช้หรือยัง Control ปุ่มยกเลิกการ Mix ทั้งหมด
      if ($("#cBomMixUse").val() < $("#cBomMix_total").val()) {
        $("#md_bom_cancelMix").css("display", "none");
      } else if ($("#cBomMixUse").val() == $("#cBomMix_total").val()) {
        $("#md_bom_cancelMix").css("display", "");
      }
      // Check การใช้ Bommix ว่ามีการ๔ุกดึงไปใช้หรือยัง Control ปุ่มยกเลิกการ Mix ทั้งหมด

      if (data_bomsum == 0) {
        $("#md_bom_canuse").css("display", "none");
        $("#md_bom_notuse").css("display", "");
      } else {
        $("#md_bom_canuse").css("display", "");
        $("#md_bom_notuse").css("display", "none");
      }

      ////////////////////////////////////////////////////////////////////////////////////////
      ////////////////การตำนวณ แบ่ง Item ลง Feeder
      ///////////////////////////////////////////////////////////////////////////////////////
      let bombalance = 0;
      let bomQty = 0;
      let bomQtyUse = 0;
      let bombalance2 = 0;
      let result = 0;

      if (parseFloat(data_bomqtyuse) === 0) {
        bombalance = parseFloat(data_bomqty);
        bomQty = parseFloat(data_bomqty);
        bomQtyUse = parseFloat(data_bomqtyuse);
      } else if (parseFloat(data_bomqtyuse) > 0) {
        bombalance = parseFloat(data_bomsum);
        bomQty = parseFloat(data_bomqtyuse) + parseFloat(data_bomsum);
        bomQtyUse = parseFloat(data_bomqtyuse);
      }

      console.log(
        "AutoID: " +
          data_bomautoid +
          " " +
          " Bom Balance: " +
          bombalance +
          " Bom QTY: " +
          bomQty +
          " Bom QTY USE:" +
          bomQtyUse
      );

      // Check qty label
      // let resultQty = 0;
      // if (data_bomqtyuse === 0) {
      //     resultQty = data_bomqty;
      // } else {
      //     resultQty = data_bomqty - data_bomqtyuse;
      // }
      // console.log(resultQty);

      $("#textMatname , #textMatname2").text(data_rawmaterial);
      $("#textValue , #textValue2").text(bombalance.toFixed(3));
      $("#md_mainformno").val(data_mainformno);
      $("#md_prodid").val(data_prodid);
      $("#md_rawmaterial").val(data_rawmaterial);
      $("#md_autoid").val(data_bomautoid);
      $("#md_qtyuse").val(data_bomqtyuse);

      $("#md_qtyBalance").val(bomQty - bomQty);
      $("#md_qtyuseCal").val(bomQty);

      // ส่งค่าไป Form ใส่วัตถุดิบลง Feeder
      $("#md_value").val(bombalance.toFixed(3));

      // ส่งค่าไป Title modal
      $("#showDetail_md_addmatFeeder").html(
        "<b>Product ID : </b>" +
          data_prodid +
          "&nbsp;&nbsp;<b>Product Code : </b>" +
          data_productcode +
          "<br><b>Batch Number : </b>" +
          data_batchnumber
      );

      chooseFeeder(data_mainformno);

      $("#md_value").keyup(function () {
        let sumValue = 0;
        let sumUse = 0;
        if ($("#md_value").val() == "") {
          sumValue = parseFloat(bombalance);
        } else {
          // sumValue = parseFloat(resultQty) - parseFloat($('#md_value').val());
          sumValue = calBalance(parseFloat(bombalance), $("#md_value").val());
        }

        if (sumValue < 0) {
          $("#textValue2").text(sumValue.toFixed(3)).css("color", "#e20707");
        } else {
          $("#textValue2").text(sumValue.toFixed(3)).css("color", "#009900");
        }

        sumUse = parseFloat($("#md_value").val()) + bomQtyUse;

        if (isNaN(sumUse) == true) {
          sumUse = 0;
        }

        $("#md_qtyBalance").val(sumValue.toFixed(3));
        $("#md_qtyuseCal").val(sumUse.toFixed(3));

        // Check จำนวนของวัตถุดิบที่ระบุว่า เกินจำนวนที่มีอยู่หรือไม่
        const inputvalue = parseFloat($("#md_value").val());
        if (inputvalue > parseFloat(bombalance)) {
          // console.log('จำนวน วัตถุดิบไม่พอ');
          $("#btn_adddatafeeder").prop("disabled", true);
          $("#alertMdvalue").html(
            '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>วัตถุดิบไม่พอค่ะ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
          );
          $("#md_value").addClass("inputNull");
        } else {
          $("#alertMdvalue").html("");
          $("#btn_adddatafeeder").prop("disabled", false);
          $("#md_value").removeClass("inputNull");
        }
        // Check จำนวนของวัตถุดิบที่ระบุว่า เกินจำนวนที่มีอยู่หรือไม่
      });
    });

    ///////////////////////////////////////
    // Function การยกเลิกการ Mix
    $("#btn_canMixmat").click(function () {
      if (confirm("คุณต้องการยกเลิกการ Mix ใช่หรือไม่") == true) {
        const can_mainformno = $("#can_mainformno").val();
        canCelMix(can_mainformno);
      }
    });

    // $("#close_md_addmatFeeder").click(function () {
    //   $("#md_chooseFeeder , #md_value").val("");
    //   $("#textValue2").text("");
    // });

    $("#btn_adddatafeeder").click(function () {
      saveDataToFeeder();
    });

    // Delete Feeder value
    $(document).on("click", ".iconFeedDel", function () {
      const data_autoid = $(this).attr("data_autoid");
      const data_mainformno = $(this).attr("data_mainformno");
      const data_prodid = $(this).attr("data_prodid");
      const data_rawmaterial = $(this).attr("data_rawmaterial");
      const data_value = $(this).attr("data_value");
      const data_rawautoid = $(this).attr("data_rawautoid");
      const data_itemusemix = $(this).attr("data_itemusemix");

      if (confirm("คุณต้องการลบรายการนี้ทิ้งใช่หรือไม่") == true) {
        // console.log('ลบรายการทิ้งแล้ว');
          delValueFeeder(
            data_autoid,
            data_mainformno,
            data_prodid,
            data_rawmaterial,
            data_value,
            data_rawautoid
          );
        
      } else {
        // console.log('ยังไม่ได้ลบรายการนี้ทิ้ง');
      }
    });

    ////////////////////////////////////////////////////
    ////////// Control การกำหนดค่า S Point
    ///////////////////////////////////////////////////
    $(document).on("focus", ".runvalueCheck", function () {
      const data_mat_autoid = $(this).attr("data_mat_autoid");
      const min = $("#sMinValue" + data_mat_autoid).val();
      const max = $("#sMaxValue" + data_mat_autoid).val();
      // console.log("Auto ID :"+data_mat_autoid);
      $(this).select();
      // console.log("Min:"+min+" Max:"+max);

      $(document).on("blur", "#sRunscreenValue" + data_mat_autoid, function () {
        //    console.log($('#sRunscreenValue'+data_mat_autoid).val());
        const sRunscreenValue = $("#sRunscreenValue" + data_mat_autoid);
        if (sRunscreenValue.val() != "") {
          if (sRunscreenValue.val() < min && sRunscreenValue.val() != 0) {
            // console.log('ค่าที่ระบุน้อยกว่าที่ระบบกำหนด');
            sRunscreenValue.addClass("inputNull");
          } else {
            sRunscreenValue.removeClass("inputNull");
          }
          if (sRunscreenValue.val() > max) {
            // console.log('ค่าที่ระบุมากกว่าที่ระบบกำหนด');
            sRunscreenValue.addClass("inputNull2");
          } else {
            sRunscreenValue.removeClass("inputNull2");
          }
        } else {
          sRunscreenValue.addClass("inputNull");
        }
      });

      $(document).on(
        "keyup",
        "#sRunscreenValue" + data_mat_autoid,
        function () {
          //    console.log($('#sRunscreenValue'+data_mat_autoid).val());
          const sRunscreenValue = $("#sRunscreenValue" + data_mat_autoid);
          const checkNumber = /^[^A-Za-zก-เ]{1,20}$/.test(
            $("#sRunscreenValue" + data_mat_autoid).val()
          );
          if (checkNumber == false) {
            $("#sRunscreenValue" + data_mat_autoid).val("");
            sRunscreenValue.addClass("inputNull");
          } else {
            sRunscreenValue.removeClass("inputNull");

            if (sRunscreenValue.val() != "") {
              if (sRunscreenValue.val() < min && sRunscreenValue.val() != 0) {
                // console.log('ค่าที่ระบุน้อยกว่าที่ระบบกำหนด');
                sRunscreenValue.addClass("inputNull");
              } else {
                sRunscreenValue.removeClass("inputNull");
              }
              if (sRunscreenValue.val() > max) {
                // console.log('ค่าที่ระบุมากกว่าที่ระบบกำหนด');
                sRunscreenValue.addClass("inputNull2");
              } else {
                sRunscreenValue.removeClass("inputNull2");
              }
            } else {
              sRunscreenValue.addClass("inputNull");
            }
          }
        }
      );
    });
    ////////////////////////////////////////////////////
    ////////// Control การกำหนดค่า S Point
    ///////////////////////////////////////////////////

    ////////////////////////////////////////////////////
    ////////// Control การแก้ไขค่า Run Screen
    ///////////////////////////////////////////////////

    $(document).on("focus", ".runvalueCheckEdit", function () {
      const data_far_autoid = $(this).attr("data_far_autoid");
      const min = $("#editMinValue" + data_far_autoid).val();
      const max = $("#editMaxValue" + data_far_autoid).val();
      // console.log('Autoid:'+data_far_autoid+' Min:'+min+' Max:'+max);
      $(this).select();

      $(document).on(
        "keyup",
        "#sRunscreenValue" + data_far_autoid,
        function () {
          const sRunscreenValue = $("#sRunscreenValue" + data_far_autoid);
          const checkNumber = /^[^A-Za-zก-เ]{1,20}$/.test(
            $("#sRunscreenValue" + data_far_autoid).val()
          );
          if (checkNumber == false) {
            $("#sRunscreenValue" + data_far_autoid).val("");
            sRunscreenValue.addClass("inputNull");
          } else {
            sRunscreenValue.removeClass("inputNull");

            if (sRunscreenValue.val() != "") {
              if (sRunscreenValue.val() < min && sRunscreenValue.val() != 0) {
                // console.log('ค่าที่ระบุน้อยกว่าที่ระบบกำหนด');
                sRunscreenValue.addClass("inputNull");
              } else {
                sRunscreenValue.removeClass("inputNull");
              }
              if (sRunscreenValue.val() > max) {
                // console.log('ค่าที่ระบุมากกว่าที่ระบบกำหนด');
                sRunscreenValue.addClass("inputNull2");
              } else {
                sRunscreenValue.removeClass("inputNull2");
              }
            } else {
              sRunscreenValue.addClass("inputNull");
            }
          }
        }
      );
    });

    ////////////////////////////////////////////////////
    ////////// Control การแก้ไขค่า Run Screen
    ///////////////////////////////////////////////////
  }
  ////////////////////////////////////////////////////////////
  /////////////Control page viewmaindata.html
  ////////////////////////////////////////////////////////////





  ////////////////////////////////////////////////////////////
  /////////////Control page viewmaindata.html
  ////////////////////////////////////////////////////////////
  if ($("#checkpage").val() == "viewmaindata.html") {
    let template = $("#fam_machinenameV").val();
    let mainFormno = $("#view_loadMainData").val();

    let batchnumber = $('#checkDataBatchNumber').val();
    let productnumber = $('#checkDataProductNumber').val();
    let productcode = $('#checkDataProductCode').val();
    let dataareaid = $('#checkDataAreaid').val();
    // loadTemplate(template);
    // getsubmaindata(mainFormno);

    // showSubmainData(mainFormno);

    $('#tabpage1').click(function(){
      const id = $(this).attr("href").substr(1);
      window.location.hash = id;
    });
    $('#tabpage2').click(function(){
      const id = $(this).attr("href").substr(1);
      window.location.hash = id;
    });
    $('#tabpage3').click(function(){
      const id = $(this).attr("href").substr(1);
      window.location.hash = id;
    });


    loadQcSampling(batchnumber , productnumber , productcode , dataareaid);

    loadGetBom(mainFormno);
    loadGetBomMix(mainFormno);
    loadFeederTemp(mainFormno);

    checkFeederPercen();

    countFeeder(mainFormno);

    ////////////////////////////////////////////
    ////////save submain
    $("#btn_add_submain_frm").click(function () {
      saveSubmain();
    });
    ////////save submain
    ///////////////////////////////////////////

    ////////////////////////////////////////////
    ////////save S/Point

    $("#btn_addSpoint").click(function () {
      let data_template = $(this).attr("data_template");
      let data_mainform = $(this).attr("data_mainform");
      let data_prodid = $(this).attr("data_prodid");
      let data_productcode = $(this).attr("data_productcode");
      let data_batchnumber = $(this).attr("data_batchnumber");

      $("#showTemplateText").text(data_template);
      $("#sPointTemplatename").val(data_template);
      $("#sPointMainForm").val(data_mainform);

      // ส่งค่าไป Title modal
      $("#show_spoint_modal").html(
        "<span><b>บันทึก S Point</b><hr></span><b>Product ID : </b>" +
          data_prodid +
          "&nbsp;&nbsp;<b>Product Code : </b>" +
          data_productcode +
          "<br><b>Batch Number : </b>" +
          data_batchnumber
      );

      loadTemplateSpoint(data_template);
    });

    $("#btn_saveSpoint").click(function () {
      checkSaveSpoint();
    });

    if ($("#checkSpointDataOnDatabase").val() != 0) {
      $("#btn_addSpoint").css("display", "none");
      $(".check_btn_addSpoint").css("display", "none");
    } else {
      $("#btn_addSpoint").css("display", "");
      $(".check_btn_addSpoint").css("display", "");
      $(".sectionShift").css("display", "none");
    }

    ////////////////////////////////////////////////////
    ///////////กดปุ่มเพิ่มข้อมูล
    $(document).on("click", ".btn_addrun", function () {
      let data_matchineTemp = $(this).attr("data_matchineTemp");
      let data_mainFormno = $(this).attr("data_mainFormno");
      let data_subFormno = $(this).attr("data_subFormno");
      let data_autoid = $(this).attr("data_autoid");
      let data_shift = $(this).attr("data_shift");

      let data_prodid = $(this).attr("data_prodid");
      let data_productcode = $(this).attr("data_productcode");
      let data_batchnumber = $(this).attr("data_batchnumber");

      let data_systemdatetime = $(this).attr("data_systemdatetime");

      $("#rMainFormno").val(data_mainFormno);
      $("#rSubFormno").val(data_subFormno);
      $("#rMachineTemp").val(data_matchineTemp);
      $("#show_runs_modal_title").text(data_matchineTemp);
      $("#checkMdShift").val(data_shift);
      $("#rAutoidCheck").val(data_autoid);

      $("#nowdate").val(data_systemdatetime);

      // Display Detail of pd
      $("#showMainDetailOnRunModal").html(
        "<b>Product ID : </b>" +
          data_prodid +
          "&nbsp;&nbsp;<b>Product Code : </b>" +
          data_productcode +
          "<br><b>Batch Number : </b>" +
          data_batchnumber +
          "&nbsp;&nbsp;<b>Shift : </b>" +
          data_shift
      );

      console.log('FasubFormno : '+data_subFormno);

      loadTemplateRun(data_matchineTemp, data_subFormno , data_mainFormno);
    // $(document).on("blur", "#rChooseTime", function () {
      $("input[name='rChooseTime']").on("blur" , function(){

        checkSubmainTable(data_mainFormno);//ตรวจสอบว่ามีการสร้างกะงานกันหรือยังโดย Return data มาที่ input บน modal

        let chooseTime = $(this).val();
        let shiftResult = "";

        if($('#returnCheckShift').val() == 0){
          if(chooseTime >= "07:15" && chooseTime <= "19:14"){
            shiftResult = "shift-a";
          }else if(chooseTime >= "19:15" && chooseTime <= "23:59"){
            shiftResult = "shift-c";
          }else if(chooseTime >= "00:01" && chooseTime <= "07:14"){
            shiftResult = "shift-c";
          }

          $('#fasub_worktime').val(shiftResult);
        }else{
          if(chooseTime >= "07:15" && chooseTime <= "19:14"){
            shiftResult = "shift-a";
          }else if(chooseTime >= "19:15" && chooseTime <= "23:59"){
            shiftResult = "shift-c";
          }else if(chooseTime >= "00:01" && chooseTime <= "07:14"){
            shiftResult = "shift-c";
          }

          $('#fasub_worktime').val(shiftResult);
        }

        
  
  
        // let chooseTime = $(this).val();
  
        // const rsInput = conTimeInput(chooseTime);
  
        // const rsShiftAs = conTimeInput(shiftAs);
        // const rsShiftAe = conTimeInput(shiftAe);
        // const rsShiftBs = conTimeInput(shiftBs);
        // const rsShiftBe = conTimeInput(shiftBe);
        // const rsShiftCs = conTimeInput(shiftCs);
        // const rsShiftCe = conTimeInput(shiftCe);
  
        // const checkMdShift = $("#checkMdShift").val();
  
        // if (checkMdShift == "shift-a") {
        //   checkShiftTime(rsInput, rsShiftAs, rsShiftAe);
        //   // console.log(rsInput+' '+rsShiftAs);
        // }
  
        // if (checkMdShift == "shift-b") {
        //   checkShiftTime(rsInput, rsShiftBs, rsShiftBe);
        //   // console.log(rsInput+' '+rsShiftBs);
        // }
  
        // if (checkMdShift == "shift-c") {
        //   checkShiftTime2(rsInput, rsShiftCs, rsShiftCe);
        //   // console.log(rsInput+' '+rsShiftCs);
        // }
  
        // ///////////////////////////////////////
        // /////// Check Duplicate Time
        // //////////////////////////////////////
        // checkDuplicateTime(data_subFormno, chooseTime);
      });
      // Check เวลาให้สัมพันธ์กับกะงาน
    });



    ////////////////////////////////////////////////////
    /////////กดปุ่ม Edit ข้อมูล
    $(document).on("click", ".btn_editrun", function () {
      const data_matchineTemp = $(this).attr("data_matchineTemp");
      const data_mainFormno = $(this).attr("data_mainFormno");
      const data_subFormno = $(this).attr("data_subFormno");
      const data_autoid = $(this).attr("data_autoid");

      const data_prodid = $(this).attr("data_prodid");
      const data_productcode = $(this).attr("data_productcode");
      const data_batchnumber = $(this).attr("data_batchnumber");

      $("#eMainFormno").val(data_mainFormno);
      $("#eSubFormno").val(data_subFormno);
      $("#eMachineTemp").val(data_matchineTemp);
      $("#eMainFormno").val(data_mainFormno);
      $("#showTemplateTextEdit").text(data_matchineTemp);

      // Display Detail of pd
      $("#showMainDetailOnEditRunModal").html(
        "<b>Product ID : </b>" +
          data_prodid +
          "&nbsp;&nbsp;<b>Product Code : </b>" +
          data_productcode +
          "<br><b>Batch Number : </b>" +
          data_batchnumber
      );

      loadWorkTimeByDetail(data_mainFormno);



      $("#editRunWorktime").change(function () {

        const fardetailFormno = $("#editRunWorktime :selected").val();
        const farDetailMainFormno = $('#eMainFormno').val();

        const data_far_worktime = $('#op_'+fardetailFormno).attr('data_far_worktime');
        const data_group_linenum = $('#op_'+fardetailFormno).attr('data_group_linenum');

        $('#rChooseTime_edit').val(data_far_worktime);
        
        if (fardetailFormno != "") {
          $(".fileSectionBtn").css("display", "");
          $("#buttonBlock").css("display", "");
          loadDataRunEdit(fardetailFormno , farDetailMainFormno);
        }else{
          $(".fileSectionBtn").css("display", "none");
          $("#buttonBlock").css("display", "none");
          $('#showdataRunEdit').html('');
        }

        $("#eDetailFormno").val(fardetailFormno);

        $(document).on("click", ".iconImageDel", function () {
          if (confirm("ท่านต้องการลบรูปนี้ใช่หรือไม่") == true) {
            const data_fileAutoid = $(this).attr("data_fileAutoid");
            const data_fileName = $(this).attr("data_fileName");
            delFileUpload(data_fileAutoid, data_fileName, fardetailFormno , farDetailMainFormno);
            console.log(data_fileAutoid);
          }
        });
      });



      $(document).on("click", ".fileup1", function () {
        $(".fileSection1").toggle();
      });
      $(document).on("click", ".fileup2", function () {
        $(".fileSection2").toggle();
      });
      $(document).on("click", ".fileup3", function () {
        $(".fileSection3").toggle();
      });
      $(document).on("click", ".fileup4", function () {
        $(".fileSection4").toggle();
      });

      $(document).on("click", ".editrunclose", function () {
        // location.reload();
        $('#editRuns_modal').modal('hide');
        $('#showdataRunEdit').html('');
        $("#buttonBlock").css("display", "none");
        $('#eDetailFormno').val('');
      });

      $("#btn_saveEditRunForm").click(function () {
        if ($("#editRunWorktime :selected").val() == "") {
          $("#editRunWorktime").addClass("inputNull");
          $("#alert_btn_saveEditRunForm").fadeIn();
          $("#alert_btn_saveEditRunForm").html(
            '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>กรุณาเลือก ช่วงเวลาด้วยค่ะ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
          );
          $("#alert_btn_saveEditRunForm").fadeOut(2000);
        } else {
          $("#editRunWorktime").removeClass("inputNull");
          check_saveEditRun();
        }
      });
      $("#editRunWorktime").change(function () {
        if ($("#editRunWorktime :selected").val() != "") {
          $("#editRunWorktime").removeClass("inputNull");
          $("#alert_btn_saveEditRunForm").fadeOut(2000);
        } else {
          $("#editRunWorktime").addClass("inputNull");
        }
      });

      //////////////////////////////////////
      ///////Delete ข้อมูลในช่วงเวลาที่เลือก
      $("#btn_saveDelEditRunForm").click(function () {
        if (confirm("คุณต้องการลบข้อมูลใช่หรือไม่") == true) {
          deleteEditRun();
        }
      });
    });
    ////////////////////////////////////////////////////
    /////////กดปุ่ม Edit ข้อมูล





    //////////////////////////////////////////////////////
    //////////กดปุ่มบันทึกข้อมูล
    $("#btn_saveRunForm").click(function () {
      if ($("#rChooseTime").val() == "") {
        alert("กรุณาเลือกเวลาในการเดินเครื่อง");
      } else {
        check_saveRun();
      }
    });

    // Control ปุ่ม Start , Stop

    // Control ปุ่มเพิ่มข้อมูล
    let loadautoid = $("#checkAutoid").val();
    // console.log(loadautoid);
    // Control Start and Stop Button
    if ($("#checkSubformStatus" + loadautoid).val() == "") {
        $("#btn_startprocess" + loadautoid).css("display", "");
        $("#btn_stopprocess" + loadautoid).css("display", "none");
        $("#btn_delworktime" + loadautoid).css("display", "");
    } else if ($("#checkSubformStatus" + loadautoid).val() == "start") {
        $("#btn_startprocess" + loadautoid).css("display", "none");
        $("#btn_stopprocess" + loadautoid).css("display", "");
        $("#addBtnRunDiv" + loadautoid).css("display", "");
        $("#btn_delworktime" + loadautoid).css("display", "none");

    } else if ($("#checkSubformStatus" + loadautoid).val() == "stop") {
      //Speacial User สามารถแก้ไขรายการได้หลังจากที่ Stop เอกสารไปแล้ว M0089=prateep
      if (sessionEcode == "M0089") {
        $("#btn_startprocess" + loadautoid).css("display", "");
      } else {
        $("#btn_startprocess" + loadautoid).css("display", "none");
      }

      $("#btn_stopprocess" + loadautoid).css("display", "none");
      $("#addBtnRunDiv" + loadautoid).css("display", "none");
      $("#btn_delworktime" + loadautoid).css("display", "none");
    }





    $(document).on("click", ".texttab", function () {
      const data_tab_autoid = $(this).attr("data_tab_autoid");
      // console.log(data_tab_autoid);

      // Check Page Status

      if ($("#checkStartPage2").val() == "Stop") {
        //Speacial User สามารถแก้ไขรายการได้หลังจากที่ Stop เอกสารไปแล้ว M0089=prateep
        if (sessionEcode == "M0089") {
          $(".ctrStartBtn , #textStartBtn").css("display", "");
        } else {
          $(".ctrStartBtn , #textStartBtn").css("display", "none");
        }

        $("#btn_reportStop").css("display", "none");
        $(".btnzone").css("display", "none");
        $("#btnStartStopDiv").css("display", "none");

        // Close button
        $("#submain_frm , .csubmain_frm").css("display", "none");
        $("button").css("display", "none");
      } else {
        // Control Start and Stop Button
        if ($("#checkSubformStatus" + data_tab_autoid).val() == "") {
          $("#btn_startprocess" + data_tab_autoid).css("display", "");
          $("#btn_stopprocess" + data_tab_autoid).css("display", "none");
          $("#btn_delworktime" + data_tab_autoid).css("display", "");
        } else if (
          $("#checkSubformStatus" + data_tab_autoid).val() == "start"
        ) {
          $("#btn_startprocess" + data_tab_autoid).css("display", "none");
          $("#btn_stopprocess" + data_tab_autoid).css("display", "");
          $("#addBtnRunDiv" + data_tab_autoid).css("display", "");
          $("#btn_delworktime" + data_tab_autoid).css("display", "none");
        } else if ($("#checkSubformStatus" + data_tab_autoid).val() == "stop") {
          //Speacial User สามารถแก้ไขรายการได้หลังจากที่ Stop เอกสารไปแล้ว M0089=prateep
          if (sessionEcode == "M0089") {
            $("#btn_startprocess" + data_tab_autoid).css("display", "");
          } else {
            $("#btn_startprocess" + data_tab_autoid).css("display", "none");
          }

          $("#btn_stopprocess" + data_tab_autoid).css("display", "none");
          $("#addBtnRunDiv" + data_tab_autoid).css("display", "none");
          $("#btn_delworktime" + data_tab_autoid).css("display", "none");
        }
      }
    });






    // Control เมื่อกดปุ่ม Start
    $(document).on("click", ".btn_startprocess", function () {
      const data_subformno = $(this).attr("data_subformno");
      const data_shiftS = $(this).attr("data_shift");
      const data_mainformno = $(this).attr("data_mainformno");
      // console.log(data_subformno + " " + data_shiftS);

      checkActiveWorktime(data_mainformno, data_subformno);
    });

    // Control เมื่อกดปุ่ม Stop
    $(document).on("click", ".btn_StopPro", function () {
      const data_subformno = $(this).attr("data_subformno");
      const data_ecode = $(this).attr("data_ecode");
      const data_autoid = $(this).attr("data_autoid");

      if ($("#checkDeptCode").val() == 1007 || data_ecode == "M1809") {
        if ($("#checkPosi").val() == 15) {
          alert("คุณไม่สามารถใช้งานปุ่มนี้ได้ค่ะ");
        } else if ($("#checkPosi").val() > 15) {
          if (
            confirm("ท่านต้องการ หยุดการบันทึกข้อมูลของกะนี้ใช่หรือไม่") == true
          ) {
            endprocess(data_subformno);
          }
        }
      } else {
        alert("คุณไม่สามารถใช้งานปุ่มนี้ได้ค่ะ");
      }

      // console.log('test');
    });

    // Control เมื่อกดปุ่ม Delete
    $(document).on("click", ".btn_delworktime", function () {
      const data_subformno = $(this).attr("data_subformno");
      if (confirm("คุณต้องการลบกะงานนี้ออก ใช่หรือไม่") == true) {
        delWorktime(data_subformno);
      }
    });

    // Control Memo Modal
    $(document).on("click", ".faMemo", function () {
      const data_faMemo = $(this).attr("data_faMemo");
      $("#view_faMemo").html(data_faMemo);
    });

    // Control image runscreen
    $(document).on("click", ".faImage", function () {
      const data_detailFormno = $(this).attr("data_detailFormno");
      const data_mainFormno = $(this).attr("data_mainFormno");
      const data_fileType = $(this).attr("data_fileType");
      const data_filename = $(this).attr("data_filename");
      //    console.log(data_detailFormno+" - "+data_fileType+" - "+data_filename);
      $('#runImageTitle').text(data_fileType);

      getImageOnRun(data_detailFormno, data_fileType , data_mainFormno);
    });

    $(document).on("click", ".faImage2", function () {
      const data_detailFormno = $(this).attr("data_detailFormno");
      const data_mainFormno = $(this).attr("data_mainFormno");
      const data_fileType = $(this).attr("data_fileType");
      const data_filename = $(this).attr("data_filename");
      // console.log(data_detailFormno+" - "+data_fileType+" - "+data_filename);
      $('#runImageTitle').text(data_fileType);

      getImageOnRun(data_detailFormno, data_fileType , data_mainFormno);
    });

    $(document).on("click", ".faImage3", function () {
      const data_detailFormno = $(this).attr("data_detailFormno");
      const data_mainFormno = $(this).attr("data_mainFormno");
      const data_fileType = $(this).attr("data_fileType");
      const data_filename = $(this).attr("data_filename");
      // console.log(data_detailFormno+" - "+data_fileType+" - "+data_filename);
      $('#runImageTitle').text(data_fileType);

      getImageOnRun(data_detailFormno, data_fileType , data_mainFormno);
    });

    $(document).on("click", ".faImage4", function () {
      const data_detailFormno = $(this).attr("data_detailFormno");
      const data_mainFormno = $(this).attr("data_mainFormno");
      const data_fileType = $(this).attr("data_fileType");
      const data_filename = $(this).attr("data_filename");
      // console.log(data_detailFormno+" - "+data_fileType+" - "+data_filename);
      $('#runImageTitle').text(data_fileType);

      getImageOnRun(data_detailFormno, data_fileType , data_mainFormno);
    });
  } //End check page
  ////////////////////////////////////////////////////////////
  /////////////Control page viewmaindata.html
  ////////////////////////////////////////////////////////////






  //////////////////////////////////////////////////////////
  ///////////Control page viewmaindata.html
  //////////////////////////////////////////////////////////
  if ($("#checkpage").val() == "viewmaindata.html") {
    // const checkTemplateReport = $('#fam_machinenameV').val();
    // $('#runscreenManage').removeAttr('width').dataTable({
    //   "scrollX": true,
    // });



    const mainform = $("#view_loadMainData").val();
    const url = $("#getUrl").val();
    loadReportFarrel(mainform);
    loadReportCheckMachine(mainform);
    loadBomReport(mainform);
    loadBomMixReport(mainform);

    ////////////////////////////////////////////////////
    ///////////////// Check page status
    /////////////////////////////////////////////////////

    if ($("#checkStartPage2").val() == "") {
      $(".control_report").css("display", "none");
      $("#section_btnSpoint").css("display", "none");
    } else {
      $(".control_report").css("display", "");

      if ($("#checkStartPage2").val() == "Start") {
        $("#section_btnSpoint").css("display", "");
        $(".ctrStartBtn , #textStartBtn").css("display", "none");

        $("#btns_addOutput").css("display", "");

        // Check Stop Button Permmission
        if ($("#checkPosi").val() == 15) {
          $(".ctrStopBtn").css("display", "none");
        } else {
          $(".ctrStopBtn , #btn_reportStop").css("display", "");
        }
      } else if ($("#checkStartPage2").val() == "Stop" || $("#checkStartPage2").val() == "Cancel") {
        //Speacial User สามารถแก้ไขรายการได้หลังจากที่ Stop เอกสารไปแล้ว M0089=prateep
        if (sessionEcode == "M0089") {
          $(".ctrStartBtn , #textStartBtn , .statusStopBtn").css("display", "");
          // $("button").css("display", "");
          // Zone Control Button By Form status
        } else {
          $(".ctrStartBtn , #textStartBtn , .statusStopBtn").css("display", "none");
          // $("button").css("display", "none");
        }

        $("#btn_reportStop").css("display", "none");
        $(".btnzone").css("display", "none");
        $("#btnStartStopDiv").css("display", "none");
        $(".editHead").css("display","none");

        // Close button
        $("#submain_frm , .csubmain_frm").css("display", "none");
      }
    }
    ////////////////////////////////////////////////////
    ///////////////// Check page status
    /////////////////////////////////////////////////////

    $("#btn_reportStart").click(function () {
      let countFeeder = parseFloat($("#countFeeder").val());
      if (countFeeder == 0) {
        alert("กรุณาเพิ่มวัตถุดิบลง Feeder ให้เรียบร้อยก่อนนะคะ");
      } else {
        if (confirm("คุณต้องการเริ่มต้นบันทึกข้อมูลใช่หรือไม่") == true) {
          startPageTwo(mainform);
        }
      }
    });

    $("#btn_reportStop").click(function () {
      if (confirm("คุณต้องการสิ้นสุดการบันทึกข้อมูลใช่หรือไม่") == true) {
        // Check posi
        let conPosi = parseFloat($("#checkPosiPage2").val());
        if (conPosi == 15) {
          alert("ท่านไม่สามารถกดปุ่ม Stop ได้กรุณาติดต่อหัวหน้างาน");
        } else if (conPosi > 15) {
          $('#stopMemo_modal').modal('show');
          // endPageTwo(mainform);
        }
      }
    });
    $('#save_stopmemo').click(function(){
      const stopmemo = $('#stopmemo_value').val();
      endPageTwo(mainform , stopmemo);
    });



    $("#btn_reportCancel").click(function () {
      if (confirm("คุณต้องการยกเลิกรายการนี้ใช่หรือไม่") == true) {
        // Check posi
        let conPosi = parseFloat($("#checkPosiPage2").val());
        if (conPosi == 15) {
          alert("ท่านไม่สามารถกดปุ่ม Cancel ได้กรุณาติดต่อหัวหน้างาน");
        } else if (conPosi > 15) {
          // cancelPage(mainform);
          $('#cancel_modal').modal("show");
        }
      }
    });

    $('#btn_saveCancelForm').click(function(){
      const cancelMemo = $('#cancel_memo').val();
      cancelPage(mainform , cancelMemo);
    });



    $(document).on("click", ".addoutPuts", function () {
      const data_prodid = $(this).attr("data_prodid");
      const data_productcode = $(this).attr("data_productcode");
      const data_batchnumber = $(this).attr("data_batchnumber");
      const data_outputhr = $(this).attr("data_outputhr");

      $("#show_checkFeeder_modal").html(
        "<b>Product ID : </b>" +
          data_prodid +
          "&nbsp;&nbsp;<b>Product Code : </b>" +
          data_productcode +
          "<br><b>Batch Number : </b>" +
          data_batchnumber
      );

      checkDataFeederForEdit(mainform);
      loadDeviation(mainform);
      $("#cf_output").val(data_outputhr);

      // Check Output data for change to edit
      if ($("#cf_output").val() != "" && $("#cf_deviation").val() != "") {
        $("#cf_output").prop("disabled", true);
        $("#cf_deviation").prop("disabled", true);
        $("#btn_addoutput").css("display", "none");
        $("#btn_editoutput").css("display", "");
      } else {
        $("#btn_editoutput").css("display", "none");
      }
    });

    $("#btn_addoutput").click(function () {
      saveOutput();
    });

    $("#btn_editoutput").click(function () {
      // Check posi
      let conPosi = parseFloat($("#checkPosiPage2").val());
      if ($(this).text() == "แก้ไขรายการ") {
        if (conPosi < 15) {
          alert("ท่านไม่สามารถทำการแก้ไขได้ กรุณาติดต่อหัวหน้างาน");
        } else if (conPosi >= 15) {
          $("#cf_output , #cf_deviation").prop("disabled", false);
          $("#btn_editoutput")
            .text("บันทึกการแก้ไข")
            .removeClass("btn-warning")
            .addClass("btn-success");
        }
      } else if ($(this).text() == "บันทึกการแก้ไข") {
        if (
          confirm(
            "การแก้ไขค่า Output และ ค่าเบี่ยงเบน นั้นจะส่งผลต่อการคำนวณ ค่าของการตรวจสอบ Feeder ดังนั้นท่านมีความจำเป็นที่จะต้องลบค่าการทดสอบที่ได้บันทึกเอาไว้ออกทั้งหมด เพื่อให้ท่านทำการกรอกข้อมูลเพื่อคำนวณค่าใหม่ ท่านยืนยันที่จะดำเนินการต่อหรือไม่"
          ) == true
        ) {
          if ($("#checkFeederDataForEdit").val() != 0) {
            alert("กรุณาลบข้อมูลการตรวจสอบ Feeder ออกก่อนนะคะ");
            $("#btn_editoutput")
              .text("แก้ไขรายการ")
              .removeClass("btn-success")
              .addClass("btn-warning");
            $("#checkFeeder_modal").modal("hide");
            // location.reload();
          } else {
            saveOutput();
          }
        } else {
          return false;
        }
      }
    });

    $(document).on("click", ".outputClose", function () {});

    $(document).on("click", ".feederCheck", function () {
      
      const data_faf_mainformno = $(this).attr("data_faf_mainformno");
      const data_faf_feedername = $(this).attr("data_faf_feedername");
      const data_faf_rawmaterial = $(this).attr("data_faf_rawmaterial");
      const data_faf_value = $(this).attr("data_faf_value");
      const data_faf_autoid = $(this).attr("data_faf_autoid");
      const data_fam_deviation = $("#acf_deviation :selected").val();
      const data_fam_outputhr = $(this).attr("data_fam_outputhr");

      const data_prodid = $(this).attr("data_prodid");
      const data_productcode = $(this).attr("data_productcode");
      const data_batchnumber = $(this).attr("data_batchnumber");

      $('#addf_ex1').val(0);

      if (data_fam_deviation == "") {
        alert("คุณต้องกำหนด ค่า Output และ ค่าเบี่ยงเบนก่อน");
      } else {
        $("#showTxtCheckFeeder").text(data_faf_feedername);
        $("#addf_rawmaterial").val(data_faf_rawmaterial);
        $("#addf_value").val(data_faf_value);
        $("#addf_output").val(data_fam_outputhr);
        // $('#addf_deviation').val(data_fam_deviation);
        $("#checkAddfAutoid").val(data_faf_autoid);

        $("#show_addFeeder_modal").html(
          "<b>Product ID : </b>" +
            data_prodid +
            "&nbsp;&nbsp;<b>Product Code : </b>" +
            data_productcode +
            "<br><b>Batch Number : </b>" +
            data_batchnumber +
            "&nbsp;&nbsp;<br><b>Feeder : </b>" +
            data_faf_feedername
        );

        // ตรวจสอบว่ามีการบันทึกค่าไปแล้วหรือยัง
        getDataFeeder(data_faf_autoid, mainform);

        // หาค่าน้ำหนักต่อ 1 ชั่วโมง
        const sumperhr =
          (parseFloat(data_faf_value) * parseFloat(data_fam_outputhr)) / 100;
        const sumpermin = sumperhr / 60;
        let useSumHr = 0;
        let useSumMin = 0;

        if (isNaN(sumperhr) == true) {
          useSumHr = "";
        } else {
          useSumHr = sumperhr.toFixed(3);
        }

        if (isNaN(sumpermin) == true) {
          useSumMin = "";
        } else {
          useSumMin = sumpermin.toFixed(3);
        }

        $("#addf_perhr").val(useSumHr);
        $("#addf_permin").val(useSumMin);

        // หาค่าเฉลี่ย
        $("#btnCalEx").click(function () {
          calAvg(sumperhr, sumpermin);
        });

        $("#addf_ex1").keyup(function () {
          calAvg(sumperhr, sumpermin);
        });
        $("#addf_ex2").keyup(function () {
          calAvg(sumperhr, sumpermin);
        });
        $("#addf_ex3").keyup(function () {
          calAvg(sumperhr, sumpermin);
        });
        $("#addf_ex4").keyup(function () {
          calAvg(sumperhr, sumpermin);
        });
        $("#addf_ex5").keyup(function () {
          calAvg(sumperhr, sumpermin);
        });
      }
    });

    $("#btn_saveAddf").click(function () {
      saveReportFeeder();
    });

    $("#btn_editAddf").click(function () {
      const checkAddfAutoid = $("#checkAddfAutoid").val();
      loadDeviation2(mainform, checkAddfAutoid);
      $(".adex").prop("readonly", false);
      $("#btn_saveAddf").css("display", "");
      $("#btn_saveAddf")
        .text("บันทึกการแก้ไข")
        .removeClass("btn-warning")
        .addClass("btn-primary");
      $("#btn_editAddf").css("display", "none");
    });

    $("#btn_delAddfCheck").click(function () {
      if (confirm("ท่านต้องการลบข้อมูล ใช่หรือไม่") == true) {
        delReportFeeder();
      } else {
        return false;
      }
    });

    $(document).on("click", ".machineCheckList", function () {
      const data_ckautoid = $(this).attr("data_ckautoid");
      const data_checklistname = $(this).attr("data_checklistname");

      const data_prodid = $(this).attr("data_prodid");
      const data_productcode = $(this).attr("data_productcode");
      const data_batchnumber = $(this).attr("data_batchnumber");

      $("#addMc_checkFormno").val(mainform);
      $("#addMc_checkAutoid").val(data_ckautoid);
      $("#show_addCheckMachine_modal").html(
        "<b>Product ID : </b>" +
          data_prodid +
          "&nbsp;&nbsp;<b>Product Code : </b>" +
          data_productcode +
          "<br><b>Batch Number : </b>" +
          data_batchnumber +
          "<br><b>รายการ : </b>" +
          data_checklistname
      );

      $('#addMc_emQc').val(0);
      $('#addMc_moisture').val(0);

      getdataMachineList(data_ckautoid);
    });

    $(document).on("click", ".clsCheckMachine", function () {
      $('input:radio[name="addMc_status"]').prop("checked", false);
      $("#addMc_memo").val("");
      $("#addMc_emQc").val("");
      $("#addMc_moisture").val("");
      $("#btn_saveAddCheckMachine").prop("disabled", true);
    });

    $(document).on("click", ".clsaddFeeder", function () {
      $(".ex").val("");
      $('input:checkbox[id="notpass"]').prop("checked", false);
      $('input:checkbox[id="pass"]').prop("checked", false);
      $("#btn_saveAddf").prop("disabled", true);
    });

    $('input:radio[name="addMc_status"]').change(function(){
      $("#btn_saveAddCheckMachine").prop("disabled", false);
    });

    // $("#addMc_moisture").keyup(function () {
    //   if ($(this).val() != "") {
    //     $("#btn_saveAddCheckMachine").prop("disabled", false);
    //   } else {
    //     $("#btn_saveAddCheckMachine").prop("disabled", true);
    //   }
    // });

    $("#btn_saveAddCheckMachine").click(function () {
      if ($("#addMc_emQc").val() == "") {
        $("#addMc_emQc").addClass("inputNull");
      }
      if ($("#addMc_moisture").val() == "") {
        $("#addMc_moisture").addClass("inputNull");
      }
      if ($("#addMc_emQc").val() != "" && $("#addMc_moisture").val() != "") {
        $("#btn_saveAddCheckMachine").prop("disabled", false);
        saveCheckMachine();
      }
    });
  }

  ///////////////////////////////////////////////////////////
  /////////////Control Home page
  ///////////////////////////////////////////////////////////
  if ($("#checkpage").val() == "") {
    $("#fam_prodid").keyup(function () {
      if ($(this).val() != "") {
        let dataareaid = $("#fam_dataareaid :selected").val();
        let searchProdid = $(this).val();
        loadProdId(dataareaid, searchProdid);
      } else {
        $("#showProdId").html("");
      }

      if ($("#fam_dataareaid :selected").val() == "") {
        $("#fam_dataareaid").addClass("null_fam_dataareaid");
        $("#fam_prodid").val("");
      } else {
        $("#fam_dataareaid").removeClass("null_fam_dataareaid");
      }
    });

    $(document).on("click", "#prodid_attr", function () {
      const data_prodid = $(this).attr("data_prodid");
      const data_itemid = $(this).attr("data_itemid");
      const data_inventbatchid = $(this).attr("data_inventbatchid");
      const data_dataareaid = $(this).attr("data_dataareaid");
      const data_slc_orgreference = $(this).attr("data_slc_orgreference");
      const data_prodiduse = $(this).attr("data_prodiduse");
      // Check PD WIP



      checkPdStart(data_dataareaid, data_prodid);

      $("#fam_productcode").val(data_itemid);
      $("#fam_batchnumber").val(data_inventbatchid);
      $("#fam_prodid").val(data_prodid);
      $("#fam_prodidwip").val(data_prodiduse);

      $("#showProdId").html("");

      loadMachineTemplate(data_itemid);

      $('.bs-searchbox > input').addClass('searchTem');

      $(document).on('keyup' , '#machineSearch' , function(){
        const templateName = $(this).val();
        // console.log($(this).val());
        if(templateName != ""){
          loadMachineTemplate2(templateName);
        }else{
          loadMachineTemplate(data_itemid);
        }

        $('#fam_machinename').val('');
        
      });


      $(document).on('click' , '#chooseTemplate' ,function(){
        const data_tempname = $(this).attr("data_tempname");
        $('#fam_machinename , #machineSearch').val(data_tempname);
        $('#show_famprocode').html('');

        if($('#fam_machinename').val() != ""){
          $("#fam_machinename , #machineSearch , .chooseTemplateUl").removeClass("inputNullNew");
        }
      });
    });
  }

  ////////////////////////////////////////////////////////////
  /////////////Control page setting.html
  ////////////////////////////////////////////////////////////
  if ($("#checkpage").val() == "setting.html") {
    ///////////////////////////////////
    ////Load Runscreen master to page
    //////////////////////////////////
    
    // getRunscreenMasterNew();
    getMachineTemp(" ");
    runacreenManagement();
    ///////////////////////////////////
    ////Load Runscreen master to page
    //////////////////////////////////

    ///////////////////////////////////////////
    ////Load Machine template to page
    //////////////////////////////////////////
    $("#mat_machine_name").keyup(function () {
      let machineNameTemp = $(this).val();
      // getMachineTemp(machineNameTemp);
      if (machineNameTemp == "") {
        $("#mat_machine_nameUse").val("");
        $("#showListMachineTemp").html("");
        // getListMachineTemp(' ');
        getMachineTemp(" ");
      } else {
        getListMachineTemp(machineNameTemp);
      }
    });

    $(document).on("click", ".getDataFromTemp", function () {
      const data_mat_machine_name = $(this).attr("data_mat_machine_name");
      $("#mat_machine_nameUse").val(data_mat_machine_name);
      getMachineTemp(data_mat_machine_name);
      $("#showListMachineTemp").html("");
      $("#mat_machine_name").val("");
    });

    $(document).on("click", ".create_template_close", function () {
      getMachineTemp(" ");
      $("#mat_machine_nameUse").val("");
    });
    ///////////////////////////////////////////
    ////Load Machine template to page
    //////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////
    ////////////Click เลือกรายการ Runscreen เพื่อเพิ่มลง Template ที่ต้องการ
    /////////////////////////////////////////////////////////////////
    $(document).on("click", ".iconMachineEdit", function () {
      let data_run_name = $(this).attr("data_run_name");
      const data_run_type = $(this).attr("data_run_type");
      let data_template_name = $("#mat_machine_nameUse").val();

      if (data_template_name == "") {
        $("#alertSaveTemplate").fadeIn();
        $("#alertSaveTemplate").html(
          '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>คุณยังไม่ได้กดเลือกชื่อ Template <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        $("#alertSaveTemplate").delay(3000).fadeOut();
      } else {
        /////////////////////////////////////////////////
        ///Reun function add to table machine template
        /////////////////////////////////////////////////
        checkDuplicateRunscreen(
          data_template_name,
          data_run_name,
          data_run_type
        );
      }
    });
    ///////////////////////////////////////////////////////////////////
    ////////////Click เลือกรายการ Runscreen เพื่อเพิ่มลง Template ที่ต้องการ
    /////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////
    ///////// ลบ Runscreen ออกจาก Template
    ////////////////////////////////////////////

    $(document).on("click", ".iconMachineDel", function () {
      let data_mat_autoid = $(this).attr("data_mat_autoid");
      let data_mat_machine_name = $(this).attr("data_mat_machine_name");

      /////////////////////////////////////////////////
      /// Run funcntion del runscreen
      deleteRunscreenFromTemp(data_mat_autoid, data_mat_machine_name);
    });

    ////////////////////////////////////////////
    ///////// ลบ Runscreen ออกจาก Template
    ////////////////////////////////////////////

    //////////////////////////////////////////////////////
    //////////Control Run Screen modal
    /////////////////////////////////////////////////////

    // $('#run_name').keydown(function(event){
    //     var keyCode = (event.keyCode ? event.keyCode : event.which);
    //     if (keyCode == 13) {
    //         $('#btn_runscreenManage').trigger('click');
    //     }
    // });

    

////////////////////////////////////////////
// Function บันทึกข้อมูล Runscreen #เพิ่มข้อมูล

// Open modal
$('#btn_new_runscreen').click(function(){
  $('#new_runscreen_md').modal("show");
});

$(document).on('click' , '.btnCloseNewRun' , function(){
  $("#run_name , #run_minvalue , #run_maxvalue , #run_spoint").val("");
  $('input:radio[name="run_type"]').prop("checked", false);
});


    $("#btn_runscreenManage").click(function () {
      const runtype = $('input:radio[name="run_type"]:checked');

      if ($(this).text() == "บันทึกข้อมูล") {
        // if ($('#run_name').val() != "" && runtype.length == 0) {
        if (runtype.length != 0 && $("#run_name").val() != "") {
          $("#box_run_name , #box_run_type").removeClass("run_name");
          checkDupRunManage();
        } else {
          $("#box_run_name , #box_run_type").addClass("run_name");
        }
      }
    });



    $("#btn_runscreenClear").click(function () {
      $("#run_name").val("");
      $("#btn_runscreenManage")
        .text("บันทึกข้อมูล")
        .removeClass("button-amber")
        .addClass("button-green");
      $('input:radio[name="run_type"]').prop("checked", false);

      $('#title_new_runscreen').text("เพิ่ม Runscreen ใหม่");
    });



    $(document).on("click", ".iconRunEdit", function () {
      $("#box_run_name , #box_run_type").removeClass("run_name");
      let data_run_name = $(this).attr("data_run_name");
      let data_run_autoid = $(this).attr("data_run_autoid");
      let data_run_type = $(this).attr("data_run_type");
      let data_run_min = $(this).attr("data_run_min");
      let data_run_max = $(this).attr("data_run_max");
      let data_run_spoint = $(this).attr("data_run_spoint");


      // New update ui
      $('#edit_runscreen_md').modal("show");

      // Get data to edit runscreen modal
      $('#edit_run_name').val(data_run_name);
      $('#edit_run_minvalue').val(data_run_min);
      $('#edit_run_maxvalue').val(data_run_max);
      $('#edit_run_spoint').val(data_run_spoint);
      $('#edit_run_autoid').val(data_run_autoid);

      if (data_run_type == "Extruder") {
        $("#edit_run_typeExtruder").prop("checked", true);
      }
      if (data_run_type == "Feeder") {
        $("#edit_run_typeFeeder").prop("checked", true);
      }

    });



    $('#btn_edit_runscreenManage').click(function(){
      // Check Run Screen Name Input
      if($('#edit_run_name').val() == ""){
        $('#edit_run_name').addClass("inputNull");

        $("#alertEditRunscreenManage").fadeIn();
        $("#alertEditRunscreenManage").html(
          '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>กรุณากรอก ชื่อ RunScreen ด้วยค่ะ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        $("#alertEditRunscreenManage").delay(1000).fadeOut(1000);
      }else{
        $('#edit_run_name').removeClass("inputNull");
        checkDupEditRunManage();
      }


      // Check Run Screen Min
      if($('#edit_run_minvalue').val() == "" || $('#edit_run_maxvalue').val() == "" || $('#edit_run_spoint').val() == ""){
        $('#edit_run_minvalue').addClass("inputNullWarning");
        $('#edit_run_maxvalue').addClass("inputNullWarning");
        $('#edit_run_spoint').addClass("inputNullWarning");
      }
    });


    $(document).on('click' , '.btnCloseEditRun' , function(){
      $('#edit_run_name').removeClass("inputNull");
      $('#edit_run_minvalue').removeClass("inputNullWarning");
      $('#edit_run_maxvalue').removeClass("inputNullWarning");
      $('#edit_run_spoint').removeClass("inputNullWarning");
    });




    $(document).on("click", ".iconRunDel", function () {
      let data_run_autoid = $(this).attr("data_run_autoid");
      if (confirm("คุณต้องการลบข้อมูลใช่หรือไม่") == true) {
        delRunManage(data_run_autoid);
      }
    });

    //////////////////////////////////////////////////////
    //////////Control Run Screen modal
    /////////////////////////////////////////////////////

    ////////////////////////////////////////////////////
    ////////Control template detail
    ///////////////////////////////////////////////////
    $(document).on("click", ".tempdetailBox", function () {
      let data_machinename = $(this).attr("data_machinename");
      tempDetail(data_machinename);
      $("#tempDetailTitle").text(data_machinename);
    });



    $(document).on("click", ".iconEditMinMax", function () {
      const data_run_name = $(this).attr("data_run_name");
      const data_run_autoid = $(this).attr("data_run_autoid");
      const data_run_machinename = $(this).attr("data_run_machinename");
      const data_minvalue = $(this).attr("data_minvalue");
      const data_maxvalue = $(this).attr("data_maxvalue");
      const data_spointvalue = $(this).attr("data_spointvalue");

      $("#minMaxTitle").text(data_run_name);
      $("#minMaxAutoid").val(data_run_autoid);
      $("#minMaxMachinename").val(data_run_machinename);

      // Get old data to input
      $("#minvalue").val(data_minvalue);
      $("#maxvalue").val(data_maxvalue);
      $("#spointvalue").val(data_spointvalue);
    });

    ///////////////////////////////////////////////////
    ////////Control btn_addMinMax

    $("#btn_addMinMax").click(function () {
      if ($("#minvalue").val() == "") {
        $("#minvalue").addClass("nullMinMax");
      } else {
        $("#minvalue").removeClass("nullMinMax");
      }

      if ($("#maxvalue").val() == "") {
        $("#maxvalue").addClass("nullMinMax");
      } else {
        $("#maxvalue").removeClass("nullMinMax");
      }

      if ($("#minMaxAutoid").val() != "") {
        addMinMax();
      }
    });

    $("#maxvalue").keydown(function (event) {
      var keyCode = event.keyCode ? event.keyCode : event.which;
      if (keyCode == 13) {
        if ($("#minvalue").val() == "") {
          $("#minvalue").addClass("nullMinMax");
        } else {
          $("#minvalue").removeClass("nullMinMax");
        }

        if ($("#maxvalue").val() == "") {
          $("#maxvalue").addClass("nullMinMax");
        } else {
          $("#maxvalue").removeClass("nullMinMax");
        }

        if ($("#minvalue").val() != "" && $("#maxvalue").val() != "") {
          addMinMax();
        }
      }
    });

    $("#copyTemplateBtn").click(function () {
      copyTemplate();
    });
    $(document).on("click", ".copyIcon", function () {
      const data_mat_machine_name = $(this).attr("data_mat_machine_name");
      $("#confirm_copy_template_md").modal("show");
      $("#oldTemplatename").val(data_mat_machine_name);
    });


/////////////////////////////////////////////////////////////////////////
//Function Control edit template on setting.html page
////////////////////////////////////////////////////////////////////////
    $(document).on("click", ".iconTemEdit", function () {
      const data_mat_machine_name = $(this).attr("data_mat_machine_name");
      const data_matchine_image = $(this).attr("data_matchine_image");
      const urlimage = "/intsys/msd/upload/images_template/";
      const data_matchine_prodcode = $(this).attr("data_matchine_prodcode");

      let imagefile = "";
      $("#edit_template_md").modal("show");
      $('#copy_template_md').modal("hide");

      if(data_matchine_image == ""){
        imagefile = "noimage.jpg";
      }else{
        imagefile = data_matchine_image;
      }

      $("#template_name").text(data_mat_machine_name);
      $('#ted_template_name').val(data_mat_machine_name);
      $('#ted_template_imageShow').attr({
        "src" :urlimage+imagefile,
        "width":"100%"
      });
      $('#ted_template_itemuse , #ted_template_itemuse_2').val(data_matchine_prodcode);
      $('#ted_template_image_old').val(data_matchine_image);

      if(data_matchine_prodcode != "" || data_matchine_image != ""){
        $('#btnSaveTemplateDetail').text('แก้ไข').removeClass('btn-primary').addClass('btn-warning');
        $('#ted_template_itemuse , #ted_template_itemuse_2').prop('readonly' , true);
        $('#ted_template_image').css('display' , 'none');
      }else{
        $('#btnSaveTemplateDetail').text('บันทึก').removeClass('btn-warning').addClass('btn-primary');
        $('#ted_template_itemuse , #ted_template_itemuse_2').prop('readonly' , false);
        $('#ted_template_image').css('display' , '');
      }


      $('#ted_template_itemuse').keyup(function(){
        if($(this).val() != ""){
          getProductCode($(this).val());
        }
      });


      $(document).on('click' , '#prodcode_attr' , function(){
        const data_itemid = $(this).attr("data_itemid");
        $('#ted_template_itemuse').val(data_itemid);
        $('#ted_template_itemuse_2').val(data_itemid);
        $('#showProductCode').html('');
      });
    });


    $('#btnSaveTemplateDetail').click(function(){
        if($('#btnSaveTemplateDetail').text() == "แก้ไข"){

          $('#ted_template_itemuse , #ted_template_itemuse_2').prop('readonly' , false);
          $('#btnSaveTemplateDetail').text('บันทึกการแก้ไข').removeClass('btn-warning').addClass('btn-primary');
          $('#ted_template_image').css('display' , '');
          $('#ted_template_itemuse_2 , #ted_template_itemuse').val('');

        }else if($('#btnSaveTemplateDetail').text() == "บันทึกการแก้ไข"){
          if($('#ted_template_itemuse').val() == ""){
            alert("กรุณาเลือก Product Code");
            return false;
          }else{
            saveChangeTemplateDetail();
          }

        }else if($('#btnSaveTemplateDetail').text() == "บันทึก"){

          saveTemplateDetail();

        }
        
      });










    $("#btn_saveCopyTem").click(function () {
      saveTemplateCopy();
    });

    $(document).on("click", ".iconTemDel", function () {
      if (confirm("ท่านต้องการลบ Template นี้ใช่หรือไม่") == true) {
        const data_mat_machine_name = $(this).attr("data_mat_machine_name");
        delTemplate(data_mat_machine_name);
      }
    });

    loadTemplateBox();
    $("#seachMatchineBox").keyup(function () {
      const templatename = $(this).val();
      loadTemplateBox(templatename);
    });
  }

  ////////////////////////////////////////////////////////////
  /////////////Control page setting.html
  ////////////////////////////////////////////////////////////

  ////////////////////////////////////////////////////////////
  /////////////Control page setting_main.html class
  ////////////////////////////////////////////////////////////

  if ($("#checkpage").val() == "setting_main.html") {
    //////////////////////////////////////////////
    //////////Control หน้าบันทึกกะงาน
    $("#btn_saveSetShift").click(function () {
      if ($("#shift_name").val() == "") {
        $("#shift_name").addClass("inputNullNew");
        $("#showAlertSetShift").fadeIn();
        $("#showAlertSetShift").html(
          '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>กรุณาระบุกะการทำงานด้วยค่ะ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        $("#showAlertSetShift").delay(2000).fadeOut(500);
      } else if ($("#shift_starttime").val() == "") {
        $("#shift_starttime").addClass("inputNullNew");
        $("#showAlertSetShift").fadeIn();
        $("#showAlertSetShift").html(
          '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>กรุณาระบุเวลาเริ่มงานด้วยค่ะ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        $("#showAlertSetShift").delay(2000).fadeOut(500);
      } else if ($("#shift_endtime").val() == "") {
        $("#shift_endtime").addClass("inputNullNew");
        $("#showAlertSetShift").fadeIn();
        $("#showAlertSetShift").html(
          '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>กรุณาระบุเวลาเริ่มงานด้วยค่ะ</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        $("#showAlertSetShift").delay(2000).fadeOut(500);
      } else {
        saveSetShift();
      }
    });

    // Check null value
    $("#shift_name").blur(function () {
      if ($(this).val() != "") {
        $("#shift_name").removeClass("inputNullNew");
      }
    });
    $("#shift_starttime").blur(function () {
      if ($(this).val() != "") {
        $("#shift_starttime").removeClass("inputNullNew");
      }
    });
    $("#shift_endtime").blur(function () {
      if ($(this).val() != "") {
        $("#shift_endtime").removeClass("inputNullNew");
      }
    });

    // Clear data on input
    $(".setShiftClose").click(function () {
      $("#setShift_frm input").val("");
    });
    //////////////////////////////////////////////
    //////////Control หน้าบันทึกกะงาน

    // Control หน้าเพิ่ม User เข้าสู่โปรแกรม เพื่อกำหนด Template
    // loadUserFromDb();
  }




  $(document).on('click' , '#tempdetailBox' , function(){
    // truncate_machine_template_temp();
    const data_machinename = $(this).attr("data_machinename");
    $('.select_showdata').css('display' , '');
    $('.select_editdata').css('display' , 'none');
    $('#btnSelectTemplate_edit').css('display' , '');
    $('#btnSelectTemplate_canceledit').css('display' , 'none');
    $('#select_template_modal').modal('show');
    loadDataTemplate(data_machinename);
    $('#select_check_templatename').val(data_machinename);
    $('#btnSaveSelectTemplate_edit').css('display' , 'none');
    $('#select_edit_template_name_new , #select_edit_template_itemid_new').val('');


    // Code Check Permission Edit , Delete Button
    if($('#checkSessionEcode').val() == "M1809" || $('#checkSessionEcode').val() == "M1413" || $('#checkSessionEcode').val() == "M0089" || $('#checkSessionEcode').val() == "M2117"){
      $('#btnSelectTemplate_edit , #btnSelectTemplate_delete').css('display' , '');
    }else{
      $('#btnSelectTemplate_edit , #btnSelectTemplate_delete').css('display' , 'none');
    }
    // Code Check Permission Edit , Delete Button

    // $('#select_edit_template_name').removeClass('inputSuccess');
    // $('#select_edit_template_itemid').removeClass('inputSuccess');
  });


  // $(document).on('click' , '.btn_exportrun' , function(){
  //   //load Function Export data
  //   const mainformno = $(this).attr("data_mainFormno");
  //   exportdata(mainformno);
  // });




});
// End ready function






