<?php
require_once('../layouts/header.php');
require_once __DIR__ . '/../../models/Treatment.php';

$treatmentModel = new Treatment();
$treatments = $treatmentModel->getAll();
?>
<div class="container">

    <h1 class="mx-3 my-5">Treatments</h1>
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
                                <th class="">Description</th>
                                <th class="">Treatment Fees</th>
                                <th class="">Registration Fees</th>
                                <th class="">Status</th>
                                <!-- <th style="width: 200px">Options</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($treatments as $c) {
                            ?>
                                <tr>
                                    <td> <?= $c['id'] ?? ""; ?> </td>
                                    <td> <?= $c['name'] ?? ""; ?> </td>
                                    <td> <?= $c['description'] ?? ""; ?> </td>
                                    <td class="text-right">LKR <?= number_format($c['treatment_fee'], 2) ?? 0; ?> </td>
                                    <td class="text-right">LKR <?= number_format($c['registration_fee'], 2) ?? 0; ?> </td>
                                    <td>
                                        <div class="">
                                            <?php if ($c['is_active'] == 1) { ?>
                                                <span class="badge bg-success">Enable</span>
                                            <?php } else { ?>
                                                <span class="badge bg-danger">Disable</span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <!-- TODO -->
                                            <!-- <a class="btn btn-sm btn-info m-2" href="edit.php?id=<?= $c['id']; ?>">Edit</a>
                                            <a class="btn btn-sm btn-danger m-2" href="#" onclick="confirmDelete(<?= $c['id']; ?>)">Delete</a> -->
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