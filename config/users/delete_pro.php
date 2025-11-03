<?php
header('Content-Type: application/json');
include '../connection.php';

$response = [
    'status' => 'error', 
    'message' => 'Terjadi kesalahan.'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'] ?? null;

  $delete = mysqli_query($conn, "DELETE FROM users WHERE id='$id'");

  if ($delete) {
    $response['status'] = 'success';
    $response['message'] = 'Berhasil dihapus.';
  } else {
    $response['message'] = 'Gagal menghapus data: ' . mysqli_error($conn);
  }
}

echo json_encode($response);
exit;
?>
