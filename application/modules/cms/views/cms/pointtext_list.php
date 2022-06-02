<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-body">
 
                <div class="">
                    <table class="datatable table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('title') ?></th>
                                <th><?php echo display('description') ?></th>
                                <th>icon</th>
                                <th><?php echo display('action') ?></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pointtext)) ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($pointtext as $value) { ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><?php echo $value->title; ?></td>
                                    <td><?php echo character_limiter(strip_tags($value->description),50); ?></td>
                                <td><?php echo $value->icon; ?></td>
                                <td>

                                <?php if($this->permission->method('fleet','update')->access()): ?>
                                    <a href="<?php echo base_url("cms/cms/pointtext_form/$value->id") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <?php endif; ?>

                                <?php if($this->permission->method('fleet','delete')->access()): ?>
                                    <a href="<?php echo base_url("cms/cms/pointtext_formte/$value->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

 