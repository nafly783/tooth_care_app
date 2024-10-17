<?php
require_once('../layouts/header.php');
require_once __DIR__ . '/../../models/DoctorAvailability.php';

$doctorAvailabilityModel = new DoctorAvailability();
$doctorAvailabilities = $doctorAvailabilityModel->getAll();

?>
<div class="container">

    <h1 class="mx-3 my-5">Doctor Availability</h1>
    <section class="content m-3">
        <div class="container-fluid">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th class="">Day</th>
                                <th class="">Session From</th>
                                <th class="">Session To</th>
                                <th class="">Doctor</th>
                                <th class="">Status</th>
                                <!-- <th class="text-center" style="width: 200px">Options</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($doctorAvailabilities as $c) {
                            ?>
                                <tr>
                                    <td> <?= $c['id'] ?? ""; ?> </td>
                                    <td> <?= $c['day'] ?? ""; ?> </td>
                                    <td> <?= $c['session_from'] ?? ""; ?> </td>
                                    <td> <?= $c['session_to'] ?? ""; ?> </td>
                                    <td> <?= $c['doctor_name'] ?? ""; ?> </td>
                                    <td>
                                        <div class="">
                                            <?php if ($c['is_active'] == 1) { ?>
                                                <span class="badge bg-success">Enable</span>
                                            <?php } else { ?>
                                                <span class="badge bg-danger">Disable</span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                    <!-- TODO -->
                                    <!-- <td>
                                        <div>
                                            <a class="btn btn-sm btn-info m-2" href="edit.php?id=<?= $c['id']; ?>">Edit</a>
                                            <a class="btn btn-sm btn-danger m-2" href="#" onclick="confirmDelete(<?= $c['id']; ?>)">Delete</a>
                                        </div>
                                    </td> -->
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