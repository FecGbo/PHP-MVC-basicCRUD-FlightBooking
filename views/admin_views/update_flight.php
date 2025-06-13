<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../config/database.php';

header('Content-Type: application/json');

$db = new Database();
$conn = $db->connect();

// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['id'])) {
    echo json_encode(['success' => false, 'error' => 'Invalid input']);
    exit;
}

try {
    $sql = "UPDATE flights SET 
        airline = :airline,
        departure_city = :departure_city,
        destination_city = :destination_city,
        departure_time = :departure_time,
        arrival_time = :arrival_time,
        Days = :Days,
        price = :price,
        available_seats = :available_seats
        WHERE flight_id = :id";

    $stmt = $conn->prepare($sql);
    $success = $stmt->execute([
        ':airline' => $data['airline'],
        ':departure_city' => $data['departure_city'],
        ':destination_city' => $data['destination_city'],
        ':departure_time' => $data['departure_time'],
        ':arrival_time' => $data['arrival_time'],
        ':Days' => $data['Days'],
        ':price' => $data['price'],
        ':available_seats' => $data['available_seats'],
        ':id' => $data['id']
    ]);

    if ($success) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Update failed']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

// [User edits table row] 
//       ↓
// [Clicks Save]
//       ↓
// [JS fetch() sends JSON to update_flight.php]
//       ↓
// [PHP decodes JSON, validates, prepares SQL]
//       ↓
// [Executes UPDATE in DB]
//       ↓
// [Returns JSON {success:true/false}]
//       ↓
// [JS updates UI or shows error]