<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">
                <?php echo form_open_multipart('website/cms/fasilitas','class="form-inner"') ?>

                    <div class="form-group row">
                        <label for="pemilihanseat" class="col-xs-3 col-form-label">Pemilihan Seat</label>
                        <div class="col-xs-9">
                            <textarea name="pemilihanseat" class="tinymce form-control"  placeholder="description" rows="7"><?php echo $pemilihanseat->konten ?></textarea>
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="onlinebooking" class="col-xs-3 col-form-label">Online Booking</label>
                        <div class="col-xs-9">
                            <textarea name="onlinebooking" class="tinymce form-control"  placeholder="description" rows="7"><?php echo $onlinebooking->konten ?></textarea>
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
 

