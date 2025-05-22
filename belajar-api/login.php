<?php

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    http_response_code(200);
    exit();
}

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Koneksi ke database
include 'connection.php';

$method = $_SERVER['REQUEST_METHOD'];
if ($method !== 'POST') {
    http_response_code(response_code: 400);
    echo 'ONLY POST method is allowed';
    exit();
}


// Ambil data dari body request (JSON)
$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

$username = $data['username'];
$password = sha1($data['password']);


$response = [];
$sql = mysqli_query($connect, "SELECT * FROM  users WHERE username = '$username' AND password = '$password'");
$numRows = mysqli_num_rows($sql); //mendapatkan jumlah data dari sebuah query

if ($numRows > 0) {
    $row = mysqli_fetch_assoc($sql);
    $response = $row;

    echo json_encode(['status' => 'success', 'msg' => 'User Found', 'data' => $response]);
} else {
    echo json_encode(['status' => 'fail', 'msg' => 'User Not Found', 'data' => $response]);
}

?>