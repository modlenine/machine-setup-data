<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{title}</title>



    <script>
        $(document).ready(function() {

            $('#dataMainList thead th').each(function() {
                var title = $(this).text();
                $(this).html(title + ' <input type="text" class="col-search-input" placeholder="Search ' + title + '" />');
            });

            

            var widthss;
            const browserWidth = $(window).width();
            if(browserWidth > 768){
                    $('#dataMainList').css('width' , '100%');
                }

            $(window).resize(function(){
                if(browserWidth > 768){
                    $('#dataMainList').css('width' , '100%');
                }
            });

            
                var table = $('#dataMainList').removeAttr('width').DataTable({
                            "scrollX": true,
                            "processing": true,
                            "serverSide": true,
                            "stateSave": true,
                            stateLoadParams: function(settings, data) {
                                for (i = 0; i < data.columns["length"]; i++) {
                                    let col_search_val = data.columns[i].search.search;
                                    if (col_search_val !== "") {
                                        $("input", $("#dataMainList thead th")[i]).val(col_search_val);
                                    }
                                }
                            },
                            "ajax": "<?php echo base_url('main/loadMainData/') ?>",
                            order: [
                                [0, 'desc']
                            ],
                            columnDefs: [{
                                    targets: "_all",
                                    orderable: false
                                },
                                {"width": "80","targets": 0},
                                {"width": "200","targets": 1},
                                {"width": "100","targets": 2},
                                {"width": "100","targets": 3},
                                {"width": "100","targets": 4},
                                {"width": "100","targets": 5},
                                {"width": "100","targets": 6},
                                {"width": "150","targets": 7},
                                {"width": "80","targets":8}
                            ],
                            });
 

            




            table.columns().every(function() {
                var table = this;
                $('input', this.header()).on('keyup change', function() {
                    if (table.search() !== this.value) {
                        table.search(this.value).draw();
                    }
                });
            });


        });
    </script>
</head>

<body>


    <div class="container-fluid" id="app">

        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Machine setup data</h1>
            </div>
        </div>

        <div class="table-responsive">
            <table id="dataMainList" class="table table-striped table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        <th>Form No.</th>
                        <th>Machine Name</th>
                        <th>Product Code</th>
                        <th>Product No.</th>
                        <th>Batch Number</th>
                        <th>MIS</th>
                        <th>Output</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
    <div class="mt-6"></div>

</body>
<script>
    $(document).ready(function(){
        $(document).on('click' , '.stopMemoView' , function(){
            // Open modal
            const data_stopMemo = $(this).attr("data_stopMemo");
            $('#stopmemo_view').html(data_stopMemo);
            $('#stopMemoView_modal').modal('show');
        })
    });
</script>

</html>