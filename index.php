<?php
$pageTitle = "Speedbooster - ILC";
include_once(__DIR__ . '/init.php');
include_once(__DIR__ . '/template/header.php');

use App\Mikrotik;
use App\Unifi;

$unifi = new Unifi();
$mikrotik = new Mikrotik(IP_STORE['merapi']);
?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">


  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <!-- <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li> -->
    <li>
      <a href="#" class="nav-link">APLIKASI SPEEDBOOSTER</a>
    </li>

  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="assets/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-wight fs-5">Internet Learning Cafe</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="assets/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">BARISTA NEXT LEVEL YEAH</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">EXAMPLES</li>
        <li class="nav-item">
          <a href="pages/calendar.html" class="nav-link">
            <i class="nav-icon far fa-calendar-alt"></i>
            <p>
              Calendar
              <span class="badge badge-info right">2</span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/gallery.html" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              Gallery
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm">
          <h1 class="text-center m-0">Internet Learning Cafe <?= STORE ?></h1>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->


  <!-- Main content -->
  <section class="content pt-3">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3> <?= $mikrotik->getListSpeedboosterAllStore() ?> </h3>
              <p>Speedbooster Aktiv di semua Store</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3> <?= $mikrotik->getCountQueueSpeedbooster() ?> </h3>
              <p>Spedbooster Aktiv ILC Ambarukmo</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            Penambahan Service Speedbooster
          </div>
          <div class="card-body">
            <form class="" action="" method="POST">
              <div class="mb-2">
                <label for="username" class="form-label">Masukan username akun voucher</label>
                <input type="text" id="username" class="form-control" name="usernameAccount" value="<?= (isset($_POST['usernameAccount']) ? $_POST['usernameAccount'] : '')   ?>" required>
              </div>
              <button type="submit" name="submit" class="btn btn-primary">Cek</button>
            </form>





            <?php
            if (isset($_POST['submit'])) {
              $account = $mikrotik->getDetailDataVoucher($_POST['usernameAccount']);
              if (!is_null($account)) {        ?>
                <div class="mt-2 alert alert-info" role="alert">
                  <!-- tampil data voucher -->
                  <h5> Username : <?= $account['user'] ?> </h5>
                  <h5> IP Address : <?= $account['address'] ?> </h5>
                  <h5> Nama Perangkat : <?= $unifi->getHostnameClient($account['mac-address'])  ?> </h5>
                </div>
            <?php
              } else {
                echo 'tidak ditemukan';
              }
            }
            ?>

          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <?php $listSpeedbooster = $mikrotik->getQueueSpeedbooster(); ?>

        <div>
          <div class="card">
            <div class="card-header">
              Daftar IP speedbooster
            </div>
            <div class="card-body">
              <table class="table">
                <?php if ($listSpeedbooster == null) : ?>
                  <h3>Tidak ada customer speedbooster</h3>
                <?php else : ?>
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">IP Address</th>
                      <th scope="col">Speed Internet</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 0  ?>
                    <?php foreach ($listSpeedbooster as $data) : ?>
                      <?php $i++ ?>
                      <tr>
                        <th scope="row"><?= $i ?></th>
                        <td><?= $data['target'] ?></td>
                        <td><?= $data['max-limit'] ?></td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                <?php endif ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>




    <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>

<!-- 
<div class="container">
    
</div> -->

<?php include_once(__DIR__ . '/template/footer.php'); ?>