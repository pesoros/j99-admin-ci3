<div class="sidebar">
	<!-- Sidebar user panel -->
	<?php if($this->uri->segment(2) !=='User'){?>
	<div class="user-panel text-center">
		<div class="image">
			<?php $image = $this->session->userdata('image') ?>
			<img src="<?php echo base_url((!empty($image)?$image:'assets/img/icons/default.jpg')) ?>" class="img-circle"
				alt="User Image">
		</div>
		<div class="info">
			<p><?php echo $this->session->userdata('fullname') ?></p>
			<a href="#"><i class="fa fa-circle text-success"></i>
				<?php echo $this->session->userdata('user_level') ?></a>
		</div>
	</div>
	<?php } ?>



	<!-- sidebar menu -->
	<ul class="sidebar-menu">
		<li
			class="treeview <?php echo (($this->uri->segment(2)=="home" || $this->uri->segment(2)=="")?"active":null) ?>">
			<a href="<?php echo base_url('dashboard/home') ?>"><i class="ti-home"></i>
				<span><?php echo display('dashboard')?></span>
			</a>
		</li>
		<li class="treeview <?php echo (($this->uri->segment(2)=="paket")?"active":null) ?>">
			<a href="#">
				<i class="fa fa-archive"></i><span>Paket</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li><a href="<?php echo base_url('paket/paket_controller/create_paket') ?>">List Paket</a></li>
			</ul>
		</li>

		<li class="treeview">

			<a href="javascript:void(0)">
				<i class="fa fa-ticket"></i> <span>Ticket Management</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>

			<ul class="treeview-menu">

				<li class="">
					<a href="#">Passenger <span class="pull-right-container"><i
								class="fa fa-angle-left pull-right"></i></span>
					</a>
					<ul class="treeview-menu ">
						<li class=""><a href="<?php echo base_url('') ?>/j99-admin-ci3/ticket/passenger/form">Add Passenger</a>
						</li>
						<li class=""><a href="<?php echo base_url('') ?>/j99-admin-ci3/ticket/passenger/index">Passenger List</a>
						</li>

					</ul>
				</li>

				<li class="">
					<a href="#">Booking Information <span class="pull-right-container"><i
								class="fa fa-angle-left pull-right"></i></span>
					</a>
					<ul class="treeview-menu ">
						<li class=""><a href="<?php echo base_url('') ?>/j99-admin-ci3/ticket/booking/form">Add Booking</a></li>
						<li class=""><a href="<?php echo base_url('') ?>/j99-admin-ci3/ticket/booking/index">Booking List</a></li>

					</ul>
				</li>

				<li class="">
					<a href="#">Refund <span class="pull-right-container"><i
								class="fa fa-angle-left pull-right"></i></span>
					</a>
					<ul class="treeview-menu ">
						<li class=""><a href="<?php echo base_url('') ?>/j99-admin-ci3/ticket/refund/form">Add Refund</a></li>
						<li class=""><a href="<?php echo base_url('') ?>/j99-admin-ci3/ticket/refund/index">Refund List</a></li>

					</ul>
				</li>
				
			</ul>
		</li>

		<li class="treeview">
			<a href="<?php echo base_url('agent/agent_controller/agent_ledger/'.$this->session->userdata('id')); ?>"><i class="ti-home"></i>
				<span>Report</span>
			</a>
		</li>

	</ul>
</div> <!-- /.sidebar -->
