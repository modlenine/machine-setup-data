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

        <!-- <div class="row text-center">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <button style="width:100%;" class="button button-desc button-3d button-rounded button-green center" data-toggle="modal" data-target="#set_shift_modal">ตั้งค่ากะการทำงาน</button>
            </div>
            <div class="col-md-2"></div>
        </div> -->

        <!-- <div class="row text-center">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <button style="width:100%;" class="button button-desc button-3d button-rounded button-green center" data-toggle="modal" data-target="#set_shift_modal">ตั้งค่า ค่าเบี่ยงเบน</button>
            </div>
            <div class="col-md-2"></div>
        </div> -->

        <!-- <div class="row text-center">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <button style="width:100%;" class="button button-desc button-3d button-rounded button-green center" data-toggle="modal" data-target="#supset_modal">ตั้งค่า หัวหน้างาน</button>
            </div>
            <div class="col-md-2"></div>
        </div> -->

        <div class="divider divider-border divider-center"><i class="icon-email2"></i></div>


    </div>
</body>
<script>
    $(document).ready(function() {
        $('.datetimepickerS , .datetimepickerE').datetimepicker({
            format: 'HH:mm',
            showClose: true
        });
    });
</script>

</html>