<div class="row">
    <div class="col-sm-12">
        <div class="form-group text-left"> 
            <a href="<?php echo base_url();?>cms/cms/facilities" class="btn btn-primary">Kembali</a>
        </div>
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">
                <?php echo form_open_multipart('cms/cms/facilities_form/'.$show->id,'class="form-inner"') ?>

                    <div class="form-group row">
                        <label for="preview" class="col-sm-3 col-form-label">image</label>
                        <div class="col-sm-9">
                            <img src="<?php echo base_url(!empty($show->image)?$show->image: "./assets/img/icons/default.jpg") ?>" class="img-thumbnail" width="125" height="100">
                        </div>
                        <input type="hidden" name="old_image" value="<?php echo $show->image ?>">
                    </div> 

                    <div class="form-group row">
                        <label for="image" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <input type="file" name="image" id="image" aria-describedby="fileHelp">
                            <small id="fileHelp" class="text-muted"></small>
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="name" class="col-xs-3 col-form-label">Nama Fasilitas<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="name" type="text" class="form-control" id="name" placeholder="name" disabled value="<?php echo $show->name ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="title" class="col-xs-3 col-form-label">title<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="title" type="text" class="form-control" id="title" placeholder="title" value="<?php echo $show->title ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-xs-3 col-form-label">description<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="description" type="text" class="tinymce form-control" id="description" placeholder="description" value="<?php echo $show->description ?>">
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
 

