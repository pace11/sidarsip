<?php
    // database dev
    $host   ="127.0.0.1";
    $user   ="root";
    $pass   ="passwd";
    $db     ="db_sidarsip";
    $conn   = mysqli_connect($host, $user, $pass, $db);

    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
