<div class="row">
	<div class="col-sm-12 col-md-12">
		<div class="panel panel-bd lobidrag">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						<a href="<?php echo base_url('ticket/booking/index') ?>" class="btn btn-sm btn-success"
							title="List"> <i class="fa fa-list"></i> <?php echo display('list') ?></a>
						<a href="<?php echo base_url('ticket/booking/form') ?>" class="btn btn-sm btn-info"
							title="Add"><i class="fa fa-plus"></i> <?php echo display('add') ?></a>
						<a href="#" class="btn btn-sm btn-danger" title="Print" onclick="printContent('PrintMe')"><i
								class="fa fa-print"></i></a>
					</h4>
				</div>
			</div>

			<div class="panel-body" id="PrintMe">

				<?php foreach ($booking as $key => $value) { ?>
				<div class="ticket-content">
					<div class="table-responsive">
						<table style="width:100%;margin-bottom:10px">
							<tbody>
								<tr>
									<td>
										<div class="ticket-logo">
											<img src="<?php echo base_url(!empty($appSetting->logo)?$appSetting->logo:null) ?>"
												class="img-responsive" alt="">
										</div>
									</td>
									<td style="vertical-align:middle;">

									</td>
								</tr>
							</tbody>
						</table>
					</div>


					<div class="table-responsive">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td><strong><?php echo display('pickup_location') ?>:</strong>
										<?php echo (!empty($value->pickup_trip_location)?$value->pickup_trip_location:null) ?>
									</td>
									<td><strong><?php echo display('drop_location') ?>:</strong>
										<?php echo (!empty($value->drop_trip_location)?$value->drop_trip_location:null) ?>
									</td>
									<td><strong><?php echo display('date') ?>:</strong>
										<?php echo (!empty($value->booking_date)?$value->booking_date:null) ?></td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="passanger-info table-responsive">
						<div class="col-sm-12">
							<table width="100%">
								<tr>
									<td>
										<ul class="list-unstyled">
											<li>
												<strong><?php echo display('booking_id') ?> :</strong>
												<?php echo (!empty($value->booking_code)?$value->booking_code:null) ?>
											</li>
											<li>
												<strong>Pemesan :</strong>
												<?php echo (!empty($value->booker)?$value->booker:null) ?>
											</li>
											<li>
												<strong><?php echo display('phone') ?> :</strong>
												<?php echo (!empty($appSetting->phone)?$appSetting->phone:null) ?>
											</li>
									</td>
                                    <td>  
                                        <dl class="list-unstyled text-right">
                                             <li>
                                                <strong>Total Harga :</strong>
                                                <?php echo (!empty($value->total_price)?$value->total_price:null) ?>
                                            </li>
                                            <li>
												<strong><?php echo display('payment_status');?> :</strong>
												<?php $payment=$value->ps;
                                                    if($payment == 1){
                                                        echo display('paid');
                                                    }elseif($payment == 2){
                                                        echo display('cancel');
                                                    }else{
                                                        echo display('unpaid');
                                                    }
                                                ?>
											</li>
                                        </dl>
                                    </td>
								</tr>
							</table>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<div class="table-responsive">
								<table class="table table-bordered">
									<?php foreach ($value->ticket as $key => $tickvalue) { ?>
									<thead>
										<tr>
											<th>Nama</th>
											<th>Phone</th>
											<th>Seat</th>
											<th>Makanan</th>
											<th>Bagasi</th>
											<th>Harga</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<?php echo (!empty($tickvalue->name)?(str_replace(',', ', ', $tickvalue->name)):null) ?>
											</td>
											<td>
												<?php echo (!empty($tickvalue->phone)?(str_replace(',', ', ', $tickvalue->phone)):null) ?>
											</td>
											<td>
												<?php echo (!empty($tickvalue->seat_number)?(str_replace(',', ', ', $tickvalue->seat_number)):null) ?>
											</td>
											<td>
												<?php echo (!empty($tickvalue->makanan)?(str_replace(',', ', ', $tickvalue->makanan)):null) ?>
											</td>
											<td>
												<?php echo (!empty($tickvalue->baggage)?($tickvalue->baggage == 1?"Bawa":"Tidak Bawa"):null) ?>
											</td>
                                            <td>
                                            <?php echo (!empty($tickvalue->price)?(str_replace(',', ', ', $tickvalue->price)):null) ?>
											</td>
										</tr>

									</tbody>
									<?php } ?>
								</table>

								<table class="table table-responsive">
									<tbody>
										<tr>
											<td class="small"> ** This is computer generated copy. No signature
												required.</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
