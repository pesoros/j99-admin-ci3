<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4> 
                        <a href="<?php echo base_url('resto/resto_controller/create_resto') ?>" class="btn btn-sm btn-info" title="Add"><i class="fa fa-plus"></i>Back</a>  
                    </h4>
                </div>
            </div>
            <div class="panel-body">
				<?= form_open_multipart('resto/resto_controller/resto_menu_save') ?>
				<?php echo form_hidden('resto_id', $id); ?>
                <div class="form-group row">
					<label for="end_point" class="col-sm-3 col-form-label">Menu</label>
					<div class="col-sm-9">
                        <input name="menu" class="form-control" type="text"
							placeholder="" id="distance"
							value="">
                    </div>
                </div>
                <div class="form-group row">
					<label for="end_point" class="col-sm-3 col-form-label">Class</label>
					<div class="col-sm-9">
                        <?php echo form_dropdown('class', $class, null, 'class="form-control type_list" id="class"') ?></td>
                    </div>
                </div>
                <div class="form-group row">
					<label for="end_point" class="col-sm-3 col-form-label">Price</label>
					<div class="col-sm-9">
                        <input name="price" class="form-control" type="number"
							placeholder="" id="distance"
							value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="preview" class="col-sm-3 col-form-label">Gambar</label>
                    <div class="col-sm-9">
                        <img src="<?php echo base_url(!empty($fleet_type->image)?$fleet_type->image: "./assets/img/icons/default.jpg") ?>" class="img-thumbnail" width="125" height="100">
                    </div>
                    <input type="hidden" name="old_image" value="<?php echo $fleet_type->image ?>">
                </div> 

                <div class="form-group row">
                    <label for="logo" class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <input type="file" name="image" id="image" aria-describedby="fileHelp">
                        <small id="fileHelp" class="text-muted"></small>
                    </div>
                </div> 

                <div class="form-group text-right">
					<button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
				</div>
				<?php echo form_close() ?>
                <div class="">
                    <table class="datatable2 table table-bordered">
                        <thead>
                            <tr>
                                <!-- <th><?php echo display('sl_no') ?></th> -->
                                <th>Menu</th>
                                <th>Gambar</th>
                                <th>Harga</th>
                                <th>Kelas</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($menu)) ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($menu as $value) { ?>
                            <tr class="<?php echo (!empty($value->isClosed)?$value->isClosed:null) ?>">
                                <!-- <td><?php echo $sl++; ?></td> -->
                                <td><?php echo $value->food_name; ?></td>
                                <td><img src="<?php echo ($value->image) ? base_url().$value->image : 'https://api.tiketjuragan99.id/assets/default_food.jpeg'; ?>" alt="" style="max-width:100px;"></td>
                                <td><?php echo $value->price; ?></td>
                                <td><?php echo $value->classname; ?></td>
                                <td><?php echo $value->status; ?></td>
                                <td width="150">
                                <?php if($this->permission->method('trip','update')->access()): ?>
                                    <!-- <a href="<?php echo base_url("trip/assign/pointdelete/$value->id/$value->id") ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a> -->
                                    <a href="<?php echo base_url("resto/resto_controller/menu_update/$id/$value->id") ?>" class="btn btn-xs btn-info">Update</a>
                                    <?php if ($value->status == 1) { ?>
                                        <a href="<?php echo base_url("resto/resto_controller/menu_deactivate/$id/$value->id") ?>" class="btn btn-xs btn-warning" onclick="return confirm('<?php echo display('are_you_sure') ?>') ">Deactivate
                                        </a> 
                                    <?php } else {?>
                                        <a href="<?php echo base_url("resto/resto_controller/menu_activate/$id/$value->id") ?>" class="btn btn-xs btn-success" onclick="return confirm('<?php echo display('are_you_sure') ?>') ">Activate
                                        </a> 
                                    <?php } ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php } ?> 
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
</div>

 