<?php
// mpesa_payment.php
// Load environment variables
$consumerKey = getenv('MPESA_API_KEY');
$consumerSecret = getenv('MPESA_API_SECRET');
$shortCode = getenv('MPESA_SHORTCODE');
$passkey = getenv('MPESA_PASSKEY');
$callbackUrl = getenv('MPESA_CALLBACK_URL');

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
$phone = $data['phone'] ?? '';
$amount = $data['amount'] ?? '';

if(!$phone || !$amount) {
    echo json_encode(['success' => false, 'message' => 'Missing phone or amount']);
    exit;
}

// 1. Get access token
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Basic '.base64_encode($consumerKey.':'.$consumerSecret)]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
if(!$result) {
    echo json_encode(['success' => false, 'message' => 'Failed to get access token']);
    exit;
}
$token = json_decode($result, true)['access_token'] ?? '';
curl_close($ch);
if(!$token) {
    echo json_encode(['success' => false, 'message' => 'No access token']);
    exit;
}

// 2. Initiate STK Push
$timestamp = date('YmdHis');
$password = base64_encode($shortCode.$passkey.$timestamp);
$payload = [
    'BusinessShortCode' => $shortCode,
    'Password' => $password,
    'Timestamp' => $timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $amount,
    'PartyA' => $phone,
    'PartyB' => $shortCode,
    'PhoneNumber' => $phone,
    'CallBackURL' => $callbackUrl,
    'AccountReference' => 'BablazSip',
    'TransactionDesc' => 'Drink Payment'
];
$ch = curl_init('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest');
// Log the request payload
file_put_contents('mpesa_payment_log.txt', "[".date('c')."] Request:\n".json_encode($payload, JSON_PRETTY_PRINT)."\n", FILE_APPEND);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer '.$token
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
$response = curl_exec($ch);
$err = curl_error($ch);
// Log the response
file_put_contents('mpesa_payment_log.txt', "[".date('c')."] Response:\n".$response."\n", FILE_APPEND);
curl_close($ch);
if($err) {
    echo json_encode(['success' => false, 'message' => 'cURL error: '.$err]);
    exit;
}
$res = json_decode($response, true);
if(isset($res['ResponseCode']) && $res['ResponseCode'] == '0') {
    echo json_encode(['success' => true, 'message' => 'STK Push sent']);
} else {
    echo json_encode(['success' => false, 'message' => $res['errorMessage'] ?? 'Unknown error']);
}
