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

// lanjut dengan kode insert data kamu


// Koneksi ke database
include 'connection.php';

// Pastikan request-nya POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'ERROR', 'msg' => 'Only POST method is allowed']);
    exit();
}

// Ambil data dari body request (JSON)
$data = json_decode(file_get_contents("php://input"), true);

// Validasi
if (!$data || !isset($data['student_id']) ||  !isset($data['student_no']) || !isset($data['student_name']) || !isset($data['student_class'])) {
    http_response_code(400);
    echo json_encode(['status' => 'ERROR', 'msg' => 'Missing required fields']);
    exit();
}

$student_id = $data['student_id'];
$student_no = $data['student_no'];
$student_name = $data['student_name'];
$student_class = $data['student_class'];

// Masukkan ke database
$query = "INSERT INTO students (student_id, student_no, student_name, student_class) VALUES ('$student_id', '$student_no', '$student_name', '$student_class')";
$result = mysqli_query($connect, $query);

if ($result) {
    $insertedId = mysqli_insert_id($connect);
    echo json_encode([
        'status' => 'OK',
        'msg' => 'Student added successfully',
        'inserted_id' => $insertedId
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'status' => 'ERROR',
        'msg' => 'Failed to insert data',
        'error' => mysqli_error($connect)
    ]);
}
