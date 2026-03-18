<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$method = $_SERVER['REQUEST_METHOD'];
$dataFile = 'db.json';

if ($method == 'OPTIONS') {
    http_response_code(200);
    exit();
}

if ($method == 'GET') {
    if (file_exists($dataFile)) {
        echo file_get_contents($dataFile);
    } else {
        echo json_encode(["ativacao" => ["status" => false], "dados" => []]);
    }
} elseif ($method == 'POST' || $method == 'PUT') {
    $input = json_decode(file_get_contents('php://input'), true);
    file_put_contents($dataFile, json_encode($input, JSON_PRETTY_PRINT));
    echo json_encode(["success" => true]);
}
?>
