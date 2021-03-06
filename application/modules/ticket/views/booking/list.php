<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4> 
                        <a href="<?php echo base_url('ticket/booking/form') ?>" class="btn btn-sm btn-info" title="Add"><i class="fa fa-plus"></i> <?php echo display('add') ?></a>  
                    </h4>
                </div>
            </div>
            <div class="panel-body">
 
                <div class="">
                    <table class="datatable2 table table-bordered ">
                        <thead>
                            <tr>
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('booking_date') ?></th>
                                <th><?php echo display('booking_id') ?></th>
                                <th><?php echo display('email') ?></th>
                                <!-- <th><?php echo display('route_name') ?></th> -->
                                <th><?php echo display('total_seat') ?></th>
                                <th><?php echo display('price') ?></th>
                                <th>Metode Pembayaran</th>
                                <th>Pembayaran</th>
                               
                                <th><?php echo display('action') ?></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($bookings)) ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($bookings as $booking) { 

                       
                                ?>

                            <tr class="<?php echo (!empty($booking->tkt_refund_id) ? "bg-danger" : null ) ?>">
                                <td><?php echo $sl++; ?></td>
                                <td><?php echo $booking->booking_date; ?></td>
                                <td><?php echo $booking->booking_code; ?></td>
                                <!-- <td><?php $result=$this->db->select('firstname,lastname')->from('tkt_passenger')->where('id_no',$booking->tkt_passenger_id_no)->get()->result();
                                 foreach ($result as $name) {
                                    echo $name->firstname.' '.$name->lastname;
                                 }
                                 ?></td> -->
                                 <td><?php echo $booking->booker ?></td>
                                <!-- <td><?php echo $booking->route_name; ?></td> -->
                                <td><?php echo $booking->total_seat; ?></td>
                                <td><?php echo $currency; ?><?php echo $booking->price; ?></td>
                                <td><?php  echo $booking->payment_method.' - '.$booking->payment_channel_code; ?></td>
                                <td >
                                <?php 
                                if($booking->ps == 0){
                                    echo '<a type="button" class="test btn btn-primary btn-xs" onclick="modal_load('."'".$booking->booking_code."'".')" data-toggle="modal">Menunggu</a>';
                                } else if($booking->ps == 1){
                                    echo '<a type="button" class="test btn btn-success btn-xs" )">Terbayar</a>';
                                } else if($booking->ps == 2){
                                    echo '<a type="button" class="test btn btn-warning btn-xs" )">Dikembalikan</a>';
                                }
                                ?>
                                </td>
                                <td>
                                    <a href="<?php echo base_url("ticket/booking/view/$booking->booking_code") ?>" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="left" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                

                                    <a href="<?php echo base_url("ticket/refund/form?bid=$booking->booking_code&pid=$booking->tkt_passenger_id_no") ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="left" title="Refund"><i class="fa fa-undo" aria-hidden="true"></i></a>
                                    <input type="hidden" id="bookingid" value="<?php echo $booking->booking_code; ?>">
                                

                                    <a href="<?php echo base_url("ticket/booking/delete/$booking->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                
                                </td>
                            </tr>
                            <?php } ?> 
                        </tbody>
                    </table>
                    <?= $links ?>
                </div>
            </div> 
        </div>
    </div>
</div>

 <div id="add1" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" style="background-color:green; color: white">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center><strong>Payment info</strong></center>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="panel">

                            <div class="panel-body">

                                <?= form_open('ticket/Booking/booking_paid') ?>
                                    <div class="form-group row">
                                        <label for="fitness_id" class="col-sm-3 col-form-label">
                                          </label>
                                        <div class="col-sm-9">
                                           <h1>Do You Want to Pay Now ??</h1>
                                           <input type="hidden" name="booking_id" value="" id="bookid">
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="button" class="btn btn-danger w-md m-b-5" data-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-success w-md m-b-5">
                                            Yes
                                        </button>
                                    </div>
                                    <?php echo form_close() ?>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="modal-footer">

        </div>

    </div>


</div>
<script type="text/javascript">
function modal_load(id_no){
    $('#bookid').val(id_no);
    $('#add1').modal('show');
}

</script>