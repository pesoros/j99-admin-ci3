<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4> 
                        <a href="<?php echo base_url('resto/resto_controller/resto_menu/'.$idResto) ?>" class="btn btn-sm btn-info" title="Add"><i class="fa fa-plus"></i>Back</a>  
                    </h4>
                </div>
            </div>
            <div class="panel-body">
				<?= form_open_multipart('resto/resto_controller/editsave_menu') ?>
				<?php echo form_hidden('id', $id); ?>
				<?php echo form_hidden('idResto', $idResto); ?>
                <div class="form-group row">
					<label for="end_point" class="col-sm-3 col-form-label">Menu</label>
					<div class="col-sm-9">
                        <input name="menu" class="form-control" type="text"
							placeholder="" id="distance"
							value="<?php echo $menu->food_name ?>">
                    </div>
                </div>
                <div class="form-group row">
					<label for="end_point" class="col-sm-3 col-form-label">Class</label>
					<div class="col-sm-9">
                        <?php echo form_dropdown('class', $class, (!empty($menu->class)?$menu->class:null), 'class="form-control type_list" id="class"') ?></td>
                    </div>
                </div>
                <div class="form-group row">
					<label for="end_point" class="col-sm-3 col-form-label">Price</label>
					<div class="col-sm-9">
                        <input name="price" class="form-control" type="number"
							placeholder="" id="distance"
							value="<?php echo $menu->price ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="preview" class="col-sm-3 col-form-label">Gambar</label>
                    <div class="col-sm-9">
                        <img src="<?php echo base_url(!empty($menu->image)?$menu->image: "./assets/img/icons/default.jpg") ?>" class="img-thumbnail" width="125" height="100">
                    </div>
                    <input type="hidden" name="old_image" value="<?php echo $menu->image ?>">
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
            </div> 
        </div>
    </div>
</div>

 