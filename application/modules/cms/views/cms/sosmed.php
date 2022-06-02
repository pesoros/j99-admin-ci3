<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">
                <?php echo form_open_multipart('cms/cms/sosmed','class="form-inner"') ?>

                    <div class="form-group row">
                        <label for="youtube" class="col-xs-3 col-form-label">youtube<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="youtube" type="text" class="form-control" id="youtube" placeholder="youtube" value="<?php echo $show->youtube ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="instagram" class="col-xs-3 col-form-label">instagram<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="instagram" type="text" class="form-control" id="instagram" placeholder="instagram" value="<?php echo $show->instagram ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="twitter" class="col-xs-3 col-form-label">twitter<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="twitter" type="text" class="form-control" id="twitter" placeholder="twitter" value="<?php echo $show->twitter ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="facebook" class="col-xs-3 col-form-label">Facebook<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="facebook" type="text" class="form-control" id="facebook" placeholder="facebook" value="<?php echo $show->facebook ?>">
                        </div>
                    </div>

                    <div class="form-group text-right">
                        <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                    </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
 

