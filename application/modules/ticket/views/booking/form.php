<div id="output" class="hide alert alert-danger"></div>

<div class="row">
	<div class="col-sm-12 col-md-12">
		<div class="panel panel-bd lobidrag">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						<a href="<?php echo base_url('ticket/booking/index') ?>" class="btn btn-sm btn-success"
							title="List"> <i class="fa fa-list"></i> <?php echo display('list') ?></a>
						<?php if($booking->id): ?>
						<a href="<?php echo base_url('ticket/booking/form') ?>" class="btn btn-sm btn-info"
							title="Add"><i class="fa fa-plus"></i> <?php echo display('add') ?></a>
						<?php endif; ?>
					</h4>
				</div>
			</div>
			<div class="panel-body">

				<?= form_open('ticket/booking/createBooking/', 'id="bookingFrm"') ?>


				<div class="form-group row">
					<label for="approximate_time" class="col-sm-3 col-form-label"><?php echo display('booking_date') ?>
						*</label>
					<div class="col-sm-9">
						<input name="approximate_time" class="findTripByRouteDate form-control datepicker" type="text"
							placeholder="<?php echo display('booking_date') ?>" id="approximate_time"
							value="">
					</div>
				</div>
				<div class="form-group row">
					<label for="dep_city" class="col-sm-3 col-form-label">Kota Berangkat *</label>
					<div class="col-sm-9">
						<?php echo form_dropdown('dep_city', $city_dropdown, (!empty($booking->route_id)?$booking->route_id:null), 'id="dep_city" class="searchbus form-control"') ?>
						<div id="typeHelpText"></div>
					</div>
				</div>

                <div class="form-group row">
					<label for="s" class="col-sm-3 col-form-label">Kota Tujuan *</label>
					<div class="col-sm-9">
						<?php echo form_dropdown('arr_city', $city_dropdown, (!empty($booking->route_id)?$booking->route_id:null), 'id="arr_city" class="searchbus form-control"') ?>
						<div id="typeHelpText"></div>
					</div>
				</div>

                <div class="form-group row">
                    <label for="choosebus" class="col-sm-3 col-form-label">Pilih Bus</label>
                    <div class="col-sm-9">
                        <select class="listbus form-control" name="choosebus" id="choosebus"></select> 
                    </div>
                </div>

                <div class="form-group row">
					<label for="jumpenumpang" class="col-sm-3 col-form-label">Jumlah Penumpang</label>
					<div class="col-sm-9">
						<input name="jumpenumpang" id="jumpenumpang" class="form-control seatno"
							placeholder="Jumlah Penumpang" autocomplete="off" type="number" />
					</div>
				</div>

                <section class="formpenumpang">

                </section>

                <div class="form-group text-right">
                        <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                        <button type="submit" class="btn btn-success w-md m-b-5 savebutton" disabled><?php echo display('save') ?></button>
                    </div>
                <?php echo form_close() ?>
		    </div>
		</div>
	</div>
</div>






