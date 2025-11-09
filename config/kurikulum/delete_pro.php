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

  $update = mysqli_query($conn, "UPDATE curriculum_submissions 
                                SET deleted_at='$now'
                                WHERE id='$id'");

  if ($update) {
    $response['status'] = 'success';
    $response['message'] = 'Data berhasil dihapus.';
  } else {
    $response['message'] = 'Gagal menghapus data: ' . mysqli_error($conn);
  }
}

echo json_encode($response);
exit;
?>
