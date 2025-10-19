<?php

include 'connection.php';

if (isset($_POST['level'])) {
    $level = $_POST['level'];

    $query = mysqli_query($conn, "SELECT id, name FROM institutions WHERE level = '$level' AND deleted_at IS NULL ORDER BY name ASC");

    $result = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($result);
    exit;
}

?>
