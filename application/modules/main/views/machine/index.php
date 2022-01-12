<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{title}</title>
</head>

<body>

    <div class="container" id="app">
        <div class="row text-center">
            <div class="col-md-6">
                <button class="button button-desc button-3d button-rounded button-green center" data-toggle="modal" data-target="#create_new_template_modal" style="width:100%;" id="btnCreateTemplateMain">สร้าง Template</button>
            </div>

            <!-- <div class="col-md-6">
                <button id="copyTemplateBtn" class="button button-desc button-3d button-rounded button-green center" data-toggle="modal" data-target="#copy_template_md" style="width:100%">จัดการ Template</button>
            </div> -->

            <div class="col-md-6">
                <button class="button button-desc button-3d button-rounded button-green center" data-toggle="modal" data-target="#runscreen_md" style="width:100%">จัดการ Run Screen</button>
            </div>


            <div class="divider divider-border divider-center"><i class="icon-email2"></i></div>
            

        </div>

        <div class="row form-group">
            <div class="col-md-6">
                <label for="">ค้นหา Template</label>
                <input type="text" name="seachMatchineBox" id="seachMatchineBox" class="form-control">
            </div>
        </div>
        
        <div id="showMachineBox" class="row"></div>
        
    </div>

    <!-- <a href="#" class="button button-desc button-3d button-rounded button-green center">Create a Canvas Account<span>Free Forever, Instant Activation</span></a> -->

</body>


</html>