<!-- ADD NEW PASSENGER -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><?php echo display('add_passenger') ?></h4>
			</div>
			<div class="modal-body">
				<div id="passengerMsg" class="alert hide"></div>

				<?= form_open_multipart('ticket/booking/newPassenger', array("id"=>"passengerFrm")) ?>

				<div class="form-group row">
					<label for="name" class="col-sm-3 col-form-label"><?php echo display('name') ?> *</label>
					<div class="col-sm-9">
						<div class="row">
							<div class="col-sm-6">
								<input name="firstname" class="form-control" type="text"
									placeholder="<?php echo display('firstname') ?>" id="name"
									value="<?php echo $passenger->firstname ?>">
							</div>
							<div class="col-sm-6">
								<input name="lastname" class="form-control" type="text"
									placeholder="<?php echo display('lastname') ?>"
									value="<?php echo $passenger->lastname ?>">
							</div>
						</div>
					</div>
				</div>

				<div class="form-group row">
					<label for="phone" class="col-sm-3 col-form-label"><?php echo display('phone') ?></label>
					<div class="col-sm-9">
						<input name="phone" class="form-control" type="text"
							placeholder="<?php echo display('phone') ?>" id="phone"
							value="<?php echo $passenger->phone ?>">
					</div>
				</div>

				<div class="form-group row">
					<label for="email" class="col-sm-3 col-form-label"><?php echo display('email') ?></label>
					<div class="col-sm-9">
						<input name="email" class="form-control" type="text"
							placeholder="<?php echo display('email') ?>" id="email"
							value="<?php echo $passenger->email ?>">
					</div>
				</div>


				<div class="form-group row">
					<label for="address_line_1"
						class="col-sm-3 col-form-label"><?php echo display('address_line_1') ?></label>
					<div class="col-sm-9">
						<input name="address_line_1" class="form-control" type="text"
							placeholder="<?php echo display('address_line_1') ?>" id="address_line_1"
							value="<?php echo $passenger->address_line_1 ?>">
					</div>
				</div>

				<div class="form-group row">
					<label for="address_line_2"
						class="col-sm-3 col-form-label"><?php echo display('address_line_2') ?></label>
					<div class="col-sm-9">
						<input name="address_line_2" class="form-control" type="text"
							placeholder="<?php echo display('address_line_2') ?>" id="address_line_2"
							value="<?php echo $passenger->address_line_2 ?>">
					</div>
				</div>

				<div class="form-group row">
					<label for="country" class="col-sm-3 col-form-label"><?php echo display('country') ?></label>
					<div class="col-sm-9">
						<?php echo form_dropdown('country', $country_dropdown, (!empty($passenger->country)?$passenger->country:"BD"), ' class="form-control" id="country" style="width:100%"') ?>
					</div>
				</div>

				<div class="form-group row">
					<label for="city" class="col-sm-3 col-form-label"><?php echo display('city') ?></label>
					<div class="col-sm-9">
						<input name="city" class="form-control" type="text" placeholder="<?php echo display('city') ?>"
							id="city" value="<?php echo $passenger->city ?>">
					</div>
				</div>

				<div class="form-group row">
					<label for="zip_code" class="col-sm-3 col-form-label"><?php echo display('zip_code') ?></label>
					<div class="col-sm-9">
						<input name="zip_code" class="form-control" type="text"
							placeholder="<?php echo display('zip_code') ?>" id="zip_code"
							value="<?php echo $passenger->zip_code ?>">
					</div>
				</div>


				<div class="form-group text-right">
					<button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
					<button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
				</div>

				<?php echo form_close() ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">
    let foodMenu = []
    let seatList = []
    let booking_date = ''
	$(document).ready(function () {

        $(".searchbus").change(function () {
            let departure = $("#dep_city").val()
            let arrive = $("#arr_city").val()
            let listbus   = $(".listbus");
            let isiselect = '';
            booking_date = $("#approximate_time").val()

            if (departure.length == 0 || arrive.length == 0) {
                return;
            } else {
                // console.log(departure,arrive)
                $.ajax({
                    method: 'POST',
                    url: "<?php echo getenv("API_URL"); ?>/listbus",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    contentType: 'application/x-www-form-urlencoded; charset=utf-8',
                    dataType: 'json',
                    data: {
                        'berangkat'  : departure, 
                        'tujuan'     : arrive,
                        'tanggal'    : booking_date
                    },
                    success: function(data) {
                        // console.log('ddd',data);
                        data.forEach(el => {
                            let idsel = el.trip_id_no +'-'+ el.trip_route_id + '-' + el.price + '-' + el.type + '-' + el.resto_id + '-' + el.pickup_trip_location + '-' + el.drop_trip_location
                            let descripsel = el.class + ' / ' + el.pickup_trip_location + ' - ' + el.drop_trip_location + ' / ' + el.start + ' / sisa kursi : ' + el.seatAvail + ' / ' + el.price 
                            isiselect += '<option value="">Please Select Bus</option>';
                            isiselect += '<option value="'+ idsel +'">'+ descripsel +'</option>';
                        });
                        listbus.empty().html(isiselect);
                    }, 
                    error: function(xhr) {
                        console.log('not found')
                    }
                });
            }
        });

        $("#choosebus").change(function (){
            let choosen = $("#choosebus").val()
            let choosenarr = choosen.split('-')
            let tripIdNo = choosenarr[0]
            let tripRouteId = choosenarr[1]
            let type = choosenarr[3]
            let idResto = choosenarr[4]

            $.ajax({
                method: 'POST',
                url: "<?php echo getenv("API_URL"); ?>/seatlist",
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                contentType: 'application/x-www-form-urlencoded; charset=utf-8',
                dataType: 'json',
                data: {
                    'trip_id_no'        : tripIdNo, 
                    'trip_route_id'     : tripRouteId,
                    'fleet_type_id'     : type,
                    'booking_date'      : booking_date
                },
                success: function(dataseat) {
                    seatList = dataseat;
                    console.log('ds',dataseat)
                }, 
                error: function(xhr) {
                    console.log('not found')
                }
            });

            $.ajax({
                method: 'POST',
                url: "<?php echo getenv("API_URL"); ?>/datarestomenu",
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                contentType: 'application/x-www-form-urlencoded; charset=utf-8',
                dataType: 'json',
                data: {
                    'idResto'  : idResto
                },
                success: function(datamenu) {
                    foodMenu = datamenu;
                }, 
                error: function(xhr) {
                    console.log('not found')
                }
            });
        });

        $("#jumpenumpang").on('keyup', function(){
            let jumpenumpang = $("#jumpenumpang").val()
            let formpenumpang   = $(".formpenumpang");
            let savebutton   = $(".savebutton");
            let formhtml = '';

            savebutton.prop('disabled', true)
            formpenumpang.empty()

            if (jumpenumpang == 0 || jumpenumpang > 4) {
                return;
            } else {
                for (let index = 0; index < jumpenumpang; index++) {
                    indexing = index + 1
                    formhtml += '<hr><h3>Penumpang '+indexing+'</h3>'

                    formhtml += '<div class="form-group row"><label for="name" class="col-sm-3 col-form-label">Nama Lengkap</label><div class="col-sm-9">'
					formhtml += '<input name="name['+ index +']" class="form-control" type="text" placeholder="Nama Lengkap" id="nama" value="">'
                    formhtml += '</div> </div>'

                    formhtml += '<div class="form-group row"><label for="phone" class="col-sm-3 col-form-label">Phone</label><div class="col-sm-9">'
					formhtml += '<input name="phone['+ index +']" class="form-control" type="text" placeholder="Phone" id="nama" value="">'
                    formhtml += '</div> </div>'

                    formhtml += '<div class="form-group row"><label for="baggage" class="col-sm-3 col-form-label">Bagasi</label><div class="col-sm-9">'
                    formhtml += '<select class="listbus form-control" name="baggage['+ index +']" id="baggage">'
                    formhtml += '<option value="">Please Select Bagagge</option>' 
                    formhtml += '<option value="1">Bawa</option>'
                    formhtml += '<option value="2">Tidak Bawa</option>'
                    formhtml += '</select>'
                    formhtml += '</div> </div>'

                    formhtml += '<div class="form-group row"><label for="food" class="col-sm-3 col-form-label">Menu Makanan</label><div class="col-sm-9">'
                    formhtml += '<select class="listbus form-control" name="food['+ index +']" id="food">'
                    formhtml += '<option value="">Please Select Makanan</option>'
                    foodMenu.forEach(element => {
                        formhtml += '<option value="'+ element.id +'">'+ element.food_name +'</option>'
                    })
                    formhtml += '</select>'
                    formhtml += '</div> </div>'

                    formhtml += '<div class="form-group row"><label for="seat" class="col-sm-3 col-form-label">Pilih Kursi</label><div class="col-sm-9">'
                    formhtml += '<select class="listbus form-control" name="seat['+ index +']" id="seat">'
                    formhtml += '<option value="">Please Select Kursi</option>'
                    seatList.seats.forEach(element => {
                        console.log(element.isAvailable.toString())
                        if (element.isAvailable.toString() === 'false') {
                            formhtml += '<option value="'+ element.name +'" disabled>'+ element.name +'</option>'
                        } else {
                            formhtml += '<option value="'+ element.name +'" >'+ element.name +'</option>'
                        }
                    })
                    formhtml += '</select>'
                    formhtml += '</div> </div>'
                }
                formpenumpang.html(formhtml);
                savebutton.prop('disabled', false);
            }
        });

	});

</script>
