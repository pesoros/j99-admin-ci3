<div class="row">
	<div class="col-sm-12 col-md-12">
		<div class="panel panel-bd lobidrag">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						<a href="<?php echo base_url('ticket/booking/form') ?>" class="btn btn-sm btn-info"
							title="Add"><i class="fa fa-plus"></i> <?php echo display('add') ?></a>

					</h4>
					<!-- <div class="form-group row">
						<label for="approximate_time" class="col-sm-3 col-form-label">jarak tanggal
							*</label>
						<div class="col-sm-4">
							<input name="start" class="start form-control datepicker" type="text"
								placeholder="Tanggal Awal" id="start" value="">
						</div>
						<div class="col-sm-4">
							<input name="end" class="end form-control datepicker" type="text"
								placeholder="Tanggal Akhir" id="end" value="">
						</div>
					</div> -->
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
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($bookings)) ?>
							<?php $sl = 1; ?>
							<?php $total_price = 0; ?>
							<?php foreach ($bookings as $booking) { 
                            $total_price += $booking->price;
                       
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
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<h2>Total Pendapatan : Rp.<?php echo $total_price; ?></h2>
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
									<button type="button" class="btn btn-danger w-md m-b-5"
										data-dismiss="modal">No</button>
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
	function modal_load(id_no) {
		$('#bookid').val(id_no);
		$('#add1').modal('show');
	}

</script>
