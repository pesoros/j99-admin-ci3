

<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4><?php echo (!empty($title)?$title:null) ?></h4>
                    </div>
                </div>
                <div class="panel-body">

                    <?= form_open('manifest/manifest_controller/manifest_update/'. $data->id) ?>
                    <input type="hidden" name="id" value="<?php echo $data->id?>">

                         <div class="form-group row">
                            <label for="route_id" class="col-sm-3 col-form-label">Email*</label>
                            <div class="col-sm-9">
                                <input name="emailassign" value="<?php echo $data->email_assign?>" class="form-control" type="text" placeholder="" id="emailassign">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vehicle_type_id" class="col-sm-3 col-form-label">Tanggal *</label>
                            <div class="col-sm-9">
                                <input type="text" name="dateassign" value="<?php echo $data->trip_date?>" class="form-control datetimepicker" value="" placeholder="Date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vehicle_type_id" class="col-sm-3 col-form-label">Trip Assign*</label>
                            <div class="col-sm-9">
                                <?php echo form_dropdown('trip_assign', $trip_list, $data->trip_assign, 'class="form-control" id="trip_assign"') ?>
                            </div>
                        </div>
                        <!-- <div class="tripfield">
                            <?php if ($manifest_trip) { ?>
                                <?php foreach ($manifest_trip as $key => $value) { ?>
                                    <div class="form-group row" id="fl-<?php echo $value->trip_id_no ?>"><label for="status" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-7 ">
                                    <input class="form-control" type="text"id="tripText" name="tripText[]" value="<?php echo $value->trip_title ?>" readonly>
                                    <input class="form-control" type="hidden"id="tripId" name="tripId[]" value="'<?php echo $value->trip_id_no ?>" readonly></div>
                                    <div class="col-sm-1 "><button class="btn btn-danger w-md m-b-5 btn_remove" id="<?php echo $value->trip_id_no ?>" onclick="deletethis(<?php echo $value->trip_id_no ?>)" type="button">Delete</button></div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div> -->
             
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
        // $('#trip_assign').on('select2:select', function (e) {
        //     var data = e.params.data;
        //     $('.tripfield').append(
        //         '<div class="form-group row" id="fl-'+data.id+'"><label for="status" class="col-sm-3 col-form-label"></label>' +
        //         '<div class="col-sm-7 ">' +
        //         '<input class="form-control" type="text"id="tripText" name="tripText[]" value="'+ data.text +'" readonly>' +
        //         '<input class="form-control" type="hidden"id="tripId" name="tripId[]" value="'+ data.id +'" readonly></div>' +
        //         '<div class="col-sm-1 "><button class="btn btn-danger w-md m-b-5 btn_remove" id="'+data.id+'" type="button">Delete</button></div>' +
        //         '</div>'
        //     );

        //     $(document).on('click', '.btn_remove', function () {
        //         var button_id = $(this).attr("id");
        //         $('#fl-' + button_id + '').remove();
        //     });
        // });
        // function deletethis(button_id) {
        //     $('#fl-' + button_id + '').remove();
        // }

function Checkmanifest() {
     var gp = document.getElementById("group_manifest_per_person").value;
     var ap = document.getElementById("manifest").value;
           if (parseInt(ap) < parseInt(gp)) {
        setTimeout(function(){
        alert('Group manifest Can not Greater Than Adult manifest');
        document.getElementById("group_manifest_per_person").value = '';

        },500);

            return false;
        }
        return true;
}
</script>