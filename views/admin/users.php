<?php
require_once('../layouts/header.php');
require_once __DIR__ . '/../../models/User.php';

$userModel = new User();
$users = $userModel->getAll();

?>

<div class="container">

    <h1 class="mx-3 my-5">
        Users

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary float-end m-3" data-bs-toggle="modal" data-bs-target="#createUserModal">
            Create User
        </button>
    </h1>
    <section class="content m-3">
        <div class="container-fluid">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th class="">Username</th>
                                <th class="">Email</th>
                                <th class="">Permission</th>
                                <th class=""></th>
                                <th class="">Status</th>
                                <!-- <th style="width: 200px">Options</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($users as $key => $c) {
                            ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td> <?= $c['username'] ?? ""; ?> </td>
                                    <td> <?= $c['email'] ?? ""; ?> </td>
                                    <td class="text-capitalize"> <?= $c['permission'] ?? ""; ?> </td>
                                    <td> </td>
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
                                            <button class="btn btn-sm btn-info m-2 edit-user" data-id="<?= $c['id']; ?>">Edit</button>
                                            <button class="btn btn-sm btn-danger m-2 delete-user" data-id="<?= $c['id']; ?>">Delete</button>

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

<!-- Modal -->
<div class="modal fade " id="createUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="create-user-form" action="<?= url('services/ajax_functions.php') ?>" enctype="multipart/form-data">
                <input type="hidden" name="action" value="create_user">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Create User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="username" class="form-label">User Name</label>
                            <input type="text" id="username" name="username" class="form-control" placeholder="Enter Name" required />
                        </div>
                    </div>
                    <div class="row g-1">
                        <div class="col mb-0">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="xxxx@xxx.xx" required />
                        </div>

                    </div>
                    <div class="row g-2 mt-2">
                        <div class="col mb-0 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="password" placeholder="············" aria-describedby="basic-default-password2" required>
                                <span id="basic-default-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="col mb-0 form-password-toggle">
                            <label class="form-label" for="basic-default-password12">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" name="confirm_password" class="form-control" id="basic-default-password12" placeholder="············" aria-describedby="basic-default-password2" required>
                                <span id="basic-default-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col mb-0">
                            <label class="form-label" for="permission">Permission</label>
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                <select class="form-select" id="permission" name="permission" required>
                                    <option selected="" value="">Choose...</option>
                                    <option value="operator">Operator</option>
                                    <option value="doctor">Doctor</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="additional-fields"></div>
                    <div class="mb-3 mt-3">
                        <div id="alert-container"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" id="create-now" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update User Modal -->
<div class="modal fade " id="editUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="update-user-form" action="<?= url('services/ajax_functions.php') ?>" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update_user">
                <input type="hidden" name="id" id="user_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="username" class="form-label">User Name</label>
                            <input type="text" id="username" name="username" class="form-control" placeholder="Enter Name" required />
                        </div>
                    </div>
                    <div class="row g-1">
                        <div class="col mb-0">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="xxxx@xxx.xx" required />
                        </div>

                    </div>
                    <div class="row g-2 mt-2">
                        <div class="col mb-0 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="password" placeholder="············" aria-describedby="basic-default-password2" required>
                                <span id="basic-default-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="col mb-0 form-password-toggle">
                            <label class="form-label" for="basic-default-password12">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" name="confirm_password" class="form-control" id="basic-default-password12" placeholder="············" aria-describedby="basic-default-password2" required>
                                <span id="basic-default-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col mb-0">
                            <label class="form-label" for="permission">Permission</label>
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                <select class="form-select" id="edit_permission" name="permission" required>
                                    <option selected="" value="">Choose...</option>
                                    <option value="operator">Operator</option>
                                    <option value="doctor">Doctor</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col mb-0">
                            <label class="form-label" for="is_active">Status</label>
                            <div class="input-group">
                                <select class="form-select" id="is_active" name="is_active" required>
                                    <option selected="" value="">Choose...</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="edit-additional-fields"></div>
                    <div class="mb-3 mt-3">
                        <div id="alert-container-update-form"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" id="update-now" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once('../layouts/footer.php');
?>

<script>
    $(document).ready(function() {

        // Handle modal button click
        // $('#create-now').on('click', function() {

        //     // Get the form element
        //     var form = $('#create-user-form')[0];
        //     $('#create-user-form')[0].reportValidity();

        //     // Check form validity
        //     if (form.checkValidity()) {
        //         // Serialize the form data
        //         var formData = $('#create-user-form').serialize();
        //         var formAction = $('#create-user-form').attr('action');

        //         // Perform AJAX request
        //         $.ajax({
        //             url: formAction,
        //             type: 'POST',
        //             data: formData, // Form data
        //             dataType: 'json',
        //             success: function(response) {
        //                 showAlert(response.message, response.success ? 'primary' : 'danger');
        //                 if (response.success) {
        //                     $('#createUserModal').modal('hide');
        //                     setTimeout(function() {
        //                         location.reload();
        //                     }, 1000);
        //                 }
        //             },
        //             error: function(error) {
        //                 // Handle the error
        //                 console.error('Error submitting the form:', error);
        //             },
        //             complete: function(response) {
        //                 // This will be executed regardless of success or error
        //                 console.log('Request complete:', response);
        //             }
        //         });
        //     } else {
        //         var message = ('Form is not valid. Please check your inputs.');
        //         showAlert(message, 'danger');
        //     }
        // });

        $('#create-now').on('click', function() {
            // Get the form element
            var form = $('#create-user-form')[0];
            $('#create-user-form')[0].reportValidity();

            // Check form validity
            if (form.checkValidity()) {
                // Create a FormData object
                var formData = new FormData($('#create-user-form')[0]);

                // Perform AJAX request
                $.ajax({
                    url: $('#create-user-form').attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false, // Don't set content type
                    processData: false, // Don't process the data
                    dataType: 'json',
                    success: function(response) {
                        showAlert(response.message, response.success ? 'primary' : 'danger');
                        if (response.success) {
                            $('#createUserModal').modal('hide');
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    },
                    error: function(error) {
                        // Handle the error
                        console.error('Error submitting the form:', error);
                    },
                    complete: function(response) {
                        // This will be executed regardless of success or error
                        console.log('Request complete:', response);
                    }
                });
            } else {
                var message = ('Form is not valid. Please check your inputs.');
                showAlert(message, 'danger');
            }
        });


        $('.edit-user').on('click', async function() {
            var user_id = $(this).data('id');
            await getUserById(user_id);
        })

        $('.delete-user').on('click', async function() {
            var user_id = $(this).data('id');
            var is_confirm = confirm('Are you sure,Do you want to delete?');
            if (is_confirm) await deleteById(user_id);
        })

        $('#update-now').on('click', function() {

            // Get the form element
            var form = $('#update-user-form')[0];
            $('#update-user-form')[0].reportValidity();

            // Check form validity
            if (form.checkValidity()) {
                // Serialize the form data
                var formAction = $('#update-user-form').attr('action');
                var formData = new FormData($('#update-user-form')[0]);

                // Perform AJAX request
                $.ajax({
                    url: formAction,
                    type: 'POST',
                    data: formData, // Form data
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        showAlert(response.message, response.success ? 'primary' : 'danger', 'alert-container-update-form');
                        if (response.success) {
                            $('#editUserModal').modal('hide');
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    },
                    error: function(error) {
                        // Handle the error
                        console.error('Error submitting the form:', error);
                    },
                    complete: function(response) {
                        // This will be executed regardless of success or error
                        console.log('Request complete:', response);
                    }
                });
            } else {
                var message = ('Form is not valid. Please check your inputs.');
                showAlert(message, 'danger');
            }
        });

        $('#permission').change(function() {
            var permission = $(this).val();
            if (permission === 'doctor') {
                $('#additional-fields').html(
                    '<div class="row mt-2">' +
                    '<div class="col-12 mb-3">' +
                    '<label for="name" class="form-label">Doctor Name</label>' +
                    '<input type="text" id="name" name="doctor_name" class="form-control" placeholder="Enter Name" required />' +
                    '</div>' +
                    '<div class="col-12 mb-3">' +
                    '<label for="about" class="form-label">About Doctor</label>' +
                    '<textarea id="about" name="about_doctor" class="form-control" placeholder="Enter About" required></textarea>' +
                    '</div>' +
                    '<div class="col-12 mb-3">' +
                    '<label for="formFile" class="form-label">Doctor Photo</label>' +
                    '<input class="form-control" name="image" id="image" type="file" accept="image/*">' +
                    '</div>' +
                    '</div>'
                );
            } else {
                $('#additional-fields').empty();
            }
        });

        // Trigger change event on page load if doctor permission is selected by default
        if ($('#permission, #edit_permission').val() === 'doctor') {
            $('#permission, #edit_permission').trigger('change');
        }

        $('#edit_permission').change(function() {
            var permission = $(this).val();
            if (permission === 'doctor') {
                $('#edit-additional-fields').html(
                    '<div class="row mt-2">' +
                    '<div class="col-12 mb-3">' +
                    '<label for="name" class="form-label">Doctor Name</label>' +
                    '<input type="text" id="edit_name" name="doctor_name" class="form-control" placeholder="Enter Name" required />' +
                    '</div>' +
                    '<div class="col-12 mb-3">' +
                    '<label for="about" class="form-label">About Doctor</label>' +
                    '<textarea id="edit_about" name="about_doctor" class="form-control" placeholder="Enter About" required></textarea>' +
                    '</div>' +
                    '<div class="col-12 mb-3">' +
                    '<label for="formFile" class="form-label">Doctor Photo</label>' +
                    '<input class="form-control" name="image" id="edit_image" type="file" accept="image/*">' +
                    '</div>' +
                    '</div>'
                );
            } else {
                $('#edit-additional-fields').empty();
            }
        });
    });

    async function getUserById(id) {
        var formAction = $('#update-user-form').attr('action');

        // Perform AJAX request
        $.ajax({
            url: formAction,
            type: 'GET',
            data: {
                user_id: id,
                action: 'get_user'
            }, // Form data
            dataType: 'json',
            success: function(response) {
                showAlert(response.message, response.success ? 'primary' : 'danger');
                if (response.success) {
                    var user_id = response.data.id;
                    var username = response.data.username;
                    var email = response.data.email;
                    var permission = response.data.permission;
                    var is_active = response.data.is_active;

                    $('#editUserModal #user_id').val(user_id);
                    $('#editUserModal #username').val(username);
                    $('#editUserModal #email').val(email);
                    $('#editUserModal #permission option[value="' + permission + '"]').prop('selected', true);
                    $('#editUserModal #is_active option[value="' + is_active + '"]').prop('selected', true);
                    $('#editUserModal').modal('show');
                }
            },
            error: function(error) {
                // Handle the error
                console.error('Error submitting the form:', error);
            },
            complete: function(response) {
                // This will be executed regardless of success or error
                console.log('Request complete:', response);
            }
        });
    }

    async function deleteById(id) {
        var formAction = $('#update-user-form').attr('action');

        // Perform AJAX request
        $.ajax({
            url: formAction,
            type: 'GET',
            data: {
                user_id: id,
                action: 'delete_user'
            }, // Form data
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }
            },
            error: function(error) {
                // Handle the error
                console.error('Error submitting the form:', error);
            },
            complete: function(response) {
                // This will be executed regardless of success or error
                console.log('Request complete:', response);
            }
        });
    }
</script>