<?php
header('Content-Type: application/json');
include '../connection.php';

$response = [
    'status' => 'error', 
    'message' => 'Terjadi kesalahan.'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'] ?? null;
  $name = $_POST['name'] ?? null;
  $level = $_POST['level'] ?? null;
  $updated_at = date('Y-m-d H:i:s');

  $update = mysqli_query($conn, "UPDATE institutions 
                                SET name='$name', level='$level', updated_at='$updated_at'
                                WHERE id='$id'");

  if ($update) {
    $response['status'] = 'success';
    $response['message'] = 'Berhasil diperbarui.';
  } else {
    $response['message'] = 'Gagal memperbarui data: ' . mysqli_error($conn);
  }
}

echo json_encode($response);
exit;
?>
