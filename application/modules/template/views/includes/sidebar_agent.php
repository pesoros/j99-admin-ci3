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

		<?php if ($this->session->userdata('cashpay') == 1) { ?>
			<li class="treeview <?php echo (($this->uri->segment(2)=="manifest")?"active":null) ?>">
				<a href="#">
					<i class="fa fa-flag"></i><span>Manifest</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url('manifest/manifest_controller/create_manifest') ?>">List Manifest</a>
					</li>
				</ul>
			</li>
		<? } ?>

		<li class="treeview">

			<a href="javascript:void(0)">
				<i class="fa fa-ticket"></i> <span><?php echo display('ticket')?></span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>

			<ul class="treeview-menu">

				<!-- <li class="">
					<a href="#"><?php echo display('passenger')?> <span class="pull-right-container"><i
								class="fa fa-angle-left pull-right"></i></span>
					</a>
					<ul class="treeview-menu ">
						<li class=""><a href="<?php echo base_url('') ?>ticket/passenger/form"><?php echo display('add')?></a>
						</li>
						<li class=""><a href="<?php echo base_url('') ?>ticket/passenger/index"><?php echo display('list')?></a>
						</li>

					</ul>
				</li> -->

				<li class="">
					<a href="#"><?php echo display('booking')?> <span class="pull-right-container"><i
								class="fa fa-angle-left pull-right"></i></span>
					</a>
					<ul class="treeview-menu ">
						<li class=""><a href="<?php echo base_url('') ?>ticket/booking/form"><?php echo display('add')?></a></li>
						<li class=""><a href="<?php echo base_url('') ?>ticket/booking/index"><?php echo display('list')?></a></li>

					</ul>
				</li>

				<li class="">
					<a href="#"><?php echo display('refund')?> <span class="pull-right-container"><i
								class="fa fa-angle-left pull-right"></i></span>
					</a>
					<ul class="treeview-menu ">
						<li class=""><a href="<?php echo base_url('') ?>ticket/refund/form"><?php echo display('add')?></a></li>
						<li class=""><a href="<?php echo base_url('') ?>ticket/refund/index"><?php echo display('list')?></a></li>

					</ul>
				</li>
				
			</ul>
		</li>

		<li class="treeview">
			<a href="<?php echo base_url('agent/agent_controller/agent_ledger/'.$this->session->userdata('id')); ?>"><i class="ti-home"></i>
				<span>Laporan</span>
			</a>
		</li>

	</ul>
</div> <!-- /.sidebar -->
