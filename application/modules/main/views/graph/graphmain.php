<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{title}</title>

    <!-- <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script> -->

    <script src="<?=base_url('assets/js/custom/highcharts.js?v='.filemtime('./assets/js/custom/highcharts.js'))?>"></script>
    <script src="<?=base_url('assets/js/custom/series-label.js?v='.filemtime('./assets/js/custom/series-label.js'))?>"></script>
    <script src="<?=base_url('assets/js/custom/exporting.js?v='.filemtime('./assets/js/custom/exporting.js'))?>"></script>
    <script src="<?=base_url('assets/js/custom/export-data.js?v='.filemtime('./assets/js/custom/export-data.js'))?>"></script>
    <script src="<?=base_url('assets/js/custom/accessibility.js?v='.filemtime('./assets/js/custom/accessibility.js'))?>"></script>
    
</head>


<body>

    <div class="container px-5" id="app">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center h1vtitle">หน้าแสดงข้อมูล กราฟ<span id="textTitle"></span></h3>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 clearDiv">
                <input type="text" name="searchItemID" id="searchItemID" class="form-control" placeholder="ค้นหา Item ID">
                <div id="showSearchItemID" class="mt-2"></div>
                <i class="icon-undo-alt clearDivIcon"></i>
            </div>
            <div class="col-lg-3"></div>
        </div>

        <div class="divider divider-center"><i class="icon-cloud"></i></div>

        <div class="row mt-5">
            <div class="col-lg-4">
                <span><b>Item ID : </b></span><span id="itemid_text"></span>
            </div>
            <div class="col-lg-8">
                <span><b>Lot Number : </b></span><span id="lotnumber_text"></span>
            </div>
        </div>
        
        <div id="showCheckGraphByCheckLot" class="row mt-5"></div>

        <div class="row mt-4">
            <div class="col-lg-12">
                <div id="showGraphByCheckLotMain"></div>
            </div>
        </div>


    </div>


</body>

