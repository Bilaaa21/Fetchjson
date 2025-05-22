<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'PATCH') {
    http_response_code(400);
    echo json_encode(['status' => 'Error', 'msg' => 'Only PATCH method is allowed']);
    exit();
}

$input = file_get_contents("php://input");
$data = json_decode($input, true);

$studentId = $data['student_id'] ?? '';
$studentNo = $data['student_no'] ?? '';
$studentName = $data['student_name'] ?? '';
$studentClass = $data['student_class'] ?? '';

if (!$studentId || !$studentNo || !$studentName || !$studentClass) {
    http_response_code(400);
    echo json_encode(['status' => 'Error', 'msg' => 'Incomplete data']);
    exit();
}

$sql = mysqli_query($connect, "UPDATE students SET 
    student_no = '$studentNo', 
    student_name = '$studentName', 
    student_class = '$studentClass' 
    WHERE student_id = '$studentId'");

if ($sql) {
    echo json_encode(['status' => 'OK', 'msg' => 'Data updated successfully']);
} else {
    echo json_encode(['status' => 'Error', 'msg' => 'Failed to update data']);
}
