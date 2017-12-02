 <aside class="main-sidebar" id="sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
        <h4><a href="{{ route('profile') }}">{{ auth()->user()->name }}</a></h4>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu</li>
          <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> <span>{{ trans('translate.home') }}</span></a></li>
          <li><a href="{{ route('pages') }}"><i class="fa fa-files-o"></i> <span>{{ trans('translate.pages') }}</span></a></li>
          <li><a href="{{ route('sliders') }}"><i class="fa fa-camera-retro"></i> <span>{{ trans('translate.sliders') }}</span></a></li>
          <li><a href="{{ route('users') }}"><i class="fa fa-users"></i> <span>{{ trans('translate.users') }}</span></a></li>
          <li><a href="{{ route('profile') }}"><i class="fa fa-id-card-o"></i> <span>{{ trans('translate.profile') }}</span></a></li>
          <li><a href="{{ route('settings') }}"><i class="fa fa-bar-chart"></i><span>Settings</span></a></li>
          <li><a href="{{ route('modules') }}"><i class="fa fa-check"></i><span>Modules</span></a></li>
          <?php $modules = CMS\admin\Module::where('is_installed', 1)->where('sidebar', '!=', null)->get(); ?>
          @if ($modules) 
            @foreach ($modules as $module)
              <li><a href="{{ route('module-link', [$module]) }}"><i class="fa fa-check"></i><span><?= ucfirst($module->sidebar);?></span></a></li>
            @endforeach  
          @endif
        </li>
		@if (auth()->user()->is_admin)
        <li class="header"></li>
        <li><a href="{{ route('sitemap') }}"><i class="fa fa-sitemap"></i><span>Sitemap</span></a></li>
	@endif

        <li class="header"></li>
        <li><a href="{{ route('logout') }}"><i class="fa fa-circle-o text-red"></i><span>{{ trans('translate.logout') }}</span></a></li>
        <!-- text-yellow
        text-aqua -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
