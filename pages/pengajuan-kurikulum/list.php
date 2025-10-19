<div class="c-subheader px-3">
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="?page=beranda">Home</a></li>
        <li class="breadcrumb-item active">Pengajuan Kurikulum</li>
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
                                        <i class="fa fa-plus-circle"></i> Upload
                                    </a>
                                </div>
                            </div>
                            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form id="formAddCurriculum" enctype="multipart/form-data">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="addModalLabel">Add Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">File</label>
                                                    <input class="form-control" type="file" name="file_upload" accept=".pdf" required>
                                                </div>
                                                <div class="form-group" style="<?= is_superadmin() ? '' : 'display:none;' ?>">
                                                    <label for="name">Jenjang</label>
                                                    <select class="form-control" name="jenjang" id="level" <?= is_superadmin() ? 'required' : '' ?>>
                                                        <option value="" disabled selected hidden>-- pilih salah satu --</option>
                                                        <option value="SD">SD</option>
                                                        <option value="SMP">SMP</option>
                                                        <option value="SMA">SMA</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Institusi</label>
                                                    <select class="form-control" name="institusi" id="institution">
                                                        <option value="" disabled selected hidden>-- pilih salah satu --</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
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
                                                <th>File</th>
                                                <th>Institusi</th>
                                                <th>Status</th>
                                                <th width="300px">Remark</th>
                                                <th>Tanggal Diajukan</th>
                                                <th width="100px">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $no = 1;
                                    
                                        $user_type = get_user_login('type');
                                        switch ($user_type) {
                                            case 'superadmin':
                                                $sql = "SELECT cs.id, cs.file, i.name AS institution_name, cs.status, cs.remark, cs.created_at FROM curriculum_submissions cs JOIN institutions i ON cs.institution_id=i.id WHERE cs.deleted_at IS NULL ORDER BY cs.updated_at DESC";
                                                break;
                                            default:
                                                $sql = "SELECT cs.id, cs.file, i.name AS institution_name, cs.status, cs.remark, cs.created_at FROM curriculum_submissions cs JOIN institutions i ON cs.institution_id=i.id WHERE i.level='$user_type' ORDER BY cs.updated_at DESC";
                                        }

                                        $q = mysqli_query($conn, $sql);
                                        while($data=mysqli_fetch_array($q)){ ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= url_file($data['file']) ?></td>
                                                <td><?= !empty($data['institution_name']) ? $data['institution_name'] : '-' ?></td>
                                                <td><?= label_status($data['status']) ?></td>
                                                <td><?= !empty($data['remark']) ? $data['remark'] : '-' ?></td>
                                                <td><?= !empty($data['created_at']) ? date_time($data['created_at']) : '-' ?></td>
                                                <td>
                                                    <div class="action-box">
                                                        <a href="#" 
                                                            class="btn btn-secondary btn-sm btn-edit-status"
                                                            data-id="<?= $data['id'] ?>"
                                                            data-status="<?= $data['status'] ?>"
                                                            data-remark="<?= $data['remark'] ?>" style="<?= is_superadmin() && $data['status'] == 'in_review' ? '' : 'display:none;' ?>">
                                                            <i class="fa fa-pencil"></i> Edit Status
                                                        </a>
                                                        <a href="?page=productdelete&id=<?= $data['id'] ?>" class="btn btn-danger btn-sm" style="<?= is_superadmin() ? '' : 'display:none;' ?>"><i class="fa fa-trash"></i> Hapus</a>
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
    <!-- Modal Global: Edit Status -->
    <div class="modal fade" id="editStatusModal" tabindex="-1" role="dialog" aria-labelledby="editStatusLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form id="formEditStatus" enctype="multipart/form-data">
                <div class="modal-header">
                <h5 class="modal-title" id="editStatusLabel">Edit Status Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>

                <div class="modal-body">
                <input type="hidden" name="id" id="modal_id">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status" id="modal_status" required>
                    <option value="" disabled selected hidden>-- pilih salah satu --</option>
                    <option value="approved">Approved</option>
                    <option value="not_approved">Not Approved</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="remark">Catatan / Remark</label>
                    <textarea class="form-control" name="remark" id="modal_remark" rows="3" placeholder="Tambahkan keterangan..." required></textarea>
                </div>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript">
$(function () {
    const isSuperadmin = <?= json_encode(is_superadmin()) ?>;
    const userLevel = <?= json_encode(get_user_login('type')) ?>;

    // === Saat user yang login adalah admin sd, smp, sma ===
    if (!isSuperadmin && userLevel) {
        $.ajax({
            url: 'config/get_institution_by_level.php',
            type: 'POST',
            data: { level: userLevel },
            dataType: 'json',
            success: function(res) {
                $('#institution').empty();

                if (res.length > 0) {
                    $('#institution').append('<option value="" disabled selected hidden>-- Pilih Institution --</option>');
                    $.each(res, function(i, item) {
                        $('#institution').append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                } else {
                    $('#institution').append('<option value="" disabled selected hidden>Tidak ada data</option>');
                }
            },
            error: function(err) {
                console.error(err);
                $('#institution').html('<option value="" disabled selected hidden>Error loading data</option>');
            }
        });
    }

    // === Saat form level di form curriculum diubah ===
    $('#level').change(function() {
        var selectedLevel = $(this).val();
        $('#institution').html('<option value="">-- Loading... --</option>');

        if (selectedLevel) {
            $.ajax({
                url: 'config/get_institution_by_level.php',
                type: 'POST',
                data: { level: selectedLevel },
                dataType: 'json',
                success: function(res) {
                    $('#institution').empty();

                    if (res.length > 0) {
                        $('#institution').append('<option value="" disabled selected hidden>-- Pilih Institution --</option>');
                        $.each(res, function(i, item) {
                            $('#institution').append('<option value="' + item.id + '">' + item.name + '</option>');
                        });
                    } else {
                        $('#institution').append('<option value="" disabled selected hidden>Tidak ada data</option>');
                    }
                },
                error: function(err) {
                    console.error(err);
                    $('#institution').html('<option value="" disabled selected hidden>Error loading data</option>');
                }
            });
        } else {
            $('#institution').html('<option value="" disabled selected hidden>-- Pilih Institution --</option>');
        }
    });

    // === Saat form add curriculum disubmit ===   
    $('#formAddCurriculum').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        $.ajax({
            url: 'config/kurikulum/add_pro.php',
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
            console.log("err -> ", {err, xhr});
            console.error(err);
            showToast('error', 'Terjadi kesalahan jaringan atau server.');
            }
        });
    });

    // === Ketika tombol edit status diklik ===
    $(document).on('click', '.btn-edit-status', function(e) {
        e.preventDefault();

        console.log($(this).data())
        
        const id = $(this).data('id');
        const status = $(this).data('status');
        const remark = $(this).data('remark');

        // Isi modal field
        $('#modal_id').val(id);
        $('#modal_status').val(status);
        $('#modal_remark').val(remark);

        // Buka modal
        $('#editStatusModal').modal('show');
    });

    // === Saat form edit status disubmit ===
    $('#formEditStatus').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        console.log("data => ", formData)

        $.ajax({
            url: 'config/kurikulum/edit_status.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    showToast('success', res.message);
                setTimeout(() => {
                    $('#editStatusModal').modal('hide');
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

});
</script>