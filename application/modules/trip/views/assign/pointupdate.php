<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4> 
                        <a href="<?php echo base_url('trip/assign/index') ?>" class="btn btn-sm btn-info" title="Add"><i class="fa fa-plus"></i>Back</a>  
                    </h4>
                </div>
            </div>
            <div class="panel-body">
				<?= form_open('trip/assign/pointsaveupdate') ?>
				<?php echo form_hidden('pointid', $idpoint); ?>
				<?php echo form_hidden('trip_assign_id', $id); ?>
                <div class="form-group row">
					<label for="from" class="col-sm-3 col-form-label">From</label>
					<div class="col-sm-2">
                        <input type="text" name="timefrom" id="start" placeholder="" class="form-control timepicker" value="<?php echo $tripPoint[0]->dep_time ?>"> 
                    </div>
					<div class="col-sm-7">
                        <?php echo $tripPoint[0]->dep_point ?>
                    </div>
                </div>
                <div class="form-group row">
					<label for="end_point" class="col-sm-3 col-form-label">To</label>
					<div class="col-sm-2">
                        <input type="text" name="timeto" id="start" placeholder="" class="form-control timepicker" value="<?php echo $tripPoint[0]->arr_time ?>"> 
                    </div>
					<div class="col-sm-7">
                        <?php echo $tripPoint[0]->arr_point ?>
                    </div>
                </div>
                <?php if ($type) { ?>
                    <?php foreach ($type as $key => $value) {?>
                        <div class="form-group row">
                            <label for="[rice]" class="col-sm-3 col-form-label"><?php echo $value->typeName ?> Price</label>
                            <div class="col-sm-4">
                                <?php foreach ($tripPoint[0]->price as $keyprc => $valprc) {
                                    if (intval($valprc->type) == intval($value->type)) {
                                        $price =  intval($valprc->price);
                                    }
                                } ?>
                                <input name="price[<?php echo $value->type ?>]" class="form-control" type="number"
                                    placeholder="Normal Price" id="distance"
                                    value="<?php echo $price?>">
                            </div>
                            <div class="col-sm-4">
                                <?php foreach ($tripPoint[0]->price as $keyprc => $valprc) {
                                    if (intval($valprc->type) == intval($value->type)) {
                                        $sp_price =  intval($valprc->sp_price);
                                    }
                                } ?>
                                <input name="sp_price[<?php echo $value->type ?>]" class="form-control" type="number"
                                    placeholder="Special Price" id="distance"
                                    value="<?php echo $sp_price?>">
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
                <!-- <div class="form-group row">
					<label for="end_point" class="col-sm-3 col-form-label">Price</label>
					<div class="col-sm-9">
                        <input name="price" class="form-control" type="number"
							placeholder="0" id="distance"
							value="">
                    </div>
                </div> -->
                <div class="form-group text-right">
					<button type="submit" class="btn btn-success w-md m-b-5">Mengubah</button>
				</div>
				<?php echo form_close() ?>
            </div> 
        </div>
    </div>
</div>

 