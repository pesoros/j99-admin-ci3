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

		<li class="treeview <?php echo (($this->uri->segment(2)=="resto")?"active":null) ?>">
			<a href="#">
				<i class="fa fa-cutlery"></i><span>Resto</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li><a href="<?php echo base_url('resto/resto_controller/create_resto') ?>">List Resto</a></li>
			</ul>
		</li>

		<li class="treeview <?php echo (($this->uri->segment(2)=="website")?"active":null) ?>">
			<a href="#">
				<i class="fa fa-globe"></i><span>CMS</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li><a href="<?php echo base_url('cms/cms/home') ?>">Home Text</a></li>
				<li><a href="<?php echo base_url('cms/cms/footer') ?>">Footer</a></li>
				<li><a href="<?php echo base_url('cms/cms/facilities') ?>">Fasilitas</a></li>
				<li><a href="<?php echo base_url('cms/cms/sosmed') ?>">Sosial Media</a></li>
				<li><a href="<?php echo base_url('cms/cms/pointtext') ?>">Point Text</a></li>
			</ul>
		</li>

		<?php if($this->uri->segment(2) !=='User'){?>



		<!-- *************************************
        **********STATS OF CUSTOM MODULES*********
        ************************************* -->
		<?php  
        $path = 'application/modules/';
        $map  = directory_map($path);


        $HmvcMenu   = array();
        if (is_array($map) && sizeof($map) > 0)
        foreach ($map as $key => $value) {
            $menu = str_replace("\\", '/', $path.$key.'config/menu.php');

            if (file_exists($menu)) {
                @include($menu);
            }  
        }   


        if(isset($HmvcMenu) && $HmvcMenu!=null && sizeof($HmvcMenu) > 0)

        foreach ($HmvcMenu as $moduleName => $moduleData) {

            // check module permission 
            if (file_exists(APPPATH.'modules/'.$moduleName.'/assets/data/env'))
            if ($this->permission->module($moduleName)->access()) {

            $this->permission->module($moduleName)->access();
            if ($moduleName == 'website') {
                continue;
            }
        ?>

		<li class="treeview <?php echo (($this->uri->segment(1)==$moduleName)?"active":null) ?>">

			<a href="javascript:void(0)">
				<?php echo (($moduleData['icon']!=null)?$moduleData['icon']:null) ?>
				<span><?php echo display($moduleName) ?></span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
 
			<ul class="treeview-menu">
				<?php foreach ($moduleData as $groupLabel => $label) {?>
				<?php   
                            if ($groupLabel!='icon') 

                            if ((isset($label['controller']) && $label['controller']!=null) && ($label['method']!=null)) {

                               if($this->permission->check_label($groupLabel)->access()){
                                //if ($this->permission->method($moduleName,$label['permission'])->access()) {  
                
                            ?>
				<!-- single level menu/link -->
				<li
					class="<?php echo (($this->uri->segment(1)==$moduleName && $this->uri->segment(2)==$label['controller'])?"active":null) ?>">
					<a
						href="<?php echo base_url($moduleName."/".$label['controller']."/".$label['method']) ?>"><?php echo display($groupLabel) ?></a>
				</li>

				<?php 
                                } 

                            } else { 
                         
                            ?>

				<!-- multilevel menu/link -->
				<!-- extract $label to compare with segment -->
				<?php 
                            if($this->permission->check_label($groupLabel)->access()){
                            
                            foreach ($label as $url) 
                               
                            ?>
				<li class="<?php echo (($this->uri->segment(2)==$url['controller'])?"active":null) ?>">
					<a href="#"><?php echo display($groupLabel) ?>
						<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
					</a>
					<ul
						class="treeview-menu <?php echo (($this->uri->segment(2)==$url['controller'])?"menu-open":null) ?>">
						<?php 
                                        foreach ($label as $name => $value) {

                                            if($this->permission->check_label($name)->access()){
                                            // if ($this->permission->method($moduleName,$value['permission'])->access()) {  
                                            ?>
						<li class="<?php echo (($this->uri->segment(3)==$value['method'])?"active":null) ?>"><a
								href="<?php echo base_url($moduleName."/".$value['controller']."/".$value['method']) ?>">
								<?php echo (($value['method'] == 'akumulasi') ? 'Akumulasi' : display($name)) ?></a>
						</li>
						<?php 
                                            } //endif
                                        } //endforeach
                                        ?>
					</ul>
				</li>
				<?php } ?>

				<!-- endif -->
				<?php } ?>
				<!-- endforeach -->
				<?php } ?>
			</ul>
		</li>
		<!-- end if -->
		<?php } ?>
		<!-- end foreach -->
		<?php } ?>
		<!-- *************************************
        **********ENDS OF CUSTOM MODULES*********
        ************************************* -->

		<li class="header">Default </li>

		<?php if($this->session->userdata('isAdmin')) { ?>
		<li class="treeview <?php echo (($this->uri->segment(2)=="user")?"active":null) ?>">
			<a href="#">
				<i class="ti-user"></i><span><?php echo display('user')?></span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li><a href="<?php echo base_url('dashboard/user/form') ?>"><?php echo display('add_user')?></a></li>
				<li><a href="<?php echo base_url('dashboard/user/index') ?>"><?php echo display('user_list')?></a></li>
			</ul>
		</li>
		<!--     <li class="treeview <?php echo (($this->uri->segment(2)=="module")?"active":null) ?>">
            <a href="#">
                <i class="pe-7s-box2"></i><span><?php echo display('module')?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo base_url('dashboard/module/install') ?>"><?php echo display('add_module')?></a></li>
                <li><a href="<?php echo base_url('dashboard/module/index') ?>"><?php echo display('module_list')?></a></li> 
            </ul>
        </li> -->

		<li class="treeview <?php echo (($this->uri->segment(2)=="role")?"active":null) ?>">
			<a href="#">

				<i class="ti-lock"></i><span><?php echo display('module_permission')?></span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li><a
						href="<?php echo base_url('dashboard/permission_setup') ?>"><?php echo display('module_permission')?></a>
				</li>
				<li><a
						href="<?php echo base_url('dashboard/role/create_system_role') ?>"><?php echo display('add')?></a>
				</li>
				<li><a href="<?php echo base_url('dashboard/role/role_list') ?>"><?php echo display('list')?></a></li>
				<li><a
						href="<?php echo base_url('dashboard/role/user_access_role') ?>"><?php echo display('user_permission')?></a>
				</li>
				<!--  <li><a href="<?php echo base_url('dashboard/module_permission/create') ?>"><?php echo display('add_module_permission')?></a></li>
                <li><a href="<?php echo base_url('dashboard/module_permission/index') ?>"><?php echo display('module_permission_list')?></a></li>  -->
			</ul>
		</li>

		<!-- <li class="treeview <?php echo (($this->uri->segment(2)=="language")?"active":null) ?>">
            <a href="<?php echo base_url('dashboard/language') ?>"><i class="ti-flag-alt"></i> <span><?php echo display('language')?></span> 
            </a>
        </li> -->

		<li class="treeview <?php echo (($this->uri->segment(2)=="backup_restore")?"active":null) ?>">
			<a href="<?php echo base_url('dashboard/backup_restore/index') ?>"><i class="fa fa-database"></i>
				<span><?php echo display('backup_and_restore') ?></span>
			</a>
		</li>

		<li class="treeview <?php echo (($this->uri->segment(2)=="setting")?"active":null) ?>">
			<a href="<?php echo base_url('dashboard/setting') ?>"><i class="ti-settings"></i>
				<span><?php echo display('application_setting')?></span>
			</a>
		</li>
		<?php } ?>
		<!-- ends of admin area -->



		<?php if($this->session->userdata('isLogIn')): ?>
		<!-- <li class="treeview <?php echo (($this->uri->segment(2)=="message")?"active":null) ?>">
            <a href="#">
                <i class="ti-comments"></i><span><?php echo display('message')?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo base_url('dashboard/message/new_message') ?>"><?php echo display('new')?></a></li>
                <li><a href="<?php echo base_url('dashboard/message/index') ?>"><?php echo display('inbox')?></a></li>
                <li><a href="<?php echo base_url('dashboard/message/sent') ?>"><?php echo display('sent')?></a></li> 
            </ul>
        </li>        -->
		<?php endif; ?>
		<?php } ?>

	</ul>
</div> <!-- /.sidebar -->
