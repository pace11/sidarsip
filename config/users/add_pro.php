<?php
header('Content-Type: application/json');
include '../connection.php';
include '../global_vars.php';

$response = [
    'status' => 'error', 
    'message' => 'Terjadi kesalahan.'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'] ?? null;
  $email = $_POST['email'] ?? null;
  $type = $_POST['type'] ?? null;
  $password = $_POST['password'] ?? null;

  $encrypted_password = encrypt_decrypt('encrypt', $password);

  $insert = mysqli_query($conn, "INSERT INTO users SET
      name   = '$name',
      email  = '$email',
      type   = '$type',
      password = '$encrypted_password'");

  if ($insert) {
    $response['status'] = 'success';
    $response['message'] = 'Berhasil ditambahkan.';
  } else {
    $response['message'] = 'Gagal menambahkan data: ' . mysqli_error($conn);
  }
}

echo json_encode($response);
exit;
?>
