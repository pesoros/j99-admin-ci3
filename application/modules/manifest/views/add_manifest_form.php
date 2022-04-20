<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4><?php echo (!empty($title)?$title:null) ?></h4>
                    </div>
                </div>
                <div class="panel-body">

                    <?= form_open('manifest/manifest_controller/addmanifest/') ?>
                    <input type="hidden" name="id" value="">

                         <div class="form-group row">
                            <label for="route_id" class="col-sm-3 col-form-label">Email*</label>
                            <div class="col-sm-9">
                                <input name="emailassign" class="form-control" type="text" placeholder="" id="emailassign">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vehicle_type_id" class="col-sm-3 col-form-label">Tanggal *</label>
                            <div class="col-sm-9">
                                <input type="text" name="dateassign" class="form-control datetimepicker" value="" placeholder="Date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vehicle_type_id" class="col-sm-3 col-form-label">Trip *</label>
                            <div class="col-sm-9">
                                <?php echo form_dropdown('trip_id', $trip_list,null, 'class="form-control" id="trip_id"') ?>
                            </div>
                        </div>
                        <div class="tripfield"></div>
             
                        <div class="form-group text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                        </div>
                    <?php echo form_close() ?>

                </div>  
            </div>
        </div>
    </div>
    <script>
        $('#trip_id').on('select2:select', function (e) {
            var data = e.params.data;
            $('.tripfield').append(
                '<div class="form-group row" id="fl-'+data.id+'"><label for="status" class="col-sm-3 col-form-label"></label>' +
                '<div class="col-sm-7 ">' +
                '<input class="form-control" type="text"id="tripText" name="tripText[]" value="'+ data.text +'" readonly>' +
                '<input class="form-control" type="hidden"id="tripId" name="tripId[]" value="'+ data.id +'" readonly></div>' +
                '<div class="col-sm-1 "><button class="btn btn-danger w-md m-b-5 btn_remove" id="'+data.id+'" type="button">Delete</button></div>' +
                '</div>'
            );

            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('#fl-' + button_id + '').remove();
            });
        });
        function deletethis(button_id) {
            $('#fl-' + button_id + '').remove();
        }

function Checkprice() {
     var gp = document.getElementById("group_price_per_person").value;
     var ap = document.getElementById("price").value;
           if (parseInt(ap) < parseInt(gp)) {
        setTimeout(function(){
        alert('Group Price Can not Greater Than Adult price');
        document.getElementById("group_price_per_person").value = '';

        },500);

            return false;
        }
        return true;
}
</script>