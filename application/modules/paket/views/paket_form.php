<div class="form-group text-right">
    <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal">
        Tambah Paket
    </button>
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
                                Kode Paket
                            </th>
                            <th>
                                Pengirim
                            </th>
                            <th>
                                Penerima
                            </th>
                            <th>
                                Dari
                            </th>
                            <th>
                                Ke
                            </th>
                            <!-- <th>
                                <?php echo display('action') ?>
                            </th> -->

                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($paket)) { ?>
                            <?php $sl = 1; ?>
                                <?php foreach ($paket as $value) { ?>
                                    <tr class="<?php echo ($sl & 1)?" odd gradeX ":"even gradeC " ?>">
                                        <td>
                                            <?php echo $sl; ?>
                                        </td>
                                        <td>
                                            <?php echo $value->packet_code; ?>
                                        </td>
                                        <td>
                                            <?php echo $value->sender_name.' <br>'.$value->sender_phone; ?>
                                        </td>
                                        <td>
                                            <?php echo $value->receiver_name.' <br>'.$value->receiver_phone; ?>
                                        </td>
                                        <td>
                                            <?php echo $value->sendfrom; ?>
                                        </td>
                                        <td>
                                            <?php echo $value->sendto; ?>
                                        </td>
                                       
                                        <!-- <td class="center">
                                            <a href="<?php echo base_url("paket/paket_controller/paket_update/$value->packet_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a> 


                                            <a href="<?php echo base_url("paket/paket_controller/paket_delete/$value->packet_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-times" aria-hidden="true"></i>
                                            </a> 
                                        </td> -->
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
                                <?= form_open('paket/paket_controller/create_paket',array('name'=>'myForm')) ?>
                                    <!-- <div class="form-group row">
                                        <label for="route_id" class="col-sm-4 col-form-label">
                                            <?php echo display('route_id') ?> *</label>
                                        <div class="col-sm-8">
                                            <?php echo form_dropdown('route_id',$rout,null,'class="form-control" style="width:100%"') ?>
                                        </div>

                                    </div> -->
                                    <div class="form-group row">
                                        <label for="pengirim" class="col-sm-4 col-form-label">
                                            Pengirim *</label>
                                        <div class="col-sm-8">
                                            <input name="pengirim" class="form-control" type="text" placeholder="" id="pengirim">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nopengirim" class="col-sm-4 col-form-label">
                                            Nomor Pengirim *</label>
                                        <div class="col-sm-8">
                                            <input name="nopengirim" class="form-control" type="text" placeholder="" id="nopengirim">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="penerima" class="col-sm-4 col-form-label">
                                            Penerima *</label>
                                        <div class="col-sm-8">
                                            <input name="penerima" class="form-control" type="text" placeholder="" id="penerima">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nopenerima" class="col-sm-4 col-form-label">
                                            Nomor Penerima *</label>
                                        <div class="col-sm-8">
                                            <input name="nopenerima" class="form-control" type="text" placeholder="" id="nopenerima">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="berat" class="col-sm-4 col-form-label">
                                            Berat *</label>
                                        <div class="col-sm-8">
                                            <input name="berat" class="form-control" type="text" placeholder="" id="berat">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="panjang" class="col-sm-4 col-form-label">
                                            Panjang *</label>
                                        <div class="col-sm-8">
                                            <input name="panjang" class="form-control" type="text" placeholder="" id="panjang">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lebar" class="col-sm-4 col-form-label">
                                            Lebar *</label>
                                        <div class="col-sm-8">
                                            <input name="lebar" class="form-control" type="text" placeholder="" id="lebar">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dari" class="col-sm-4 col-form-label">
                                            dari *</label>
                                        <div class="col-sm-8">
						                    <?php echo form_dropdown('dari', $location_list,null, 'class="form-control" id="dari"') ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="ke" class="col-sm-4 col-form-label">
                                            ke *</label>
                                        <div class="col-sm-8">
						                    <?php echo form_dropdown('ke', $location_list,null, 'class="form-control" id="ke"') ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="price" class="col-sm-4 col-form-label">
                                            <?php echo display('price') ?> *</label>
                                        <div class="col-sm-8">
                                            <input name="price" class="form-control" type="text" placeholder="<?php echo display('price') ?>" id="price">
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