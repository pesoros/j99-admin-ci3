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
				<?= form_open('trip/assign/pointsave') ?>
				<?php echo form_hidden('trip_assign_id', $id); ?>
                <div class="form-group row">
					<label for="from" class="col-sm-3 col-form-label">From</label>
					<div class="col-sm-2">
                        <input type="text" name="timefrom" id="start" placeholder="" class="form-control timepicker" value=""> 
                    </div>
					<div class="col-sm-7">
                        <?php echo form_dropdown('from', $tripRoute,null, 'class="form-control startend" id="from"') ?>
                    </div>
                </div>
                <div class="form-group row">
					<label for="end_point" class="col-sm-3 col-form-label">To</label>
					<div class="col-sm-2">
                        <input type="text" name="timeto" id="start" placeholder="" class="form-control timepicker" value=""> 
                    </div>
					<div class="col-sm-7">
                        <?php echo form_dropdown('to', $tripRoute,null, 'class="form-control startend" id="to"') ?>
                    </div>
                </div>
                <?php if ($type) { ?>
                    <?php foreach ($type as $key => $value) {?>
                        <div class="form-group row">
                            <label for="[rice]" class="col-sm-3 col-form-label"><?php echo $value->typeName ?> Price</label>
                            <div class="col-sm-4">
                                <input name="price[<?php echo $value->type ?>]" class="form-control" type="number"
                                    placeholder="Normal Price" id="distance"
                                    value="">
                            </div>
                            <div class="col-sm-4">
                                <input name="sp_price[<?php echo $value->type ?>]" class="form-control" type="number"
                                    placeholder="Special Price" id="distance"
                                    value="">
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
					<button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
				</div>
				<?php echo form_close() ?>
                <div class="">
                    <table class="datatable2 table table-bordered">
                        <thead>
                            <tr>
                                <!-- <th><?php echo display('sl_no') ?></th> -->
                                <th>Departure</th>
                                <th>Arrive</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($tripPoint)) ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($tripPoint as $value) { ?>
                            <tr class="<?php echo (!empty($value->isClosed)?$value->isClosed:null) ?>">
                                <!-- <td><?php echo $sl++; ?></td> -->
                                <td><?php echo $value->dep_point; ?></td>
                                <td><?php echo $value->arr_point; ?></td>
                                <td width="150">
                                <?php if($this->permission->method('trip','update')->access()): ?>
                                    <a href="<?php echo base_url("trip/assign/pointdelete/$value->id/$value->trip_assign_id") ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

 