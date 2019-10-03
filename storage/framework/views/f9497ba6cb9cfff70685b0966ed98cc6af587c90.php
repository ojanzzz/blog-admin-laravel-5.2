  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand light" href="<?php echo e(url('admin')); ?>">Administrator</a>
        <ul class="user-menu">
          <li class="dropdown pull-right">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
            <?php if(Auth::guard('admin')->check()): ?>
            <?php echo e($role->name); ?>

            <?php endif; ?><span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="<?php echo e(url('admin/password')); ?>"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Change Password</a></li>
              <li><a href="<?php echo e(url('admin/logout')); ?>"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>

    </div><!-- /.container-fluid -->
  </nav>

  <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
  <div class="sidebar-header">
    <p>Panel Administrasi</p>
  </div>
  <div class="sidebar-logo">
    <img width="200" src="<?php echo e(asset('assets/landing/logo_bima.png')); ?>">
  </div>
    <!-- <img src="<?php echo e(asset('assets/landing/kuliner-bima.jpeg')); ?>"> -->
    <ul class="nav menu">
      <li class="<?php echo e(Request::is('admin') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin')); ?>"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>

      <?php /* <li class="parent">
        <a data-toggle="collapse" href="#sub-item-1" class="parent-item">
          <span><svg class="glyph stroked table"><use xlink:href="#stroked-table"/></svg></span> Data
        </a>
        <ul class="children collapse sub-item-id" id="sub-item-1">
          <li class="sub-item <?php echo e(Request::is('admin/data-pendaftar') ? 'active' : ''); ?>">
            <a href="<?php echo e(url('admin/data-pendaftar')); ?>"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Pendaftar</a>
          </li>
          <li class="sub-item <?php echo e(Request::is('admin/data-siswa') || Request::is('admin/data-siswa/*') ? 'active' : ''); ?>">
            <a href="<?php echo e(url('admin/data-siswa')); ?>"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg> Siswa</a>
          </li>
          <li class="sub-item <?php echo e(Request::is('admin/data-guru') || Request::is('admin/data-guru/*') ? 'active' : ''); ?>">
            <a href="<?php echo e(url('admin/data-guru')); ?>"><svg class="glyph stroked female user"><use xlink:href="#stroked-female-user"/></svg> Guru</a>
          </li>
          <li class="sub-item <?php echo e(Request::is('admin/lesson') || Request::is('admin/lesson-edit/*') ? 'active' : ''); ?>">
            <a href="<?php echo e(url('admin/lesson')); ?>"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Pelajaran</a>
          </li>
          <li class="sub-item <?php echo e(Request::is('admin/kelas') || Request::is('admin/kelas-edit/*') ? 'active' : ''); ?>">
            <a href="<?php echo e(url('admin/kelas')); ?>"><svg class="glyph stroked key "><use xlink:href="#stroked-key"/></svg> Kelas</a>
          </li>
          <li class="sub-item <?php echo e(Request::is('admin/schedule') || Request::is('admin/schedule-edit/*') ? 'active' : ''); ?>">
            <a href="<?php echo e(url('admin/schedule')); ?>"><svg class="glyph stroked clock"><use xlink:href="#stroked-clock"/></svg> Jadwal</a>
          </li>
          <li class="sub-item <?php echo e(Request::is('admin/data-alumni') || Request::is('admin/data-alumni/*') ? 'active' : ''); ?>">
            <a href="<?php echo e(url('admin/data-alumni')); ?>"><svg class="glyph stroked female user"><use xlink:href="#stroked-female-user"/></svg> Alumni</a>
          </li>
          
        </ul>
      </li>

      <li class="<?php echo e(Request::is('admin/halaman') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/halaman')); ?>"><svg class="glyph stroked blank document"><use xlink:href="#stroked-blank-document"/></svg> Halaman</a></li> */ ?>

      <?php /* <li class="<?php echo e(Request::is('admin/mbojo') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/mbojo')); ?>"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Artikel</a></li> */ ?>

      <?php /* <li class="<?php echo e(Request::is('admin/galeri') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/galeri')); ?>"><svg class="glyph stroked landscape"><use xlink:href="#stroked-landscape"/></svg> Galeri</a></li>

      <li class="<?php echo e(Request::is('admin/prestasi') || Request::is('admin/prestasi-edit/*') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/prestasi')); ?>"><svg class="glyph stroked notepad"><use xlink:href="#stroked-notepad"/></svg> Prestasi</a></li>

      <li class="<?php echo e(Request::is('admin/arsip') || Request::is('admin/arsip-edit/*') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/arsip')); ?>"><svg class="glyph stroked notepad"><use xlink:href="#stroked-notepad"/></svg> Arsip</a></li>

      <li class="<?php echo e(Request::is('admin/inbox') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/inbox')); ?>"><svg class="glyph stroked email"><use xlink:href="#stroked-email"/></svg> Inbox</a></li> */ ?>


    </ul>
  </div><!--/.sidebar-->
