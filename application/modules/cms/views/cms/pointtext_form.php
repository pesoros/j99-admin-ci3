<div class="row">
    <div class="col-sm-12">
        <div class="form-group text-left"> 
            <a href="<?php echo base_url();?>cms/cms/pointtext" class="btn btn-primary">Kembali</a>
        </div>
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">
                <?php echo form_open_multipart('cms/cms/pointtext_form/'.$show->id,'class="form-inner"') ?>

                    <div class="form-group row">
                        <label for="sequence" class="col-xs-3 col-form-label">Urutan<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="sequence" type="text" class="form-control" id="sequence" placeholder="sequence" disabled value="<?php echo $show->sequence ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="title" class="col-xs-3 col-form-label">Judul<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="title" type="text" class="form-control" id="title" placeholder="title" value="<?php echo $show->title ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-xs-3 col-form-label">description<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="description" type="text" class="form-control" id="description" placeholder="description" value="<?php echo $show->description ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="icon" class="col-xs-3 col-form-label">icon<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="icon" type="text" class="form-control" id="icon" placeholder="icon" value="<?php echo $show->icon ?>">
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
 

