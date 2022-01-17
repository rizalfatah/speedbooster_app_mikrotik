<?php
$PageTitle = "Speedbooster - ILC";
require_once __DIR__ . '/vendor/autoload.php';

include_once(__DIR__ . '/config.php');
include_once(__DIR__ . '/functions.php');
include_once(__DIR__ . '/template/header.php');
?>

<div class="container">

    <?php
    // die();
    ?>

    <h3 class="text-center mt-3  mb-5 fs-3">APLIKASI SPEEDBOOSTER</h3>

    <div class="row">
        <div>
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

                    <div class="mt-2 alert alert-info" role="alert">
                        <div class="row">
                            <?php
                            if (isset($_POST['submit'])) {
                                $account = getDetailDataVoucher($_POST['usernameAccount']);
                                if (!is_null($account)) {        ?>

                                    <!-- tampil data voucher -->
                                    <h4> Username : <?= $account['user'] ?> </h4>
                                    <h4> IP ADDRESS : <?= $account['address'] ?> </h4>
                                    <h4> NAMA PERANGKAT : <?= getHostnameClient($account['mac-address'])  ?> </h4>
                            <?php
                                } else {
                                    echo 'tidak ditemukan';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- tampilkan data voucher yg dipilih -->
    </div>

    <div class="row mt-5 mb-5">
        <?php $listSpeedbooster = getQueue(); ?>

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

<?php include_once(__DIR__ . '/template/footer.php'); ?>