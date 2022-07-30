<div class="form-group text-right">
    <?php if($this->permission->method('price', 'create')->access()): ?>
    <!-- <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal">
        Assign
    </button> -->
    <!-- <a href="<?php echo base_url('manifest/manifest_controller/addmanifest') ?>" class="btn btn-sm btn-info" title="Add"><i class="fa fa-plus"></i> <?php echo display('add') ?></a>   -->
    <?php endif; ?> 
</div>

<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail">

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>
                                <?php echo display('sl') ?>
                            </th>
                            <th>
                                Nama
                            </th>
                            <th>
                                Nomor tiket
                            </th>
                            <th>
                                Phone
                            </th>
                            <th>
                                Kursi
                            </th>
                            <th>
                                Makanan
                            </th>
                            <th>
                                Titik Jemput
                            </th>
                            <th>
                                Titik Akhir
                            </th>
                            <th>
                                Bagasi
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data)) { ?>
                            <?php $sl = 1; ?>
                                <?php foreach ($data as $value) { ?>
                                    <tr class="<?php echo ($sl & 1)?" odd gradeX ":"even gradeC " ?>">
                                        <td>
                                            <?php echo $sl; ?>
                                        </td>
                                        <td>
                                            <?php echo $value->name; ?>
                                        </td>
                                        <td>
                                            <?php echo $value->ticket_number; ?>
                                        </td>
                                        <td>
                                            <?php echo $value->phone; ?>
                                        </td>
                                        <td>
                                            <?php echo $value->seat_number; ?>
                                        </td>
                                        <td>
                                            <?php echo $value->food_name; ?>
                                        </td>
                                        <td>
                                            <?php echo $value->pickup_trip_location.' / '.$value->dep_time; ?>
                                        </td>
                                        <td>
                                            <?php echo $value->drop_trip_location.' / '.$value->arr_time; ?>
                                        </td>
                                        <td>
                                            -
                                        </td>
                                    </tr>
                                    <?php 
                                        $sl++; 
                                        if ($value->action == 'spend') {
                                            $summary = $summary - $value->nominal;
                                        } else {
                                            $summary = $summary + $value->nominal;
                                        }
                                    ?>
                                <?php } ?>
                            <?php } ?>
                    </tbody>
                </table>
                <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>




<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" style="background-color:green; color: white">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center><strong>Tambah</strong></center>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                                <?= form_open('manifest/manifest_controller/create_manifest',array('name'=>'myForm')) ?>
                                    <!-- <div class="form-group row">
                                        <label for="route_id" class="col-sm-4 col-form-label">
                                            <?php echo display('route_id') ?> *</label>
                                        <div class="col-sm-8">
                                            <?php echo form_dropdown('route_id',$rout,null,'class="form-control" style="width:100%"') ?>
                                        </div>

                                    </div> -->
                                    <div class="form-group row">
                                        <label for="emailassign" class="col-sm-4 col-form-label">
                                            Email *</label>
                                        <div class="col-sm-8">
                                            <input name="emailassign" class="form-control" type="text" placeholder="" id="emailassign">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="date" class="col-sm-4 col-form-label">
                                            Tanggal *</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="dateassign" class="form-control datetimepicker" value="" placeholder="Date">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dari" class="col-sm-4 col-form-label">
                                            Trip *</label>
                                        <div class="col-sm-8">
						                    <?php echo form_dropdown('trip_id', $trip_list,null, 'class="form-control" id="trip_id"') ?>
                                        </div>
                                    </div>

                                    <div class="form-group text-right">
                                        <button type="reset" class="btn btn-primary w-md m-b-5">
                                            <?php echo display('reset') ?>
                                        </button>
                                        <button type="submit" class="btn btn-success w-md m-b-5">
                                            <?php echo display('add') ?>
                                        </button>
                                    </div>
                                <?php echo form_close() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function Checkprice() {
     var gp = document.getElementById("group_price_per_person").value;
     var ap = document.getElementById("price").value;
           if (parseInt(ap) <= parseInt(gp) ) {
        setTimeout(function(){
        alert('Group Price Can not Greater Than Adult price');
        document.getElementById("group_price_per_person").value = '';

        },1000);

            return false;
        }
        return true;
}
</script>