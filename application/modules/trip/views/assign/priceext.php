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
				<?= form_open('trip/assign/priceextsave') ?>
				<?php echo form_hidden('trip_assign_id', $id); ?>
                <div class="form-group row">
					<label for="end_point" class="col-sm-3 col-form-label">Date</label>
					<div class="col-sm-8">
                        <input type="text" name="dateprice" id="dateprice" placeholder="" class="form-control datetimepicker" value=""> 
                    </div>
                </div>
                <div class="form-group row">
					<label for="end_point" class="col-sm-3 col-form-label">Type</label>
					<div class="col-sm-8">
                        <?php echo form_dropdown('type', $type_dropdown, (!empty($assign->type)?$assign->type:null), ' class="form-control"') ?> 
                    </div>
                </div>
                <div class="form-group row">
					<label for="end_point" class="col-sm-3 col-form-label">Price Extension</label>
					<div class="col-sm-8">
                        <input type="number" name="priceext" id="priceext" placeholder="0" class="form-control" value=""> 
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
                                <th>Date</th>
                                <th>type</th>
                                <th>Price Extension</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($priceext)) ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($priceext as $value) { ?>
                            <tr class="">
                                <!-- <td><?php echo $sl++; ?></td> -->
                                <td><?php echo $value->date; ?></td>
                                <td><?php echo $value->type; ?></td>
                                <td><?php echo $value->price; ?></td>
                                <td width="150">
                                <?php if($this->permission->method('trip','update')->access()): ?>
                                    <a href="<?php echo base_url("trip/assign/priceextdelete/$value->id/$id") ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

 