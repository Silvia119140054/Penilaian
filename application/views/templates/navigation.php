<?php if (!isset($menu_name)) $menu_name = '';
if (!isset($role)) $role = $this->auth_model->current_user()->role;
if (!isset($userfullname)) $userfullname = $this->auth_model->current_user()->name;
if (!isset($userAvatar)) $userAvatar = $this->auth_model->current_user()->avatar;
if (!isset($notifikasis)) $notifikasis = [];

$user = $this->auth_model->current_user();
$notifikasis = $this->notifikasi_model->get_notifikasis_unseen_uid($user->id);

?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
	</ul>

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">

		<!-- Notifications Dropdown Menu -->
		<li class="nav-item dropdown">
			<a class="nav-link" data-toggle="dropdown" href="#">
				<i class="far fa-bell"></i>
				<span class="badge badge-warning navbar-badge">
					<?= count($notifikasis) ?>
				</span>
			</a>
			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<?php if (count($notifikasis) != 0) { ?>
					<span class="dropdown-item dropdown-header">
						<?= count($notifikasis) ?> Notifikasi
					</span>
				<?php } ?>
				<div class="dropdown-divider"></div>
				<?php foreach ($notifikasis as $notifikasi) { ?>
					<a href="<?= base_url('notifikasi/' . $notifikasi->id) ?>" class="dropdown-item" style="overflow: hidden">
						<!-- <i class="fas fa-envelope mr-2"></i> -->
						<?= $notifikasi->title ?>
						<span class="float-right text-muted text-sm">
							<?php if (!is_null($notifikasi->release_at)) { ?>
								<?= $notifikasi->release_at ?>
							<?php } ?>
						</span>
					</a>
				<?php } ?>
				<div class="dropdown-divider"></div>
				<a href="<?= base_url('notifikasi') ?>" class="dropdown-item dropdown-footer">Lihat semua notifikasi</a>
			</div>
		</li>

		<!-- Bantuan -->
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('bantuan') ?>">
				<i class="fas fa-question-circle mr-1"></i>
				<span>Bantuan</span>
			</a>
		</li>
	</ul>
</nav>
<!-- /.navbar -->

<?php if (!isset($menu_location)) $menu_location = '' ?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Sidebar -->
	<div class="sidebar">
	    <div class="d-flex justify-content-center pt-4 " >
			<img class="img p-2" style="width: 180px; height: 200px; object-fit: contain;" src="<?= base_url('storage/assets/logo.png'); ?>" alt="Profile">
		</div>
		<div class="user-panel mt-1 pb-1 mb-1 d-flex ">
		</div>
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
				<li class="nav-item">
					<a href="<?= base_url('beranda') ?>" class="nav-link <?php echo $menu_location == 'beranda' ? 'active' : '' ?>">
						<i class="nav-icon fas fa-home"></i>
						<p>Beranda</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('penilaian') ?>" class="nav-link  <?php echo $menu_location == 'penilaian' ? 'active' : '' ?> ">
						<i class="nav-icon fas fa-user-check"></i>
						<p>Penilaian</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('/riwayat') ?>" class="nav-link  <?php echo $menu_location == 'riwayat' ? 'active' : '' ?> ">
						<i class="nav-icon fas fa-history"></i>
						<p>Riwayat</p>
					</a>
				</li>
				<?php if ($role === 'admin') { ?>
					<li class="nav-header">
						Admin
					</li>
					<li class="nav-item">
						<a href="<?= base_url('admin/dashboard') ?>" class="nav-link  <?php echo $menu_location == 'dashboard_admin' ? 'active' : '' ?> ">
							<i class="fas fa-tachometer-alt nav-icon"></i>
							<p>Dashboard Admin</p>
						</a>
					</li>
					<!-- pengaturan organisasi -->
					<li class="nav-item <?php echo $menu_location == 'dinas_jabatan' || $menu_location == 'pengaturan_pegawai' ? 'menu-open' : '' ?>">
						<a href="#" class="nav-link">
							<i class="nav-icon fas fa-building"></i>
							<p>
								Pengaturan Organisasi
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('dinas_jabatan') ?>" class="pl-4 nav-link  <?php echo $menu_location == 'dinas_jabatan' ? 'active' : '' ?> ">
									<i class="nav-icon fas fa-user-tag"></i>
									<p>Dinas dan Jabatan</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('pegawai') ?>" class="pl-4 nav-link  <?php echo $menu_location == 'pengaturan_pegawai' ? 'active' : '' ?> ">
									<i class="nav-icon fas fa-user-tie"></i>
									<p>Pegawai</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item <?php echo $menu_location == 'pengaturan_faktor' || $menu_location == 'pengaturan_jadwal' ? 'menu-open' : '' ?>">
						<a href="#" class="nav-link"> <i class="nav-icon fas fa-calculator"></i>
							<p>
								Pengaturan Penilaian
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('faktor') ?>" class="pl-4 nav-link  <?php echo $menu_location == 'pengaturan_faktor' ? 'active' : '' ?> ">
									<i class="nav-icon fas fa-clipboard"></i>
									<p>Faktor Penilaian</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('jadwal') ?>" class="pl-4 nav-link  <?php echo $menu_location == 'pengaturan_jadwal' ? 'active' : '' ?> ">
									<i class="nav-icon fas fa-calendar"></i>
									<p>Jadwal Penilaian</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('pengaturan_notifikasi') ?>" class="nav-link  <?php echo $menu_location == 'pengaturan_notifikasi' ? 'active' : '' ?> ">
							<i class="nav-icon fas fa-bell"></i>
							<p>Pengaturan Notifikasi</p>
						</a>
					</li>
				<?php } ?>
				<li class="nav-header">Aplikasi</li>
				<li class="nav-item">
					<a href="<?= base_url('profil') ?>" class="nav-link  <?php echo $menu_location == 'profil' ? 'active' : '' ?> ">
						<i class="nav-icon fas fa-user"></i>
						<p>Profil</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('tentang') ?>" class="nav-link  <?php echo $menu_location == 'tentang' ? 'active' : '' ?> ">
						<i class="nav-icon fas fa-info-circle"></i>
						<p>Tentang</p>
					</a>
				</li>
				<li class="nav-item">
					<a type="button" href="#" class="nav-link" data-toggle="modal" data-target="#modal-keluar">
						<i class="nav-icon fas fa-sign-out-alt"></i>
						<p>Keluar</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>

<!-- Main Sidebar Container -->

<div class="modal fade" id="modal-keluar">
	<div class="modal-dialog">
		<div class="modal-content  ">
			<div class="modal-body">
				<p>Anda yakin ingin keluar?</p>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-sm btn-outline-light" data-dismiss="modal">Tutup</button>

				<a class="btn btn-sm btn-danger" href="<?= base_url('logout') ?>" type="submit">
					<i class="nav-icon fas fa-sign-out-alt"></i>

					Keluar
				</a>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
