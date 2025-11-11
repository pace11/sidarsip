<?php
header('Content-Type: application/json');
include '../connection.php';

$response = [
    'status' => 'error', 
    'message' => 'Terjadi kesalahan.'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'] ?? null;
  $now = date('Y-m-d H:i:s');

  if (!$id) {
    $response['message'] = 'Data tidak lengkap.';
    echo json_encode($response);
    exit;
  }

  // Hapus data dan file not approved terakhir
    $query_data = mysqli_query($conn, "SELECT file FROM curriculum_submissions WHERE id='$id'");
    
  // Hapus file fisik terlebih dahulu
  while ($old_data = mysqli_fetch_array($query_data)) {
      $path_file = dirname(__DIR__) . '/uploads/' . $old_data['file'];
      if (file_exists($path_file)) {
          unlink($path_file);
      }
  }

  // Hapus data dari database
  $delete = mysqli_query($conn, "DELETE FROM curriculum_submissions WHERE id='$id'");

  if ($delete) {
    $response['status'] = 'success';
    $response['message'] = 'Data berhasil dihapus.';
  } else {
    $response['message'] = 'Gagal menghapus data: ' . mysqli_error($conn);
  }
}

echo json_encode($response);
exit;
?>
