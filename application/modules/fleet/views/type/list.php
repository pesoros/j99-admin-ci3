<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4> 
                        <a href="<?php echo base_url('fleet/fleet_type/form') ?>" class="btn btn-sm btn-info" title="Add"><i class="fa fa-plus"></i> <?php echo display('add') ?></a>  
                    </h4>
                </div>
            </div>
            <div class="panel-body">
 
                <div class="">
                    <table class="datatable table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('fleet_type') ?></th>
                                <th><?php echo display('total_seat') ?></th>
                                <th><?php echo display('layout') ?></th>
                                <th><?php echo display('status') ?></th>
                                <th><?php echo display('action') ?></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($fleet_types)) ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($fleet_types as $fleet_type) { ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><?php echo $fleet_type->type; ?></td>
                                 <td><?php echo $fleet_type->total_seat; ?></td>
                                  <td><?php echo $fleet_type->layout; ?></td>
                                <td><?php echo (($fleet_type->status==1)?display('active'):display('inactive')); ?></td>
                                <td>

                                <?php if($this->permission->method('fleet','update')->access()): ?>
                                    <a href="<?php echo base_url("fleet/fleet_type/form/$fleet_type->id") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <?php endif; ?>

                                <?php if($this->permission->method('fleet','delete')->access()): ?>
                                    <a href="<?php echo base_url("fleet/fleet_type/delete/$fleet_type->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

 