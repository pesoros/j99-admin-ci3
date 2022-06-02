<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">
                <?php echo form_open_multipart('cms/cms/home','class="form-inner"') ?>

                    <div class="form-group row">
                        <label for="content" class="col-xs-3 col-form-label">Content<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="content" type="text" class="tinymce form-control" id="content" placeholder="content" value="<?php echo $show->content ?>">
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
 

