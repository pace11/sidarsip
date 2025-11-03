<div class="c-subheader px-3">
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="?page=beranda">Home</a></li>
        <li class="breadcrumb-item active">Institusi</li>
    </ol>
</div>
<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card card-accent-primary">
                        <div class="card-header">List</div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal">
                                        <i class="fa fa-plus-circle"></i> Tambah Data
                                    </a>
                                </div>
                            </div>
                            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form id="formAdd" enctype="multipart/form-data">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="addModalLabel">Tambah Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="remark">Nama</label>
                                                    <input class="form-control" name="name" placeholder="Nama..." required></input>
                                                </div>
                                                <div class="form-group">
                                                    <label for="remark">Email</label>
                                                    <input class="form-control" type="email" name="email" placeholder="Email..." required></input>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Type</label>
                                                    <select class="form-control" name="type">
                                                        <option value="" disabled selected hidden>-- pilih salah satu --</option>
                                                        <option value="admin">ADMIN</option>
                                                        <option value="tk">TK</option>
                                                        <option value="sd">SD</option>
                                                        <option value="smp">SMP</option>
                                                        <option value="sma">SMA</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="remark">Password</label>
                                                    <div class="input-group">
                                                        <input class="form-control" type="password" name="password" placeholder="Password..." required>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-sm btn-outline-secondary togglePassword" type="button">
                                                                <i class="fa fa-eye togglePasswordIcon"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="example table table-responsive-sm table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Type</th>
                                                <th width="100px">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $no = 1;
                                        $q = mysqli_query($conn, "SELECT * FROM users WHERE type <> 'superadmin' ORDER BY updated_at DESC");
                                        while($data=mysqli_fetch_array($q)){ ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= !empty($data['name']) ? $data['name'] : '-' ?></td>
                                                <td><?= !empty($data['email']) ? $data['email'] : '-' ?></td>
                                                <td><?= !empty($data['type']) ? strtoupper($data['type']) : '-' ?></td>
                                                <td>
                                                    <div class="action-box">
                                                        <a href="#" 
                                                            class="btn btn-secondary btn-sm btn-edit"
                                                            data-id="<?= $data['id'] ?>"
                                                            data-name="<?= $data['name'] ?>"
                                                            data-email="<?= $data['email'] ?>"
                                                            data-type="<?= $data['type'] ?>"
                                                            data-password="<?= encrypt_decrypt('decrypt', $data['password']) ?>">
                                                            <i class="fa fa-pencil"></i> Edit
                                                        </a>
                                                        <a href="#" 
                                                            class="btn btn-danger btn-sm btn-delete"
                                                            data-id="<?= $data['id'] ?>">
                                                            <i class="fa fa-trash"></i> Hapus
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php $no++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Global: Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editStatusLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form id="formEdit" enctype="multipart/form-data">
                <div class="modal-header">
                <h5 class="modal-title" id="editStatusLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="modal_id">
                    <div class="form-group">
                        <label for="remark">Nama</label>
                        <input class="form-control" name="name" id="modal_name" placeholder="Nama..." required></input>
                    </div>
                    <div class="form-group">
                        <label for="remark">Email</label>
                        <input class="form-control" type="email" name="email" id="modal_email" placeholder="Email..." required></input>
                    </div>
                    <div class="form-group">
                        <label for="name">Type</label>
                        <select class="form-control" id="modal_type" name="type">
                            <option value="" disabled selected hidden>-- pilih salah satu --</option>
                            <option value="admin">ADMIN</option>
                            <option value="tk">TK</option>
                            <option value="sd">SD</option>
                            <option value="smp">SMP</option>
                            <option value="sma">SMA</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="remark">Password</label>
                        <div class="input-group">
                            <input class="form-control" type="password" name="password" id="modal_password" placeholder="Password..." required>
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-outline-secondary togglePassword" type="button">
                                    <i class="fa fa-eye togglePasswordIcon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Modal Global: Delete -->
    <div class="modal fade modal-danger" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteStatusLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form id="formDelete" enctype="multipart/form-data">
                <div class="modal-header">
                <h5 class="modal-title" id="editStatusLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="modal_delete_id">
                    <p>Apakah Anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name="submit" class="btn btn-primary">Ya, Hapus</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript">
$(function () {
    // === Saat form add ===
    $('#formAdd').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        $.ajax({
            url: 'config/users/add_pro.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(res) {
            if (res.status === 'success') {
                showToast('success', res.message);
                setTimeout(() => {
                    $('#addModal').modal('hide');
                    location.reload()
                }, 1500);
            } else {
                showToast('error', res.message);
            }
            },
            error: function(xhr, status, err) {
            console.error(err);
            showToast('error', 'Terjadi kesalahan jaringan atau server.');
            }
        });
    });

    // === Ketika tombol edit diklik ===
    $(document).on('click', '.btn-edit', function(e) {
        e.preventDefault();
        
        const id = $(this).data('id');
        const name = $(this).data('name');
        const email = $(this).data('email');
        const type = $(this).data('type');
        const password = $(this).data('password');

        // Isi modal field
        $('#modal_id').val(id);
        $('#modal_name').val(name);
        $('#modal_email').val(email);
        $('#modal_type').val(type);
        $('#modal_password').val(password);

        // Buka modal
        $('#editModal').modal('show');
    });

    // === Saat form edit disubmit ===
    $('#formEdit').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        $.ajax({
            url: 'config/users/edit_pro.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    showToast('success', res.message);
                setTimeout(() => {
                    $('#editModal').modal('hide');
                    location.reload()
                }, 1500);
                } else {
                showToast('error', res.message);
                }
            },
            error: function(xhr, status, err) {
                showToast('error', 'Terjadi kesalahan jaringan atau server.');
            }
        });
    });

    // === Ketika tombol delete diklik ===
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        
        const id = $(this).data('id');

        // Isi modal field
        $('#modal_delete_id').val(id);

        // Buka modal
        $('#deleteModal').modal('show');
    });

    // === Saat form delete disubmit ===
    $('#formDelete').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        $.ajax({
            url: 'config/users/delete_pro.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    showToast('success', res.message);
                setTimeout(() => {
                    $('#deleteModal').modal('hide');
                    location.reload()
                }, 1500);
                } else {
                showToast('error', res.message);
                }
            },
            error: function(xhr, status, err) {
                console.log('err -> ', err);
                // console.error(err);
                showToast('error', 'Terjadi kesalahan jaringan atau server.');
            }
        });
    });

    // === Toggle Password Visibility ===
    $(document).on('click', '.togglePassword', function() {
        const passwordField = $(this).closest('.input-group').find('input[type="password"], input[type="text"]');
        const toggleIcon = $(this).find('.togglePasswordIcon');
        
        if (passwordField.attr('type') === 'password') {
            passwordField.attr('type', 'text');
            toggleIcon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            passwordField.attr('type', 'password');
            toggleIcon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

});
</script>