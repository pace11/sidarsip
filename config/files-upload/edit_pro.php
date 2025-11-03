<?php
header('Content-Type: application/json');
include '../connection.php';
include '../global_vars.php';

$response = [
    'status'  => 'error',
    'message' => 'Terjadi kesalahan yang tidak diketahui.'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id         = $_POST['id'] ?? null;
    $name       = $_POST['name'] ?? null;
    $created_by = $_POST['created_by'] ?? null;
    $updated_at = date('Y-m-d H:i:s');

    // Validasi ID untuk edit
    if (empty($id)) {
        $response['message'] = 'ID data tidak ditemukan.';
        echo json_encode($response);
        exit;
    }

    // Cek apakah ada file yang diupload
    $has_file_upload = isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] === UPLOAD_ERR_OK;
    
    if ($has_file_upload) {
        // === Jika ada file baru yang diupload ===
        $file = $_FILES['file_upload'];

        // === File handling ===
        $upload_dir = dirname(__DIR__) . '/uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $file_name  = $file['name'];
        $file_tmp   = $file['tmp_name'];
        $file_size  = $file['size'];
        $file_error = $file['error'];

        $allowed_ext = ['pdf'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Validasi jenis file
        if (!in_array($file_ext, $allowed_ext)) {
            $response['message'] = 'File harus berupa PDF.';
            echo json_encode($response);
            exit;
        }

        // Validasi ukuran file (maks 5 MB)
        if ($file_size > 5 * 1024 * 1024) {
            $response['message'] = 'Ukuran file terlalu besar (maksimal 5MB).';
            echo json_encode($response);
            exit;
        }

        // Ambil data file lama untuk dihapus
        $old_data = mysqli_fetch_array(mysqli_query($conn, "SELECT file FROM files WHERE id='$id'"));
        $old_file_path = $upload_dir . $old_data['file'];

        // Generate nama file baru
        $new_name = generate_file_name($name, $file_ext, 'document');
        $target_path = $upload_dir . $new_name;

        if (!move_uploaded_file($file_tmp, $target_path)) {
            $response['message'] = 'Gagal menyimpan file ke server.';
            echo json_encode($response);
            exit;
        }

        // Hapus file lama jika ada
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        // Update database dengan file baru
        $update = mysqli_query($conn, "UPDATE files SET
            file        = '$new_name',
            name        = '$name',
            created_by  = '$created_by',
            updated_at  = '$updated_at'
            WHERE id    = '$id'");

    } else {
        // === Jika hanya update nama tanpa file baru ===
        $update = mysqli_query($conn, "UPDATE files SET
            name        = '$name',
            created_by  = '$created_by',
            updated_at  = '$updated_at'
            WHERE id    = '$id'");
    }

    if ($update) {
        $response['status']  = 'success';
        $response['message'] = 'Data berhasil diperbarui.';
    } else {
        $response['message'] = 'Gagal memperbarui data: ' . mysqli_error($conn);
    }
}

echo json_encode($response);
exit;
?>
