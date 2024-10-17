<?php
require_once('../layouts/header.php');
require_once __DIR__ . '/../../models/Doctor.php';

$doctorModel = new Doctor();
$doctors = $doctorModel->getAll();
?>
<div class="container">

    <h1 class="mx-3 my-5">Doctors</h1>
    <section class="content m-3">
        <div class="container-fluid">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th class="">Name</th>
                                <th class="">About</th>
                                <th class="">Photo</th>
                                <th class="">Status</th>
                                <!-- <th class="text-center" style="width: 200px">Options</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($doctors as $c) {
                            ?>
                                <tr>
                                    <td> <?= $c['id'] ?? ""; ?> </td>
                                    <td> <?= $c['name'] ?? ""; ?> </td>
                                    <td> <?= $c['about'] ?? ""; ?> </td>
                                    <td>
                                        <?php if (isset($c['photo']) || !empty($c['photo'])) : ?>
                                            <img src="<?= asset('assets/uploads/' . $c['photo']) ?>" alt="user-avatar" class="d-block rounded m-3" width="80" id="uploadedAvatar">
                                        <?php else : ?>
                                            <img src="<?= asset('assets/img/avatars/1.png') ?>" alt="user-avatar" class="d-block rounded m-3" width="80" id="uploadedAvatar">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="">
                                            <?php if ($c['is_active'] == 1) { ?>
                                                <span class="badge bg-success">Enable</span>
                                            <?php } else { ?>
                                                <span class="badge bg-danger">Disable</span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
</div>
<?php require_once('../layouts/footer.php'); ?>