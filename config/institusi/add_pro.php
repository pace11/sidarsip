<?php
header('Content-Type: application/json');
include '../connection.php';

$response = [
    'status' => 'error', 
    'message' => 'Terjadi kesalahan.'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'] ?? null;
  $level = $_POST['jenjang'] ?? null;

  $insert = mysqli_query($conn, "INSERT INTO institutions SET
      name   = '$name',
      level  = '$level'");

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
