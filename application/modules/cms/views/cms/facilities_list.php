<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-body">
 
                <div class="">
                    <table class="datatable table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('fleet_facilities') ?></th>
                                <th><?php echo display('description') ?></th>
                                <th><?php echo display('status') ?></th>
                                <th><?php echo display('action') ?></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($facilities)) ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($facilities as $fleet_facilities) { ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><?php echo $fleet_facilities->name; ?></td>
                                    <td><?php echo character_limiter(strip_tags($fleet_facilities->description),50); ?></td>
                                <td><?php echo (($fleet_facilities->status==1)?display('active'):display('inactive')); ?></td>
                                <td>

                                <?php if($this->permission->method('fleet','update')->access()): ?>
                                    <a href="<?php echo base_url("cms/cms/facilities_form/$fleet_facilities->id") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <?php endif; ?>

                                <?php if($this->permission->method('fleet','delete')->access()): ?>
                                    <a href="<?php echo base_url("cms/cms/facilities_formte/$fleet_facilities->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

 