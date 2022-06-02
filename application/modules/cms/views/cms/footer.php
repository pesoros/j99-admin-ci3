<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">
                <?php echo form_open_multipart('cms/cms/footer','class="form-inner"') ?>

                    <div class="form-group row">
                        <label for="preview" class="col-sm-3 col-form-label">Logo</label>
                        <div class="col-sm-9">
                            <img src="<?php echo base_url(!empty($show->logo)?$show->logo: "./assets/img/icons/default.jpg") ?>" class="img-thumbnail" width="125" height="100">
                        </div>
                        <input type="hidden" name="old_image" value="<?php echo $show->logo ?>">
                    </div> 

                    <div class="form-group row">
                        <label for="logo" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <input type="file" name="image" id="image" aria-describedby="fileHelp">
                            <small id="fileHelp" class="text-muted"></small>
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="email" class="col-xs-3 col-form-label">Email<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="email" type="text" class="form-control" id="email" placeholder="Email" value="<?php echo $show->email ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-xs-3 col-form-label">Alamat<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="address" type="text" class="form-control" id="address" placeholder="Alamat" value="<?php echo $show->address ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-xs-3 col-form-label">Phone<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="phone" type="text" class="form-control" id="phone" placeholder="phone" value="<?php echo $show->phone ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone_cs" class="col-xs-3 col-form-label">Whatsapp<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="phone_cs" type="text" class="form-control" id="phone_cs" placeholder="phone_cs" value="<?php echo $show->phone_cs ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="link_apple" class="col-xs-3 col-form-label">Link Apple<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="link_apple" type="text" class="form-control" id="link_apple" placeholder="link_apple" value="<?php echo $show->link_apple ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="link_android" class="col-xs-3 col-form-label">Link Android<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="link_android" type="text" class="form-control" id="link_android" placeholder="link_android" value="<?php echo $show->link_android ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="copyright" class="col-xs-3 col-form-label">Copyright<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="copyright" type="text" class="form-control" id="copyright" placeholder="copyright" value="<?php echo $show->copyright ?>">
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
 

