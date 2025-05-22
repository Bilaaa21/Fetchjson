<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(400);
    echo json_encode(['status' => 'Error', 'msg' => 'Only DELETE method is allowed']);
    exit();
}

$input = file_get_contents("php://input");
$data = json_decode($input, true);

$studentId = $_GET['id'] ?? '';

if (!$studentId) {
    http_response_code(400);
    echo json_encode(['status' => 'Error', 'msg' => 'Student ID is required']);
    exit();
}

$sql = mysqli_query($connect, "DELETE FROM students WHERE student_id = '$studentId'");

if ($sql) {
    echo json_encode(['status' => 'OK', 'msg' => 'Data deleted successfully']);
} else {
    echo json_encode(['status' => 'Error', 'msg' => 'Failed to delete data']);
}
