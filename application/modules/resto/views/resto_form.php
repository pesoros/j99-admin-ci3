<div class="form-group text-right">
    <?php if($this->permission->method('price', 'create')->access()): ?>
    <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal">
        Tambah Resto
    </button>
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
                                Nama Resto
                            </th>
                            <th>
                                PIC
                            </th>
                            <th>
                                Phone
                            </th>
                            <th>
                                status
                            </th>
                            <th>
                                <?php echo display('action') ?>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($resto)) { ?>
                            <?php $sl = 1; ?>
                                <?php foreach ($resto as $value) { ?>
                                    <tr class="<?php echo ($sl & 1)?" odd gradeX ":"even gradeC " ?>">
                                        <td>
                                            <?php echo $sl; ?>
                                        </td>
                                        <td>
                                            <?php echo $value->resto_name; ?>
                                        </td>
                                        <td>
                                            <?php echo $value->pic; ?>
                                        </td>
                                        <td>
                                            <?php echo $value->phone; ?>
                                        </td>
                                        <td>
                                            <?php if ($value->status == 1) { ?>
                                                Active
                                            <?php } else {?>
                                                Non Active
                                            <?php } ?>
                                        </td>
                                       
                                        <td class="center">
                                            <!-- <?php if($this->permission->method('price', 'update')->access()): ?>
                                            <a href="<?php echo base_url("resto/resto_controller/resto_update/$value->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a> 
                                            <?php endif; ?> -->


                                            <?php if($this->permission->method('price', 'delete')->access()): ?>
                                            <!-- <a href="<?php echo base_url("resto/resto_controller/resto_delete/$value->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') ">Delete
                                            </a>  -->
                                            <a href="<?php echo base_url("resto/resto_controller/resto_menu/$value->id") ?>" class="btn btn-xs btn-info">Menu</a>
                                            <?php if ($value->status == 1) { ?>
                                                <a href="<?php echo base_url("resto/resto_controller/resto_close/$value->id") ?>" class="btn btn-xs btn-warning" onclick="return confirm('<?php echo display('are_you_sure') ?>') ">Close
                                                </a> 
                                            <?php } else {?>
                                                <a href="<?php echo base_url("resto/resto_controller/resto_activate/$value->id") ?>" class="btn btn-xs btn-success" onclick="return confirm('<?php echo display('are_you_sure') ?>') ">Activate
                                                </a> 
                                            <?php } ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php $sl++; ?>
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
                                <?= form_open('resto/resto_controller/create_resto',array('name'=>'myForm')) ?>
                                    <!-- <div class="form-group row">
                                        <label for="route_id" class="col-sm-4 col-form-label">
                                            <?php echo display('route_id') ?> *</label>
                                        <div class="col-sm-8">
                                            <?php echo form_dropdown('route_id',$rout,null,'class="form-control" style="width:100%"') ?>
                                        </div>

                                    </div> -->
                                    <div class="form-group row">
                                        <label for="emailassign" class="col-sm-4 col-form-label">
                                            Nama Resto *</label>
                                        <div class="col-sm-8">
                                            <input name="namaresto" class="form-control" type="text" placeholder="" id="namaresto">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="date" class="col-sm-4 col-form-label">
                                            Pic *</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="pic" class="form-control" value="" placeholder="pic">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="date" class="col-sm-4 col-form-label">
                                            Phone *</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="phone" class="form-control" value="" placeholder="phone">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="date" class="col-sm-4 col-form-label">
                                            Alamat *</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="address" class="form-control" value="" placeholder="address">
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