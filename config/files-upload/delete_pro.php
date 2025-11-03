<?php
header('Content-Type: application/json');
include '../connection.php';

$response = [
    'status' => 'error', 
    'message' => 'Terjadi kesalahan.'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'] ?? null;

  // Validasi ID
  if (empty($id)) {
    $response['message'] = 'ID data tidak ditemukan.';
    echo json_encode($response);
    exit;
  }

  // Ambil data file sebelum dihapus
  $file_data = mysqli_fetch_array(mysqli_query($conn, "SELECT file FROM files WHERE id='$id'"));
  
  if (!$file_data) {
    $response['message'] = 'Data tidak ditemukan.';
    echo json_encode($response);
    exit;
  }

  $file_name = $file_data['file'];
  $file_path = dirname(__DIR__) . '/uploads/' . $file_name;

  // Hapus data dari database
  $delete = mysqli_query($conn, "DELETE FROM files WHERE id='$id'");

  if ($delete) {
    // Hapus file fisik jika ada
    if (!empty($file_name) && file_exists($file_path)) {
      if (unlink($file_path)) {
        $response['message'] = 'Data dan file berhasil dihapus.';
      } else {
        $response['message'] = 'Data berhasil dihapus, tetapi file gagal dihapus dari server.';
      }
    } else {
      $response['message'] = 'Data berhasil dihapus (file tidak ditemukan di server).';
    }
    
    $response['status'] = 'success';
  } else {
    $response['message'] = 'Gagal menghapus data: ' . mysqli_error($conn);
  }
}

echo json_encode($response);
exit;
?>
