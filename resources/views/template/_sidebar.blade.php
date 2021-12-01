<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
	<ul class="app-menu">
		<li><a class="app-menu__item {{ Request::url() == route('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
		@if(Auth::user()->role == role('super-admin'))
		<!-- <li><a class="app-menu__item {{ strpos(Request::url(), '/admin/pengaturan') ? 'active' : '' }}" href="/admin/pengaturan"><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label">Pengaturan</span></a></li> -->
		@endif
		@if(Auth::user()->role == role('super-admin') || Auth::user()->role == role('admin') || Auth::user()->role == role('manager'))
		<li class="app-menu__submenu"><span class="app-menu__label">User</span></li>
			@if(Auth::user()->role == role('super-admin') || Auth::user()->role == role('admin'))
			<li><a class="app-menu__item {{ is_int(strpos(Request::fullUrl(), route('admin.user.index'))) && Request::query('role') == 'admin' ? 'active' : '' }}" href="{{ route('admin.user.index', ['role' => 'admin']) }}"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Admin</span></a></li>
			@endif
			@if(Auth::user()->role == role('super-admin') || Auth::user()->role == role('admin'))
			<li><a class="app-menu__item {{ is_int(strpos(Request::fullUrl(), route('admin.user.index'))) && Request::query('role') == 'manager' ? 'active' : '' }}" href="{{ route('admin.user.index', ['role' => 'manager']) }}"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Manager</span></a></li>
			@endif
			@if(Auth::user()->role == role('super-admin') || Auth::user()->role == role('admin') || Auth::user()->role == role('manager'))
			<li><a class="app-menu__item {{ is_int(strpos(Request::url(), route('admin.user.index'))) && Request::query('role') == 'member' ? 'active' : '' }}" href="{{ route('admin.user.index', ['role' => 'member']) }}"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Karyawan</span></a></li>
			@endif
		@endif
		@if(Auth::user()->role == role('super-admin') || Auth::user()->role == role('admin') || Auth::user()->role == role('manager'))
		<li class="app-menu__submenu"><span class="app-menu__label">Report</span></li>
		<li><a class="app-menu__item {{ is_int(strpos(Request::url(), route('admin.attendance.index'))) && !is_int(strpos(Request::url(), route('admin.attendance.summary'))) ? 'active' : '' }}" href="{{ route('admin.attendance.index') }}"><i class="app-menu__icon fa fa-clipboard"></i><span class="app-menu__label">Absensi</span></a></li>
		<li><a class="app-menu__item {{ is_int(strpos(Request::url(), route('admin.attendance.summary'))) ? 'active' : '' }}" href="{{ route('admin.attendance.summary') }}"><i class="app-menu__icon fa fa-clipboard"></i><span class="app-menu__label">Rekap Absensi</span></a></li>
		@endif
		@if(Auth::user()->role == role('super-admin') || Auth::user()->role == role('admin') || Auth::user()->role == role('manager'))
		<li class="app-menu__submenu"><span class="app-menu__label">Master</span></li>
			@if(Auth::user()->role == role('super-admin') || Auth::user()->role == role('admin'))
			<li><a class="app-menu__item {{ is_int(strpos(Request::url(), route('admin.group.index'))) ? 'active' : '' }}" href="{{ route('admin.group.index') }}"><i class="app-menu__icon fa fa-dot-circle-o"></i><span class="app-menu__label">Grup</span></a></li>
			@endif
			<li><a class="app-menu__item {{ is_int(strpos(Request::url(), route('admin.office.index'))) ? 'active' : '' }}" href="{{ route('admin.office.index') }}"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Kantor</span></a></li>
			<li><a class="app-menu__item {{ is_int(strpos(Request::url(), route('admin.position.index'))) ? 'active' : '' }}" href="{{ route('admin.position.index') }}"><i class="app-menu__icon fa fa-refresh"></i><span class="app-menu__label">Jabatan</span></a></li>
			<li><a class="app-menu__item {{ is_int(strpos(Request::url(), route('admin.work-hour.index'))) ? 'active' : '' }}" href="{{ route('admin.work-hour.index') }}"><i class="app-menu__icon fa fa-clock-o"></i><span class="app-menu__label">Jam Kerja</span></a></li>
			<li><a class="app-menu__item {{ is_int(strpos(Request::url(), route('admin.salary-category.index'))) ? 'active' : '' }}" href="{{ route('admin.salary-category.index') }}"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">Kategori Penggajian</span></a></li>
		@endif
	</ul>
</aside>