<?php
require('./dbConnection.php');
require('stripe-config.php');
session_start();

// Check if session_id & course_id are passed from Stripe
if (!isset($_GET['session_id']) || !isset($_GET['course_id'])) {
    header("Location: courses.php");
    exit;
}

$sessionId = $_GET['session_id'];
$courseId  = $_GET['course_id'];

// Retrieve Stripe session to confirm payment
try {
    $checkout_session = \Stripe\Checkout\Session::retrieve($sessionId);
} catch (Exception $e) {
    die("Error retrieving payment session: " . $e->getMessage());
}

// If payment was successful
if ($checkout_session->payment_status === 'paid') {

    // Get order details
    $stuEmail   = $checkout_session->customer_email;
    $amount     = $checkout_session->amount_total / 100; // convert paise to ₹
    
    // ✅ Use the order_id from session (set at checkout page)
    $orderId    = isset($_SESSION['order_id']) ? $_SESSION['order_id'] : "ORDS" . rand(10000, 99999999);

    $orderDate  = date("Y-m-d");

    // Get course name from DB
    $courseName = "";
    $sqlCourse = "SELECT course_name FROM course WHERE course_id = '$courseId' LIMIT 1";
    $resultCourse = $conn->query($sqlCourse);
    if ($resultCourse && $row = $resultCourse->fetch_assoc()) {
        $courseName = $row['course_name'];
    }

    // Insert into courseorder table (if not already inserted)
    $checkOrder = $conn->query("SELECT order_id FROM courseorder WHERE stu_email='$stuEmail' AND course_id='$courseId'");
    if ($checkOrder->num_rows == 0) {
        $sqlInsert = "INSERT INTO courseorder (order_id, stu_email, course_id, course_name, amount, order_date) 
                      VALUES ('$orderId', '$stuEmail', '$courseId', '$courseName', '$amount', '$orderDate')";
        $conn->query($sqlInsert);
    }

} else {
    // If payment failed
    header("Location: payment_failed.php?course_id=" . urlencode($courseId));
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payment Success</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background: #f0fdf4;
            font-family: Arial, sans-serif;
        }
        .success-box {
            max-width: 400px;
            background: #fff;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            margin: auto;
            margin-top: 10%;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }
        .circle {
            width: 100px;
            height: 100px;
            margin: auto;
            border-radius: 50%;
            background: #28a745;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 50px;
            animation: pulse 1.5s infinite;
        }
        .progress {
            height: 8px;
            margin-top: 25px;
            border-radius: 20px;
            overflow: hidden;
        }
        .progress-bar {
            animation: load 3s linear forwards;
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(40,167,69,0.7); }
            70% { box-shadow: 0 0 0 20px rgba(40,167,69,0); }
            100% { box-shadow: 0 0 0 0 rgba(40,167,69,0); }
        }
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }
        @keyframes load {
            from {width: 0%;}
            to {width: 100%;}
        }
    </style>
</head>

<body>
    <div class="success-box">
        <div class="circle">
            ✓
        </div>
        <h2 class="text-success mt-3">Payment Successful!</h2>
        <p class="text-muted">You will be redirected shortly...</p>
        <div class="progress">
            <div class="progress-bar bg-success"></div>
        </div>
    </div>

    <script>
        $(function () {
            setTimeout(function () {
                window.location.href = "coursedetails.php?course_id=<?php echo $courseId; ?>";
            }, 3500);
        });
    </script>
</body>
</html>