<script>
    let selectLotNumber = [];
    let qcidToDb = [];
    let inventBatchIdToDb = [];
    let data_itemid;
    let testidShowArrayCheckLot = [];

    $(document).ready(function(){

        checkDataGraph();

        $('#searchItemID').keyup(function(){
            if($(this).val() != ""){
                const itemid = $('#searchItemID').val();
                loadItemid(itemid);
            }else{
                $('#showSearchItemID').html('');
            }
        });

        $(document).on('click','.searchItemid_a',function(){
            data_itemid = $(this).attr("data_itemid");
            console.log(data_itemid);
            $('#showSearchItemID').html('');
            $('#searchItemID').val(data_itemid).prop('readonly' , true);
            $('#selectLotnumber_modal').modal('show');
            loadItemLot(data_itemid);
        });

        $(document).on('click','.clearDivIcon',function(){
            $('#searchItemID').val('').prop('readonly' , false);
        });

        $(document).on('click','.clearDivIconModal',function(){
            $('#searchItemID').val('').prop('readonly' , false);
        });

        $(document).on('click','.showLotNumber_checkbox',function(){
            const data_QCSampleId = $(this).attr("data_QCSampleId");
            const data_InventBatchId = $(this).attr("data_InventBatchId");
            const data_ItemId = $(this).attr("data_ItemId");
            const data_index = $(this).attr("data_index");

            if($(this).prop("checked") == true){
                let dataFromLot = {
                    "qcSampleID":data_QCSampleId,
                    "inventBatchId":data_InventBatchId,
                    "itemId":data_ItemId
                }
                selectLotNumber.push(dataFromLot);
                console.log(selectLotNumber);
            }else{
                // console.log("Not check");
                selectLotNumber.splice(data_index,1);
                console.log(selectLotNumber);
            } 
        });

        $('#confirm_checkboxLotnum').click(function(){
            // localStorage.setItem("selectLotNumber",JSON.stringify(selectLotNumber));
            let sortdata = selectLotNumber.sort(function(a, b) {
                let nameA = a.inventBatchId.toUpperCase(); // ignore upper and lowercase
                let nameB = b.inventBatchId.toUpperCase(); // ignore upper and lowercase
                if (nameA < nameB) {
                    return -1;
                }
                if (nameA > nameB) {
                    return 1;
                }

                // names must be equal
                return 0;
                });

                for(let i=0;i < sortdata.length;i++){
                    qcidToDb.push(sortdata[i].qcSampleID);
                    inventBatchIdToDb.push(sortdata[i].inventBatchId);
                }
                loadGraphDataByCheckLot(qcidToDb , inventBatchIdToDb , data_itemid);
                checkDataGraph();
        });



        $(document).on('click','.testidCheckLot_check' , function(){
            const data_testid = $(this).attr("data_testid");
 
                if(data_testid != ""){
                    if($(this).prop("checked") == true){
                        console.log("checked");
                        testidShowArrayCheckLot.push(data_testid);
                        updateTestIDUseCkeckLot(testidShowArrayCheckLot);
                    }else{
                        console.log("Not check");
                        
                        testidShowArrayCheckLot = arrayRemoveCheckLot(testidShowArrayCheckLot , data_testid);
                        updateTestIDUseCkeckLot(testidShowArrayCheckLot);
                    }
                }else{
                    updateTestIDUseCkeckLot('');
                }
            
        });




    });//END Ready Zone


    // Zone Function 
    function loadItemid(itemid)
    {
        $.ajax({
            url:"/intsys/msd/main/graph/loadItemid",
            method:"POST",
            data:{
                itemid:itemid
            },
            beforeSend:function(){},
            success:function(res){
                // console.log(res);
                $('#showSearchItemID').html(res);
            }
        });
    }


    function loadItemLot(itemid)
    {
        $.ajax({
            url:"/intsys/msd/main/graph/loadItemLot",
            method:"POST",
            data:{
                itemid:itemid
            },
            beforeSend:function(){},
            success:function(res){
                // console.log(res);
                $('#showLotNumberBy').html(res);
            }
        });
    }



    function loadGraphDataByCheckLot(qcid , inventBatchId , data_itemid)
    {
        $.ajax({
            url:"/intsys/msd/main/graph/loadGraphDataByCheckLot",
            method:"POST",
            data:{
                qcid:qcid,
                inventBatchId:inventBatchId,
                data_itemid:data_itemid
            },
            beforeSend:function(){},
            success:function(res){
                // console.log(JSON.parse(res));
                const resultDataArray = JSON.parse(res);
                if(resultDataArray.status == "Update data Success"){
                    console.log(resultDataArray);
                    selectLotNumber = [];
                    qcidToDb = [];
                    inventBatchIdToDb = [];
                    swal(
                        {
                            type: 'success',
                            title: 'อัพเดตข้อมูลสำเร็จ',
                            showConfirmButton: false,
                            timer: 1500
                        }
                    );

                    $('#selectLotnumber_modal').modal('hide');
                    // loadCheckGraphByCheckLotNum();
                    checkDataGraph();
                }
                
            }
        });
    }




    function loadTestid_checkLot()
    {
        $.ajax({
            url:"/intsys/msd/main/graph/loadTestid_checkLot",
            method:"POST",
            data:{
                qcidArray:qcidArray
            },
            beforeSend:function(){},
            success:function(res){
                console.log(res);
            }
        });
    }




    function loadCheckGraphByCheckLotNum()
    {
        $.ajax({
            url:"/intsys/msd/main/graph/loadCheckGraphByCheckLotNum",
            method:"POST",
            data:{},
            beforeSend:function(){},
            success:function(res){
                // console.log(res);
                $('#showCheckGraphByCheckLot').html(res);
                loadItemidAndLotNumber();
            }
        });
    }

    function arrayRemoveCheckLot(array , value)
    {
        return array.filter(function(ele){
            return ele != value;
        });
    }


    function updateTestIDUseCkeckLot(testidShowArrayCheckLot)
    {
        $.ajax({
            url:"/intsys/msd/main/graph/updateTestIDUseCheckLot",
            method:"POST",
            data:{
                testidShowArrayCheckLot:testidShowArrayCheckLot,
            },
            beforeSend:function(){},
            success:function(res){
                console.log(JSON.parse(res));
                if(JSON.parse(res).status == "Update Success"){
                    checkDataGraph()
                }else{
                    $('#showGraphByCheckLotMain').html('');
                }

            }
        });
    }


    function loadAlldataForUseGraph()
    {
        $.ajax({
            url:"/intsys/msd/main/graph/loadAlldataForUseGraph",
            method:"POST",
            data:{},
            beforeSend:function(){
                $('.loader').fadeIn(1000);
            },
            success:function(res){
                console.log(JSON.parse(res));
                // For Itemid Text
                let itemID = JSON.parse(res).itemId;
                $('#itemid_text').html(itemID);
                // For Itemid Text


                // For lot number text
                let lotnumber_text = JSON.parse(res).lotNumber;
                let lotnumber_text_use = '';
                let comma = '';
                for(let i=0;i<lotnumber_text.length;i++){

                    if(i == lotnumber_text.length-1){
                        comma = "";
                    }else{
                        comma = " , ";
                    }
                    
                    lotnumber_text_use += lotnumber_text[i]+comma;
                    // console.log(lotnumber_text_use);
                }
                $('#lotnumber_text').html(lotnumber_text_use);
                // For lot number text


                // For graph data
                let testid = JSON.parse(res).testId;
                testidShowArrayCheckLot = JSON.parse(res).testId;
                let checkdata = JSON.parse(res).checkData;
                let qcSampleNum = JSON.parse(res).qcSampleNum;

                let valueReal = [];
                let valueOutCome = [];
                let sumOutcome = [];

                let valueData10 = [];
                let valueOutCome10 = [];
                let sumOutcome10 = [];
                let lowerLimit = '';
                let upperLimit = '';
                let unitid10 = '';
                let testiduse = '';

                let resultData = [];
                for(let i=0;i<testid.length;i++){
                    // console.log(testid[i]);
                    testiduse =testid[i];
                    //รอบของ qcid
                    for(let j=0;j<checkdata.length;j++){
                        
                        //รอบของ testid ทั้ง 10 ใน 1qcid
                        for(let l=0;l<checkdata[j].length;l++){
               
                            if(testid[i] == checkdata[j][l].testid){
                                valueData10.push(...checkdata[j][l].value);
                                valueOutCome10.push(...checkdata[j][l].valueOutcome);
                                sumOutcome10.push(checkdata[j][l].sumOutcome);
                                unitid10 = checkdata[0][l].unitid;
                                lowerLimit = checkdata[0][l].lowerlimit;
                                upperLimit = checkdata[0][l].upperlimit;
                            }
                        }
                        //รอบของ testid ทั้ง 10 ใน 1qcid
                        
                    }
                    //รอบของ qcid
                    valueReal.push(...valueData10);
                    valueOutCome.push(...valueOutCome10);
                    sumOutcome.push(...sumOutcome10);

                    valueData10 = [];
                    valueOutCome10 = [];
                    sumOutcome10 = [];
                    // console.log(valueData10);


                    // console.log(valueReal);

                    let dataGraph = {
                        "testid":testiduse,
                        "valueReal":valueReal,
                        "valueOutcome":valueOutCome,
                        "sumOutcome":sumOutcome,
                        "unitid":unitid10,
                        "lowerLimit":lowerLimit,
                        "upperLimit":upperLimit
                    }
                    resultData.push(dataGraph);
                    valueReal = [];
                    valueOutCome = [];
                    sumOutcome = [];
                }

                console.log(resultData);

                // Loop for create graph section
                let areaGraphCheckLot = '';
                for(let i =0;i<resultData.length;i++){
                    areaGraphCheckLot += `<div id="areaGraphCheckLotShow_`+i+`" class="mt-5">`+resultData[i].testid+`</div>`;
                    $('#showGraphByCheckLotMain').html(areaGraphCheckLot);
                }
                 // Loop for create graph section


                //  Loop Create Graph
                let maxLimit='';
                let sumdataOutcome;
                let resultDataS;
                let calOutcome;
                for(let i =0;i<resultData.length;i++){
                    
                    calOutcome = resultData[i].sumOutcome.reduce((a,b) => a+b , 0);

                    if(calOutcome == 0){

                        resultDataS = resultData[i].valueReal;
                        maxLimit = resultData[i].upperLimit;

                        if(resultData[i].unitid == null){
                            conUnitid = "";
                        }else{
                            conUnitid = resultData[i].unitid;
                        }

                    }else{
                        resultDataS = resultData[i].valueOutcome;
                        maxLimit = 2;
                    }


                    graphBy_checkLotNumber(qcSampleNum , resultData[i].testid , resultDataS , i , resultData[i].unitid , resultData[i].lowerLimit , maxLimit , calOutcome);
                //   console.log(calOutcome);
                }
                //  Loop Create Graph
                
                
                $('.loader').fadeOut(1000);
                
                

            }
        });
    }


    function checkDataGraph()
    {
        $.ajax({
            url:"/intsys/msd/main/graph/checkDataGraph",
            method:"POST",
            data:{},
            beforeSend:function(){
                $('.loader').fadeIn(1000);
            },
            success:function(res){
                if(JSON.parse(res).status == "Found data on Database"){
                    loadCheckGraphByCheckLotNum();
                    loadAlldataForUseGraph();
                    $('.loader').fadeOut(1000);

                }else{
                    loadCheckGraphByCheckLotNum();

                }
            }
        });
    }



    function loadItemidAndLotNumber()
    {
        $.ajax({
            url:"/intsys/msd/main/graph/loadItemidAndLotNumber",
            method:"POST",
            data:{},
            beforeSend:function(){},
            success:function(res){
                console.log(JSON.parse(res));
                let itemid = JSON.parse(res).itemidHead;
                let lotnum = JSON.parse(res).lotnumberHead;
                let lotnumpush = '';
                let comma = '';
                $('#itemid_text').html(itemid);

                for(let i =0 ; i < lotnum.length; i++){

                    if(i == lotnum.length-1){
                        comma = "";
                    }else{
                        comma = " , ";
                    }

                    lotnumpush += lotnum[i]+comma;
                }

                $('#lotnumber_text').html(lotnumpush);
            }
        });
    }




    function graphBy_checkLotNumber(totalQcline , graphDataArrayName , graphDataArrayData , graphNumber , unitid , lowerLimit , upperLimit , sumOutcome)
    {
        let dataLabelShow;
        if(sumOutcome == 0){
            dataLabelShow = false;
        }else{
            dataLabelShow = true;
        }

        let minwidth = 0;
        if(graphDataArrayData.length > 300){
            minwidth = 7000;
        }else{
            minwidth = 4200;
        }

        return Highcharts.chart('areaGraphCheckLotShow_'+graphNumber, {

                chart: {
                    type: 'spline',
                    scrollablePlotArea: {
                    minWidth: minwidth,
                    scrollPositionX: 1
                    }
                },
                title: {
                    text: graphDataArrayName
                },

                subtitle: {
                    text: 'Min: '+lowerLimit+' , Max: '+upperLimit+' &nbsp;'+unitid
                },

                yAxis: {
                    // floor: lowerLimit,
                    // max: upperLimit,
                    title: {
                        text: 'รายการ'
                    },
                    allowDecimals:true,
                },

                xAxis: {
                    categories: totalQcline
                },

                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom',
                    itemMarginTop: 5,
                    itemMarginBottom: 5,
                },

                plotOptions: {
                    series: {
                        label: {
                            connectorAllowed: false
                        },
                        dataLabels: {
                            enabled: dataLabelShow,
                            // format: '<span style="font-size:10px;">{point.y:.3f}'+unitid+'</span>',
                            formatter: function() {
                                if(sumOutcome == 0){
                                    return '<span style="font-size:10px;">'+this.point.y.toFixed(3)+' '+unitid+'</span>';
                                }else{
                                    if (this.y == 0) {
                                        return '<span style="font-size:10px;"> ' + this.point.y + ' = Fail</span>';
                                    }else{
                                        return '<span style="font-size:10px;"> ' + this.point.y + ' = Pass</span>';
                                    }
                                }
                            },
                            rotation: 310,
                            y: -30
                        },
                        pointStart: 0
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.category}</span>: <b>{point.y:,.3f}'+unitid+'</b><br/>',
                    animation:true,
                },

                series: [
                    {
                        name:graphDataArrayName,
                        data:graphDataArrayData,
                        label:false
                    }
                ],

                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
        });
    }

</script>
</html>
