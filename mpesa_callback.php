<?php
// mpesa_callback.php
// This file receives the callback from Safaricom after an STK Push attempt
file_put_contents('mpesa_callback_log.txt', date('c')."\n".file_get_contents('php://input')."\n\n", FILE_APPEND);

// Parse the callback data
$data = json_decode(file_get_contents('php://input'), true);

// You can add your own logic here to update your database, mark order as paid, etc.
// For now, just respond with success
header('Content-Type: application/json');
echo json_encode(['ResultCode' => 0, 'ResultDesc' => 'Received']);
