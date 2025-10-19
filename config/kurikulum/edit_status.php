<?php
header('Content-Type: application/json');
include '../connection.php';

$response = [
    'status' => 'error', 
    'message' => 'Terjadi kesalahan.'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'] ?? null;
  $status = $_POST['status'] ?? null;
  $remark = $_POST['remark'] ?? null;
  $updated_at = date('Y-m-d H:i:s');

  if (!$id || !$status) {
    $response['message'] = 'Data tidak lengkap.';
    echo json_encode($response);
    exit;
  }

  $update = mysqli_query($conn, "UPDATE curriculum_submissions 
                                SET status='$status', remark='$remark', updated_at='$updated_at'
                                WHERE id='$id'");

  if ($update) {
    $response['status'] = 'success';
    $response['message'] = 'Status berhasil diperbarui.';
  } else {
    $response['message'] = 'Gagal memperbarui data: ' . mysqli_error($conn);
  }
}

echo json_encode($response);
exit;
?>
