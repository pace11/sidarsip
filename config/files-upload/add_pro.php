<?php
header('Content-Type: application/json');
include '../connection.php';
include '../global_vars.php';

$response = [
    'status'  => 'error',
    'message' => 'Terjadi kesalahan yang tidak diketahui.'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name       = $_POST['name'] ?? null;
    $created_by = $_POST['created_by'] ?? null;

    // Pastikan file diunggah
    if (!isset($_FILES['file_upload']) || $_FILES['file_upload']['error'] !== UPLOAD_ERR_OK) {
        $response['message'] = 'File tidak ditemukan atau gagal diunggah.';
        echo json_encode($response);
        exit;
    }

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

    $new_name = generate_file_name($name, $file_ext, 'document');
    $target_path = $upload_dir . $new_name;

    if (!move_uploaded_file($file_tmp, $target_path)) {
        $response['message'] = 'Gagal menyimpan file ke server.';
        echo json_encode($response);
        exit;
    }

    // Simpan ke database
    $insert = mysqli_query($conn, "INSERT INTO files SET
        file            = '$new_name',
        name            = '$name',
        created_by      = '$created_by'");

    if ($insert) {
        $response['status']  = 'success';
        $response['message'] = 'Data dan file berhasil diunggah.';
    } else {
        $response['message'] = 'Gagal menyimpan data ke database: ' . mysqli_error($conn);
    }
}

echo json_encode($response);
exit;
?>
