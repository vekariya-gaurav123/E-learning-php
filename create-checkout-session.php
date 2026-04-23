<?php

if (!isset($_SESSION)) {
    session_start();
}

require('stripe-config.php');

// Allow JSON POST body
header('Content-Type: application/json');

// Get data from JS fetch request
$input = json_decode(file_get_contents('php://input'), true);

$courseId = $input['course_id'] ?? null;
$courseName = $input['course_name'] ?? null;
$amount = $input['amount'] ?? null;
$stuEmail = $input['stu_email'] ?? null;
$orderId = $input['order_id'] ?? null; // ✅ Now defined

// Store order_id in session for use after payment
$_SESSION['order_id'] = $orderId;

if (!$courseId || !$courseName || !$amount || !$stuEmail || !$orderId) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required fields']);
    exit;
}

try {
    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [
            [
                'price_data' => [
                    'currency' => 'inr',
                    'unit_amount' => $amount * 100, // convert to paise
                    'product_data' => [
                        'name' => $courseName,
                        'description' => 'Course Purchase',
                    ],
                ],
                'quantity' => 1,
            ]
        ],
        'customer_email' => $stuEmail,
        'mode' => 'payment',
        'success_url' => 'http://localhost/ELEARN/payment_success.php?session_id={CHECKOUT_SESSION_ID}&course_id=' . urlencode($courseId) . '&order_id=' . urlencode($orderId),
        'cancel_url' => 'http://localhost/ELEARN/payment_fail.php?course_id=' . urlencode($courseId),
    ]);

    echo json_encode(['id' => $checkout_session->id]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

?>