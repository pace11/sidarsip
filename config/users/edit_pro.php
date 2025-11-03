<?php
header('Content-Type: application/json');
include '../connection.php';
include '../global_vars.php';

$response = [
    'status' => 'error', 
    'message' => 'Terjadi kesalahan.'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'] ?? null;
  $name = $_POST['name'] ?? null;
  $email = $_POST['email'] ?? null;
  $type = $_POST['type'] ?? null;
  $password = $_POST['password'] ?? null;
  $updated_at = date('Y-m-d H:i:s');

  $encrypted_password = encrypt_decrypt('encrypt', $password);

  $update = mysqli_query($conn, "UPDATE users SET
                                name        = '$name',
                                email       = '$email',
                                password    = '$encrypted_password',
                                type        = '$type',
                                updated_at  = '$updated_at'
                                WHERE id    = '$id'");

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
