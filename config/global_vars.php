<?php

function get_url() {
    $env = "dev"; // [production, dev]
    $protocol = $env === 'production' ? 'https://' : 'http://';
    $server_name = $_SERVER['HTTP_HOST']; 
    $app = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    return $protocol.$server_name.$app;
}

function url_file($value) {
    if (!$value) {
        return '-';
    }

    $url = '/config/uploads/'.$value;
    return '<a href="'.$url.'" target="_blank">'.$value.'</a>';
}

function count_table($name) {
    include "connection.php";
    return mysqli_num_rows(mysqli_query($conn, "SELECT * FROM $name"));
}

function count_submission() {
    include "connection.php";
    $type = get_user_login('type');
    return mysqli_num_rows(mysqli_query($conn, "SELECT * FROM curriculum_submissions JOIN institutions ON curriculum_submissions.institution_id=institutions.id WHERE institutions.level='$type'"));
}

function is_superadmin() {
    include "connection.php";
    $id = get_user_login('id');
    $find = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE id='$id' AND type='superadmin' LIMIT 1"));
    return !!$find;
}

function is_admin() {
    return get_user_login('type') == 'admin';
}

function label_status($value) {
    $status = [
        'in_review'   => '<span class="badge badge-warning">IN REVIEW</span>',
        'not_approved' => '<span class="badge badge-danger">NOT APPROVED</span>',
        'approved' => '<span class="badge badge-success">APPROVED</span>',
    ];

    return $status[$value] ?? $status['in_review'];
}

function date_ind($param){
    $month = array (1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	$split = explode('-', $param);
	return $split[2] . ' ' . $month[ (int)$split[1] ] . ' ' . $split[0];
}

function month_year($a, $b){
    $month = array (1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	return $month[$a].' '.$b;
}

function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'xxxxxxxxxxxxxxxxxxxxxxxx';
    $secret_iv = 'xxxxxxxxxxxxxxxxxxxxxxxxx';
    $key = hash('sha256', $secret_key);    
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

function get_user_login($param) {
    include "connection.php";
    $id_user_login = encrypt_decrypt('decrypt', $_COOKIE['user_sidarsip']);
    $data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE BINARY id='$id_user_login'"));
    return $data[$param];
}

function date_time($param) {
    return date_ind(date('Y-m-d', strtotime($param)));
}

function generate_file_name($name, $file_extension, $prefix = 'file') {
    $clean_name = '';
    
    if (!empty($name)) {
        $clean_name = preg_replace('/[^a-zA-Z0-9\s\-_]/', '', $name);
        $clean_name = str_replace([' ', '-'], '_', $clean_name);
        $clean_name = strtolower($clean_name);
        $clean_name = trim($clean_name, '_');
    }
    
    $epoch_time = time();
    
    if (!empty($clean_name)) {
        return $clean_name . '_' . $epoch_time . '.' . $file_extension;
    } else {
        return $prefix . '_' . $epoch_time . '.' . $file_extension;
    }
}
